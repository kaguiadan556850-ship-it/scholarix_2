<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Show student dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();
        $applications = Application::where('user_id', $user->id)
            ->with('scholarship')
            ->latest()
            ->get();

        $stats = [
            'total_applications' => $applications->count(),
            'pending' => $applications->where('status', 'pending')->count(),
            'approved' => $applications->where('status', 'approved')->count(),
            'rejected' => $applications->where('status', 'rejected')->count(),
        ];

        return view('student.dashboard', compact('user', 'applications', 'stats'));
    }

    /**
     * Show available scholarships
     */
    public function scholarships()
    {
        $scholarships = Scholarship::where('status', 'active')
            ->where('deadline', '>=', now())
            ->latest()
            ->get();

        $user = Auth::user();
        $appliedScholarshipIds = Application::where('user_id', $user->id)
            ->pluck('scholarship_id')
            ->toArray();

        return view('student.scholarships', compact('scholarships', 'appliedScholarshipIds'));
    }

    /**
     * Show scholarship details
     */
    public function showScholarship(Scholarship $scholarship)
    {
        $user = Auth::user();
        $hasApplied = Application::where('user_id', $user->id)
            ->where('scholarship_id', $scholarship->id)
            ->exists();

        return view('student.scholarship-details', compact('scholarship', 'hasApplied'));
    }

    /**
     * Apply for scholarship
     */
    public function applyScholarship(Request $request, Scholarship $scholarship)
    {
        $user = Auth::user();

        // Check if already applied
        $existingApplication = Application::where('user_id', $user->id)
            ->where('scholarship_id', $scholarship->id)
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'You have already applied for this scholarship.');
        }

        // Check if scholarship is still available
        if (!$scholarship->isActive() || $scholarship->isExpired() || !$scholarship->hasAvailableSlots()) {
            return back()->with('error', 'This scholarship is no longer available.');
        }

        $validated = $request->validate([
            'essay' => ['required', 'string', 'min:100'],
        ]);

        Application::create([
            'user_id' => $user->id,
            'scholarship_id' => $scholarship->id,
            'essay' => $validated['essay'],
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Application submitted successfully!');
    }

    /**
     * Show student profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));
    }

    /**
     * Update student profile
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'course' => ['required', 'string', 'max:255'],
            'gpa' => ['nullable', 'numeric', 'min:0', 'max:5'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }
}

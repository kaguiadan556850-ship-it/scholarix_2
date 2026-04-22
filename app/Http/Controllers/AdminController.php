<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_scholarships' => Scholarship::count(),
            'active_scholarships' => Scholarship::where('status', 'active')->count(),
            'pending_applications' => Application::where('status', 'pending')->count(),
            'total_applications' => Application::count(),
        ];

        $recentApplications = Application::with(['user', 'scholarship'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications'));
    }

    /**
     * Show all students
     */
    public function students()
    {
        $students = User::where('role', 'student')
            ->withCount('applications')
            ->latest()
            ->get();

        return view('admin.students', compact('students'));
    }

    /**
     * Show student details
     */
    public function showStudent(User $student)
    {
        $applications = Application::where('user_id', $student->id)
            ->with('scholarship')
            ->latest()
            ->get();

        return view('admin.student-details', compact('student', 'applications'));
    }

    /**
     * Show all scholarships
     */
    public function scholarships()
    {
        $scholarships = Scholarship::withCount('applications')
            ->latest()
            ->get();

        return view('admin.scholarships', compact('scholarships'));
    }

    /**
     * Show create scholarship form
     */
    public function createScholarship()
    {
        return view('admin.scholarship-create');
    }

    /**
     * Store new scholarship
     */
    public function storeScholarship(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:0'],
            'deadline' => ['required', 'date', 'after:today'],
            'requirements' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'slots' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        Scholarship::create($validated);

        return redirect()->route('admin.scholarships')
            ->with('success', 'Scholarship created successfully!');
    }

    /**
     * Show edit scholarship form
     */
    public function editScholarship(Scholarship $scholarship)
    {
        return view('admin.scholarship-edit', compact('scholarship'));
    }

    /**
     * Update scholarship
     */
    public function updateScholarship(Request $request, Scholarship $scholarship)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:0'],
            'deadline' => ['required', 'date'],
            'requirements' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'slots' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $scholarship->update($validated);

        return redirect()->route('admin.scholarships')
            ->with('success', 'Scholarship updated successfully!');
    }

    /**
     * Delete scholarship
     */
    public function deleteScholarship(Scholarship $scholarship)
    {
        $scholarship->delete();

        return redirect()->route('admin.scholarships')
            ->with('success', 'Scholarship deleted successfully!');
    }

    /**
     * Show all applications
     */
    public function applications()
    {
        $applications = Application::with(['user', 'scholarship'])
            ->latest()
            ->get();

        return view('admin.applications', compact('applications'));
    }

    /**
     * Show application details
     */
    public function showApplication(Application $application)
    {
        $application->load(['user', 'scholarship']);
        return view('admin.application-details', compact('application'));
    }

    /**
     * Update application status
     */
    public function updateApplicationStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'admin_notes' => ['nullable', 'string'],
        ]);

        $application->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? null,
            'reviewed_at' => now(),
        ]);

        // Update scholarship slots if approved
        if ($validated['status'] === 'approved') {
            $scholarship = $application->scholarship;
            $scholarship->increment('slots_filled');
        }

        return back()->with('success', 'Application status updated successfully!');
    }
}


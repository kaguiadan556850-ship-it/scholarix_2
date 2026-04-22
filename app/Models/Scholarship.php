<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'amount',
        'deadline',
        'requirements',
        'status',
        'category',
        'slots',
        'slots_filled',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    /**
     * Get the applications for the scholarship.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Check if scholarship is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if scholarship has available slots
     */
    public function hasAvailableSlots(): bool
    {
        return $this->slots_filled < $this->slots;
    }

    /**
     * Check if deadline has passed
     */
    public function isExpired(): bool
    {
        return $this->deadline < now();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'staff_id',
        'appointment_date',
        'appointment_time',
        'type',
        'status',
        'reason',
        'diagnosis',
        'treatment',
        'prescription',
        'notes',
        'follow_up_date'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
        'follow_up_date' => 'date'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function getFormattedCostAttribute(): string
    {
        return '₱' . number_format($this->cost, 2);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'scheduled' => 'primary',
            'completed' => 'success',
            'cancelled' => 'danger',
            'walkin' => 'warning',
            default => 'default'
        };
    }
} 
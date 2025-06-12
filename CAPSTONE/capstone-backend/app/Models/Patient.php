<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_name',
        'owner_contact',
        'owner_email',
        'owner_address',
        'pet_name',
        'pet_species',
        'pet_breed',
        'pet_birthdate',
        'pet_gender',
        'pet_weight',
        'medical_history',
        'allergies',
        'is_active'
    ];

    protected $casts = [
        'pet_birthdate' => 'date',
        'pet_weight' => 'float',
        'is_active' => 'boolean'
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function getFullPetInfoAttribute(): string
    {
        return "{$this->pet_name} ({$this->pet_species}" . 
               ($this->pet_breed ? ", {$this->pet_breed}" : "") . 
               ") - {$this->pet_age} years old";
    }
} 
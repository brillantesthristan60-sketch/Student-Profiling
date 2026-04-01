<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address',
        'phone',
        'email',
        'photo_path',
        'year_level',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Get the user that owns the student.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the student's academic history.
     */
    public function academicHistories(): HasMany
    {
        return $this->hasMany(StudentAcademicHistory::class);
    }

    /**
     * Get the student's activities.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(StudentActivity::class);
    }

    /**
     * Get the student's violations.
     */
    public function violations(): HasMany
    {
        return $this->hasMany(StudentViolation::class);
    }

    /**
     * Get the student's skills.
     */
    public function skills(): HasMany
    {
        return $this->hasMany(StudentSkill::class);
    }

    /**
     * Get the student's affiliations.
     */
    public function affiliations(): HasMany
    {
        return $this->hasMany(StudentAffiliation::class);
    }

    /**
     * Get the student's full name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}

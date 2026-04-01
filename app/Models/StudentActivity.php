<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentActivity extends Model
{
    protected $fillable = [
        'student_id',
        'activity_name',
        'description',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the student that owns the activity.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}

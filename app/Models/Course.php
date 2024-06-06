<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_name',
        'user_id',
    ];

    

    /**
     * Get the user that owns the course.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the time slots for the course.
     */
    public function timeSlots()
    {
        return $this->hasMany(Slot::class);
    }
}


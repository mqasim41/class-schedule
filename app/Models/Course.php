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
        'class_time',
        'course_name',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'class_time' => 'datetime', // Ensure that class_time is cast to a DateTime object
    ];

    /**
     * Get the user that owns the course.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

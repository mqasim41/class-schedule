<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Slot extends Model
{
    // Define the table associated with the model
    protected $table = 'time_slots';

    // Define the fillable attributes
    protected $fillable = ['is_set', 'time', 'course_id'];

    // Define the casting for attributes
    protected $casts = [
        'time' => 'datetime:H:i', // Cast the 'time' attribute to a DateTime object with the 'H:i' format
    ];

    // Define the relationship with the Course model
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}


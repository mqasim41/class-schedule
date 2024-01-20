<?php

namespace App\Http\Controllers;
use App\Models\Course;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CourseController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        $courses = $user->courses;
        return view('course.create',['courses' => $courses]);
    }

    public function remove(Request $request)
    {
    
        $user = Auth::user();
        $courseId = $request->input('id');
        $course = $user->courses()->findOrFail($courseId);
        $course->delete();
        return redirect()->route('course.create')->with('success', 'Course removed successfully');
    }

    public function classesToday()
    {
        $user = Auth::user();
        $coursesToday = [];
        $currentDayOfWeek = Carbon::now()->dayOfWeek + 1;

        foreach ($user->courses as $course) {
            
            $classTime = Carbon::parse($course->class_time);

            // Check if the day of the week matches the current day
            if ($classTime->dayOfWeek + 1 == $currentDayOfWeek) {
                $coursesToday[] = $course;
            }
        }

        return view('dashboard', ['coursesToday' => $coursesToday]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_time' => 'nullable|date',
            'course_name' => 'required|string|max:255',
        ]);

        // Get the authenticated user (assuming you're using Laravel's built-in authentication)
        $user = Auth::user();

        // Create a new course associated with the authenticated user
        $user->courses()->create([
            'class_time' => $request->input('class_time'),
            'course_name' => $request->input('course_name'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Course created successfully');
    }
    public function toggle(Request $request)
    {
        $user = Auth::user();
        $coursesThisWeek = $user->courses->groupBy(function ($course) {
            // Group courses by the day of the week
            return Carbon::parse($course->class_time)->format('l'); // 'l' returns the full textual representation of the day
        });
        $toggleValue = $request->input('toggleSwitch');
        if($toggleValue == "on"){

                return view('course.weekly', compact('coursesThisWeek'));
        }
        else{
            return $this->classesToday();
        }           
    }
}

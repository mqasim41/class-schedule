<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Slot;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CourseController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        $courses = $user->courses;
        $workingDays = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
        $timeSlots = Slot::all();
        return view('course.create',compact('courses','timeSlots','workingDays'));
    }

    public function remove(Request $request)
    {
    
        $user = Auth::user();
        $courseId = $request->input('id');
        $course = $user->courses()->findOrFail($courseId);
        $slots = $course->timeSlots;
        $breakCourse = Course::where('course_name', 'Break')->first();
        foreach($slots as $slot){
            $slot->update([
                'course_id' => $breakCourse->id,
            ]);
        }
        $course->delete();
        return redirect()->route('course.create')->with('success', 'Course removed successfully');
    }

    public function classesToday()
    {
        
        $today = Carbon::today()->format('l'); // 'l' format gives the full day name

        // Get all slots where the day is today
        $todaySlots = Slot::whereDay('time', '=', $today)->get();

        return view('dashboard', ['slotsToday' => $todaySlots]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
        ]);

        // Get the authenticated user (assuming you're using Laravel's built-in authentication)
        $user = Auth::user();

        // Create a new course associated with the authenticated user
        $user->courses()->create([
            'class_time' => null,
            'course_name' => $request->input('course_name'),
        ]);

        return redirect()->route('course.create')->with('success', 'Course created successfully');
    }
    public function toggle(Request $request)
    {
        $workingDays = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
        $user = Auth::user();
        $timeSlots = Slot::all();
        $toggleValue = $request->input('toggleSwitch');
        if($toggleValue == "on"){

                return view('course.weekly', compact('timeSlots','workingDays'));
        }
        else{
            return $this->classesToday();
        }           
    }

    public function update(Request $request)
    {
    
    $request->validate([
        'course_id' => 'required|array',
        
    ]);

    
    foreach ($request->input('course_id') as $slotId => $dayCourses) {
        foreach ($dayCourses as $day => $courseId) {
            
            $slot = Slot::findOrFail($slotId);

            $slot->update([
                'course_id' => $courseId,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Courses updated successfully!');
}
}

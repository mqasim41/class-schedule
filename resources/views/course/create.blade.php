@extends('layouts.app')

@section('content')

<div class="container">


    
    @foreach($courses as $course)
        <div class="row justify-content-center text-center">
            <div class="mt-2 bg-white p-2 col-6 shadow mb-3">
                <span class="float-start mt-1">{{ $course->course_name }}</span>
                <span class="float-end">
                    {{ $course->class_time->format('H:i') }}-{{ $course->class_time->addMinutes(50)->format('H:i') }}
                    <a href="{{ route('course.remove', ['id' => $course->id]) }}" class="btn btn-danger btn-sm">Remove</a>
                </span>
            </div>
        </div>
    @endforeach

    

    
    

    

    <form action="{{ route('course.store') }}" method="post">
        @csrf

        <div class="row justify-content-center text-center">
            <div class="col-6">
                <div class="display-6 mb-3">Add Your Courses</div>
                <label for="class_time" class="form-label mb-3">Class Time:</label>
                <input type="datetime-local" class="form-control " id="class_time" name="class_time">
            </div>
            
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-6">
                <label for="course_name" class="form-label">Course Name:</label>
                <input type="text" class="form-control mb-3" id="course_name" name="course_name">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
            
        </div>

        

        
    </form>

</div>

@endsection

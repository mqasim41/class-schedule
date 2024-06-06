@extends('layouts.app')

@section('content')

<div class="container-xl">
    <div class="row">
        <!-- Main content with form and table -->
        <div class="col-md-9">
            <form action="{{ route('course.store') }}" method="post">
                @csrf
                
                <div class="row justify-content-center text-center mt-3">
                    <div class="col-12 col-lg-6">
                        <label for="course_name" class="form-label">Course Name:</label>
                        <input type="text" class="form-control mb-3" id="course_name" name="course_name">
                        <button type="submit" class="btn btn-outline-primary">Add</button>
                    </div>
                </div>
            </form>

            <form method="post" action="{{ route('course.update') }}" class='row justify-content-center'>
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Timeslot</th>
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                                    <th>{{ $day }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class='form-input'>9:00-9:50</div>
                                    <div class='form-input'>10:00-10:50</div>
                                    <div class='form-input'>11:00-11:50</div>
                                    <div class='form-input'>12:00-12:50</div>
                                    <div class='form-input'>13:00-13:50</div>
                                    <div class='form-input'>14:00-14:50</div>
                                    <div class='form-input'>15:00-15:50</div>
                                    <div class='form-input'>16:00-16:50</div>
                                </td>
                                @foreach($workingDays as $day)
                                    <td>
                                        @foreach($timeSlots as $timeSlot)
                                            @if($timeSlot->time->isoFormat('dddd') == $day)
                                            <select class="form-select" name="course_id[{{ $timeSlot->id }}][{{ $day }}]">
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}" {{ $course->id == optional($timeSlot->course)->id ? 'selected' : '' }}>
                                                        {{ $course->course_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-outline-danger mb-5 col-12 col-lg-6">Set Schedule</button>
            </form>
        </div>

        <!-- Sidebar with courses on the right -->
        <div class="col-md-3 mt-3">
            <div class="text-center bold">Your Courses:</div>
            @foreach($courses as $course)
                @if($course->course_name != "Break")
                    <div class="bg-white col-12 p-2 shadow m-3 d-flex align-items-center justify-content-between">
                        <span class="mt-1">{{ $course->course_name }}</span>
                        <a href="{{ route('course.remove', ['id' => $course->id]) }}" class="btn btn-danger btn-sm">Remove</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection

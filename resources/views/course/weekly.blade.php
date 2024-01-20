@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mt-2 ml-3">
        <form id="toggleForm" method="get" action="{{ route('handleToggle') }}">
            @csrf
            <div class="row">
                <div class="form-check form-switch">
                    <input type="hidden" name="view_type" value="weekly"> <!-- Updated to weekly view -->
                    <input class="form-check-input" type="checkbox" id="toggleSwitch" name="toggleSwitch" checked onclick="toggleFormSubmit()">
                    <label class="form-check-label" for="toggleSwitch">Weekly</label>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($coursesThisWeek as $day => $courses)
                        <td>
                            @foreach($courses as $course)
                                <div class="mt-2 bg-white p-2 col-12 border-3">
                                    {{ $course->course_name }} <br>
                                    {{ $course->class_time->format('H:i') }}-{{ $course->class_time->addMinutes(50)->format('H:i') }}
                                </div>
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
    function toggleFormSubmit() {
        document.getElementById('toggleForm').submit();
    }
</script>

@endsection

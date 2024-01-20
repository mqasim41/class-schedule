@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mt-2 ml-3">
        <form id="toggleForm" method="get" action="{{ route('handleToggle') }}">
            @csrf
            <div class="row">
                <div class="form-check form-switch">
                    <input type="hidden" name="view_type" value="weekly"> <!-- Default to daily view -->
                    <input class="form-check-input" type="checkbox" id="toggleSwitch" name="toggleSwitch" onclick="toggleFormSubmit()">
                    <label class="form-check-label" for="toggleSwitch">Weekly</label>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center text-center">
        @if(is_array($coursesToday) && empty($coursesToday))
            <div class="alert alert-info mt-3" role="alert">
                No classes today.
            </div>
        @elseif($coursesToday->isEmpty())
            <div class="alert alert-info mt-3" role="alert">
                No classes today.
            </div>
        @else
            @foreach($coursesToday as $course)
                <div class="mt-2 bg-white p-2 col-6 shadow">
                    {{ $course->course_name }} <br>
                    {{ $course->class_time->format('H:i') }}-{{ $course->class_time->addMinutes(50)->format('H:i') }}
                </div>
            @endforeach
        @endif
    </div>

</div>

<script>
    function toggleFormSubmit() {
        document.getElementById('toggleForm').submit();
    }
</script>

@endsection

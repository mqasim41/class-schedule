@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-2 ml-3">
        <form id="toggleForm" method="get" action="{{ route('handleToggle') }}">
            @csrf
            <div class="row">
                <div class="form-check form-switch">
                    <input type="hidden" name="view_type" value="weekly">
                    <input class="form-check-input" type="checkbox" id="toggleSwitch" name="toggleSwitch" checked onclick="toggleFormSubmit()">
                    <label class="form-check-label" for="toggleSwitch">Weekly</label>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center text-center">
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
                            <div class="mt-2 bg-white p-2 col-12 border-3">9:00-9:50</div>
                            <div class="mt-2 bg-white p-2 col-12 border-3">10:00-10:50</div>
                            <div class="mt-2 bg-white p-2 col-12 border-3">11:00-11:50</div>
                            <div class="mt-2 bg-white p-2 col-12 border-3">12:00-12:50</div>
                            <div class="mt-2 bg-white p-2 col-12 border-3">13:00-13:50</div>
                            <div class="mt-2 bg-white p-2 col-12 border-3">14:00-14:50</div>
                            <div class="mt-2 bg-white p-2 col-12 border-3">15:00-15:50</div>
                            <div class="mt-2 bg-white p-2 col-12 border-3">16:00-16:50</div>
                        </td>
                        @foreach($workingDays as $day)
                            <td>
                                @foreach($timeSlots as $timeSlot)
                                    @if($timeSlot->time->isoFormat('dddd') == $day)
                                        @if($timeSlot->course->course_name == "Break")
                                            <div class="mt-2 bg-white p-2 col-12 border-3 text-danger fw-bold">
                                                {{ $timeSlot->course->course_name }}
                                            </div>
                                        @else
                                            <div class="mt-2 bg-white p-2 col-12 border-3">
                                                {{ $timeSlot->course->course_name }}
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleFormSubmit() {
        document.getElementById('toggleForm').submit();
    }
</script>

@endsection

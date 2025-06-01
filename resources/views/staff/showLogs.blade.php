@extends('master')
@section('content')

    @php

        function convertMinutesToHoursMins($minutes)
        {
            $hours = floor($minutes / 60);
            $mins = $minutes % 60;

            $result = '';
            if ($hours > 0) {
                $result .= $hours . ' hr' . ($hours > 1 ? 's' : '');
            }

            if ($mins > 0) {
                if ($result != '') {
                    $result .= ' and ';
                }
                $result .= $mins . ' min' . ($mins > 1 ? 's' : '');
            }

            return $result;
        }
    @endphp
    <style>
        .sidebar {
            height: 100vh;
            overflow-y: auto;
            background-color: #ffffff;
            color: #333;
            border-right: 1px solid #ddd;
        }

        .sidebar a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            display: block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .sidebar a:hover {
            background-color: #f5f5f5;
            text-decoration: none;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1rem;
        }

        .day-box {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            padding: 1rem;
            min-height: 100px;
            text-align: center;
        }

        .present {
            background-color: #d1f2eb;
            color: #1b5e20;
            font-weight: bold;
        }

        .absent {
            background-color: #f8d7da;
            color: #b71c1c;
            font-weight: bold;
        }

        .onLeave {
            background-color: #f0f0f0;
            color: #555;
            font-weight: bold;
        }
    </style>
    <!-- Calendar -->
    <div class="d-flex justify-content-center align-items-center">
        <div class="col-md-9 col-lg-10 p-4">
            <a href="{{url()->previous()}}" class="btn btn-outline-primary"
                style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
                Back
            </a>
            <br>

            <h2 class="mb-4">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }} - {{ now()->format('F Y') }}</h2>

            @php
                $start = \Carbon\Carbon::now()->startOfMonth();
                $end = \Carbon\Carbon::now()->endOfMonth();
                $daysInMonth = $start->daysInMonth;
                $firstDayOfWeek = $start->dayOfWeek;
            @endphp

            <div class="d-grid" style="grid-template-columns: repeat(7, 1fr); font-weight: bold; text-align: center;">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>

            <div class="calendar-grid mt-2">
                {{-- Empty boxes before first day --}}
                @for($i = 0; $i < $firstDayOfWeek; $i++)
                    <div></div>
                @endfor

                {{-- Calendar days --}}
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $ctr = 0;
                        $date = $start->copy()->addDays($day - 1)->format('Y-m-d');
                        $log = $attendance[$day - 1]->log_date == $date ? $attendance[$ctr] : null;

                        $statusClass = '';
                        $hoursWorked = null;

                        if ($log) {
                            $statusClass = $log->status;
                            $ctr++;

                        }
                    @endphp

                    <div class="day-box {{ $statusClass }}">
                        <strong>{{ $day }}</strong><br>
                        <span>{{ ucfirst($statusClass) }}</span><br>

                        @if($log && $statusClass === 'present')
                            <small>AM In: {{ Carbon\Carbon::parse($log->am_in)->format('g:i A') ?? 'N/A' }}</small><br>
                            <small>AM Out: {{ Carbon\Carbon::parse($log->am_out)->format('g:i A') ?? 'N/A' }}</small><br>
                            <small>PM In: {{ Carbon\Carbon::parse($log->pm_in)->format('g:i A') ?? 'N/A' }}</small><br>
                            <small>PM Out: {{ Carbon\Carbon::parse($log->pm_out)->format('g:i A') ?? 'N/A' }}</small><br>
                            <small>Undertime: {{convertMinutesToHoursMins($log->undertime)}}</small>


                        @endif
                    </div>
                @endfor
            </div>


        </div>
    </div>

@endsection



<!-- Navbar -->


<!-- Main Content -->
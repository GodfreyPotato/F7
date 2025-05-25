@extends('master')
@section('content')

    <div class="container mt-4">
        <div class="d-flex">
            <!-- profile card -->
            <div class="p-4 me-4"
                style="width: 30%; height: 30%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <span style="font-size: 20px;"
                    class="fw-bold d-flex justify-content-center mb-3 mt-2">{{Auth::user()->firstname}}
                    {{Auth::user()->lastname}}</span>
                <div class="d-flex justify-content-between" style="margin-bottom: -10px;">
                    <p style="color: #878585;">Department:</p>
                    <p>{{Auth::user()->department}}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p style="color: #878585">Type of Employee:</p>
                    <p>{{Auth::user()->role == "ins" ? "Instructional Staff" : "Non-Instructional Staff"}}</p>
                </div>
                <div>
                    <a href="" class="btn d-flex justify-content-center" style="background-color: #1D4ED8; color: white;">
                        <img src="{{ asset('images/edit-contained.png') }}"
                            style="width: 23px; height: 23px; margin-right: 8px;">
                        Edit Profile
                    </a>
                </div>
            </div>

            <!-- right column -->
            <div class="d-flex flex-column" style="width: 68%; height: 30%; gap: 20px;">
                <!-- Attendance Logs-->
                <div class="p-4"
                    style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                    <div class="d-flex justify-content-between ">
                        <span style="font-size: 20px;" class="fw-bold">Attendance Logs</span>
                        <a href="{{route('showLogs')}}" class="btn d-flex justify-content-center"
                            style="background-color: #1D4ED8; color: white;">
                            View Logs
                        </a>

                    </div>
                    <div>
                        <span style="font-size: 20px;" class="fw-light mb-3"><span id="clock"></span> |
                            <span class="fw-semibold"> {{now()->hour < 12 ? "Morning" : "Afternoon" }}</span></span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">

                        {{-- AM time in --}}
                        @if (now()->hour > 17)

                            <div class="p-2 me-2 "
                                style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">Time In</p>
                                    <span class="fw-bold" style="font-size: 24px; margin: 0;">
                                        {{$log == null || $log->am_in == null ? "--:--" : Carbon\Carbon::parse($log->am_in)->format('g:i A')}}
                                    </span>

                                    @if ($log == null || $log->am_in == null)
                                        <form action="{{route('timeInAm')}}" method="post">
                                            @csrf
                                            <button class="btn"
                                                style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                Time In
                                            </button>
                                        </form>
                                    @else
                                        <span class=" fw-bold"
                                            style="background-color:#D1FADF; color:#00764C;  width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">Present</span>
                                    @endif

                                </div>
                            </div>

                            <div class="p-2 me-2 "
                                style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">Time Out</p>
                                    <span class="fw-bold" style="font-size: 24px; margin: 0;">
                                        {{ $log == null || $log->am_out == null ? "--:--" : Carbon\Carbon::parse($log->am_out)->format('g:i A')}}
                                    </span>

                                    @if ($log == null || $log->am_out == null)
                                        <form action="{{route('timeOutAm')}}" method="post">
                                            @csrf
                                            <button class="btn"
                                                style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                Time Out
                                            </button>
                                        </form>
                                    @else
                                        <span class=" fw-bold"
                                            style="background-color:#BCBCBC; color:white;  width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">Timed
                                            Out
                                        </span>
                                    @endif

                                </div>
                            </div>
                        @else


                            {{-- PM time in --}}
                            <div class="p-2 me-2 "
                                style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">Time In</p>
                                    <span class="fw-bold" style="font-size: 24px; margin: 0;">
                                        {{$log == null || $log->pm_in == null ? "--:--" : Carbon\Carbon::parse($log->pm_in)->format('g:i A')}}
                                    </span>

                                    @if ($log == null || $log->pm_in == null)
                                        <form action="{{route('timeInPm')}}" method="post">
                                            @csrf
                                            <button class="btn"
                                                style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                Time In
                                            </button>
                                        </form>
                                    @else
                                        <span class=" fw-bold"
                                            style="background-color:#D1FADF; color:#00764C;  width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">Present</span>
                                    @endif

                                </div>
                            </div>

                            <div class="p-2 me-2 "
                                style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">Time Out</p>
                                    <span class="fw-bold" style="font-size: 24px; margin: 0;">
                                        {{$log == null || $log->pm_out == null ? "--:--" : Carbon\Carbon::parse($log->pm_out)->format('g:i A')}}
                                    </span>

                                    @if ($log == null || $log->pm_out == null)
                                        <form action="{{route('timeOutPm')}}" method="post">
                                            @csrf
                                            <button class="btn"
                                                style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                Time Out
                                            </button>
                                        </form>
                                    @else
                                        <span class=" fw-bold"
                                            style="background-color:#BCBCBC; color:white;  width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">Timed
                                            Out </span>
                                    @endif

                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Attendance Log 2 -->
                <div class="p-4"
                    style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                    <div class="d-flex justify-content-between">
                        <span style="font-size: 20px;" class="fw-bold">Recent Leave Requests</span>
                        <a href="{{route('letter.index')}}" class="btn d-flex justify-content-center"
                            style="background-color: #1D4ED8; color: white;">
                            <img src="{{ asset('images/plus.png') }}" style="width: 23px; height: 23px; margin-right: 8px;">
                            Apply Leave
                        </a>
                    </div>
                    <div class="d-flex flex-column gap-3 mt-3">

                        @foreach ($letters as $letter)
                            <div class="p-3"
                                style="width: 100%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center;">
                                    <!-- Vertical line -->
                                    <div
                                        style="width: 5px; height: 40px;  {{$letter->letter_status == "pending" ? "background-color: #EAB308;" : ($letter->letter_status == "rejected" ? "background-color:  red;" : "background-color:  #0F7552;") }} margin-right: 10px; border-radius: 2px;">
                                    </div>
                                    <div>
                                        <div style="font-weight: bold;">{{$letter->cause}}</div>
                                        @php

                                            $start = Carbon\Carbon::parse($letter->start_date);
                                            $end = Carbon\Carbon::parse($letter->end_date);
                                        @endphp

                                        <div style="font-size: 14px; color: #666;">
                                            @if ($start->equalTo($end))
                                                {{ $start->format('F j, Y') }}
                                            @elseif ($start->month === $end->month && $start->year === $end->year)
                                                {{ $start->format('F j') }}–{{ $end->format('j, Y') }}
                                            @else
                                                {{ $start->format('F j') }} – {{ $end->format('F j, Y') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- status badge -->
                                <span class="badge d-flex justify-content-center align-items-center fw-bold"
                                    style="  {{$letter->letter_status == "pending" ? "background-color: #FFF6D9; color: #EAB308;" : ($letter->letter_status == "rejected" ? "background-color: red; color: red;" : "background-color: #D1FADF; color: #0F7552;") }} font-size: 14px; padding: 6px 12px; border-radius: 5px;">
                                    <img src="{{$letter->letter_status == "pending" ? asset('images/clock2.png') : ($letter->letter_status == "rejected" ? asset('images/x.png') : asset('images/check.png')) }}"
                                        style="width: 20px; height: 20px;">
                                    {{Str::ucfirst($letter->letter_status)}}
                                </span>
                            </div>
                        @endforeach
                        {{-- <div class="p-3"
                            style="width: 100%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center;">
                                <!-- Vertical line -->
                                <div
                                    style="width: 5px; height: 40px; background-color: #FFE699; margin-right: 10px; border-radius: 2px;">
                                </div>
                                <div>
                                    <div style="font-weight: bold;">Vacation Leave</div>
                                    <div style="font-size: 14px; color: #666;">March 20-22, 2025</div>
                                </div>
                            </div>

                            <!-- status badge -->
                            <span class="badge d-flex justify-content-center align-items-center fw-bold"
                                style="background-color: #FFF6D9; color: #EAB308; font-size: 14px; padding: 6px 12px; border-radius: 5px;">
                                <img src="{{ asset('images/clock2.png') }}"
                                    style="width: 20px; height: 20px; margin-right: 10px">
                                Pending
                            </span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function updateTime() {
            const now = new Date();
            document.getElementById("clock").textContent = now.toLocaleString();
        }
        setInterval(updateTime, 1000);
        updateTime(); 
    </script>
@endsection
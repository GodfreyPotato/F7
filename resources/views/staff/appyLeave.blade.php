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
                                            <span style="font-size: 20px;" class="fw-bold">Apply Leave Request</span>

                    
                </div>
            </div>
        </div>
    </div
@endsection
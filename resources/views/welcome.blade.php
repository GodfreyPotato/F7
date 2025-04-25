{{-- <h1> This is home</h1> --}}
@extends('master')
@section('content')
    @if(auth()->check())
    <div class="container mt-4">
        <div class="d-flex">
            <!-- profile card -->
            <div class="p-4 me-4" style="width: 30%; height: 30%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <span style="font-size: 20px;" class="fw-bold d-flex justify-content-center mb-3 mt-2">Godfrey Javier</span>
                <div class="d-flex justify-content-between" style="margin-bottom: -10px;">
                    <p style="color: #878585;">Department:</p>
                    <p>Information Technology</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p style="color: #878585">Type of Employee:</p>
                    <p>Instructional Staff</p>
                </div>
                <div>
                <a href="" class="btn d-flex justify-content-center" style="background-color: #1D4ED8; color: white;">
                    <img src="{{ asset('images/edit-contained.png') }}" style="width: 23px; height: 23px; margin-right: 8px;">
                    Edit Profile
                </a>
                </div>
            </div>

            <!-- right column -->
            <div class="d-flex flex-column" style="width: 68%; height: 30%; gap: 20px;">
                <!-- Attendance Logs-->
                <div class="p-4" style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                    <div class="d-flex justify-content-between mb-3">
                        <span style="font-size: 20px;" class="fw-bold">Attendance Logs</span>
                        <a href="" class="btn d-flex justify-content-center" style="background-color: #1D4ED8; color: white;">
                            View DTR
                        </a>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div class="p-2 me-2" style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">Time In</p>
                                <span class="fw-bold" style="font-size: 24px; margin: 0;">--:--</span>
                                <span class="btn" style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                    Time In
                                </span>
                            </div>
                        </div>

                        <div class="p-2 ms-2" style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">Time Out</p>
                                <span class="fw-bold" style="font-size: 24px; margin: 0;">--:--</span>
                                <span class="btn" style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                    Time Out
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Log 2 -->
                <div class="p-4" style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                    <div class="d-flex justify-content-between">
                        <span style="font-size: 20px;" class="fw-bold">Recent Leave Requests</span>
                        <a href="" class="btn d-flex justify-content-center" style="background-color: #1D4ED8; color: white;">
                            <img src="{{ asset('images/plus.png') }}" style="width: 23px; height: 23px; margin-right: 8px;">
                            Apply Leave
                        </a>
                    </div>
                    <div class="d-flex flex-column gap-3 mt-3">
                        <div class="p-3" style="width: 100%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center;">
                                <!-- Vertical line -->
                                <div style="width: 5px; height: 40px; background-color: #00764C; margin-right: 10px; border-radius: 2px;"></div>
                                <div>
                                    <div style="font-weight: bold;">Sick Leave</div>
                                    <div style="font-size: 14px; color: #666;">April 10-12, 2025</div>
                                </div>
                            </div>

                            <!-- status badge -->
                            <span class="badge d-flex justify-content-center align-items-center fw-bold" style="background-color: #D1FADF; color: #0F7552; font-size: 14px; padding: 6px 12px; border-radius: 5px;">
                                <img src="{{ asset('images/check.png') }}" style="width: 20px; height: 20px;">
                                Approved
                            </span>
                        </div>

                        <div class="p-3" style="width: 100%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center;">
                                <!-- Vertical line -->
                                <div style="width: 5px; height: 40px; background-color: #FFE699; margin-right: 10px; border-radius: 2px;"></div>
                                <div>
                                    <div style="font-weight: bold;">Vacation Leave</div>
                                    <div style="font-size: 14px; color: #666;">March 20-22, 2025</div>
                                </div>
                            </div>

                            <!-- status badge -->
                            <span class="badge d-flex justify-content-center align-items-center fw-bold" style="background-color: #FFF6D9; color: #EAB308; font-size: 14px; padding: 6px 12px; border-radius: 5px;">
                                <img src="{{ asset('images/clock2.png') }}" style="width: 20px; height: 20px; margin-right: 10px">
                                Pending
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <div class="container" > -->
            <!-- banner -->
            <!-- <div class="card mb-4" style="background-color: #1E3A8A; color: white; border: none; border-radius: 8px; height: 300px;">
                <div class="card-body d-flex justify-content-between align-items-center h-100 px-5">
                    <div class="d-flex flex-column justify-content-center">
                        <h1 style="margin-bottom: 0;">Welcome Back, {{ auth()->user()->name }}!</h1>
                        <p style="margin-bottom: 0;">Here's what's happening in your HR system today.</p>
                    </div>
                    <div class="p-4" style="margin-bottom: 100px;">
                        <img src="{{ asset('images/Saly-10.png') }}" style="max-height: 350px;">
                    </div>
                </div>
            </div> -->

            <!-- 4 buttons -->
            <!-- <div class="row" style="margin-top: 87px;">
                <div class="col-6 col-md-3 mb-4">
                    <a href="" class="text-decoration-none">
                        <div class="card h-100 text-center" style="padding-top: 16px; padding-bottom: 16px; background-color: #0d6efd;">
                            <div class="card-body">
                                <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
                                    <img src="{{ asset('images/user-profile-group.png') }}" style="height: 45px; width: 45px;">
                                </div>
                                <h5 class="card-title" style="color: white;">View Employees</h5>
                                <p class="card-text" style="color: white; font-size: 14px;">Total employees</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-6 col-md-3 mb-4">
                    <a href="" class="text-decoration-none">
                        <div class="card h-100 text-center" style="padding-top: 16px; padding-bottom: 16px; background-color: #0d6efd;">
                            <div class="card-body">
                                <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
                                    <img src="{{ asset('images/calendar-check.png') }}" style="height: 45px; width: 45px;">
                                </div>
                                <h5 class="card-title" style="color: white;">Leave Requests</h5>
                                <p class="card-text" style="color: white; font-size: 14px;">Pending approval</p>
                            </div>
                        </div>
                    </a>
                </div> -->

                <!-- <div class="col-6 col-md-3 mb-4">
                    <a href="" class="text-decoration-none">
                        <div class="card h-100 text-center" style="padding-top: 16px; padding-bottom: 16px; background-color: #0d6efd;">
                            <div class="card-body">
                                <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
                                    <img src="{{ asset('images/user-profile-add.png') }}" style="height: 40px; width: 40px;">
                                </div>
                                <h5 class="card-title" style="color: white;">Add Employee</h5>
                                <p class="card-text" style="color: white; font-size: 14px;">Create new record</p>
                            </div>
                        </div>
                    </a>
                </div> -->
<!-- 
                <div class="col-6 col-md-3 mb-4">
                    <a href="" class="text-decoration-none">
                        <div class="card h-100 text-center" style="padding-top: 16px; padding-bottom: 16px; background-color: #0d6efd;">
                            <div class="card-body">
                                <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
                                    <img src="{{ asset('images/icons-pdf.png') }}" style="height: 32px; width: 25px;">
                                </div>
                                <h5 class="card-title" style="color: white;">PDF Preview</h5>
                                <p class="card-text" style="color: white; font-size: 14px;">View reports</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div> -->

            <!-- Stat Cards -->
            <!-- <div class="row g-3 mt-3">
                <div class="col-12 col-md-4">
                    <div class="card" style="border-radius: 12px; border: 1px solid #eaeaea; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                        <div class="card-body d-flex justify-content-between align-items-center" style="padding: 16px;">
                            <div>
                                <p style="color: #6c757d; margin-bottom: 4px; font-size: 14px;">Total employees</p>
                                <h2 style="margin-bottom: 0; font-weight: 700;">54</h2>
                            </div>
                            <div style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background-color: rgba(13, 110, 253, 0.1);">
                                <img src="{{ asset('images/user-profile-group-b.png') }}" style="height: 25px; width: 25px;">
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="col-12 col-md-4">
                    <div class="card" style="border-radius: 12px; border: 1px solid #eaeaea; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                        <div class="card-body d-flex justify-content-between align-items-center" style="padding: 16px;">
                            <div>
                                <p style="color: #6c757d; margin-bottom: 4px; font-size: 14px;">Pending Requests</p>
                                <h2 style="margin-bottom: 0; font-weight: 700;">11</h2>
                            </div>
                            <div style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background-color: #DBEAFE;">
                                <img src="{{ asset('images/clock.png') }}" style="height: 25px; width: 25px;">
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="col-12 col-md-4">
                    <div class="card" style="border-radius: 12px; border: 1px solid #eaeaea; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                        <div class="card-body d-flex justify-content-between align-items-center" style="padding: 16px;">
                            <div>
                                <p style="color: #6c757d; margin-bottom: 4px; font-size: 14px;">Departments</p>
                                <h2 style="margin-bottom: 0; font-weight: 700;">3</h2>
                            </div>
                            <div style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background-color:  #DBEAFE;">
                                <img src="{{ asset('images/office-building.png') }}" style="height: 25px; width: 25px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    @else
        <h1>This is home</h1>
        <a href="{{route('auth.login')}}">Login Here</a>
    @endif
@endsection
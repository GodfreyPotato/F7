{{-- <h1> This is home</h1> --}}
@extends('master')
@section('content')
    @if(auth()->check())
    <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <div class="container" >
            <!-- banner -->
            <div class="card mb-4" style="background-color: #1E3A8A; color: white; border: none; border-radius: 8px; height: 300px;">
                <div class="card-body d-flex justify-content-between align-items-center h-100 px-5">
                    <div class="d-flex flex-column justify-content-center">
                        <h1 style="margin-bottom: 0;">Welcome Back, {{ auth()->user()->name }}!</h1>
                        <p style="margin-bottom: 0;">Here's what's happening in your HR system today.</p>
                    </div>
                    <div class="p-4" style="margin-bottom: 100px;">
                        <img src="{{ asset('images/Saly-10.png') }}" style="max-height: 350px;">
                    </div>
                </div>
            </div>

            <!-- 4 buttons -->
            <div class="row">
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
                </div>

                <div class="col-6 col-md-3 mb-4">
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
                </div>

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
            </div>

            <!-- Stat Cards -->
            <div class="row g-3 mt-3">
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
                </div>

                <div class="col-12 col-md-4">
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
                </div>

                <div class="col-12 col-md-4">
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
    </div>
    @else
        <h1>This is home</h1>
        <a href="{{route('auth.login')}}">Login Here</a>
    @endif
@endsection
@extends('master')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-sm w-100" style="max-width: 500px;">
            <h3 class="text-center mb-4">Create Account</h3>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('registration.store') }}">
                @csrf

                <div class="d-flex justify-content-between">
                    <div class="mb-3" style="width:45%;">
                        <label for="name" class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control" id="name" value="{{ old('firstname') }}"
                            required>
                    </div>
                    <div class="mb-3" style="width:45%;">
                        <label for="name" class="form-label">Middle Name</label>
                        <input type="text" name="middlename" class="form-control" id="name" value="{{ old('middlename') }}"
                            required>
                    </div>
                    <div class="mb-3" style="width:45%;">
                        <label for="name" class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control" id="name" value="{{ old('lastname') }}"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Department</label>
                    <select name="department" class="form-control">
                        <option value="" disabled selected>Select Department</option>
                        <option value="NI">Non Instructional</option>
                        <option value="BSCE">BS Civil Engineering</option>
                        <option value="BSME">BS Mechanical Engineering</option>
                        <option value="BSEE">BS Electrical Engineering</option>
                        <option value="BSCoE">BS Computer Engineering</option>
                        <option value="BSMATH">BS Mathematics</option>
                        <option value="BSA">BS Architecture</option>
                        <option value="BSIT">BS Information Technology</option>
                        <option value="ABEL">AB English Language</option>
                        <option value="BSE">Bachelor of Secondary Education</option>
                        <option value="BSECE">Bachelor of Early Childhood Education</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                        required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="mt-3">Already have an account? <a href="{{route('login.index')}}">Login</a> </div>
        </div>

    </div>
@endsection
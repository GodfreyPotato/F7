<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <div class="d-flex justify-content-center align-items-center ">
        <div class="d-flex justify-content-around align-items-center min-vh-100" style="width: 90%;">
        <div class="w-50">
            <img src="{{ asset('images/pangasinan-state-university.jpg') }}" style="width: 42vw; height: 45vw;">
        </div>
        <div >
            <div style="width: 329px; height: 59px; flex-shrink: 0; background-color: #EFF6FF; border-radius: 6px" class="d-flex justify-content-center align-items-center mx-auto">
                <h4 class="text-center fw-bold" style="color: #1E3A8A;">Create Account</h4>
            </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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

            <form method="POST" action="{{ route('registration.store') }}" class="mt-4">
                @csrf

                <div class="d-flex justify-content-between">
                    <div class="mb-3" style="width:30%;">
                        <label for="name" class="form-label">First Name</label>
                        <input type="text" name="firstname" class="form-control" id="name" value="{{ old('firstname') }}"
                            required style="height: 3vw;">
                    </div>
                    <div class="mb-3" style="width:30%;">
                        <label for="name" class="form-label">Middle Name</label>
                        <input type="text" name="middlename" class="form-control" id="name" value="{{ old('middlename') }}"
                            required style="height: 3vw;">
                    </div>
                    <div class="mb-3" style="width:30%;">
                        <label for="name" class="form-label">Last Name</label>
                        <input type="text" name="lastname" class="form-control" id="name" value="{{ old('lastname') }}"
                            required style="height: 3vw;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required style="height: 3vw;">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Department</label>
                    <select name="department" class="form-control" style="height: 3vw;">
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
                    <input type="password" name="password" class="form-control" id="password" required style="height: 3vw;">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                        required style="height: 3vw;">
                </div>

                <button type="submit" class="btn btn-primary w-100"  style="height: 3vw;">Register</button>
            </form>
            <div class="mt-5 d-flex justify-content-center align-items-center">Already have an account?&nbsp;<a href="{{route('login')}}">Login</a> </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>


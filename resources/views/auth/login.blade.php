<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <h4 class="text-center fw-bold" style="color: #1E3A8A;">Login</h4>
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

                <form method="POST" action="{{ route('login.store') }}" class="mt-3">
                    @csrf

                    <div class="mb-3">
                        @error('email')
                            <span>{{$message}}</span>
                        @enderror
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required style="height: 3vw; width: 25vw;">
                    </div>

                    <div class="mb-3">
                        @error('password')
                            <span>{{$message}}</span>
                        @enderror
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required style="height: 3vw; width: 25vw;">
                    </div>

                    <button type="submit" class="btn btn-primary w-100" style="height: 3vw; width: 25vw;">Login</button>
                </form>
                <div class="mt-3 d-flex justify-content-end"><a href="{{route('password.request')}}">Forgot Password?</a> </div>
                <div class="mt-5 d-flex justify-content-center align-items-center">Doesn't have an account? <a href="{{route('registration.index')}}">Sign Up</a> </div>
                
            </div>
        </div>
    </div>
    </div>
</body>
</html>

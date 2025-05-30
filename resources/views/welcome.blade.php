<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Welcome</title>
</head>
<body style="margin: 0; height: 100vh; background: linear-gradient(135deg, #002766, #1E40AF); display: flex; justify-content: center; align-items: center;">
    <div class="d-flex flex-column">
        <img src="{{ asset('images/fullLogo.png') }}" style="width: 10vw">
    <img src="{{ asset('images/psu.png') }}">

   @auth
     <a href="{{Auth::user()->role == "admin" ? route('admin.index') : route('staff.index')}}">
            <button type="button" class="btn text-white" style="background-color: #3B82F6; width: 15.68vw; height: 3vw; font-size: 1vw;">
            Dashboard
            </button>
        </a>
        @else
         <div class="d-flex gap-3 mt-4">
        <a href="{{route('login')}}">
            <button type="button" class="btn text-white" style="background-color: #3B82F6; width: 15.68vw; height: 3vw; font-size: 1vw;">
            Login
            </button>
        </a>
        <a href="{{route('registration.index')}}">
            <button type="button" class="btn text-white" style="background-color: #3B82F6; width: 15.68vw; height: 3vw; font-size: 1vw;">
            Register
            </button>
        </a>
    </div>
   @endauth
    </div>
</body>
</html>
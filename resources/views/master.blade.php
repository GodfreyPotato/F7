<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="d-flex justify-content-between align-items-center px-5 py-2" style="background-color: #1E3A8A;">
        <div class="d-flex align-items-center justify-content-around w-50">
            <h2 class="text-light">Form 7</h2>
            @if (auth()->check())
                @if(auth()->user()->role == 'admin')
                    <nav class="h-100">
                        <ul class="d-flex h-100 align-items-center list-unstyled gap-5 fw-semibold text-white mt-3">
                            <li>Employee Records</li>
                            <li>Attendance Logs</li>
                        </ul>
                    </nav>
                @endif
            @endif
        </div>

        @if (auth()->check())
            <div>
                <a href="{{route('auth.logout')}}" class="btn d-flex align-items-center"
                    style="background-color: #1D4ED8; color: white;">
                    <img src="{{ asset('images/logout.png') }}" alt="Log Out"
                        style="width: 23px; height: 23px; margin-right: 8px;">
                    Log Out
                </a>
            </div>
        @endif
    </div>
    <div style="margin-top: 65px; margin-bottom: 90px;">
        @yield('content')
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form 7</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="d-flex justify-content-between align-items-center px-5 py-2" style="background-color: #1E3A8A;">
        <img src="{{ asset('images/fullLogo.png') }}" style="width: 7vw">

        @auth
        <div>
            <a href="{{route('logout')}}" class="btn d-flex align-items-center"
                style="background-color: #1D4ED8; color: white;">
                <img src="{{ asset('images/logout.png') }}" alt="Log Out"
                    style="width: 23px; height: 23px; margin-right: 8px;">
                Log Out
            </a>
        </div>
        @endif
    </div>
    <div>
        @yield('content')
    </div>


    @stack('scripts')
</body>

</html>
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

    <div class="bg-primary d-flex justify-content-between align-items-center px-5 py-2">
        <div class="d-flex flex-column">
            <h2 class="text-white">Form 7</h2>
            <nav>
                <ul class="d-flex list-unstyled gap-4 text-white">
                    <li>Home</li>
                    <li>About</li>
                    <li>Add Form</li>
                </ul>
            </nav>
        </div>

        @if (auth()->check())
            <div>
                <a href="{{route('auth.logout')}}" class="btn btn-danger btn-md">Log Out</a>
            </div>

        @endif
    </div>
    @yield('content')
</body>

</html>
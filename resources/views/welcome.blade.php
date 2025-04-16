{{-- <h1> This is home</h1> --}}


@if(auth()->check())
    <h1>Welcome, {{ auth()->user()->name }}!</h1>
@else
    <h1>This is home</h1>
@endif
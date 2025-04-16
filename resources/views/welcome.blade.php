{{-- <h1> This is home</h1> --}}
@extends('master')
@section('content')
    @if(auth()->check())
        <h1>Welcome, {{ auth()->user()->name }}!</h1>
    @else
        <h1>This is home</h1>
        <a href="{{route('auth.login')}}">Login Here</a>
    @endif
@endsection
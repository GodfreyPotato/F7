{{-- <h1> This is home</h1> --}}
@extends('master')
@section('content')
    @if(auth()->check())
        @if(auth()->user()->role == 'employee')
           
        @elseif(auth()->user()->role == 'admin')
            
        @endif

    @else
        <h1>This is home</h1>
        <a href="{{route('auth.login')}}">Login Here</a>
    @endif
@endsection
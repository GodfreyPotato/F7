@extends('master')
@section('content')
    <div class="container" style="margin-top: 5vw;">
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-between ">
                <span style="font-size: 20px;" class="fw-bold"> {{$letter->cause}}</span>
                <a href="#" class="btn d-flex justify-content-center" style="background-color: #059669; color: white;">
                    Review
                </a>
            </div>
        </div>
    </div>
@endsection
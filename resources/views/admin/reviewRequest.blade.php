@extends('master')
@section('content')
    <div class="container" style="margin-top: 5vw;">
        <div class="d-flex flex-column p-4" style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
            <div class="d-flex justify-content-between">
                <span style="font-size: 24px;" class="fw-bold">Review Requests</span>
                <div class="d-flex">
                    <a href="#" class="btn d-flex justify-content-center me-3" style="background-color: #059669; color: white; width: 8vw;">
                    Approve
                    </a>
                     
                    <a href="#" class="btn d-flex justify-content-center" style="background-color: #DC2626; color: white; width: 8vw;">
                    Reject
                    </a>
                </div>
            </div>
            <hr>
             <div class="d-flex flex-column p-4" style="background-color: #F6F6F6; border-radius: 8px;">
                <div class="d-flex justify-content-between">
                    <div>
                        <span style="color: #878585; font-size: 16px;" class="fw-semibold">CAUSE OF ABSENCE</span>
                        <br>
                        <span style="font-size: 18px;" class="fw-bold">{{$letter->cause}}</span>
                    </div>
                    <div class="d-flex flex-column justify-content-end align-items-end">
                        <span style="color: #878585; font-size: 16px;" class="fw-semibold">REQUEST SUBMITTED</span>
                        <span style="font-size: 18px;" class="fw-bold">{{{Carbon\Carbon::parse($letter->date)->format('M d, Y')}}}</span>
                    </div>
                </div>
                <br>
                 {{-- EMPLOYEE INFORMATION --}}
                 <div class="d-flex justify-content-between">
                    <span style="font-size: 20px;" class="fw-bold">Employee Information</span>
                    <a href="#" class="btn d-flex justify-content-center me-3" style="background-color: #1D4ED8; color: white; width: 10vw;">
                    View CS Form
                    </a>
                 </div>
                 <div class="d-flex justify-content-between"">
                        <div class="d-flex flex-column p-3 mt-3" style="background-color: white; border-radius: 8px; width: 48%;">
                            <span style="color: #878585; font-size: 16px;" class="fw-semibold">NAME</span>
                            <span style="font-size: 18px;" class="fw-bold">
                                {{Str::ucfirst($letter->firstname)}}
                                    {{Str::ucfirst($letter->middlename[0])}}.
                                    {{Str::ucfirst($letter->lastname)}}
                            </span>
                        </div>

                        <div class="d-flex flex-column p-3 mt-3" style="background-color: white; border-radius: 8px; width: 48%;">
                            <span style="color: #878585; font-size: 16px;" class="fw-semibold">EMAIL</span>
                            <span style="font-size: 18px;" class="fw-bold">
                               {{$letter->email}}
                            </span>
                        </div>
                 </div>
                 <div class="d-flex justify-content-between mt-2">
                        <div class="d-flex flex-column p-3 mt-3" style="background-color: white; border-radius: 8px; width: 48%;">
                            <span style="color: #878585; font-size: 16px;" class="fw-semibold">DEPARTMENT</span>
                            @php
                            $code = $letter->department;
                            switch ($code) {
                                case 'BSIT':
                                    $dept = 'BS Information Technology';
                                    break;
                                case 'BSMATH':
                                    $dept = 'BS Mathematics';
                                    break;
                                case 'BSCE':
                                    $dept = 'BS Civil Engineering';
                                    break;
                                case 'BSED':
                                    $dept = 'BS Education';
                                    break;
                                case 'BSCoE':
                                    $dept = 'BS Computer Engineering';
                                    break;
                                case 'BSME':
                                    $dept = 'BS Mechanical Engineering';
                                    break;
                                case 'BSE':
                                    $dept = 'BS Education';
                                    break;
                                case 'BSA':
                                    $dept = 'BS Architecture';
                                    break;
                                case 'BSECE':
                                    $dept = 'BS Early Childhood Education';
                                    break;
                                case 'ABEL':
                                    $dept = 'AB English Language';
                                    break;
                                case 'NI':
                                    $dept = 'Non Instructional';
                                    break;
                                case 'BSEE':
                                    $dept = 'BS Electrical Engineering';
                                    break;
                                default:
                                    $dept = 'Unknown Course Code';
                                    break;
                                }
                            @endphp
                            <span style="font-size: 18px;" class="fw-bold">
                                {{$dept}}
                            </span>
                        </div>

                        <div class="d-flex flex-column p-3 mt-3" style="background-color: white; border-radius: 8px; width: 48%;">
                            <span style="color: #878585; font-size: 16px;" class="fw-semibold">TYPE OF EMPLOYEE</span>
                            <span style="font-size: 18px;" class="fw-bold">
                               {{$letter->department == "NI" ? "Non Instructional" : "Instructional" }}
                            </span>
                        </div>
                 </div>
             </div>
        </div>
    </div>
@endsection
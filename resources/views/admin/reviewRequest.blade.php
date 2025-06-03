@extends('master')
@section('content')
    <div class="container" style="margin-top: 2vw;">
        <a href="{{url()->previous()}}" class="btn btn-outline-primary"
            style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
            Back
        </a>
        <br>
        <div class="d-flex flex-column p-4"
            style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
            <div class="d-flex justify-content-between">
                <span style="font-size: 24px;" class="fw-bold">Review Application</span>
                <div class="d-flex">
                    <a href="" class="btn d-flex justify-content-center me-3"
                        style="background-color: #059669; color: white; width: 8vw;" data-bs-toggle="modal"
                        data-bs-target="#actionModal">
                        Approve
                    </a>

                    <form action="{{route('rejectLetter', ['letter' => $letter])}}" method="post">
                        @csrf
                        <button class="btn d-flex justify-content-center"
                            style="background-color: #DC2626; color: white; width: 8vw;" type="submit">

                            Reject
                        </button>
                    </form>

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
                    <div>
                        <span style="color: #878585; font-size: 16px;" class="fw-semibold">ACTION TAKEN</span>
                        <br>
                         @php
                            $actionTaken="";
                            $code =  $letter->letter_action_taken;    
                            switch($code){
                                case 'SP':
                                    $actionTaken = "Sick Leave with Pay";
                                    break;
                                case 'VP':
                                    $actionTaken = "Vacation Leave with Pay";
                                    break;
                                case 'SO':
                                    $actionTaken = "Special Occation Leave";
                                    break;
                                case 'PD':
                                    $actionTaken = "Personal Day";
                                    break;
                                case 'FL':
                                    $actionTaken = "Force Leave";
                                    break;
                                case 'SPL':
                                    $actionTaken = "Special Leave";
                                    break;

                                case 'OP':
                                    $actionTaken = "Official Purpose/ Other Purpose";
                                    break;

                                // case 'SOP':
                                //     $actionTaken = "Special Leave w/o Pay";
                                //     break;

                                case 'VOP':
                                    $actionTaken = "Vacation w/o Pay";
                                    break;

                                case 'SLOP':
                                    $actionTaken = "Sick Leave w/o Pay";
                                    break;  

                                default:
                                    $actionTaken = "Unknown";
                                    break;
                            }
                            @endphp
                        <span style="font-size: 18px;" class="fw-bold">
                           
                            {{$actionTaken}}</span>
                    </div>
                    <div class="d-flex flex-column justify-content-end align-items-end">
                        <span style="color: #878585; font-size: 16px;" class="fw-semibold">REQUEST SUBMITTED</span>
                        <span style="font-size: 18px;"
                            class="fw-bold">{{{Carbon\Carbon::parse($letter->date)->format('M d, Y')}}}</span>
                    </div>
                </div>
                <br>
                {{-- EMPLOYEE INFORMATION --}}
                <div class="d-flex justify-content-between">
                    <span style="font-size: 20px;" class="fw-bold">Employee Information</span>
                    @if ($letter->file_path)
                        <a href="{{asset('form6/' . basename($letter->file_path))}}" target="_blank"
                            class="btn d-flex justify-content-center me-3"
                            style="background-color: #1D4ED8; color: white; width: 10vw;">
                            View CS Form
                        </a>
                    @endif
                </div>
                <div class="d-flex justify-content-between">
                    <div class=" d-flex flex-column p-3 mt-3"
                        style="background-color: white; border-radius: 8px; width: 48%;">
                        <span style="color: #878585; font-size: 16px;" class="fw-semibold">NAME</span>
                        <span style="font-size: 18px;" class="fw-bold">
                            {{Str::ucfirst($letter->firstname)}}
                            {{Str::ucfirst($letter->middlename[0])}}.
                            {{Str::ucfirst($letter->lastname)}}
                        </span>
                    </div>

                    <div class="d-flex flex-column p-3 mt-3"
                        style="background-color: white; border-radius: 8px; width: 48%;">
                        <span style="color: #878585; font-size: 16px;" class="fw-semibold">EMAIL</span>
                        <span style="font-size: 18px;" class="fw-bold">
                            {{$letter->email}}
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="d-flex flex-column p-3 mt-3"
                        style="background-color: white; border-radius: 8px; width: 48%;">
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

                    <div class="d-flex flex-column p-3 mt-3"
                        style="background-color: white; border-radius: 8px; width: 48%;">
                        <span style="color: #878585; font-size: 16px;" class="fw-semibold">TYPE OF EMPLOYEE</span>
                        <span style="font-size: 18px;" class="fw-bold">
                            {{$letter->department == "NI" ? "Non Instructional" : "Instructional" }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('approveLetter', ['letter' => $letter]) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actionModalLabel">Approve Leave Application</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Action Taken -->
                    <div>
                        <label>Leave Type</label>
                        <select name="action_taken" class="form-control" id="" required>
                                <option disabled selected>Select one</option>
                               
                                	<option value="FL">Force Leave</option>
                               <option value="OP">Official Purpose/ Other Purpose</option>
                               <option value="PD">Personal Day</option>
                                <option value="SP">Sick Leave with Pay</option>
                               <option value="SLOP">Sick Leave w/o Pay</option>
                               <option value="SPL">Special Leave</option>
                               {{-- <option value="SOP">Special Leave w/o Pay</option> --}}
                               <option value="SO">Special Occation Leave</option>
                                <option value="VP">Vacation Leave with Pay</option>
                               <option value="VOP">Vacation w/o Pay</option>


                            </select> @error('action_taken')  
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                    </div>  
                        <!-- Reason -->
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea name="cause_by_admin" id="reason" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('master')
@section('content')

    <div class="container mt-4">
        <a href="{{route('staff.index')}}" class="btn btn-outline-primary"
            style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
            Back
        </a>
        <br>
        <div class="d-flex">
            <!-- profile card -->
            <div class="p-4 me-4"
                style="width: 30%; height: 30%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <span style="font-size: 20px;"
                    class="fw-bold d-flex justify-content-center mb-3 mt-2">{{Auth::user()->firstname}}
                    {{Auth::user()->lastname}}</span>
                <div class="d-flex justify-content-between" style="margin-bottom: -10px;">
                    <p style="color: #878585;">Department:</p>
                    <p>{{Auth::user()->department}}</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p style="color: #878585">Type of Employee:</p>
                    <p>{{Auth::user()->role == "ins" ? "Instructional Staff" : "Non-Instructional Staff"}}</p>
                </div>

            </div>

            <!-- right column -->
            <div class="d-flex flex-column" style="width: 68%; height: 30%; gap: 20px;">
                <!-- Leave Request Form-->
                <div class="p-4"
                    style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                    <span style="font-size: 20px;" class="fw-bold">Leave Application</span>
                    <form action="{{route('letter.store')}}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf

                        {{-- Cause of Absence --}}
                        <div class="mb-3">
                            <label for="cause" class="form-label">Cause of Absence</label>
                            <input type="text" class="form-control" id="cause" name="cause" placeholder="">
                            @error('cause')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="action_taken" class="form-label">Action Taken</label>
                            <select name="letter_action_taken" class="form-control" id="" required>
                                <option disabled selected>Select one</option>
                                <option value="SP">Sick Leave with Pay</option>
                                <option value="VP">Vacation Leave with Pay</option>
                                <option value="SO">Special Occation Leave</option>
                                <option value="PD">Personal Day</option>
                                <option value="FL">Force Leave</option>
                                <option value="SPL">Special Leave</option>
                                <option value="OP">Official Purpose/ Other Purpose</option>
                            </select> @error('action_taken')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        {{-- Date Range and CS Form --}}
                        <div class="row mb-3">
                            {{-- Date Range --}}
                            <div class="col-md-6">
                                <label for="date_range" class="form-label">Date Range</label>
                                <div class="d-flex justify-content-between">
                                    <input type="date" class="form-control" id="date_start" min="{{date('Y-m-d')}}"
                                        name="start_date" style="width:48%;">
                                    <h4> - </h4>
                                    <input type="date" class="form-control" id="date_end" name="end_date"
                                        style="width:48%;">
                                </div>
                                @error('date_start')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- CS Form --}}
                            <div class="col-md-6">
                                <label for="cs_form" class="form-label">CS Form</label>
                                <input type="file" class="form-control" id="cs_form" name="file_path">
                                @error('file_path')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Save and Cancel Buttons --}}
                        <div class="d-flex justify-content-end">
                            <a href="" class="btn btn-outline-primary me-2"
                                style="width: 5.7vw; height: 2.2vw; display: flex; align-items: center; justify-content: center;">Cancel</a>
                            <button type="submit" class="btn text-white"
                                style="background-color: #1D4ED8; width: 5.7vw; height: 2.2vw; display: flex; align-items: center; justify-content: center;">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#date_start").on("change", function () {
                $('#date_end').attr('min', $(this).val());
                $("#date_end").val($(this).val());
            });
        });
    </script>
@endpush
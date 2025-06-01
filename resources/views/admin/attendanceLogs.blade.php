@extends('master')
@section('content')
    <div class="container" style="margin-top: 5vw;">
        <div class="d-flex flex-column">
            <a href="{{url()->previous()}}" class="btn btn-outline-primary"
                style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
                Back
            </a>
            <div class="p-4 mt-4"
                style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <div class="d-flex justify-content-between">
                    <span style="font-size: 24px;" class="fw-bold">Attendance Logs</span>
                    <div class="d-flex w-25 justify-content-center align-items-center">
                        <label for="" class="me-3">Filter</label>
                        <input type="date" class="form-control  " id="filterDate" name="filterDate"
                            style="height:3vw; border: 2px solid #BCBCBC; ">
                    </div>
                </div>
                <hr>

                <br>
                {{-- table --}}
                <table class="table" style="border-collapse: collapse;">
                    <thead style="font-size: 16px; border-bottom: 1px solid #dee2e6;" class="fw-bold">
                        <tr>
                            <th style="background-color: #F4F5F6;">Employee</th>
                            <th style="background-color: #F4F5F6;">Date</th>
                            <th style="background-color: #F4F5F6;">AM Time in</th>
                            <th style="background-color: #F4F5F6;">AM Time Out</th>
                            <th style="background-color: #F4F5F6;">PM Time in</th>
                            <th style="background-color: #F4F5F6;">PM Time Out</th>
                            <th style="background-color: #F4F5F6;">Status</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 16px;" id="table-body">
                        @foreach ($logs as $log)
                            <tr>
                                <td>
                                    {{$log->firstname}} {{$log->lastname}}
                                </td>
                                <td>{{ $log->log_date ? Carbon\Carbon::parse($log->log_date)->format('M d, Y') : ''}}</td>
                                <td>{{ $log->am_in ? Carbon\Carbon::parse($log->am_in)->format('g:i A') : ''}} </td>
                                <td>{{ $log->am_out ? Carbon\Carbon::parse($log->am_out)->format('g:i A') : ''}}</td>
                                <td>{{ $log->pm_in ? Carbon\Carbon::parse($log->pm_in)->format('g:i A') : '' }}</td>
                                <td>{{ $log->pm_out ? Carbon\Carbon::parse($log->pm_out)->format('g:i A') : ''}}</td>
                                <td>{{$log->status == "present" ? "Present" : ($log->status == "absent" ? "Absent" : "On Leave")}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- PAGINATION --}}


    <script>
        $(document).ready(function () {
            $('#filterDate').on('change', function () {
                var date = $(this).val();

                $.ajax({
                    url: '/filterDate',
                    method: 'GET',
                    data: {
                        filterDate: date,
                    },
                    success: function (response) {
                        $('#table-body').html(response);
                    }
                });
            })
        });
    </script>
@endsection
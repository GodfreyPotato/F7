@php


    function convertMinutesToHoursMins($minutes)
    {
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        $result = '';
        if ($hours > 0) {
            $result .= $hours . ' hr' . ($hours > 1 ? 's' : '');
        }

        if ($mins > 0) {
            if ($result != '') {
                $result .= ' and ';
            }
            $result .= $mins . ' min' . ($mins > 1 ? 's' : '');
        }

        return $result;
    }


@endphp

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

<body style="font-family: Arial, Helvetica, sans-serif;" @if ($preview == 1) class="container p-2" @endif>
    <div class="d-flex flex-column justify-content-between align-items-center">
        <div class="w-100 h-100">
            @if ($preview == 1)
                <a href="{{route('admin.index')}}" class="btn btn-outline-primary mt-2"
                    style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
                    Back
                </a>
            @endif

            <br>

            <div style="text-align: center; font-size: 12px;margin-bottom:30px;">
                PANGASINAN
                STATE UNIVERSITY<br>
                Urdaneta City Campus <br>
                <b>MONTHLY REPORT ON SERVICE OF INSTRUCTIONAL AND NON INSTRUCTIONAL PERSONNEL</b> <br>
                For {{now()->format('F Y')}}
            </div>
            <div style="margin-bottom:10px;"> <span style="font-size: 12px; "><b>The President</b><br> Pangasinan State
                    University
                    <br>Lingayen,
                    Pangasinan</span></div>
            <br>
            <div class="d-flex justify-content-between">
                <span style="font-size: 12px;">SIR <br> I have the honor to submit herewith the following report on
                    services
                    of
                    all
                    teaching & non teaching
                    personnel in the college to wit:
                </span>
                @if ($preview == 1)
                    <div class="d-flex">
                        <div class="me-2">
                            <select class="form-select" name="month" id="month" style="height: 90%">
                                <option selected value="{{ now()->month }}">{{ now()->format('M') }}</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div>
                            <select class="form-select" name="year" id="year" style="height: 90%">
                                <option selected value="{{ now()->year }}">{{ now()->year }}</option>
                                @for ($y = date('Y'); $y >= 2000; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                @endif
            </div>
            <table border="1" style="width:100%; border-collapse: collapse; text-align: center;" @if ($preview == 1)
            class="table table-bordered" @endif>
                <tr style="font-size: 12px; ">
                    <th></th>
                    <th style="width: 120px;"><b>NON INSTRUCTIONAL STAFF</b></th>
                    <th style="width: 110px;">Undertime</th>
                    <th style="width: 120px;">Inclusive Date of Absence</th>
                    <th>Action Taken</th>
                    <th>Cause of Absence</th>
                    <th>Service rendered on Saturday</th>
                    <th>Has CS Form submitted</th>

                </tr>
                <tbody style="font-size: 12px;" id="table-body">

                    @php
                        $ctr = 1;
                        $month = now()->month;
                        $year = now()->year;
                    @endphp
                    @foreach ($ni as $user)
                        @php

                            $name = $user->lastname . ', ' . $user->firstname;
                            $undertime = convertMinutesToHoursMins(
                                $user->logs->sum('undertime')

                            );


                            $leaveDates = [];
                            foreach ($user->leaves as $leave) {
                                if ($leave->letter) { //Check if letter is not null

                                    $start = Carbon\Carbon::parse($leave->letter->start_date);
                                    $end = Carbon\Carbon::parse($leave->letter->end_date);

                                    if ($start->isSameMonth(now())) {
                                        if ($start->equalTo($end)) {
                                            $leaveDates[] = $start->format('j');
                                        } else {
                                            $leaveDates[] = $start->format('j') . '–' . $end->format('j');
                                        }
                                    }
                                }
                            }
                            //updating
                            foreach ($user->logs as $log) {
                                if ($log->status === "absent") {

                                    $start = Carbon\Carbon::parse($log->log_date);
                                    $end = Carbon\Carbon::parse($log->log_date);
                                    if ($start->isSameMonth(now())) {
                                        if ($start->equalTo($end)) {
                                            $leaveDates[] = $start->format('j');
                                        } else {
                                            $leaveDates[] = $start->format('j') . '–' . $end->format('j');
                                        }
                                    }
                                }
                            }
                            sort($leaveDates);
                            $formattedLeaveString = implode(';', $leaveDates);

                            $actionTaken = [];

                            foreach ($user->leaves as $leave) {
                                if (
                                    Carbon\Carbon::parse($leave->letter->start_date)->month == $month &&
                                    Carbon\Carbon::parse($leave->letter->start_date)->year == $year
                                ) {
                                    $actionTaken[] = $leave->action_taken;
                                }
                            }

                            $cause = [];
                            foreach ($user->leaves as $leave) {
                                if (
                                    Carbon\Carbon::parse($leave->letter->start_date)->month == $month &&
                                    Carbon\Carbon::parse($leave->letter->start_date)->year == $year
                                ) {
                                    $cause[] = $leave->cause_by_admin;
                                }
                            }

                            $withF6 = [];
                            foreach ($user->leaves as $leave) {
                                if (
                                    Carbon\Carbon::parse($leave->letter->start_date)->month == $month &&
                                    Carbon\Carbon::parse($leave->letter->start_date)->year == $year
                                ) {
                                    $withF6[] = $leave->with_f6 ? 'w/ F6' : 'w/o F6';
                                }
                            }

                        @endphp

                        <tr>
                            <td style="padding: 10px;"> {{$ctr}}</td>
                            <td style="text-align: start; padding: 12px;">{{$name}}</td>
                            <td style="text-align: start;">
                                {{$undertime}}
                            </td>
                            <td style="text-align: start;">
                                {{ $formattedLeaveString ? now()->format('M') . " " . $formattedLeaveString . ', ' . now()->year : '' }}
                            </td>

                            <td>
                                {{implode('/', $actionTaken)}}
                            </td>
                            <td>
                                {{implode('/', $cause)}}
                            </td>
                            <td>

                            </td>
                            <td>
                                {{implode(',', $withF6)}}
                            </td>

                        </tr>

                        @php
                            $ctr += 1;
                        @endphp
                    @endforeach
                    <td colspan="8" style="padding: 20px; text-align: start;"><b>INSTRUCTIONAL STAFF</b></td>

                    @foreach ($ins as $user)
                        @php

                            $name = $user->lastname . ', ' . $user->firstname;
                            $undertime = convertMinutesToHoursMins(
                                $user->logs->sum('undertime')
                            );


                            $leaveDates = [];
                            foreach ($user->leaves as $leave) {
                                if ($leave->letter) { //Check if letter is not null

                                    $start = Carbon\Carbon::parse($leave->letter->start_date);
                                    $end = Carbon\Carbon::parse($leave->letter->end_date);

                                    if ($start->isSameMonth(now())) {
                                        if ($start->equalTo($end)) {
                                            $leaveDates[] = $start->format('j');
                                        } else {
                                            $leaveDates[] = $start->format('j') . '–' . $end->format('j');
                                        }
                                    }
                                }
                            }
                            //updating
                            foreach ($user->logs as $log) {
                                if ($log->status === "absent") {

                                    $start = Carbon\Carbon::parse($log->log_date);
                                    $end = Carbon\Carbon::parse($log->log_date);
                                    if ($start->isSameMonth(now())) {
                                        if ($start->equalTo($end)) {
                                            $leaveDates[] = $start->format('j');
                                        } else {
                                            $leaveDates[] = $start->format('j') . '–' . $end->format('j');
                                        }
                                    }
                                }
                            }
                            sort($leaveDates);
                            $formattedLeaveString = implode(';', $leaveDates);

                            $actionTaken = [];

                            foreach ($user->leaves as $leave) {
                                if (
                                    Carbon\Carbon::parse($leave->letter->start_date)->month == $month &&
                                    Carbon\Carbon::parse($leave->letter->start_date)->year == $year
                                ) {
                                    $actionTaken[] = $leave->action_taken;
                                }
                            }

                            $cause = [];
                            foreach ($user->leaves as $leave) {
                                if (
                                    Carbon\Carbon::parse($leave->letter->start_date)->month == $month &&
                                    Carbon\Carbon::parse($leave->letter->start_date)->year == $year
                                ) {
                                    $cause[] = $leave->cause_by_admin;
                                }
                            }

                            $withF6 = [];
                            foreach ($user->leaves as $leave) {
                                if (
                                    Carbon\Carbon::parse($leave->letter->start_date)->month == $month &&
                                    Carbon\Carbon::parse($leave->letter->start_date)->year == $year
                                ) {
                                    $withF6[] = $leave->with_f6 ? 'w/ F6' : 'w/o F6';
                                }
                            }

                        @endphp

                        <tr>
                            <td style="padding: 10px;">{{$ctr}}</td>
                            <td style="text-align: start; padding: 12px;">{{$name}}</td>
                            <td style="text-align: start;">
                                {{$undertime}}
                            </td>
                            <td style="text-align: start;">
                                {{ $formattedLeaveString ? now()->format('M') . " " . $formattedLeaveString . ', ' . now()->year : '' }}
                            </td>

                            <td>
                                {{implode('/', $actionTaken)}}
                            </td>
                            <td>
                                {{implode('/', $cause)}}
                            </td>
                            <td>

                            </td>
                            <td>
                                {{implode(',', $withF6)}}
                            </td>

                        </tr>

                        @php
                            $ctr += 1;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($preview == 0)
            <div style="position: fixed; bottom: 0; left: 0;  text-align: start; font-size: 12px;" id="footerDownload">
                {!!$footer!!}
            </div>
        @endif
    </div>

    @if ($preview == 1)
        <div class="d-flex ">
            <div class="me-5">

                <button class="btn btn-primary btn-sm" id="downloadBtn" target="_blank">Download</button>
            </div>
            <div class="d-flex justify-content-center">
                <label class="me-5">For Footer</label>
                <textarea name="" class="form-control" style="width: 400px;" id="footermsg">{{$defaultFooter}}</textarea>
            </div>
        </div>
    @endif



    <script>
        $(document).ready(function () {

            $('#downloadBtn').on('click', function () {

                const footer = encodeURIComponent($('#footermsg').val());
                const url = `/pdfDownload/${footer}`;
                window.open(url, '_blank');
            });



            $('#month, #year').on('change', function () {
                var month = $('#month').val();
                var year = $('#year').val();

                $.ajax({
                    url: '/filterPDF/' + month + "/" + year,
                    type: 'GET',

                    success: function (response) {

                        $('#table-body').html(response)
                    },
                    error: function (e) {
                        alert('error ' + e.message)
                    }

                });
            });

            $('#add').on('click', function () {
                $('#user_id').val($(this).data('user-id'));
            });


        });
    </script>
</body>

</html>
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

        return $result ?: '0 mins';
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

<body style="font-family: Arial, Helvetica, sans-serif;" @if ($preview==1)
    class="container p-2"
@endif>

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
        <span style="font-size: 12px;">SIR <br> I have the honor to submit herewith the following report on services of all
            teaching & non teaching
            personnel in the college to wit:
        </span>
            @if ($preview==1)
            <div class="d-flex">
                <div class="me-2">
                     <select class="form-select" name="month" style="height: 90%">
                        <option disabled selected>Month</option>
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
                    <select class="form-select" name="year" style="height: 90%">
                        <option disabled selected>Year</option>
                        @for ($y = date('Y'); $y >= 1950; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            @endif
    </div>
    <table border="1" style="width:100%; border-collapse: collapse; text-align: center;" @if ($preview==1)
        class ="table table-bordered"
    @endif>
        <thead style="font-size: 12px;">
            <tr>
                <th></th>
                <th>Non Structural Staff</th>
                <th>Undertime</th>
                <th>Inclusive Date of Absence</th>
                <th>Action Taken (SO,PD,OP,RS)</th>
                <th>Cause of Absence</th>
                <th>Service rendered on Saturday</th>
                <th>Has CS Form submitted</th>
                @if ($preview==1)
                    <th>Add Service Rendered on Saturday</th>
                @endif
            </tr>
        </thead>
        <tbody style="font-size: 12px;">
            @php
                $ctr =1;
            @endphp
            @foreach ($users as $user)
                <tr>
                    <td>{{$ctr}}</td>
                    <td>{{$user->firstname}} {{$user->lastname}}</td>
                    <td>{{convertMinutesToHoursMins($user->logs->whereBetween('created_at',[ now()->startOfMonth(), now()->endOfMonth()])->sum('undertime'))}}</td>
                    <td>
                        @php
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
                            $formattedLeaveString = implode(';', $leaveDates);
                        @endphp
                                        {{ $formattedLeaveString ?now()->format('M')." " . $formattedLeaveString . ', ' . now()->year : '' }}
                    </td>

                    <td>
                        @foreach ($user->leaves as $leave)
                           @if(Carbon\Carbon::parse($leave->letter->start_date)->month==now()->month&& Carbon\Carbon::parse($leave->letter->start_date)->year==now()->year)
                            {{$leave->action_taken}}
                                @if (!$loop->last)
                                    /
                                @endif
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($user->leaves as $leave)
                            @if(Carbon\Carbon::parse($leave->letter->start_date)->month==now()->month&& Carbon\Carbon::parse($leave->letter->start_date)->year==now()->year)
                                {{$leave->cause_by_admin}}
                                @if (!$loop->last)
                                    /
                                @endif
                            @endif
                        @endforeach</td>
                    <td>
                         @foreach ($user->services as $service)
                            @if(Carbon\Carbon::parse($service->created_at)->month==now()->month&& Carbon\Carbon::parse($service->created_at)->year==now()->year)
                                {{$service->service}}
                                @if (!$loop->last)
                                    /
                                @endif
                            @endif
                        @endforeach
                    </td>
                    <td>
                    @foreach ($user->leaves as $leave)
                    @if(Carbon\Carbon::parse($leave->letter->start_date)->month==now()->month&& Carbon\Carbon::parse($leave->letter->start_date)->year==now()->year)
                        @if($leave->with_f6 != null)
                            w/ F6  @if (!$loop->last)
                                    ,
                                @endif
                        @else 
                            w/o F6  @if (!$loop->last)
                                    ,
                                @endif
                        @endif
                    @endif
                    @endforeach
                </td>
                 @if ($preview==1)
                       <td><button class="btn btn-secondary btn-sm" type="submit" data-bs-toggle="modal"
                        data-bs-target="#actionModal" id="add" data-user-id="{{$user->id}}">Add Saturday Service</button></td>
                @endif
                </tr>

                @php
                    $ctr+=1;
                @endphp
            @endforeach

        </tbody>
    </table>
    @if ($preview == 1)
        <a href="{{route('pdfDownload')}}" target="_blank">Download</a>
    @endif

    @if ($preview==1)
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('addSaturday')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actionModalLabel">Add Service Rendered on Saturday</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Action Taken -->
                        <div class="mb-3">
                            <input type="hidden" id="user_id" name="user_id">
                            <label for="action_taken" class="form-label">Service</label>
                            <input class="form-control" type="text" name="service">
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
    @endif

    <script>
        $(document).ready(function(){
            $('#add').on('click',function(){
                $('#user_id').val($(this).data('user-id'));
            });
        });
    </script>
</body>

</html>
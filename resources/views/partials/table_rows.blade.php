@php $ctr = 1; @endphp

@foreach ($ni as $user)
    <tr>
        <td>{{ $ctr }}</td>
        <td style="text-align: start;">{{ $user->firstname }} {{ $user->lastname }}</td>
        <td style="text-align: start;">
            {{ convertMinutesToHoursMins($user->logs->whereBetween('created_at', [now()->setMonth($month)->startOfMonth(), now()->setMonth($month)->endOfMonth()])->sum('undertime')) }}
        </td>
        <td style="text-align: start;">
            @php
                $leaveDates = [];
                foreach ($user->leaves as $leave) {
                    if ($leave->letter) {
                        $start = \Carbon\Carbon::parse($leave->letter->start_date);
                        $end = \Carbon\Carbon::parse($leave->letter->end_date);
                        if ($start->month == $month && $start->year == $year) {
                            $leaveDates[] = $start->eq($end)
                                ? $start->format('j')
                                : $start->format('j') . '–' . $end->format('j');
                        }
                    }
                }
            @endphp
            {{ count($leaveDates) ? date("M", mktime(0, 0, 0, $month, 1)) . ' ' . implode(';', $leaveDates) . ', ' . $year : '' }}
        </td>
        <td>
            @foreach ($user->leaves as $leave)
                @if (\Carbon\Carbon::parse($leave->letter->start_date)->month == $month && \Carbon\Carbon::parse($leave->letter->start_date)->year == $year)
                    {{ $leave->action_taken }}@if (!$loop->last) / @endif
                @endif
            @endforeach
        </td>
        <td>
            @foreach ($user->leaves as $leave)
                @if (\Carbon\Carbon::parse($leave->letter->start_date)->month == $month && \Carbon\Carbon::parse($leave->letter->start_date)->year == $year)
                    {{ $leave->cause_by_admin }}@if (!$loop->last) / @endif
                @endif
            @endforeach
        </td>
        <td>
            @foreach ($user->services as $service)
                @if (\Carbon\Carbon::parse($service->created_at)->month == $month && \Carbon\Carbon::parse($service->created_at)->year == $year)
                    {{ $service->service }}@if (!$loop->last) / @endif
                @endif
            @endforeach
        </td>
        <td>
            @foreach ($user->leaves as $leave)
                @if (\Carbon\Carbon::parse($leave->letter->start_date)->month == $month && \Carbon\Carbon::parse($leave->letter->start_date)->year == $year)
                    {{ $leave->with_f6 ? 'w/ F6' : 'w/o F6' }}@if (!$loop->last), @endif
                @endif
            @endforeach
        </td>
        <td>
            <button class="btn btn-secondary btn-sm add-saturday" type="button"
                    data-bs-toggle="modal" data-bs-target="#actionModal"
                    data-user-id="{{ $user->id }}">
                Add Saturday Service
            </button>
        </td>
    </tr>
    @php $ctr++; @endphp
@endforeach

<tr>
    <td colspan="9" style="padding: 20px; text-align: start;"><b>INSTRUCTIONAL STAFF</b></td>
</tr>

@foreach ($ins as $user)   <tr>
        <td>{{ $ctr }}</td>
        <td style="text-align: start;">{{ $user->firstname }} {{ $user->lastname }}</td>
        <td style="text-align: start;">
            {{ convertMinutesToHoursMins($user->logs->whereBetween('created_at', [now()->setMonth($month)->startOfMonth(), now()->setMonth($month)->endOfMonth()])->sum('undertime')) }}
        </td>
        <td style="text-align: start;">
            @php
                $leaveDates = [];
                foreach ($user->leaves as $leave) {
                    if ($leave->letter) {
                        $start = \Carbon\Carbon::parse($leave->letter->start_date);
                        $end = \Carbon\Carbon::parse($leave->letter->end_date);
                        if ($start->month == $month && $start->year == $year) {
                            $leaveDates[] = $start->eq($end)
                                ? $start->format('j')
                                : $start->format('j') . '–' . $end->format('j');
                        }
                    }
                }
            @endphp
            {{ count($leaveDates) ? date("M", mktime(0, 0, 0, $month, 1)) . ' ' . implode(';', $leaveDates) . ', ' . $year : '' }}
        </td>
        <td>
            @foreach ($user->leaves as $leave)
                @if (\Carbon\Carbon::parse($leave->letter->start_date)->month == $month && \Carbon\Carbon::parse($leave->letter->start_date)->year == $year)
                    {{ $leave->action_taken }}@if (!$loop->last) / @endif
                @endif
            @endforeach
        </td>
        <td>
            @foreach ($user->leaves as $leave)
                @if (\Carbon\Carbon::parse($leave->letter->start_date)->month == $month && \Carbon\Carbon::parse($leave->letter->start_date)->year == $year)
                    {{ $leave->cause_by_admin }}@if (!$loop->last) / @endif
                @endif
            @endforeach
        </td>
        <td>
            @foreach ($user->services as $service)
                @if (\Carbon\Carbon::parse($service->created_at)->month == $month && \Carbon\Carbon::parse($service->created_at)->year == $year)
                    {{ $service->service }}@if (!$loop->last) / @endif
                @endif
            @endforeach
        </td>
        <td>
            @foreach ($user->leaves as $leave)
                @if (\Carbon\Carbon::parse($leave->letter->start_date)->month == $month && \Carbon\Carbon::parse($leave->letter->start_date)->year == $year)
                    {{ $leave->with_f6 ? 'w/ F6' : 'w/o F6' }}@if (!$loop->last), @endif
                @endif
            @endforeach
        </td>
        <td>
            <button class="btn btn-secondary btn-sm add-saturday" type="button"
                    data-bs-toggle="modal" data-bs-target="#actionModal"
                    data-user-id="{{ $user->id }}">
                Add Saturday Service
            </button>
        </td>
    </tr>
    @php $ctr++; @endphp
@endforeach

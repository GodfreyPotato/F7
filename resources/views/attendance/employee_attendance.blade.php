<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            overflow-y: auto;
            background-color: #ffffff;
            color: #333;
            border-right: 1px solid #ddd;
        }

        .sidebar a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            display: block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .sidebar a:hover {
            background-color: #f5f5f5;
            text-decoration: none;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1rem;
        }

        .day-box {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            padding: 1rem;
            min-height: 100px;
            text-align: center;
        }

        .present {
            background-color: #d1f2eb;
            color: #1b5e20;
            font-weight: bold;
        }

        .absent {
            background-color: #f8d7da;
            color: #b71c1c;
            font-weight: bold;
        }

        .on_leave {
            background-color: #f0f0f0;
            color: #555;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top px-3">
        <div class="d-flex align-items-center gap-3">
            <span class="navbar-brand mb-0 h4">Form 7</span>
            <a class="nav-link text-white" href="#">Employee Records</a>
            <a class="nav-link text-white" href="{{ route('attendance.index') }}">Attendance Logs</a>
        </div>
        <div class="ms-auto">
            <button class="btn btn-light text-primary fw-bold">Log out</button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-4">
                <h4 class="mb-4">Employees</h4>
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
                <ul class="list-unstyled" id="employeeList">
                    @foreach($employees as $employee)
                        <li class="mb-2">
                            <a href="{{ route('attendance.show', $employee->id) }}">
                                {{ $employee->firstname }} {{ $employee->lastname }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Calendar -->
            <div class="col-md-9 col-lg-10 p-4">
                @if(isset($user))
                    <h2 class="mb-4">{{ $user->firstname }} {{ $user->lastname }} - {{ now()->format('F Y') }}</h2>

                    @php
                        $start = \Carbon\Carbon::now()->startOfMonth();
                        $end = \Carbon\Carbon::now()->endOfMonth();
                        $daysInMonth = $start->daysInMonth;
                        $firstDayOfWeek = $start->dayOfWeek;
                    @endphp

                    <div class="d-grid" style="grid-template-columns: repeat(7, 1fr); font-weight: bold; text-align: center;">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>

                    <div class="calendar-grid mt-2">
                        {{-- Empty boxes before first day --}}
                        @for($i = 0; $i < $firstDayOfWeek; $i++)
                            <div></div>
                        @endfor

                        {{-- Calendar days --}}
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $date = $start->copy()->addDays($day - 1)->format('Y-m-d');
                                $log = $attendance[$date] ?? null;
                                $statusClass = $log->status ?? 'absent';

                                $hoursWorked = null;
                                if ($log && $log->time_in && $log->time_out) {
                                    $timeIn = \Carbon\Carbon::parse($log->time_in);
                                    $timeOut = \Carbon\Carbon::parse($log->time_out);
                                    $hoursWorked = $timeOut->diffInMinutes($timeIn) / 60;
                                }
                            @endphp

                            <div class="day-box {{ $statusClass }}">
                                <strong>{{ $day }}</strong><br>
                                <span>{{ ucfirst($statusClass) }}</span><br>

                                @if($log && $statusClass === 'present')
                                    <small>In: {{ $log->time_in ?? 'N/A' }}</small><br>
                                    <small>Out: {{ $log->time_out ?? 'N/A' }}</small><br>
                                    @if($hoursWorked)
                                        <small>Hours: {{ number_format($hoursWorked, 2) }}</small>
                                    @endif
                                @endif
                            </div>
                        @endfor
                    </div>
                @else
                <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                    <h4 class="text-muted">Please select an employee to view attendance.</h4>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Live search
        document.getElementById("searchInput").addEventListener("input", function () {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll("#employeeList li");

            items.forEach(function (item) {
                let name = item.textContent.toLowerCase();
                item.style.display = name.includes(filter) ? "" : "none";
            });
        });
    </script>
</body>
</html>

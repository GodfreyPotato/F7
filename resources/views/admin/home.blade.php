@extends('master')
@section('content')
    <div class="d-flex justify-content-center align-items-center"
        style="height: 90vh; margin-top: 5vw; margin-bottom: 5vw;">
        <div class="container">

            <div class="card mb-4"
                style="background-color: #1E3A8A; color: white; border: none; border-radius: 8px; height: 300px;">
                <div class="card-body d-flex justify-content-between align-items-center h-100 px-5">
                    <div class="d-flex flex-column justify-content-center">
                        <span style="font-size: 26px;" class="fw-light mb-3"><span id="clock"></span>
                            <h1 style="margin-bottom: 0;">Welcome Back, {{ auth()->user()->firstname }}!</h1>
                            <p style="margin-bottom: 0;">Here's what's happening in your HR system today.</p>

                    </div>
                    <div class="p-4" style="margin-bottom: 100px;">
                        <img src="{{ asset('images/Saly-10.png') }}" style="max-height: 350px;">
                    </div>
                </div>
            </div>

            @php
                use App\Models\Letter;
                use App\Models\User;

                $totalPending = Letter::where('letter_status', 'pending')
                    ->count();

                $totalEmployees = User::where('role', '!=', 'admin')->count();
                $totalAccepted = Letter::where('letter_status', '!=', 'pending')->count();
            @endphp

            <div class="row g-3 mt-3">
                <div class="col-12 col-md-4">
                    <a href="{{route('staffListing')}}" class="text-decoration-none">
                        <div class="card"
                            style="border-radius: 12px; border: 1px solid #eaeaea; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                            <div class="card-body d-flex justify-content-between align-items-center" style="padding: 16px;">
                                <div>
                                    <p style="color: #6c757d; margin-bottom: 4px; font-size: 14px;">Total employees</p>
                                    <h2 style="margin-bottom: 0; font-weight: 700;">{{$totalEmployees}}</h2>
                                </div>
                                <div
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background-color: rgba(13, 110, 253, 0.1);">
                                    <img src="{{ asset('images/user-profile-group-b.png') }}"
                                        style="height: 25px; width: 25px;">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md-4">
                    <a href="{{route('letter.create')}}" class="text-decoration-none">
                        <div class="card"
                            style="border-radius: 12px; border: 1px solid #eaeaea; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                            <div class="card-body d-flex justify-content-between align-items-center" style="padding: 16px;">
                                <div>
                                    <p style="color: #6c757d; margin-bottom: 4px; font-size: 14px;">Pending Leave
                                        Application</p>
                                    <h2 style="margin-bottom: 0; font-weight: 700;">{{$totalPending}}</h2>
                                </div>
                                <div
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background-color: #DBEAFE;">
                                    <img src="{{ asset('images/clock.png') }}" style="height: 25px; width: 25px;">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card"
                        style="border-radius: 12px; border: 1px solid #eaeaea; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                        <div class="card-body d-flex justify-content-between align-items-center" style="padding: 16px;">
                            <div>
                                <p style="color: #6c757d; margin-bottom: 4px; font-size: 14px;">Reviewed Leave Application
                                </p>
                                <h2 style="margin-bottom: 0; font-weight: 700;">{{$totalAccepted}}</h2>
                            </div>
                            <div
                                style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; background-color:  #DBEAFE;">
                                <img src="{{ asset('images/office-building.png') }}" style="height: 25px; width: 25px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $startDate = Carbon\Carbon::now()->subMonths(2)->startOfMonth();

                $leavePerMonth = DB::table('letters')
                    ->select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('SUM(CASE WHEN letter_status = "pending" THEN 1 ELSE 0 END) as total_pending'),
                        DB::raw('SUM(CASE WHEN letter_status = "approved" THEN 1 ELSE 0 END) as total_approved'),
                        DB::raw('SUM(CASE WHEN letter_status = "rejected" THEN 1 ELSE 0 END) as total_rejected')
                    )
                    ->where('created_at', '>=', $startDate)
                    ->groupByRaw('YEAR(created_at), MONTH(created_at)')
                    ->orderByRaw('YEAR(created_at) DESC, MONTH(created_at) DESC')
                    ->get();
                // Prepare data for the chart
                $months = [];
                $total_pending = [];
                $total_approved = [];
                $total_rejected = [];

                foreach ($leavePerMonth as $stat) {
                    $months[] = date('M Y', strtotime($stat->year . '-' . $stat->month . '-01'));
                    $total_pending[] = $stat->total_pending;
                    $total_approved[] = $stat->total_approved;
                    $total_rejected[] = $stat->total_rejected;
                }
            @endphp

            <div class=" d-flex justify-content-center align-items-center w-100 mt-4 p-4" style="height: 40vh; ">
                <canvas id="leaveApplication" class="" style="width:100%; height: 100%;"></canvas>
            </div>

            <div class="d-flex justify-content-between" style="margin-top: 50px;">
                <div class="mb-4" style="width: 23%">
                    <a href="{{route('staffListing')}}" class="text-decoration-none">
                        <div class="card h-100 text-center"
                            style="padding-top: 16px; padding-bottom: 16px; background-color: #0d6efd;">
                            <div class="card-body">
                                <div
                                    style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
                                    <img src="{{ asset('images/user-profile-group.png') }}"
                                        style="height: 45px; width: 45px;">
                                </div>
                                <h5 class="card-title" style="color: white;">View Employees</h5>
                                <p class="card-text" style="color: white; font-size: 14px;">Total employees</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="mb-4" style="width: 23%">
                    <a href="{{route('letter.create')}}" class="text-decoration-none">
                        <div class="card h-100 text-center"
                            style="padding-top: 16px; padding-bottom: 16px; background-color: #0d6efd;">
                            <div class="card-body">
                                <div
                                    style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
                                    <img src="{{ asset('images/calendar-check.png') }}" style="height: 45px; width: 45px;">
                                </div>
                                <h5 class="card-title" style="color: white;">Leave Applications</h5>
                                <p class="card-text" style="color: white; font-size: 14px;">Pending approval</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="mb-4" style="width: 23%">
                    <a href="{{route('attendanceLogs')}}" class="text-decoration-none">
                        <div class="card h-100 text-center"
                            style="padding-top: 16px; padding-bottom: 16px; background-color: #0d6efd;">
                            <div class="card-body">
                                <div
                                    style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
                                    <img src="{{ asset('images/clock_white.png') }}" style="height: 45px; width: 45px;">
                                </div>
                                <h5 class="card-title" style="color: white;">Attendance Logs</h5>
                                <p class="card-text" style="color: white; font-size: 14px;">View Logs</p>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="mb-4" style="width: 23%">
                    <a href="{{route('pdf.index')}}" class="text-decoration-none">
                        <div class="card h-100 text-center"
                            style="padding-top: 16px; padding-bottom: 16px; background-color: #0d6efd;">
                            <div class="card-body">
                                <div
                                    style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px auto;">
                                    <img src="{{ asset('images/icons-pdf.png') }}" style="height: 32px; width: 25px;">
                                </div>
                                <h5 class="card-title" style="color: white;">PDF Preview</h5>
                                <p class="card-text" style="color: white; font-size: 14px;">View reports</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <script>
        function updateTime() {
            const now = new Date();
            document.getElementById("clock").textContent = now.toLocaleString();
        }
        setInterval(updateTime, 1000);
        updateTime()
    </script>





@endsection
@push('scripts')
    <script>
        const month = {!! json_encode($months) !!};
        const total_pending = {!! json_encode($total_pending) !!};
        const total_approved = {!! json_encode($total_approved) !!};
        const total_rejected = {!! json_encode($total_rejected) !!};


        new Chart("leaveApplication", {
            type: "bar",
            data: {
                labels: month,
                datasets: [{
                    label: "Total Pending",
                    data: total_pending,
                    borderColor: "#0C53A5",
                    backgroundColor: "rgba(12, 83, 165, 0.1)",
                    fill: true,
                    tension: 0.4
                }, {
                    label: "Total Approved",
                    data: total_approved,
                    borderColor: "#10B981",
                    backgroundColor: "rgba(16, 185, 129, 0.1)",
                    fill: false,
                    tension: 0.4
                }, {
                    label: "Total Rejected",
                    data: total_rejected,
                    borderColor: "#EF4444",
                    backgroundColor: "rgba(239, 68, 68, 0.1)",
                    fill: false,
                    tension: 0.4
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Leave Application'
                        }
                    }],
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: true
            }
        });
    </script>
@endpush
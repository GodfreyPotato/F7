@extends('master')
@section('content')

<div class="container mt-5 mb-4">
    <div class="d-flex" style="gap: 26px;">
        <!-- Left Column -->
        <div style="width: 30%; display: flex; flex-direction: column; gap: 20px;">
            <!-- Profile Card -->
            <div class="p-4"
                style="box-shadow: 0px 0px 4.2px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <span style="font-size: 20px;"
                    class="fw-bold d-flex justify-content-center mb-3 mt-2">{{ Auth::user()->firstname }}
                    {{ Auth::user()->lastname }}</span>
                <div class="mb-3 text-center">
                    @if (Auth::user()->image_path)
                        <img src="{{ asset(Auth::user()->image_path) }}" alt="Profile Image" class="mb-2"
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; margin: 0 auto; display: block;">
                    @else
                        <img src="{{ asset('images/default-profile.jpg') }}" alt="Default Profile" class="mb-2"
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; margin: 0 auto; display: block;">
                    @endif
                </div>

                <div class="d-flex justify-content-between">
                    <p style="color: #878585;">Department:</p>
                    <p>{{ Auth::user()->department }}</p>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <p style="color: #878585;">Type of Employee:</p>
                    <p>{{ Auth::user()->role == 'ins' ? 'Instructional Staff' : 'Non-Instructional Staff' }}</p>
                </div>
                <a href="#" class="btn w-100 d-flex align-items-center justify-content-center"
                    style="background-color: #1D4ED8; color: white;" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <img src="{{ asset('images/edit-contained.png') }}"
                        style="width: 23px; height: 23px; margin-right: 8px;">
                    Edit Profile
                </a>
            </div>

            <!-- Modal (EDIT PROFILE) -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="editProfileModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('editProfile', ['id' => Auth::id()]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-body">
                                <div class="mb-3 text-center">
                                    <img id="imagePreview"
                                        src="{{ Auth::user()->image_path ? asset(Auth::user()->image_path) : asset('images/default-profile.jpg') }}"
                                        alt="Profile Image" class="mb-2"
                                        style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; margin: 0 auto; display: block;">

                                    <div class="mt-2">
                                        <input type="file" name="image" class="form-control" accept="image/*"
                                            onchange="previewImage(event)">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control"
                                        value="{{ Auth::user()->firstname }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="middlename" class="form-label">Middle Name</label>
                                    <input type="text" name="middlename" id="middlename" class="form-control"
                                        value="{{ Auth::user()->middlename }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        value="{{ Auth::user()->lastname }}" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="#" class="btn btn-outline-primary me-2"
                                    data-bs-dismiss="modal">Cancel</a>
                                <button type="submit" class="btn text-white"
                                    style="background-color: #1D4ED8;">
                                    Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="p-4 mt-4"
                style="box-shadow: 0px 0px 4.2px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px; height: 400px;">
                <h5 class="fw-bold mb-3 mt-2">Reviewed Leave Application</h5>
                <hr>
                <div style="height: 320px; overflow-y: auto;" class="d-flex flex-column gap-2">
                    {{-- for loop --}}
                    @foreach ($reviewedLetters as $letter)
                        <div class="p-3 d-flex justify-content-between align-items-center"
                            style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); border: 1px solid #EFF6FF; border-radius: 8px; background-color: #ffffff;">

                            <span
                                class="fw-semibold {{ $letter->letter_status == 'rejected' ? 'text-danger' : 'text-success' }}"
                                style="font-size: 16px;">
                                {{ $letter->cause }}
                            </span>

                            <span style="font-size: 14px; color: #64748B;">
                                Reviewed on: {{ $letter->updated_at->format('M d, Y') }}
                            </span>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <!-- Right Column -->
        <div style="width: 70%; display: flex; flex-direction: column; gap: 20px;">
            <!-- Attendance Logs-->
                 <div class="p-4 w-100"
                style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <div class="d-flex justify-content-between ">
                    <span style="font-size: 20px;" class="fw-bold">Attendance Logs</span>
                    <a href="{{route('showLogs')}}" class="btn d-flex justify-content-center"
                        style="background-color: #1D4ED8; color: white;">
                        View Logs
                    </a>

                </div>
                <div>
                    <span style="font-size: 20px;" class="fw-light mb-3"><span id="clock"></span> |
                        <span class="fw-semibold">
                            {{ now()->hour < 12 ? 'Morning' : (now()->hour > 19 ? 'Evening' : 'Afternoon') }}
                            {{ now() }}</span></span>
                </div>
                <div class="d-flex justify-content-between mt-2">

                    {{-- AM time in --}}
                    @if($log != null && $log->status == "onLeave")

                        <div class="bg-secondary p-4 w-50 text-white rounded">
                            <h2>On Leave</h2>
                        </div>
                    @else
                        @if (now()->format('H:i') < '12:30')
                            <div class="p-2 me-2 "
                                style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">AM Time In</p>
                                    <span class="fw-bold" style="font-size: 24px; margin: 0;">
                                        {{$log == null || $log->am_in == null ? "--:--" : Carbon\Carbon::parse($log->am_in)->format('g:i A')}}
                                    </span>

                                    @if ($log == null || $log->am_in == null)
                                        <form action="{{route('timeInAm')}}" method="post">
                                            @csrf
                                            <button class="btn"
                                                style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                Time In
                                            </button>
                                        </form>
                                    @else
                                        <span class=" fw-bold"
                                            style="background-color:#D1FADF; color:#00764C;  width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">Present</span>
                                    @endif

                                </div>
                            </div>

                            <div class="p-2 me-2 "
                                style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">AM Time Out</p>
                                    <span class="fw-bold" style="font-size: 24px; margin: 0;">
                                        {{ $log == null || $log->am_out == null ? "--:--" : Carbon\Carbon::parse($log->am_out)->format('g:i A')}}
                                    </span>

                                    @if ($log == null || $log->am_out == null)
                                        <form action="{{route('timeOutAm')}}" method="post">
                                            @csrf
                                            <button class="btn"
                                                style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                Time Out
                                            </button>
                                        </form>
                                    @else
                                        <span class=" fw-bold"
                                            style="background-color:#BCBCBC; color:white;  width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">Timed
                                            Out
                                        </span>
                                    @endif

                                </div>
                            </div>
                        @else
                            {{-- PM time in --}}
                            <div class="p-2 me-2 "
                                style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">PM Time In</p>
                                    <span class="fw-bold" style="font-size: 24px; margin: 0;">
                                        {{$log == null || $log->pm_in == null ? "--:--" : Carbon\Carbon::parse($log->pm_in)->format('g:i A')}}
                                    </span>

                                    @if ($log == null || $log->pm_in == null)
                                        <form action="{{route('timeInPm')}}" method="post">
                                            @csrf
                                            <button class="btn"
                                                style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                Time In
                                            </button>
                                        </form>
                                    @else
                                        <span class=" fw-bold"
                                            style="background-color:#D1FADF; color:#00764C;  width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">Present</span>
                                    @endif

                                </div>
                            </div>

                            <div class="p-2 me-2 "
                                style="width: 50%; height: 40%; box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                                <div class="d-flex flex-column align-items-center justify-content-center text-center">
                                    <p style="font-size: 16px; color: #878585; margin: 0;" class="fw-semibold">PM Time Out</p>
                                    <span class="fw-bold" style="font-size: 24px; margin: 0;">
                                        {{$log == null || $log->pm_out == null ? "--:--" : Carbon\Carbon::parse($log->pm_out)->format('g:i A')}}
                                    </span>

                                    @if ($log == null || $log->pm_out == null)
                                        <form action="{{route('timeOutPm')}}" method="post">
                                            @csrf
                                            <button class="btn"
                                                style="background-color: #1D4ED8; color: white; width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                Time Out
                                            </button>
                                        </form>
                                    @else
                                        <span class=" fw-bold"
                                            style="background-color:#BCBCBC; color:white;  width: 136px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 6px;">Timed
                                            Out </span>
                                    @endif

                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <!-- Recent Leave Requests -->
            <div class="p-4"
                style="box-shadow: 0px 0px 4.2px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <div class="d-flex justify-content-between align-items-center">
                    <span style="font-size: 20px;" class="fw-bold">Pending Leave Application</span>
                    <a href="{{ route('letter.index') }}" class="btn d-flex justify-content-center"
                        style="background-color: #1D4ED8; color: white;">
                        <img src="{{ asset('images/plus.png') }}" style="width: 23px; height: 23px; margin-right: 8px;">
                        Apply Leave
                    </a>
                </div>
                <div class="d-flex flex-column gap-3 mt-3">
                    @foreach ($letters as $letter)
                        <div class="p-3"
                            style="width: 100%; box-shadow: 0px 0px 4.2px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center;">
                                <!-- Vertical line -->
                                <div
                                    style="width: 5px; height: 40px; {{ $letter->letter_status == 'pending' ? 'background-color: #EAB308;' : ($letter->letter_status == 'rejected' ? 'background-color: red;' : 'background-color: #0F7552;') }} margin-right: 10px; border-radius: 2px;">
                                </div>
                                <div>
                                    <div style="font-weight: bold;">{{ $letter->cause }}</div>
                                    @php
                                        $start = Carbon\Carbon::parse($letter->start_date);
                                        $end = Carbon\Carbon::parse($letter->end_date);
                                    @endphp

                                    <div style="font-size: 14px; color: #666;">
                                        @if ($start->equalTo($end))
                                            {{ $start->format('F j, Y') }}
                                        @elseif ($start->month === $end->month && $start->year === $end->year)
                                            {{ $start->format('F j') }}–{{ $end->format('j, Y') }}
                                        @else
                                            {{ $start->format('F j') }} – {{ $end->format('F j, Y') }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- status badge -->
                            <span class="badge d-flex justify-content-center align-items-center fw-bold"
                                style="{{ $letter->letter_status == 'pending' ? 'background-color: #FFF6D9; color: #EAB308;' : ($letter->letter_status == 'rejected' ? 'background-color: red; color: white;' : 'background-color: #D1FADF; color: #0F7552;') }} font-size: 14px; padding: 6px 12px; border-radius: 5px;">
                                <img src="{{ $letter->letter_status == 'pending' ? asset('images/clock2.png') : ($letter->letter_status == 'rejected' ? asset('images/cross.png') : asset('images/check.png')) }}"
                                    style="width: 15px; height: 15px; margin-right: 8px;">
                                {{ ucfirst($letter->letter_status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    {{ $letters->links('vendor.pagination.custom') }}
                </div>
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
        updateTime();

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>

@endsection

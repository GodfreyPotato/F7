@extends('master')
@section('content')
    <div class="container" style="margin-top: 5vw;">
        <div class="d-flex flex-column">
            {{-- SEARCH --}}
            <div class="p-4"
                style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <form class="d-flex">
                    <input type="search" placeholder="Search..."
                        style="padding:12px; width: 82vw; height: 3vw; border: 2px solid #BCBCBC; border-radius: 0.5vw;">
                </form>
            </div>

            {{-- LEAVE REQUESTS --}}
            <div class="p-4 mt-4"
                style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <span style="font-size: 24px;" class="fw-bold">Leave Requests</span>
                <hr>
                {{-- sample 1 --}}
                @foreach ($letters as $letter)

                    <div class="p-4 d-flex justify-content-between align-items-center mt-3"
                        style="box-shadow: 0px 0px 4.2px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">

                        <div class="d-flex flex-column">
                            <p class="fw-bold mb-0" style="font-size: 18px;">{{Str::ucfirst($letter->firstname)}}
                                {{Str::ucfirst($letter->middlename[0])}}.
                                {{Str::ucfirst($letter->lastname)}}
                            </p>
                            <p class="fw-semibold mb-0" style="font-size: 16px; color: #7B7878;">
                                {{{Carbon\Carbon::parse($letter->date)->format('M d, Y')}}}
                                <span class="ms-2"
                                    style="font-size: 16px; color: #7B7878;">{{{Carbon\Carbon::parse($letter->date)->format('g:i A')}}}</span>
                            </p>
                        </div>

                        <a href="{{route('letter.show', ['letter' => $letter])}}"
                            class="btn d-flex justify-content-center align-items-center"
                            style="background-color: #1D4ED8; color: white; width: 10vw;">
                            Review
                        </a>
                    </div>
                @endforeach
                {{-- sample 2 --}}
                {{-- <div class="p-4 d-flex justify-content-between align-items-center mt-4"
                    style="box-shadow: 0px 0px 4.2px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">

                    <div class="d-flex flex-column">
                        <p class="fw-bold mb-0" style="font-size: 18px;">Godfrey Javier</p>
                        <p class="fw-semibold mb-0" style="font-size: 16px; color: #7B7878;">
                            May 24, 2025
                            <span class="ms-2" style="font-size: 16px; color: #7B7878;">11:35 PM</span>
                        </p>
                    </div>
                    <a href="#" class="btn d-flex justify-content-center align-items-center"
                        style="background-color: #1D4ED8; color: white; width: 10vw;">
                        Review
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
    {{-- PAGINATION --}}
    <nav class="mt-5">
        <ul class="pagination justify-content-center" style="margin: 0;">

            <!-- Prev Button -->
            <li class="page-item">
                <a class="page-link fw-bold text-primary" href="#"
                    style="border:none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                    Prev
                </a>
            </li>

            <!-- Page 1 (Active) -->
            <li class="page-item active">
                <a class="page-link" href="#"
                    style="border-radius: 8px; width: 40px; height: 40px; background-color: #1D4ED8; color: white; border: none; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                    1
                </a>
            </li>

            <!-- Page 2-5 (Disabled Look) -->
            <li class="page-item">
                <a class="page-link" href="#"
                    style="border-radius: 8px; width: 40px; height: 40px; background-color: #f8f9fa; color: #ccc; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                    2
                </a>
            </li>


            <!-- Next Button -->
            <li class="page-item">
                <a class="page-link fw-bold text-primary" href="#"
                    style="border:none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                    Next
                </a>
            </li>
        </ul>
    </nav>

@endsection
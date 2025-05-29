@extends('master')
@section('content')
    <div class="container d-flex flex-column " style="margin-top: 5vw;">
        <a href="{{url()->previous()}}" class="btn btn-outline-primary"
            style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
           Back
        </a>
        <br>
        <div class="d-flex flex-column">
            {{-- SEARCH --}}
            <div class="p-4"
                style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">

                <input type="search" placeholder="Search..." id="searchLeave"
                    style="padding:12px; width: 100%; height: 3vw; border: 2px solid #BCBCBC; border-radius: 0.5vw;">

            </div>

            {{-- LEAVE REQUESTS --}}
            <div class="p-4 mt-4"
                style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <span style="font-size: 24px;" class="fw-bold">Leave Requests</span>
                <hr>
                <div id="letters">

                    {{-- sample 1 --}}
                    @if ($letters)
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
                        </div>


                    @endif
            </div>
        </div>

    </div>
    <div class="d-flex align-items-center justify-content-center mt-4"> {{ $letters->links() }}</div>

    <script>
        $(document).ready(function () {
            $('#searchLeave').on('keyup', function () {
                var word = $(this).val();
                $.ajax({
                    url: '/searchLeave/' + word,
                    type: 'GET',
                    success: function (result) {
                        $('#letters').html(result);
                    }
                });
            });

        });
    </script>

@endsection
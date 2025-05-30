@extends('master')
@section('content')
    <div class="container" style="margin-top: 3vw;">
        <a href="{{route('admin.index')}}" class="btn btn-outline-primary"
            style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
           Back
        </a>
        <br>
        {{-- SEARCH AND FILTER --}}
        <div class="d-flex flex-column p-4"
            style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">

            <input type="search" placeholder="Search..." id="word"
                style="padding:12px; width: 100%; height: 3vw; border: 2px solid #BCBCBC; border-radius: 0.5vw;">

        </div>
        {{-- STAFF LISTING--}}
        <div class="d-flex flex-column p-4 mt-4"
            style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
            <span style="font-size: 24px;" class="fw-bold">Employee Records</span>
            <hr>
            <div>
                <table class="table" style="border-collapse: collapse;">
                    <thead style="font-size: 16px; border-bottom: 1px solid #dee2e6;" class="fw-bold">
                        <tr>
                            <th style="background-color: #F4F5F6;">Employee</th>
                            <th style="background-color: #F4F5F6;">Email Address</th>
                            <th style="background-color: #F4F5F6;">Department</th>
                            <th style="background-color: #F4F5F6;">Type of Employee</th>
                            <th style="background-color: #F4F5F6;" class="d-flex justify-content-center">Modify Profile</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 16px;" id="employees">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ Str::ucfirst($user->lastname) }},
                                    {{ Str::ucfirst($user->firstname) }}
                                    {{Str::ucfirst($user->middlename[0])}}.

                                </td>
                                <td>{{ $user->email }}</td>
                                @php
                                    $code = $user->department;
                                    switch ($code) {
                                        case 'BSIT':
                                            $dept = 'BS Information Technology';
                                            break;
                                        case 'BSMATH':
                                            $dept = 'BS Mathematics';
                                            break;
                                        case 'BSCE':
                                            $dept = 'BS Civil Engineering';
                                            break;
                                        case 'BSED':
                                            $dept = 'BS Education';
                                            break;
                                        case 'BSCoE':
                                            $dept = 'BS Computer Engineering';
                                            break;
                                        case 'BSME':
                                            $dept = 'BS Mechanical Engineering';
                                            break;
                                        case 'BSE':
                                            $dept = 'BS Education';
                                            break;
                                        case 'BSA':
                                            $dept = 'BS Architecture';
                                            break;
                                        case 'BSECE':
                                            $dept = 'BS Early Childhood Education';
                                            break;
                                        case 'ABEL':
                                            $dept = 'AB English Language';
                                            break;
                                        case 'NI':
                                            $dept = 'Non Instructional';
                                            break;
                                        case 'BSEE':
                                            $dept = 'BS Electrical Engineering';
                                            break;
                                        default:
                                            $dept = 'Unknown Course Code';
                                            break;
                                    }
                                @endphp
                                <td>{{ $dept }}</td>
                                <td>{{ $user->role == "ins" ? "Instructional" : "Non Instructional" }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="" class="me-3" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                        <img src="{{ asset('images/edit.png') }}" alt="Edit" style="width: 20px;">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Edit User Modal -->
                @foreach ($users as $user)
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit Employee Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="firstname{{ $user->id }}" class="form-label">First Name</label>
                                    <input type="text" name="firstname" id="firstname{{ $user->id }}" class="form-control" value="{{ $user->firstname }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastname{{ $user->id }}" class="form-label">Last Name</label>
                                    <input type="text" name="lastname" id="lastname{{ $user->id }}" class="form-control" value="{{ $user->lastname }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email{{ $user->id }}" class="form-label">Email</label>
                                    <input type="email" name="email" id="email{{ $user->id }}" class="form-control" value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="department{{ $user->id }}" class="form-label">Department</label>
                                    <input type="text" name="department" id="department{{ $user->id }}" class="form-control" value="{{ $user->department }}">
                                </div>
                                <div class="mb-3">
                                    <label for="role{{ $user->id }}" class="form-label">Type</label>
                                    <select name="role" id="role{{ $user->id }}" class="form-select">
                                        <option value="ins" {{ $user->role == 'ins' ? 'selected' : '' }}>Instructional</option>
                                        <option value="non" {{ $user->role == 'non' ? 'selected' : '' }}>Non-Instructional</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer d-flex j">
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
                @endforeach
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center my-5">{{ $users->links('vendor.pagination.custom')}}</div>

    <script>
        $(document).ready(function () {
            $('#word').on('keyup', function () {
                var word = $(this).val();
                $.ajax({
                    url: '/searchEmployee/' + word,
                    type: 'GET',
                    success: function (result) {
                        $('#employees').html(result);
                    }
                });
            });

        });
    </script>
@endsection
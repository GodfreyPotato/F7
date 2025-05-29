@extends('master')
@section('content')
    <div class="container" style="margin-top: 5vw;">
        <a href="{{url()->previous()}}" class="btn btn-outline-primary"
            style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
           Back
        </a>
        <br>
        {{-- SEARCH AND FILTER --}}
        <div class="d-flex flex-column p-4" style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
            <form class="d-flex">
                    <input type="search" placeholder="Search..."
                        style="padding:12px; width: 85vw; height: 3vw; border: 2px solid #BCBCBC; border-radius: 0.5vw;">
            </form>
        </div>
        {{-- STAFF LISTING--}}
        <div class="d-flex flex-column p-4 mt-4" style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
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
                            <th style="background-color: #F4F5F6;" class="d-flex justify-content-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 16px;">
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
                            <td>{{ $user->role=="ins" ? "Instructional" : "Non Instructional" }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="#" class="me-3"><img src="{{ asset('images/edit.png') }}" alt="View Schedule"></a>
                                <a href="#"><img src="{{ asset('images/trash.png') }}" alt="Approve"></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             </div>
        </div>
    </div>
    
    {{-- PAGINATION --}}
@endsection
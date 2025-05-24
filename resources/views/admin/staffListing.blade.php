@extends('master')
@section('content')
    <div class="container" style="margin-top: 5vw;">
        {{-- SEARCH AND FILTER --}}
        <div class="d-flex flex-column p-4" style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
            <div class="d-flex justify-content-between">
                <form class="d-flex">
                    <input type="search" placeholder="Search..."
                        style="padding:12px; width: 55vw; height: 3vw; border: 2px solid #BCBCBC; border-radius: 0.5vw;">
                </form>
                <div class="d-flex me-2">
                    <input type="date" class="form-control me-3" id="#"  min="{{date('Y-m-d')}}"
                     name="#" style="height:3vw; border: 2px solid #BCBCBC;">
                     <select class="form-select" name="department" id="department" style="height: 3vw; border: 2px solid #BCBCBC;">
                        <option value="" disabled selected>Department</option>
                    </select>
                </div>
            </div>
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
                            <td>
                                {{ Str::ucfirst($user->firstname) }}
                                {{Str::ucfirst($user->middlename[0])}}.
                                {{ Str::ucfirst($user->lastname) }}
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->department }}</td>
                            <td>{{ $user->role }}</td>
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
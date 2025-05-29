@extends('master')
@section('content')
    <div class="container" style="margin-top: 5vw;">
        <div class="d-flex flex-column">
            <a href="{{url()->previous()}}" class="btn btn-outline-primary"
            style="width: 10vw; height: 2.5vw; display: flex; align-items: center; justify-content: center;">
           Back
        </a>
            <div class="p-4 mt-4"
                style="box-shadow: 0px 0px 4.2px 0px rgba(0, 0, 0, 0.25); background-color: white; border-radius: 8px;">
                <div class="d-flex justify-content-between">
                    <span style="font-size: 24px;" class="fw-bold">Attendance Logs</span>
                    <form class="d-flex">
                        <input type="search" placeholder="Search..."
                            style="padding:12px; width: 35vw; height: 3vw; border: 2px solid #BCBCBC; border-radius: 0.5vw;">
                    </form>
                </div>
                <hr>
                <div class="d-flex me-2 w-25">
                    <input type="date" class="form-control me-3" id="#"  min="{{date('Y-m-d')}}"
                     name="#" style="height:3vw; border: 2px solid #BCBCBC;">
                     <select class="form-select" name="department" id="department" style="height: 3vw; width: 13vw; border: 2px solid #BCBCBC;">
                        <option value="" disabled selected>Department</option>
                    </select>
                </div>
                <br>
                {{-- table --}}
                <table class="table" style="border-collapse: collapse;">
                    <thead style="font-size: 16px; border-bottom: 1px solid #dee2e6;" class="fw-bold">
                        <tr>
                            <th style="background-color: #F4F5F6;">Employee</th>
                            <th style="background-color: #F4F5F6;">Date</th>
                            <th style="background-color: #F4F5F6;">Time in</th>
                            <th style="background-color: #F4F5F6;">Time Out</th>
                            <th style="background-color: #F4F5F6;">Total Hours</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 16px;">
                        <tr>
                            <td>
                                Gwen S. Salvador
                            </td>
                            <td>Jan 15, 2025</td> 
                            <td>8:30 AM</td>
                            <td>5:30 PM</td>
                            <td>9h</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- PAGINATION --}}
@endsection
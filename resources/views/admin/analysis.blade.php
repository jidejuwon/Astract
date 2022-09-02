@extends('layouts.app')
@include('inc.navbar2')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
@section('content')
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Message <b>Details</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">S/N </th>
                        <th>Analysis </th>
                        <th >Total </th>

                    </tr>
                </thead>
                <tbody>
                    @if ($users > 0 and $task)
                        <tr>
                            <td> 1 </td>
                            <td>Pending Task</td>
                            <td>{{$task['pending']}}</td>
                        </tr>
                        <tr>
                            <td> 2 </td>
                            <td>Done Task</td>
                            <td>{{$task['done']}}</td>
                        </tr>
                        <tr>
                            <td> 3 </td>
                            <td>Overdue Task</td>
                            <td>{{$task['overdue']}}</td>
                        </tr>
                        <tr>
                            <td> 4 </td>
                            <td>Users </td>
                            <td>{{$users}}</td>
                        </tr>
                    @else
                        <tr>
                            <div class="text text-danger"><strong> No task data yet </strong></div>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

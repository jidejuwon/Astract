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
                        <th>S/N </th>
                        <th>Full Name </th>
                        <th >Date </th>
                        <th >Time </th>
                        <th >Message </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($messages) > 0)
                        @php $number = 1; @endphp
                        @foreach($messages as $message)
                            <tr>
                                <td> {{ $number }} </td>
                                <td> {{$message->name}} </td>
                                <td>{{ $message->date }}</td>
                                <td>{{ $message->time }} </td>
                                <td>{{ $message->message }}</td>
                            </tr>
                            @php
                                $number++;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <div class="text text-danger"><strong> No message sent yet </strong></div>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class='pagination justify-content-center'>
            {{  $messages->links('vendor.pagination.bootstrap-5')  }}
        </div>
    </div>
@endsection

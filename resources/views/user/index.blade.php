@extends('layouts.app')
@include('inc.navbar')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
@section('content')
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Message <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info addNew" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Send Message</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S/N </th>
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
                                <td>{{ $message->created_at }}</td>
                                <td>{{ $message->created_at }} </td>
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
@section('modal')
<!-- Add New Record Modal  -->
<div class="modal" id="addNew" tabindex="-1" role="dialog">
    <form action="{{ route('sendMessage') }}" method="POST">
    @csrf
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><small>Send</small> <strong>Message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="auto-form-wrapper">

                        <div class="form-group">

                            <div class="input-group">
                                <textarea placeholder="Send message" class="form-control" name="message" id="message" rows="10"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">SEND</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

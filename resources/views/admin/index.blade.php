@extends('layouts.app')
@include('inc.navbar2')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
@section('content')
    <div class="table ">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>User <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <form action="{{ route('admin.home') }}" method="GET">
                            <div style="display:flex; flex-direction:row; row-gap: space-evenly;float:right;">
                                <input type="text" name="status" value="{{ $status ?? "" }}" class="form-control" style="width:60%;"/>
                                <button type="submit" class="btn btn-info "> Search </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <th>S/N </th>
                        <th >Full Name</th>
                        <th >Phone No.</th>
                        <th >Email </th>
                        <th >Status </th>
                        <th >Verified </th>
                        <th >Total Messages </th>
                        <th >Actions </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                        @php $number = 1; @endphp
                        @foreach($users as $user)
                            <tr>
                                <td> {{ $number }} </td>
                                <td >{{ $user->name }}</td>
                                <td>{{ $user->phone }} </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    @if ($user->is_verified)
                                        <b style="color: green"> True </b
                                    @else
                                       <b style="color: red"> False </b>
                                    @endif
                                </td>
                                
                                <td>  {{$user->total}} </td>
                                <td>
                                    @if ($user->is_verified)
                                        <a  data-toggle="modal" data-target="#unverify-{{ $number }}"><i class="fa fa-times" title="Un-verify" style="color: red;font-size: 30px" aria-hidden="true"></i> </a>

                                    @else
                                        <a  data-toggle="modal" data-target="#verify-{{ $number }}"><i class="fa fa-check-circle" title="verify" style="color: green;font-size: 30px" aria-hidden="true"></i></a>

                                    @endif
                                    <a  data-toggle="modal" data-target="#delete-{{ $number }}"><i class="fa fa-trash" title="Delete" style="color: red;font-size: 30px" aria-hidden="true"></i></a>

                                    <!-- unverify Modal HTML -->
                                    <div class="modal fade" id="unverify-{{ $number }}">
                                        <div class="modal-dialog modal-delete">
                                            <div class="modal-content">
                                                <div class="modal-header flex-column">
                                                    <div class="icon-box">
                                                        <i class="material-icons">clear</i>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>You are about to <strong class="text-danger"> unverify </strong> {{  $user->name }}.</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <form action="{{ route('unverify', $user->id) }}" method="POST">
                                                        @method('POST')@csrf
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Un-verify</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete Modal HTML -->
                                    <div class="modal fade" id="delete-{{ $number }}">
                                        <div class="modal-dialog modal-delete">
                                            <div class="modal-content">
                                                <div class="modal-header flex-column">
                                                    <div class="icon-box">
                                                        <i class="material-icons">clear</i>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>You are about to <strong class="text-danger"> delete </strong> {{  $user->name }} records.</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <form action="{{ route('delete', $user->id) }}" method="POST">
                                                        @method('POST')@csrf
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- verify Modal HTML -->
                                    <div class="modal fade" id="verify-{{ $number }}">
                                        <div class="modal-dialog modal-delete">
                                            <div class="modal-content">
                                                <div class="modal-header flex-column">
                                                    <div class="icon-box">
                                                        <i class="material-icons">clear</i>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>You are about to <strong class="text-danger">verify </strong>{{ $user->name }} .</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <form action="{{ route('verify', $user->id) }}" method="POST">
                                                        @method('POST')@csrf
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Verify</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @php
                                $number++;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <div class="text text-danger"><strong> This table have no record </strong></div>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class='pagination justify-content-center'>
            {{  $users->links('vendor.pagination.bootstrap-5')  }}
        </div>
    </div>
@endsection

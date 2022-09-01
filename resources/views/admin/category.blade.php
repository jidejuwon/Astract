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
                    <div class="col-sm-8"><h2>Category <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info addNew" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add Category</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">S/N </th>
                        <th>Title</th>
                        <th >Status </th>
                        <th style="width: 10%">Action </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($category) > 0)
                        @php $number = 1; @endphp
                        @foreach($category as $cat)
                            <tr>
                                <td> {{ $number }} </td>
                                <td> {{$cat->title}} </td>
                                <td>{{ ucfirst($cat->status) }}</td>
                                <td> Action </td>

                            </tr>
                            @php
                                $number++;
                            @endphp
                        @endforeach
                    @else
                        <tr>
                            <div class="text text-danger"><strong> No data yet </strong></div>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class='pagination justify-content-center'>
            {{  $category->links('vendor.pagination.bootstrap-5')  }}
        </div>
    </div>
@endsection
@section('modal')
<!-- Add New Record Modal  -->
<div class="modal" id="addNew" tabindex="-1" role="dialog">
    <form action="{{ route('admin.create-category') }}" method="POST">
    @csrf
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><small>Create</small> <strong>Category</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="auto-form-wrapper">

                        <div class="form-group">

                            <div class="input-group">
                                <input placeholder="new category" class="form-control" name="title" id='title'/>
                            </div>

                        </div>

                        <div class="input-group" >
                            <select name='status' id='status' style="width:100%;" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="done">Done</option>
                                <option value="overdue">Over Due</option>

                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


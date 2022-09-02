@extends('layouts.app')
@include('inc.navbar')
@section('content')
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Task <b>Details</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info addNew" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add Task</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th style="width: 5%">S/N </th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th style="width:10%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($tasks) > 0)
                        @php $number = 1; @endphp
                        @foreach($tasks as $task)
                            <tr>
                                <td> {{ $number }} </td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->cat_title }} </td>
                                <td >{{ $task->deadline }}</td>
                                <td >{{ ucfirst($task->status) }}</td>
                                <td>

                                    <a  data-toggle="modal" data-target="#update-{{ $number }}"><i class="fa fa-edit" title="update" style="color: green;font-size: 30px" aria-hidden="true"></i> </a>

                                    <a  data-toggle="modal" data-target="#delete-{{ $number }}"><i class="fa fa-trash" title="Delete" style="color: red;font-size: 30px" aria-hidden="true"></i></a>



                                    <div class="modal" id="update-{{$number}}" tabindex="-1" role="dialog">
                                        <form action="{{ route('update-task') }}" method="POST">
                                        @csrf
                                            <div class="modal-dialog modal-ml" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><small>update</small> <strong>{{$task->title}}</strong> task</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="auto-form-wrapper">

                                                            <div class="form-group">

                                                                <div class="input-group">
                                                                    <input placeholder="new category" class="form-control" name="task_id" value="{{$task->id}}" id='task_id' hidden/>
                                                                </div>

                                                            </div>

                                                            <div class="input-group" >
                                                                <select name='status' id='status' style="width:100%;height:50px;" class="form-control">
                                                                    <option selected value="{{$task->status}}"> {{ucfirst($task->status)}}</option>
                                                                    <option disabled>=============================================</option>
                                                                    <option disabled></option>
                                                                    <option value="pending">Pending</option>
                                                                    <option value="done">Done</option>
                                                                    <option value="overdue">Over Due</option>

                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
                                                    <p>You are about to <strong class="text-danger"> delete </strong> {{  $task->title }} records.</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <form action="{{ route('delete-task', $task->id) }}" method="POST">
                                                        @method('POST')@csrf
                                                        <input type="text" hidden value="{{$task->id}}" name="task_id" required>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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
                            <div class="text text-danger"><strong> No tasks yet </strong></div>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class='pagination justify-content-center'>
            {{  $tasks->links('vendor.pagination.bootstrap-5')  }}
        </div>
    </div>
@endsection
@section('modal')
<!-- Add New Record Modal  -->
<div class="modal" id="addNew" tabindex="-1" role="dialog">
    <form action="{{ route('create-task') }}" method="POST">
    @csrf
        <div class="modal-dialog modal-ml" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><small>Create</small> <strong>Task</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="auto-form-wrapper">

                        <div class="form-group">

                            <div class="input-group">
                                <input type="text" placeholder="new Task" class="form-control" name="title" id='title'/>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="input-group" >
                                <select name='cat_id' id='cat_id' style="width:100%;" class="form-control" required>
                                    <option disable>select category </option>
                                    <option disable></option>

                                    @foreach ($category as $cat )
                                        <option value="{{$cat->id}}">{{$cat->title}}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="form-group">

                            <div class="input-group">
                                <input type="date" placeholder="Dead line" class="form-control" name="deadline" id='deadline'/>
                            </div>

                        </div>

                        <div class="input-group" >
                            <select name='status' id='status' style="width:100%;" class="form-control" required>
                                <option disable>select status </option>
                                <option disable></option>
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


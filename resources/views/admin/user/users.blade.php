@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="card-title" style="font-size: 2.1rem;">User </h3>
                                </div>
                                <div class="col-3">
                                    <a href="{{ url('user/create')}} " class="btn btn-info pull-right">Add User</a>
                                </div>
                            </div>
                        </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-warning alert-block">

                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                                    <!-- /.card-header -->
                        <div class="card-body" style="overflow-y: scroll">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NAME</th>
                                        <th>USER-NAME</th>
                                        <th>EMAIL ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>

                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->user_name }}</td>

                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ url('user/'.$user->id)}}/edit" class="btn btn-info btn-sm" ><i class="fa fa-edit"></i>Edit</a>

                                                <form action="{{ url('user/destroy/') }}" onsubmit="return confirm('Are you sure?');" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button class="btn btn-warning btn-sm" type="submit">Delete</button>
                                                </form>

                                                <a href="{{ url('user_attendance/'.$user->id)}}" class="btn btn-success btn-sm" ><i class="fa fa-edit"></i>Attendance</a>
                                                <a href="{{ url('ip_access/'.$user->id)}}" class="btn btn-success btn-sm" ><i class="fa fa-edit"></i>IP whiteList</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endsection

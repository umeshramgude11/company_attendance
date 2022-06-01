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
                                    <h3 class="card-title" style="font-size: 2.1rem;">Attendance </h3>
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
                                        <th>User Id</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($user_data[0]))
                                        @foreach ($user_data as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>

                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->date }}</td>

                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">No attenance found for the user</td>


                                    </tr>
                                    @endif

                                </tbody>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endsection

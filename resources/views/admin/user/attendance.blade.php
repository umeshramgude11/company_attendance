@extends('layouts.app')

@section('content')
    <div class="">
        <form form method="POST" action="{{ url('user')}}">
            @csrf
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Mark Your Attendance </h3>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group ">
                                            <label for="inputName">User Name : {{ session('attendance_session.user_name') }}</label>

                                            @if($data['attendance'] <= 0)

                                                <br><a href="{{ url('mark_attendance') }}" class="btn btn-sm btn-info"  >Mark attendance</a>

                                            @else
                                            <br>Your attendance recorded for today
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>

        </section>
    </form>
        <!-- /.content -->
    </div>
@endsection

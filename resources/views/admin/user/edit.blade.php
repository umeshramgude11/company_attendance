@extends('layouts.app')

@section('content')
    <div class="">
        <form form method="POST" action="{{ url('user/update/')}}">
            @csrf

             @method('PUT')
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit User </h3>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group ">
                                            <label for="inputName">User Name*</label>
                                            <input type="text" name="user_name" value="{{ $data['user_data']->user_name }}" class="form-control">
                                            <input type="hidden" name="user_id" value="{{ $data['user_data']->id }}" class="form-control">
                                            @error('user_name')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="inputName">Name</label>
                                            <input type="text" name="full_name"  value="{{ $data['user_data']->full_name }}" class="form-control" >
                                            @error('full_name')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="inputName">Email Address*</label>
                                            <input type="text" name="email" class="form-control" value="{{  $data['user_data']->email }}">
                                            @error('email')
                                            <span class="error invalid-feedback">{{ $errors  }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if ($errors->any())
                                <div class="alert alert-">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save" class="btn btn-success -right submit_btn">
                </div>
            </div>
        </section>
    </form>
        <!-- /.content -->
    </div>
@endsection

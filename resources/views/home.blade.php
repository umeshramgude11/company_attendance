@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Hi {{ session('attendance_session.user_name') }}!You are logged in!</h1>
    </div>
@endsection

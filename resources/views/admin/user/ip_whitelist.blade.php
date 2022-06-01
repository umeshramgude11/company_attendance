@extends('layouts.app')

@section('content')
    <div class="">
        <form form method="POST" action="{{ url('add_ip_access')}}">
            @csrf
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ip whitelist </h3>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group ">
                                            <label for="inputName">New IP*</label>
                                            <input type="text" name="ip"  class="form-control">
                                            <input type="hidden" name="user_id" value="{{ $data['user_id'] }}" class="form-control">

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="#" class="btn btn-secondary">Cancel</a>
                                        <input type="submit" value="Create" class="btn btn-success -right submit_btn">
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
                        <div class="card-body" style="overflow-y: scroll">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>whitelisted IP </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data['ips'])

                                        @foreach ($data['ips'] as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>

                                                <td>{{ $user->ip }}</td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">NO IPS  YES</td>

                                        </tr>
                                    @endif
                                </tbody>
                                </tfoot>
                            </table>
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

@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
        {{-- <small>Example 2.0</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Layout</a></li> --}}
        <li class="active">Users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ $message }}
    </div>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Profile</a></li>
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle"
                                    src="{{ asset('assets/dist/img/avatar.png') }}" alt="User profile picture">

                                <h3 class="profile-username text-center">{{ $data->name }}</h3>

                                <p class="text-muted text-center">Email : <span>{{ $data->email }}</span></p>

                                {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal" method="POST" action="{{ route('users.update', $data->id) }}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="jenis" value="1">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Nama</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" name="name"
                                        placeholder="Nama" value="{{ $data->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" name="email"
                                        placeholder="email" value="{{ $data->email }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPass" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPass" name="password"
                                        placeholder="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

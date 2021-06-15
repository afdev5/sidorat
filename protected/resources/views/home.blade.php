@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        {{-- <small>Example 2.0</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Layout</a></li> --}}
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="callout callout-info">
        <h4>Selamat Datang di Sidorat.com</h4>

        <p>Sistem Disposisi Persuratan Penyidikan</p>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Sidorat.com</h3>
        </div>
        <div class="box-body">
            Ini Adalah Aplikasi Surat Menyurat Untuk Membantu Pekerjaan Anda.
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="text-center">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" width="400"
            height="400">
    </div>

</section>
<!-- /.content -->
@endsection

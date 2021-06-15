@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Surat
        {{-- <small>Example 2.0</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Layout</a></li> --}}
        <li class="active">Surat</li>
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
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Buat Surat</h3>
                </div>
                <form role="form" method="POST" action="{{ route('surat.store') }}">
                    @csrf
                    <!-- /.box-header -->
                    <div class="box-body  bg-maroon">
                        <div class="form-group">
                            <label>Tanggal Pelaksana:</label>
                            <input name="tgl_pelaksana" type="date" class="form-control"
                                placeholder="Tanggal Pelaksana:">
                        </div>
                        <div class="form-group">
                            <label>Nomor:</label>
                            <input name="nomor" type="text" class="form-control"
                                placeholder="Nomor:">
                        </div>
                        <div class="form-group">
                            <label>Asal Surat:</label>
                            <input name="asal_surat" type="text" class="form-control"
                                placeholder="Asal Surat:">
                        </div>
                        <div class="form-group">
                            <label>Masalah:</label>
                            <textarea name="masalah" id="masalah" class="form-control" style="height: 300px"></textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                        </div>
                </form>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /. box -->
    </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('js')
<script>
    $(function () {
        CKEDITOR.replace('masalah')
    })

</script>
@endsection

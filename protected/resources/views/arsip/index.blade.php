@extends('layouts.app')

@if(Auth::user()->level == 0 || Auth::user()->level == 1 || Auth::user()->level == 2)
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Arsip Surat
        {{-- <small>Example 2.0</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Layout</a></li> --}}
        <li class="active">Arsip Surat</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @if($message = Session::get('failed'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ $message }}
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <!-- <h3 class="box-title">Hover Data Table</h3>  -->
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><i
                            class="fa fa-print"></i>
                        Cetak Laporan</a>
                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modal-defaultt"><i
                            class="fa fa-cloud-download"></i>
                        Backup</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 25px">No</th>
                                <th>No Agenda</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal</th>
                                <th style="width: 150px">#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Laporan</h4>
            </div>
            <div class="modal-body">
                <!-- checkbox -->
                <form action="{{ route('cetak.arsip') }}" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="">Mulai Tanggal</label>
                        <input type="date" name="start_date"
                            class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}" id="start_date"
                            value="{{ request()->get('start_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" name="end_date"
                            class="form-control {{ $errors->has('end_date') ? 'is-invalid':'' }}" id="end_date"
                            value="{{ request()->get('end_date') }}">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-defaultt">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Backup</h4>
                </div>
                <div class="modal-body">
                    <!-- checkbox -->
                    <form action="{{ route('arsip.backup') }}" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="">Mulai Tanggal</label>
                            <input type="date" name="start_date"
                                class="form-control {{ $errors->has('start_date') ? 'is-invalid':'' }}" id="start_date"
                                value="{{ request()->get('start_date') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Sampai Tanggal</label>
                            <input type="date" name="end_date"
                                class="form-control {{ $errors->has('end_date') ? 'is-invalid':'' }}" id="end_date"
                                value="{{ request()->get('end_date') }}">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            timeout: 500,
            ajax: "{{ route('datatable.arsip') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'no_agenda',
                    name: 'no_agenda'
                },
                {
                    data: 'jeniss',
                    name: 'jeniss'
                },
                {
                    data: 'tgl',
                    name: 'tgl'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

</script>
@endsection

@elseif(Auth::user()->level == 3 || Auth::user()->level == 4 || Auth::user()->level == 5)

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
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header">
                    <!-- <h3 class="box-title">Hover Data Table</h3> -->
                    {{-- <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>
                    User</a> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 25px">No</th>
                                <th>No Agenda</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal</th>
                                <th style="width: 150px">#</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            timeout: 500,
            ajax: "{{ route('datatable.arsip') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'agenda',
                    name: 'agenda'
                },
                {
                    data: 'jenis',
                    name: 'jenis'
                },
                {
                    data: 'tgl',
                    name: 'tgl'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

</script>
@endsection

@endif

@extends('layouts.app')

@if(Auth::user()->level == 2)
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
                                <th>Indeks</th>
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
            ajax: "{{ route('datatable.surat') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'indeks',
                    name: 'indeks'
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
            ajax: "{{ route('datatable.surat') }}",
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

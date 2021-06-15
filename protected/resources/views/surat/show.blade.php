@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{-- Asisten Tindak Pidana Khusus --}}
        {{-- <small>Example 2.0</small> --}}
        Penyidikan
    </h1>
</section>

<!-- Main content -->
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                Lembar Disposisi
                @if($data->jenis == 0)
                <span class="pull-right bg-green">
                    Biasa
                </span>
                @elseif($data->jenis == 1)
                <span class="pull-right bg-yellow">
                    Penting
                </span>
                @else
                <span class="pull-right bg-red">
                    Rahasia
                </span>
                @endif

            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
            <h4><b>No Agenda :</b> {{ $data->no_agenda }}</h4>
            <h4><b>Tanggal :</b> {{ $data->created_at->format('d/m/Y') }}</h4>
            <h4><b>Indeks :</b> {{ $data->indeks }}</h4>
            <h4><b>Masalah :</b></h4>
            <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                {!! $data->masalah !!}
            </div>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 invoice-col">
            <div class="text-center">
                <b>Tanggal Pelaksanaan</b>
                <h4>{{ $data->tgl_pelaksana }}</h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th style="width:50%">Asal Surat :</th>
                        <td>{{ $data->asal_surat }}</td>
                    </tr>
                    <th style="width:50%">Nomor :</th>
                    @if($data->nomor == null)
                        <td>-</td>
                    @else
                        <td>{{ $data->nomor }}</td>
                    @endif
                    </tr>
                    <th style="width:50%">Lamp :</th>
                    <td>Lbr</td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
            <p class="lead">INSTRUKSI / INFORMASI :</p>
            <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                {!! $data->instruksi !!}
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <p class="lead">DITERUSKAN KEPADA :</p>

            <div class="table-responsive">
                <table class="table">
                    @foreach($dispo as $index => $dispo)
                    <tr>
                        <th style="width:5%">{{$index+1}}.</th>
                        <th>{{$dispo->user['name']}}</th>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="{{route('arsip.cetak', $data->id)}}" target="_blank" class="btn btn-primary pull-right"><i
                    class="fa fa-print"></i> Print</a>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('js')
@endsection

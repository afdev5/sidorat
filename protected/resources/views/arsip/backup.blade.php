
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SiPP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body>
    @foreach($data as $data)
    @php
        $dispo = App\Teruskan::where('surat_id', $data->id)->get();
    @endphp
    <div class="wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="invoice">
            <h2>
                {{-- Asisten Tindak Pidana Khusus --}}
                {{-- <small>Example 2.0</small> --}}
                Penyidikan
            </h2>
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
                    <div class="text-muted well well-sm no-shadow">
                        {!! $data->masalah !!}
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    <div class="text-center">
                        <b>Tanggal Pelaksanaan</b>
                        <h4>{{ $data->tgl_pelaksana }}</h4>
                    </div>
                    <h4><b>Asal Surat : </b>{{ $data->asal_surat }}</h4>
                    @if($data->nomor == null)
                        <h4><b>Nomor : </b>-</h4>
                    @else
                        <h4><b>Nomor : </b>{{ $data->nomor }}</h4>
                    @endif
                    <h4><b>Lamp : </b>Lbr</h4>
                </div>
            </div>
            <!-- /.row -->


            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">INSTRUKSI / INFORMASI :</p>
                    <div class="text-muted well well-sm no-shadow">

                        {!! $data->instruksi !!}
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead">DITERUSKAN KEPADA :</p>
                    @foreach($dispo as $index => $dispo)
                    <h4>{{$index+1}}.{{$dispo->user['name']}}</h4>
                    @endforeach
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->

        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>
@endforeach
</html>



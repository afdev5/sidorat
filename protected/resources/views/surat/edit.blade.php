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
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Surat</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding bg-gray">
                    <div class="mailbox-read-info">
                        {{-- <h3>No Agenda  :{{ $data->no_agenda }}</h3> --}}
                        <h5>Indeks : {{ $data->indeks }}</h5>
                        <h5>Tanggal : {{ $data->created_at->format('d/m/Y') }}</h5>
                        <h5 class="pull-right">Tanggal Pelaksana : {{ $data->tgl_pelaksana }}</h5>
                        <h5>Asal Surat : {{ $data->asal_user['name'] }}</h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-center">
                        <form role="form" method="POST" action="{{ route('surat.update', $data->id) }}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label>Nomor:</label>
                                <input name="nomor" type="text" class="form-control{{ $errors->has('nomor') ? ' is-invalid' : '' }}"
                                    placeholder="Nomor:" value="{{ $data->nomor }}">
                                    @if ($errors->has('nomor'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nomor') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Asal Surat:</label>
                                <input name="asal_surat" type="text" class="form-control{{ $errors->has('asal_surat') ? ' is-invalid' : '' }}"
                                    placeholder="Asal Surat:" value="{{ $data->asal_surat }}">
                                    @if ($errors->has('asal_surat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('asal_surat') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Jenis</label>
                                <select class="form-control{{ $errors->has('jenis') ? ' is-invalid' : '' }}" name="jenis">
                                    <option disabled selected>Pilih</option>
                                    <option class="bg-green" value="0">Biasa</option>
                                    <option class="bg-yellow" value="1">Penting</option>
                                    <option class="bg-red" value="2">Rahasia</option>
                                </select>
                                @if ($errors->has('jenis'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('jenis') }}</strong>
                                </span>
                            @endif
                            </div>
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <h4><b>Masalah :</b></h4>

                        {!! $data->masalah !!}
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer bg-gray">
                    <ul class="mailbox-attachments clearfix">
                        <div class="form-group">
                            <label>Instruksi / Informasi :</label>
                            <textarea name="instruksi" id="instruksi" class="form-control"
                                style="height: 300px"></textarea>
                        </div>
                    </ul>
                </div>
                <!-- /.box-footer -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-default"><i class="fa fa-share"></i> Teruskan</button>
                    </div>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
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
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <!-- checkbox -->
                <div class="form-group">
                    <label>Diteruskan :</label>
                    @foreach($user as $user)
                    <div class="checkbox">
                        <label>
                            <input name="user[]" type="checkbox" value="{{ $user->id }}">
                            @if($user->level == 3)
                            Staf
                            @elseif($user->level == 4)
                            Jaksa Penelaah
                            @else
                            Penyidik
                            @endif
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</form>
@endsection

@section('js')
<script>
    $(function () {
        CKEDITOR.replace('instruksi')
    })

</script>
@endsection

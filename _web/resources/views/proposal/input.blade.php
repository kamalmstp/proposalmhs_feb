@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/col.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css" media="all"  />
    
@stop

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3><i class="fa fa-list-alt"></i> Input Proposal</h3>
  </div>
  <div class="panel-body">
    @if(Session::has('sukses'))
      <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
    @endif
  	<form action="{{ route('proposal_save') }}" method="POST" enctype="multipart/form-data" id="form">
      {{ csrf_field() }}     
		  <div class="form-group col-md-6">
          <label>Nama Ketua Pelaksana/ Tim</label>
          <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
      </div>
      <div class="form-group col-md-6">
          <label>NIM</label>
          <input type="text" class="form-control" value="{{ Auth::user()->nim }}" disabled>
      </div>
      <div class="form-group col-md-6">
          <label>Prodi</label>
          <input type="text" class="form-control" value="{{ Auth::user()->ps->nama }}" disabled>
      </div>
      <div class="form-group col-md-6">
          <label>Nomor Telepon</label>
          <input type="text" class="form-control" value="{{ Auth::user()->telepon }}" disabled>
      </div>
      <div class="form-group{{ $errors->has('organisasi') ? ' has-error' : '' }} col-md-6">
          <label>Organisasi/ Tim</label>
          <input name="organisasi" type="text" class="form-control" value="{{ old('organisasi') }}">
          @if ($errors->has('organisasi'))
            <span class="help-block">
                <strong>{{ $errors->first('organisasi') }}</strong>
            </span>
          @endif  
      </div>
      <div class="form-group{{ $errors->has('kegiatan') ? ' has-error' : '' }} col-md-6">
          <label>Nama Kegiatan</label>
          <input name="kegiatan" type="text" class="form-control" value="{{ old('kegiatan') }}">
          @if ($errors->has('kegiatan'))
            <span class="help-block">
                <strong>{{ $errors->first('kegiatan') }}</strong>
            </span>
          @endif
      </div>      
      <div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }} col-md-6">
          <label>Tanggal Kegiatan</label>
          <input name="tanggal" type="text" class="form-control" value="{{ old('tanggal') }}">
          @if ($errors->has('tanggal'))
            <span class="help-block">
                <strong>{{ $errors->first('tanggal') }}</strong>
            </span>
          @endif
      </div>
      <div class="form-group{{ $errors->has('tempat') ? ' has-error' : '' }} col-md-6">
          <label>Tempat Kegiatan</label>
          <input name="tempat" type="text" class="form-control" value="{{ old('tempat') }}">
          @if ($errors->has('tempat'))
            <span class="help-block">
                <strong>{{ $errors->first('tempat') }}</strong>
            </span>
          @endif
      </div>
      <div class="form-group{{ $errors->has('anggaran_a') ? ' has-error' : '' }} col-md-6">
          <label>Anggaran (Rp.)</label>
          <input name="anggaran_a" type="text" id="amount" class="form-control" value="{{ old('anggaran_a') }}">
          @if ($errors->has('anggaran_a'))
            <span class="help-block">
                <strong>{{ $errors->first('anggaran_a') }}</strong>
            </span>
          @endif
      </div>
      <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }} col-md-6">
          <label>Upload File Proposal (.pdf)</label>
          <input name="file" type="file" class="form-control" value="{{ old('file') }}">
          @if ($errors->has('file'))
            <span class="help-block">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
          @endif
      </div>      
      <div class="text-center">
          <button type="submit" class="btn btn-primary">Kirim</button>
          <button type="reset" class="btn btn-warning">Ulangi</button>
      </div>  		
  	</form>
  </div>
 </div>
@stop

@section('js')
  @parent
  <script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/daterangepicker.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('js/format_angka.js') }}"></script> 
  
  <script type="text/javascript">
    $(function() {
        $('input[name="tanggal"]').daterangepicker({
          locale: {
            format: 'DD/MM/YYYY'
          }
        });
    });
  </script>

  
@stop
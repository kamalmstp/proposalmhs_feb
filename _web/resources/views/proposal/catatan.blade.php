@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    
@stop

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3><i class="fa fa-list-alt"></i> Input Proposal</h3>
  </div>
  <div class="panel-body">
  <div class="table-responsive">
  	<table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th>Kegiatan</th>            
          <th>Ketua Pelaksana</th>
          <th>NIM</th>
          <th>Prodi</th>
          <th>Organisasi/ Tim</th>            
          <th>Tanggal Kegiatan</th>
          <th>Tempat</th>
          <th>Anggaran (Rp.)</th>            
          <th>Disetujui (Rp.)</th>            
          <th>Status</th>            
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $proposal -> kegiatan }}</td>            
          <td>{{ $proposal -> user->name }}</td>
          <td>{{ $proposal -> user->nim }}</td>
          <td>{{ $proposal -> user->prodi }}</td>
          <td>{{ $proposal -> organisasi }}</td>            
          <td>{{ $proposal -> tanggal }}</td>
          <td>{{ $proposal -> tempat }}</td>
          <td>{{ $proposal -> anggaran_a }}</td>
          <td>{{ $proposal -> anggaran_b }}</td>
          <td>{{ $proposal -> status }}</td>
        </tr>
      </tbody>      
    </table><hr>
  </div>  
    @permission(('input_catatan'))
    <?php $id = $proposal->id ?>
    <form action="{{ route('catatan_save', $id ) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
		  <div class="form-group">
          <label>Catatan</label>
          <textarea name="catatan" class="form-control" required></textarea>   
          <input type="hidden" name="proposal_id" value="{{ $proposal->id }}">       
      </div>
      <button type="submit" class="btn btn-primary">Simpan Catatan</button>            		
  	</form><br>
    @endpermission
    <table class="table table-bordered table-sm">
      <thead>
        <tr>
          <th>Catatan</th>            
          <th>Tanggal</th>          
        </tr>
      </thead>
      <tbody>
        @foreach($catatan_list as $catatan)
        <tr>
            <td>{{ $catatan -> catatan }}</td>
            <td>{{ date_format($catatan->created_at,"H:i d/m/Y") }}</td>
        </tr>
        @endforeach
      </tbody>      
    </table>
  </div>
 </div>
@stop

@section('js')
  @parent

@stop
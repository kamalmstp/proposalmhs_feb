@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">

@stop

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3><i class="fa fa-table"></i> Daftar User Mahasiswa</h3>
  </div>
  <div class="panel-body">
    @if(Session::has('sukses'))
      <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
    @endif
    <div class="table-responsive">
      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>            
            <th>Nama</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>Telepon</th>
            <th>Email</th>            
            <th>Action</th>
          </tr>
        </thead>        
        <tbody>          
          @foreach($mhs_list as $mhs)       
          <tr>
            <td>{{ $mhs -> name }}</td>
            <td>{{ $mhs -> nim }}</td>
            <td>{{ $mhs -> nama }}</td>
            <td>{{ $mhs -> telepon }}</td>
            <td>{{ $mhs -> email }}</td>                  
            <td>            
              <form method="POST" action="{{ route('user_delete', $mhs->id) }}">
              <a href="{{ route('user_edit', $mhs->id) }}" class="btn btn-link"><span class="fa fa-edit" title="Edit data user"></span></a>              
              
                  <input name="_method" type="hidden" value="DELETE">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}">
                  <button type="submit" class="btn btn-link"  title="hapus user" onclick="return confirm('Anda yakin akan menghapus data {{ $mhs->name }}?')">
                      <span class="fa fa-trash"></span>   
                  </button>
              </form>             
            </td>
          </tr>
          @endforeach 
        </tbody>
      </table>
    </div>
  </div>
</div>


@stop

@section('js')
  @parent 
  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>

@stop

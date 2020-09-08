@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">

@stop

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3><i class="fa fa-table"></i> Daftar Staff</h3>
  </div>
  <div class="panel-body">
    @if(Session::has('sukses'))
      <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
    @endif
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>            
            <th>Nama</th>
            <th>NIP</th>
            <th>Jabatan</th>
            <th>Telepon</th>
            <th>Email</th>            
            <th>Action</th>
          </tr>
        </thead>        
        <tbody>   
          @foreach($staff_list as $staff)       
          <tr>
            <td>{{ $staff -> name }}</td>
            <td>{{ $staff -> nim }}</td>
            <td>{{ $staff -> prodi }}</td>
            <td>{{ $staff -> telepon }}</td>
            <td>{{ $staff -> email }}</td>                  
            <td>            
              <a href="{{ route('user_edit', $staff->id) }}" class="btn btn-link"><span class="fa fa-edit" title="Edit data user"></span></a>              
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
  <script type="text/javascript" src="{{{ asset('js/bootstrap-confirmation.min.js') }}}"></script>
  <script type="text/javascript">
      $('[data-toggle="confirmation"]').confirmation('hide');
  </script>
@stop

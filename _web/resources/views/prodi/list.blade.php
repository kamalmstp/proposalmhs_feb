@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">

@stop

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3><i class="fa fa-table"></i> Daftar Program Studi
      <button data-toggle="modal" data-target="#inputModal" class="btn btn-warning pull-right" title="Input pagu baru"><span class="fa fa-book" ></span>  Input Prodi Baru</button><br>
    </h3>
  </div>
  @include('prodi.input')
  <div class="panel-body">
    @if(Session::has('sukses'))
      <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
    @endif
    <div class="table-responsive">
      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>            
            <th>Nama Program Studi</th>
            <th>Action</th>
          </tr>
        </thead>        
        <tbody>          
          <?php $no = 0; ?>
          @foreach($prodi_list as $prodi)       
            <?php $no++ ?>
          <tr>
            <td>{{ $prodi -> nama }}</td>                  
            <td>
              <table border="0">
                <tr>
                  <td>
                    <button data-toggle="modal" data-target="#editModal_{{$no}}" class="btn btn-link" title="Edit data pagu"><span class="fa fa-edit"></span></button>              
                    <div class="modal fade" id="editModal_{{$no}}" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel_{{$no}}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="inputModalLabel_{{$no}}">Input Program Studi</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('prodi_update', $prodi->id) }}" method="POST" enctype="multipart/form-data" id="form">
                              {{ csrf_field() }}
                              <input type="hidden" name="_method" value="PATCH">
                              <div class="form-group">
                                <label class="control-label">Nama Progam Studi</label>  
                                <input type="text" name="nama" class="form-control" value="{{$prodi->nama}}" required>        
                            </div>
                              <div class="modal-footer">                          
                                <button class="btn btn-primary" type="submit">Kirim</button>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button></div><br>
                              </div>
                            </form>
                          </div>                        
                        </div>
                      </div>
                    </div>
                          
                  </td>
                  <td>
                    <form method="POST" action="{{ route('prodi_delete', $prodi->id) }}">
                      <input name="_method" type="hidden" value="DELETE">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-link"  title="hapus prodi" onclick="return confirm('Anda yakin akan menghapus data {{ $prodi->nama }}?')">
                          <span class="fa fa-trash"></span>   
                      </button>
                    </form>      
                  </td>
                </tr>
              </table>                           
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

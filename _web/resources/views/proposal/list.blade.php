@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">

@stop

@section('content')
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3><i class="fa fa-table"></i>
     Daftar Proposal
     @if(Route::is('proposal_masuk')) Masuk
     @elseif(Route::is('proposal_revisi')) Revisi
     @elseif(Route::is('proposal_disetujui')) Disetujui
     @elseif(Route::is('proposal_ditolak')) Ditolak
     @endif
    </h3>
  </div>
  <div class="panel-body">
    @if(Session::has('sukses'))
      <div class="alert alert-success " role="alert">{{ Session::get('sukses') }}</div>
    @endif
    @if(Session::has('gagal'))
      <div class="alert alert-warning" role="alert">{{ Session::get('gagal') }}</div>
    @endif
    @if(Route::is('proposal_disetujui'))
      @if($current_pagu)
        <div class="alert alert-info" style="font-weight: bold;">
          Sisa pagu tahun {{$current_year}} adalah Rp. {{$current_pagu->sisa}}
        </div>
      @else
        <div class="alert alert-info" style="font-weight: bold;">
          Pagu Tahun {{$current_year}} belum diisi
        </div>
      @endif
    @endif
    @if ($errors)
      @foreach($errors->all() as $error)
        <div class="alert alert-warning" role="alert"> {{ $error }}</div>
      @endforeach
    @endif
    <div class="table-responsive">
      <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>Kegiatan</th>            
            <th>Ketua Pelaksana</th>
            <th>NIM</th>
            <th>Prodi</th>
            <th>No. Telp.</th>
            <th>Organisasi/ Tim</th>            
            <th>Tanggal Kegiatan</th>
            <th>Tempat</th>
            <th>Anggaran (Rp.)</th>            
            <th>Disetujui (Rp.)</th>
            @permission(('status_dana'))            
            <th>Dana</th>
            @endpermission
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>                
        <tbody>
        <?php $no=0; ?>            
        @foreach($list_proposal as $proposal)
        <?php $no++ ?>
          <tr>
            <td>{{$no}}</td>
            <td>{{ $proposal -> kegiatan }}</td>            
            <td>{{ $proposal -> user->name }}</td>
            <td>{{ $proposal -> user->nim }}</td>
            <td>{{ $proposal -> user->ps->nama }}</td>
            <td>{{ $proposal -> user->telepon}}</td>
            <td>{{ $proposal -> organisasi }}</td>            
            <td>{{ $proposal -> tanggal }}</td>
            <td>{{ $proposal -> tempat }}</td>
            <td>{{ $proposal -> anggaran_a }}</td>
            <td>{{ $proposal -> anggaran_b }}</td>
            @permission(('status_dana'))
              <td>
                <form action="{{ route('status_dana', $proposal->id) }}" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="hidden" name="_method" value="PATCH">
                  @if($proposal->dana == 'belum') 
                    <input type="submit" value="Belum"  class="btn btn-warning" onclick="return confirm('Apakah mahasiswa sudah menerima dana?');" title="Belum menerima dana">
                  @else
                    <input type="submit" value="Sudah"  class="btn btn-success" onclick="return confirm('Apakah ingin mengubah status menjadi Belum Menerima?');" title="Sudah menerima dana">
                  @endif  
                </form>
              </td>
            @endpermission
            <td>{{ $proposal -> status }}</td>
            <td>  
              <a href="{{ $proposal -> file }}" class="btn btn-link"><span class="fa fa-file-pdf-o" title="Lihat File"></span></a>             
              <a href="{{ route('catatan_list', $proposal->id) }}" class="btn btn-link"><span class="fa fa-commenting-o" title="Lihat Catatan ({{count($proposal->catatan)}})"></span></a>
              @permission(('edit_proposal'))
              @if($proposal->status == 'Revisi')
              <a href="{{ route('proposal_edit', $proposal->id) }}" class="btn btn-link"><span class="fa fa-edit" title="Edit Proposal"></span></a>
              @endif
              @endpermission
              @permission(('persetujuan'))
              @if($proposal->status == 'Proses')
                <button data-toggle="modal" data-target="#persetujuanModal_{{$no}}" class="btn btn-link"><span class="fa fa-check-square-o" title="Setujui/Revisi"></span></button>
                <div class="modal fade" id="persetujuanModal_{{$no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_{{$no}}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel_{{$no}}">Persetujuan Proposal {{$proposal->kegiatan}}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('proposal_persetujuan', $proposal->id) }}" method="POST" enctype="multipart/form-data" id="form">
                          {{ csrf_field() }}
                          <input type="hidden" name="_method" value="PATCH">
                          <div class="form-group">      
                              <select name="status" class="form-control" onchange="yesnoCheck(this);" required>
                                <option value="">--pilih--</option>
                                <option value="Revisi">Revisi</option>
                                <option value="Ditolak">Tolak</option>
                                <option value="Disetujui">Setujui</option>
                              </select>                                              
                          </div>
                          <div class="form-group">
                              <div id="ifYes" style="display: none;">
                              <label>Anggaran Disetujui (Rp.)</label>
                              <input name="anggaran_b" type="text" id="amount" class="form-control">  
                              </div>               
                          </div><hr>
                          <div class="form-group">
                            <textarea name="catatan" class="form-control" placeholder="Catatan untuk proposal jika ada"></textarea> 
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
                @endif 
              @endpermission
              @permission(('input_proposal'))
                @if($proposal->dana == 'sudah')
                  <button data-toggle="modal" data-target="#lpjModal_{{$no}}" class="btn btn-link"><span class="fa fa-file-archive-o" title="Upload LPJ"></span></button>
                  <div class="modal fade" id="lpjModal_{{$no}}" tabindex="-1" role="dialog" aria-labelledby="lpjModalLabel_{{$no}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="lpjModalLabel_{{$no}}">Upload LPJ</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{ route('upload_lpj', $proposal->id) }}" method="POST" enctype="multipart/form-data" id="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PATCH">
                            @if($proposal->lpj)
                            <label>File LPJ Saat Ini:</label><br>
                            <a href="{{ asset($proposal->lpj) }}"><span class="fa fa-file-pdf-o" title="Lihat File"></span> Lihat File</a> atau 
                            <input type="button" onClick="show()" value="upload file baru">
                            <div id="inputlpj" style="display: none;">
                            @endif
                            <br><br>                            
                              <input class="form-control" type="file" name="lpj" value="{{ $proposal->lpj }}">  
                              <div class="modal-footer">                          
                                <button class="btn btn-primary" type="submit">Kirim</button>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button></div><br>
                            </div>
                          </form>
                        </div>                                
                      </div>                        
                    </div>
                  </div>
                </div>
                @endif
              @endpermission
              @permission(('proposal_disetujui'))
                @if($proposal->lpj)
                  <a href="{{ $proposal -> lpj }}" class="btn btn-link"><span class="fa fa-file-archive-o" title="Lihat File LPJ"></span></a>
                @endif
              @endpermission
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div> <!-- table -->    
  </div>
</div>
@stop

@section('js')
  @parent 
  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>  
  <script type="text/javascript" src="{{ asset('js/format_angka.js') }}"></script> 
  <script>
    function yesnoCheck(that) {
        if (that.value == "Disetujui") {            
            document.getElementById("ifYes").style.display = "block";
            document.getElementById("amount").required = true;
        } else {
            document.getElementById("ifYes").style.display = "none";
            document.getElementById("amount").required = false;
        }
    }
  </script>
  <script type="text/javascript">
    function show(){
      alert('File sebelumnya akan terhapus jika anda upload file baru.')
      document.getElementById('inputlpj').style.display="block" ;
    }
  </script>  
@stop

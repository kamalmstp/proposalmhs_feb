@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/col.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css" media="all"  />
    
@stop

@section('content')
  <h3><i class="fa fa-list-alt"></i> Rekap Proposal</h3><hr>
    <form action="{{ route('proposal_rekapshow') }}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}      
    <div class="form-group col-md-6">
        <label>Tahun</label>
        <select name="tahun" class="form-control" required>
          @if($tahun)
          <option value="{{ $tahun }}">{{ $tahun }}</option>
          @endif
          <option value="">-- Pilih --</option>
          <option value="2017">2017</option>
          <option value="2018">2018</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
          <option value="2027">2027</option>
          <option value="2028">2028</option>
          <option value="2029">2029</option>
          <option value="2030">2030</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label>Status Proposal</label>
        <select id="status" name="status" class="form-control" required>          
          @if($status)
          <option value="{{ $status }}">{{ $status }}</option>
          @endif
          <option value="">-- pilih --</option>
          <option value="Direvisi">Direvisi</option>
          <option value="Ditolak">Ditolak</option>
          <option value="Disetujui">Disetujui</option>
        </select>  
    </div>
    <button class="btn btn-primary" onClick="tglget()" type="submit">Tampilkan Proposal</button><hr>
    <p id="demo"></p>
    </form>
    

    @if($list_proposal)
    @if($list_proposal->count() > 0)    
    <p class="alert alert-info">
      Menampilkan proposal dengan status <strong> {{ $status }} </strong>
      Tahun <strong> {{ $tahun }}</strong>         
      <div class="text-right"> 
        <form action="{{ route('proposal_pdf') }}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="tahun" value="{{ $tahun }}">          
          <input type="hidden" name="status" value="{{ $status }}">
          <input type="hidden" name="sisapagu" value="{{ $sisapagu }}">
          <input type="hidden" name="tanggaran" value="{{ number_format($tanggaran, 0,',','.' ) }}">          
          <button class="btn btn-primary" type="submit">
            <span class="fa fa-file-pdf-o"> Download Rekap</span>
          </button>
          
        </form>
      </div>
    </p>
    
    <div class="table-responsive">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
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
            <th>Status</th>
            <th>Tanggal Masuk</th>            
          </tr>
        </thead>
        <tbody>        
          @foreach($list_proposal as $proposal)
          <tr>
            <td>{{ $proposal -> kegiatan }}</td>            
            <td>{{ $proposal -> user->name }}</td>
            <td>{{ $proposal -> user->nim }}</td>
            <td>{{ $proposal -> user->ps->nama }}</td>
            <td>{{ $proposal -> user->telepon}}</td>
            <td>{{ $proposal -> organisasi }}</td>            
            <td>{{ $proposal -> tanggal }}</td>
            <td>{{ $proposal -> tempat }}</td>
            <td class="text-right">{{ $proposal -> anggaran_a }}</td>
            <td class="text-right">{{ $proposal -> anggaran_b }}</td>
            <td>{{ $proposal -> status }}</td>    
            <td>{{ date_format($proposal -> created_at, "d/m/Y") }}</td>    
          </tr>
          @endforeach
          @if($status == 'Disetujui')
          <tfoot>
          <tr>
            <th colspan="6" rowspan="2"></th>
            <th colspan="3">Total Anggaran yang Disetujui (Rp.)</th>
            <th colspan="1" class="text-right">{{ number_format($tanggaran, 0,",","." ) }}</th>
            <th colspan="2" rowspan="2"></th>
          </tr>
          <tr>            
            <th colspan="3">Sisa Pagu Tahun {{$tahun}} (Rp.)</th>
            <th colspan="1" class="text-right">{{ $sisapagu }}</th>
          </tr>  
          </tfoot>        
          @endif
        </tbody>      
      </table>
    </div>
    @else    
    <p class="alert alert-info">
      <strong>Tidak ada</strong> data proposal yang ditampilkan untuk status <strong> {{ $status }} </strong> Tahun <strong> {{ $tahun }} </strong>
    </p>
    @endif
    
    @endif
    </div>
    


@stop

@section('js')
  @parent  
  
@stop
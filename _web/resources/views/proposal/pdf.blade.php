<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<title>Dokumen Rekap Proposal</title>
</head>
<body>
	<table>
		<tr>
			<td rowspan="2"><img src="{{ asset('upload/img/logo.png') }}" height="80"></td>	
			<td><h3>Rekap Proposal Kegiatan Mahasiswa Fakultas Ekonomi dan Bisnis</h3></td>
		</tr>
		<tr>
			<td><p>Rekap proposal Tahun: {{ $tahun }} </p></td>	
		</tr>
	</table>
	
	
	<hr>

	<table class="table table-bordered table-responsive table-sm">
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
        <tr style="font-size:12px">
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
          <td>{{ $proposal -> status }}</td>    
          <td>{{ date_format($proposal -> created_at, "d/m/Y") }}</td>    
        </tr>
        @endforeach
        @if($status == 'Disetujui')
        <tfoot>
        <tr>
            <td colspan="5" rowspan="2"></th>
            <th colspan="4">Total Anggaran yang Disetujui (Rp.)</th>
            <td colspan="1" class="text-right">{{ $tanggaran }}</td>
            <th colspan="2" rowspan="2"></th>
          </tr>
          <tr>            
            <th colspan="4">Sisa Pagu Tahun {{$tahun}} (Rp.)</th>
            <td colspan="1" class="text-right">{{ $sisapagu }}</td>
          </tr>   
        </tfoot>        
        @endif
      </tbody>      
    </table>

    <div class="pull-right" style="page-break-inside: avoid; font">
      <table>
        <tr>
          <td>Atas Nama Dekan</td>
        </tr>
        <tr>
          <td>Wakil Dekan III</td>
        </tr>
        <tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
        <tr>
          <td>{{ $wd3 -> name }}</td>
        </tr>
        <tr>
          <td>NIP.{{ $wd3 -> nim }}</td>
        </tr>
      </table>        
    </div>
      </tbody> 
</body>
</html>
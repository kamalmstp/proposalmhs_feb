@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
    
@stop

@section('content')
<h1>Selamat Datang <span class="fa fa-vcard-o"></span></h1>
<hr>
<table class="table table-hover h3">
    <tr class="table-info">
        <th>
            Nama
        </th>
        <td>:</td>
        <td>
           {{ Auth::user()->name }} 
        </td>
    </tr>
    <tr class="table-primary">
        <th>
            @role(('mhs'))
                NIM
            @else
                NIP
            @endrole
        </th>
        <td>:</td>
        <td>            
           {{ Auth::user()->nim }} 
        </td>
    </tr>
    <tr class="table-info">
        <th>
            @role(('mhs'))
                Program Studi
            @else
                Jabatan
            @endrole
        </th>
        <td>:</td>
        <td>
            @role(('mhs'))
                {{ Auth::user()->ps->nama }} 
            @else
                {{ Auth::user()->prodi }} 
            @endrole
           
        </td>
    </tr>
    <tr class="table-primary">
        <th>
            Nomor Telepon
        </th>
        <td>:</td>
        <td>
           {{ Auth::user()->telepon }} 
        </td>
    </tr>
</table>

<h4>
    @role(('admin'))
    <a class="btn btn-link" href="{{ asset('upload/manual_admin.pdf') }}" title="manual admin">
    @endrole
    @role(('dekan'))
    <a class="btn btn-link" href="{{ asset('upload/manual_dekan.pdf') }}" title="manual dekan">
    @endrole
    @role(('wd2'))
    <a class="btn btn-link" href="{{ asset('upload/manual_wd2.pdf') }}" title="manual wd2">
    @endrole
    @role(('wd3'))
    <a class="btn btn-link" href="{{ asset('upload/manual_wd3.pdf') }}" title="manual wd3">
    @endrole
    @role(('umum'))
    <a class="btn btn-link" href="{{ asset('upload/manual_umum.pdf') }}" title="manual umum">
    @endrole
    @role(('mhs'))
    <a class="btn btn-link" href="{{ asset('upload/manual_mahasiswa.pdf') }}" title="manual mahasiswa">
    @endrole
        Download Panduan User
    </a>

</h4>

@stop

@section('js')
  @parent

@stop
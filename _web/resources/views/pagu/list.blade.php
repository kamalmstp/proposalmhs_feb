@extends('_layout.base')

@section('css')
    @parent    
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">

@stop

@section('content')
<div class="panel panel-primary">
	<div class="panel-heading">
   		<h3><i class="fa fa-table"></i> Daftar Pagu   		
   			<button data-toggle="modal" data-target="#inputModal" class="btn btn-warning pull-right" title="Input pagu baru"><span class="fa fa-money" ></span>  Input Pagu Baru</button><br>
   		</h3>
  	</div>
	@include('pagu.input')
  	<div class="panel-body">
	    @if(Session::has('sukses'))
	      <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
	    @endif

	    @if ($errors)
		  @foreach($errors->all() as $error)
		    <div class="alert alert-warning" role="alert"> {{ $error }}</div>
		  @endforeach
		@endif
				
	    <div class="table-responsive">
	    	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	        	<thead>
		        	<tr>
			            <th>Tahun</th>            
			            <th>Pagu (Rp.)</th>
			            <th>Sisa (Rp.)</th>
			            <th>Tanggal Dibuat</th>
			            <th>Tanggal Diperbaharui</th>
			            <th>Action</th>
		        	</tr>
	    		</thead>
	    		<tbody>            
	    			<?php $no = 0; ?>
				    @foreach($list_pagu as $pagu)
				    <?php $no++ ?>
				    <tr>
				        <td>{{ $pagu -> tahun }}</td>            
				        <td>{{ $pagu -> pagu }}</td>
				        <td>{{ $pagu -> sisa }}</td>
				        <td>{{ $pagu -> created_at->format('j/m/Y H:i') }}</td>
				        <td>{{ $pagu -> updated_at->format('j/m/Y H:i') }}</td>
				        <td>
				        	<button data-toggle="modal" data-target="#editModal_{{$no}}" class="btn btn-secondary" title="Edit data pagu"><span class="fa fa-edit"></span>  Edit Pagu </button>
				        	<div class="modal fade" id="editModal_{{$no}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{$no}}" aria-hidden="true">
								<div class="modal-dialog" role="document">
								  <div class="modal-content">
								    <div class="modal-header">
								      <h5 class="modal-title" id="editModalLabel_{{$no}}">Edit Pagu {{$pagu->tahun}}</h5>
								      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
								        <span aria-hidden="true">×</span>
								      </button>
								    </div>
								    <div class="modal-body">
								      <form action="{{ route('pagu_update', $pagu->id) }}" method="POST" enctype="multipart/form-data" id="form">
								        {{ csrf_field() }}
								        <input type="hidden" name="_method" value="PATCH">
								        <div class="form-group">
									        <label class="control-label">Tahun</label>
									        <input type="text" class="form-control" name="tahun" value="{{ $pagu->tahun }}" disabled>
									    </div>
								        <div class="form-group">
									        <label class="control-label">Pagu (Rp.)</label>
									        <input name="pagu" type="text" id="amount" class="form-control" value="{{ $pagu->pagu }}" required>
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
  <script type="text/javascript" src="{{ asset('js/format_angka.js') }}"></script>  
@stop

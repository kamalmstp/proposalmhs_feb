<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title" id="inputModalLabel">Input Program Studi</h5>
	      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">×</span>
	      </button>
	    </div>
	    <div class="modal-body">
	      <form action="{{ route('prodi_save') }}" method="POST" enctype="multipart/form-data" id="form">
	        {{ csrf_field() }}

	        <div class="form-group">
		        <label class="control-label">Nama Progam Studi</label>	
		        <input type="text" name="nama" class="form-control" required="">        
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
	

<div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title" id="inputModalLabel">Input Pagu</h5>
	      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">×</span>
	      </button>
	    </div>
	    <div class="modal-body">
		      <form action="{{ route('pagu_save') }}" method="POST" enctype="multipart/form-data" id="form">
		        {{ csrf_field() }}

		        <div class="form-group">
			        <label class="control-label">Tahun</label>	        
			        <select name="tahun" class="form-control" required>		        	
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
		        <div class="form-group">
			        <label class="control-label">Pagu (Rp.)</label>
			        <input name="pagu" type="text" id="amount" class="form-control" required>
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
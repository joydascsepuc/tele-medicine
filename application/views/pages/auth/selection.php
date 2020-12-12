<?php echo form_open('select');?>
	<div class="container-fluid" style="margin-top: 19vh; margin-bottom: 14vh;">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4" style="padding: 2rem 2rem 3rem 2rem; border: 2px solid #42B3A1; border-radius: 100px;">
				<div class="row mb-3">
					<div class="col-sm-4"></div>
					<div class="col-sm-4 text-center">
						<img src="<?php echo base_url().'assets/images/telemedicine.png';?>" height="60px" width="60px">
						
						<!-- <i class="fas fa-school fa-3x" style="color: #DC3545"></i> -->
					</div>
					<div class="col-sm-4"></div>
				</div>

				<h3 class="text-center mb-5 ">Department Select</h3>

			    <select required class="form-control select_group" id="department" name="department">
		          <option value="">- Select -</option>
		          <?php foreach ($department as $k => $v): ?>
		            <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
		          <?php endforeach ?>
		        </select>
				<div class="row mb-1 mt-2">
					<div class="col-2"></div>
					<div class="col-8">
						<button id="submitButton" class="btn btn-outline-secondary font-weight-bold btn-block mt-2" style="color: black;">Continue&nbsp;<i class="fas fa-sign-in-alt"></i></button>
					</div>
					<div class="col-2"></div>
				</div><br>
			</div>
			<div class="col-4"></div>
		</div>
	</div>
</form>


<script type="text/javascript">
	
	$(document).ready(function() {
    	$(".select_group").select2();
    });

</script>

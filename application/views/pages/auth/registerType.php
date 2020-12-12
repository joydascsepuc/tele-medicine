<?php echo form_open('register');?>
	<div class="container-fluid mt-5" style="">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="border: 2px solid #42B3A1; padding: 2rem 2rem 3rem 2rem; border-radius: 100px;">

				<div class="row mb-3">
					<div class="col-sm-4"></div>
					<div class="col-sm-4 text-center">
						<img src="<?php echo base_url().'assets/images/telemedicine.png';?>" height="60px" width="60px">
						
						<!-- <i class="fas fa-school fa-3x" style="color: #DC3545"></i> -->
					</div>
					<div class="col-sm-4"></div>
				</div>
				<h3 class="text-center mb-3 ">Registration Type</h3>
				
				<div class="row mb-2 text-center">
					<font color="red"><?php echo validation_errors(); ?></font>
					<font color="green">
						<?php if(!empty($success)) {
					      echo $success;
					    } ?>
					</font>
					<font color="red">

					    <?php if(!empty($errors)) {
					      echo $errors;
					    } ?>
					</font>
				</div>

				<!-- <select class="form-control mb-2 mt-2" id="registerType" name="registerType" required style="height:35px !important;">
					<option selected value="">Register Type</option>
					<option value="1">Doctor</option>
					<option value="2">Patient</option>
				</select>-->
				
				
				<div class="row mb-2 mt-2">
					<div class="col-6">
						<!-- <label for="category">Type/Category</label> -->
						<a title="Patient" href="<?php echo base_url('patientregister')?>" class="btn btn-outline-success btn-circle"><img height="50%" width="50%" style="" src="<?php echo base_url('assets/images/patient.png')?>" alt="Patient"><br>Patient</a>  
					</div>
					
					<div class="col-6">
						<!-- <label for="rank">Rank</label> -->
						<a title="Doctor" href="<?php echo base_url('doctorregister')?>" class="btn btn-outline-danger btn-circle"><img  height="50%" width="50%" src="<?php echo base_url('assets/images/doctor.png')?>" alt="Doctor"><br>Doctor</a>
					</div>
				</div>
			</div>
			<div class="col-3"></div>
		</div>
	</div>
<!-- </form> -->


<!-- <script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

	$('#registerType').on('change', function(){
	    var registerType = $(this).val();
	    if(registerType == "1")
	    {
	        $('#banks').prop('disabled', false);
	            bank.style.visibility='visible';
	            bank.style.display='initial';
	              // check.style.visibility='visible';
	              // check.style.display='initial';
	   	}
	    else {
	        $('#banks').prop('disabled', true);
	        bank.style.visibility='hidden';
	        bank.style.display='none';
	        // check.style.visibility='hidden';
	        // check.style.display='none';
	    }

	});

</script>
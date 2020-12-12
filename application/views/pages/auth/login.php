<?php echo form_open('signin');?>

	<div class="container-fluid" style="margin-top: 19vh; margin-bottom: 14vh;">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4" style="border: 2px solid #42B3A1; padding: 2rem 2rem 3rem 2rem; border-radius: 100px;">

				<div class="row mb-2">
					<div class="col-sm-4"></div>
					<div class="col-sm-4 text-center">
						<img src="<?php echo base_url().'assets/images/telemedicine.png';?>" height="60px" width="60px">
						
						<!-- <i class="fas fa-school fa-3x" style="color: #DC3545"></i> -->
					</div>
					<div class="col-sm-4"></div>
				</div>

				<h3 class="text-center mb-3">Login</h3>
				
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
				

				<input type="text" minlength="11" maxlength="11" autocomplete="off" name="mobile" id="mobile" class="form-control" placeholder="@mobile" style="height:35px !important;" required autofocus pattern="\d*">

				<input type="password" autocomplete="off" name="password" id="password" class="form-control mb-2 mt-2" placeholder="@password" style="height:35px !important;" required>

				<div class="row mb-1">
					<div class="col-2"></div>
					<div class="col-8">
						<button class="btn btn-outline-secondary font-weight-bold btn-block mt-2" style="color: black;">Login&nbsp;<i class="fas fa-sign-in-alt"></i></button>
					</div>
					<div class="col-2"></div>
				</div>

				<br>

				<div class="text-left">
					<span class="font-weight-bold">New Here.? </span><a href="<?php echo base_url('type')?>">Register Here.</a>
					<br>
					<a href="<?php echo base_url('forgot')?>">Forgot Password?</a>
				</div>

				<!-- <div><?php echo $this->session->flashdata('wrong');?></div> -->

			</div>

			<div class="col-4"></div>
		</div>
	</div>
</form>

<div class="container">
	<h4 class="mt-4 mb-3">Doctor's Basic Info</h4>

		<?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible mt-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
		<font color="red"><?php echo validation_errors(); ?></font>
		
	<div class="row text-left">
		<div class="col-sm-6">
			<span class="heading">Name: </span> <span><?=$doctor['name']?></span><br>
			<span class="heading">Qualification: </span> <span><?=$doctordetails['qualification']?></span><br>
			<span class="heading">Specility: </span> <span><?=$doctordetails['speciality']?></span><br>
			<span class="heading">Designation: </span> <span><?=$doctordetails['designation']?></span>
		</div>
		<div class="col-sm-6 text-center">
			<img style="border-radius: 50%" width="100px" height="100px" src="<?php echo base_url() . $doctordetails['image'] ?>" class="img-circle">
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form role="form" action="<?php base_url('placeserial') ?>" method="post">

				<label>Write your complaint here (আপনার অসুবিধা বা সমস্যার কথা বিস্তারিত লিখুন)</label>
				<textarea class="form-control mt-2 mb-2" name="complaint" id="complaint" required style="height: 100px;"></textarea>
				
			<div class="row mt-4">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<button type="submit" id="submitButton" class="btn btn-outline-primary btn-block" >Place your Serial</button>
					
				</div>
				<div class="col-md-3"></div>
			</div>
			</form>

		</div>
		<div class="col-md-1"></div>
	</div>
</div>


<div class="container">

          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
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

        	<h4 class="mt-2 mb-2">Appoinment Details</h4>
        		
        	<div class="row text-left">
        		<div class="col-sm-6">
        			<span class="heading">Doc. Name: </span> <span><?=$doctor['name']?></span><br>
              <span class="heading">Qualification: </span> <span><?=$doctor['qualification']?></span><br>
              <span class="heading">Specility: </span> <span><?=$doctor['speciality']?></span><br>
              <span class="heading">Designation: </span> <span><?=$doctor['designation']?></span>
        		</div>
        		<div class="col-sm-6">

        			<a href="<?php echo base_url()?>chat/<?=$appoinments['id']?>" class="btn btn-primary">Chat&nbsp;<i class="fas fa-comment-dots"></i>&nbsp; <?php if($unseen!=0){echo '('.$unseen.')';}?></a>
              <?php if ($appoinments['visited']==1): ?>
                <!-- <a download target="_blank" href="<?php echo base_url()?>pdfprescription/<?=$appoinments['id']?>" class="btn btn-danger">Prescription Download&nbsp;<i class="fas fa-file-download"></i></a> -->
                <a target="_blank" href="<?php echo base_url()?>patient/prep" class="btn btn-danger">Prescription Download&nbsp;<i class="fas fa-file-download"></i></a>
              <?php endif ?>
        		</div>
        	</div>
	
        	

        	<div class="row mt-2">
        		<div class="col-md-1"></div>

        		<div class="col-md-10">
        			<label>Your Complaint</label>
        			<p class="form-control mb-3" name="complaint" id="complaint" style="height: auto;"><?=$appoinments['complaintText']?></p>


              <?php if ($appoinments['visited']==0): ?>
                <hr>
                <h5>You are not prescribe yet. Please wait OR chat with the doctor.</h5>
                <?php if ($unseen!=0): ?>
                  <mark><font color="red">You Already Have <?=$unseen?> New Message(s)...</font></mark>
                <?php endif ?>
              
              <?php else: ?>
            
        			<h5>Your Prescription</h5>
              
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <label>Cheif Complaint</label>
                  <p class="mb-2" name="complaint" id="complaint" style="height: auto;"><?=$prescription['complaint']?></p>

                  <label>Examination Findings</label>
                  <p class="mb-2" name="examination" id="examination" style="height: auto;"><?=$prescription['examination']?></p>
  
                  <label>Clinical Diagnosis</label>
                  <p class="mb-2" name="diagnosis" id="diagnosis" style="height: auto;"><?=$prescription['diagnosis']?></p>

                  <label>Investigation</label>
                  <p class="mb-2" name="investigation" id="investigation" style="height: auto;"><?=$prescription['investigation']?></p>
    
                  <label>Advice</label>
                  <p class="mb-2" name="advice" id="advice" style="height: auto;"><?=$prescription['advice']?></p>
                </div>

                <div class="col-md-8">
                   <label>Medicines</label>
                    <p class="mb-2" name="advice" id="advice" style="height: auto;"><?=$prescription['medicines']?></p>
                </div>
              </div>
        		
              <?php endif ?>
        		</div>
        		<div class="col-md-1"></div>
        	</div>
        </div>


<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";

//outside click



</script>

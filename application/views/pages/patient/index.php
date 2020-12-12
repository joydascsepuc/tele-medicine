<div class="container">
	<h4 class="mt-2 mb-3 text-center">My Appointments</h4>
	<div class="row">
		<div class="col-12">
			<!-- Suru -->
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
	          
			<div id="listDiv"></div>
			
			
			
			

		</div>
	</div>
</div>


<script type="text/javascript">

	var base_url = "<?php echo base_url(); ?>"

	$(document).ready(function() {
		fetchAppointmentList();
    });

	function fetchAppointmentList(){
		$.ajax({
			//dataType : "json",
  			url: base_url + 'patientappointment',
			success:function(data)
			{
  				$('#listDiv').html(data); 
			},
			error: function (jqXHR, status, err) {
 				// alert('Local error callback');
			 }
 		});
	}

	function alertFunction1()
	{
		alert('Please wait for your serial.');
	}

	function alertFunction2()
	{
		alert('Your appoinment validity is over.');
	}

	setInterval(function(){ 
		fetchAppointmentList();
	}, 5000);

</script>
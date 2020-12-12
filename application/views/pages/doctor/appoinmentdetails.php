<style>
    /*.prothom{
      cursor: pointer;
      height:250px; 
      overflow-y:scroll;
    }

    #diseaseResult li,#medicineResult li, #instructionResult li,#instructionResult2 li,#dayResult li,#amountResult li{
      background-color: white;
    }
    
    #diseaseResult li:hover,#medicineResult li:hover, #instructionResult li:hover,#instructionResult2 li:hover,#dayResult li:hover,#amountResult li:hover
    {
      background-color: #4584E8;
    }*/

    .ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}
    ::-webkit-scrollbar {
      display: none;
    }

    html  {
       scrollbar-width: none;
    }

    #vr{
      border: none;
      border-left: 1px solid hsla(200, 10%, 50%, 100);
      height: 100%;
      width: 1px;
    }


 </style>

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
			<span class="heading">Name: </span> <span><?=$patient['name']?></span><br>
			<span class="heading">Navy ID: </span> <span><?=$patient['navyID']?></span><br>
			<span class="heading">Category/Rank/Relation: </span> <span><?=$category['name']?>&nbsp;&nbsp;||&nbsp;&nbsp;<?=$rank['name']?>&nbsp;&nbsp;||&nbsp;&nbsp;<?=$relationship['name']?></span><br>
			<span class="heading">Age: </span> <span><?=$patient['age']?></span>
		</div>
		<div class="col-sm-6 text-center">
			<img style="border-radius: 50%" width="100px" height="100px" src="<?php echo base_url() . $patient['image'] ?>" class="img-circle">
		</div>
	</div>
	<a href="tel:<?=$patient['phone']?>" class="btn btn-success">Call&nbsp;<i class="fa fa-mobile-alt"></i></a>
	<a href="<?php echo base_url('chat/'.$appoinments['id'])?>" class="btn btn-primary">Chat&nbsp;<i class="fas fa-comment-dots"></i></a>

	<div class="row mt-4">
		<div class="col-md-1"></div>

		<div class="col-md-10">
			<label>Patient's Complaint</label>
			<p class="form-control mb-3" name="patcomplaint" id="patcomplaint" style="height: auto;"><?=$appoinments['complaintText']?></p>

			<form id="prescription" action="<?php echo base_url('docappoinmentdetails/'.$appoinments['id']) ?>" method="post">
			<h4>Prescribe Patient From Here</h4>
      <h6 style="color: red">Use of Comma (,) between the text in those following boxes will separate it. Please Use Dash (-) instead of Comma (,)</h6>
        <div class="row mt-2">
  				<div class="col-md-6">
            <p class="form-control mb-2" style="padding: 0; overflow-y:scroll; height: 100px; border-radius: 5px; border: 1px solid #000;">
              <textarea tabindex="1" autofocus class="form-control mb-2" id="complaint" name="complaint" placeholder="@Complaint"></textarea>
            </p>
  					
            <p class="form-control mb-2" style="padding: 0; overflow-y:scroll; height: 100px; border-radius: 5px; border: 1px solid #000;">
  					  <textarea tabindex="3" class="form-control" id="investigation" name="investigation" placeholder="@Investigation"></textarea>
            </p>
            
            <p class="form-control mb-2" style="padding: 0; overflow-y:scroll; height: 100px; border-radius: 5px; border: 1px solid #000;">
  					  <textarea tabindex="5" class="form-control" id="advice" name="advice" placeholder="@Advice"></textarea>
            </p>
  				</div>
  				<div class="col-md-6">
            <p class="form-control mb-2" style="padding: 0; overflow-y:scroll;height: 100px; border-radius: 5px; border: 1px solid #000;">
  					 <textarea tabindex="2" class="form-control mb-2" id="examination" name="examination" placeholder="@Examination"></textarea>
            </p>
            <p class="form-control mb-2" style="padding: 0; overflow-y:scroll; height: 100px; border-radius: 5px; border: 1px solid #000;">
  					 <textarea tabindex="4" class="form-control mb-2" id="diagnosis" name="diagnosis" placeholder="@Diagnosis"></textarea>
            </p>
  				</div>
			</div>
      <p class="form-control mb-2" style="padding: 0; overflow-y:scroll; height: 100px; border-radius: 5px; border: 1px solid #000;">
        <textarea tabindex="6" class="form-control" id="medicine" name="medicine" placeholder="@Medicine-Doses-Instructions-Duration" style="height: 100px;"></textarea>
      </p>
			<!-- <div class="row">
						<div class="col-md-6">
							<div style="position: relative;">
								<input style="width: 100%" type="text" class="form-control mb-2" id="medicine" name="medicine" placeholder="Medicine Name" autocomplete="off">
								<button style="position: absolute; top: 0; right: 0" type="button" onclick="newMedicine();" title="Save Medicine" class="btn btn-default" ><i class="far fa-save"></i></button>
							</div>
					        <input type="hidden" id="medicineID" name="medicineID">
					        <div style="position: relative;" id="medicineResult"></div>
							
							<input type="text" class="form-control  mb-2" id="instruction" name="instruction" placeholder="Doses" autocomplete="off">
					       	<input type="hidden" id="instructionID" name="instructionID">
					        <div style="position: relative;" id="instructionResult"></div>


					        <input type="text" class="form-control  mb-2" id="instruction2" name="instruction2" placeholder="Instruction" autocomplete="off">
					        <input type="hidden" id="instructionID2" name="instructionID2">
					        <div style="position: relative;" id="instructionResult2"></div>

						</div>
						<div class="col-md-6">
							 <input type="text" class="form-control mb-2" id="amount" name="amount" placeholder="Amount" autocomplete="off">
							<div style="position: relative;" id="amountResult"></div>
							
							<input type="text" class="form-control mb-2" id="day" name="day" placeholder="Day" autocomplete="off">
					        <div style="position: relative;" id="dayResult"></div>

					        <a href="#" class="btn btn-primary  mb-2" id="input"><i class="fa fa-plus"></i></a>
						</div>
					</div> -->

					<!-- <table class="table">
			          <tbody id="cartItem">
			          	<tr>
			            </tr>
			          </tbody>
			        </table> -->


			<div class="row mt-4">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<button type="button" id="submitButton" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#previewModal">Prescribe</button>
				</div>
				<div class="col-md-2"></div>
			</div>
		</form>

		</div>
		<div class="col-md-1"></div>
	</div>
</div>


<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="previewModal">
  <div class="modal-dialog" role="document" style="max-width:100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Prescription Preview</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <p class="font-weight-bold">Cheif Complaint</p>
              <span id="cc"></span><br><br>
              
              <p class="font-weight-bold">Examination Findings</p>
              <span id="ef"></span><br><br>
              <!-- 3Rd Part -->
              <p class="font-weight-bold">Investigation</p>
              <span id="inv"></span><br><br>
              <!-- <span>2.Inlight SE</span><br> -->
              <!-- 4th Part -->
              <p class="font-weight-bold">Clinical Diagnosis</p>
              <span id="cd"></span><br><br>

              <p class="font-weight-bold">Advice</p>
              <span id="adv"></span><br><br>
            </div>
            
            <!-- <div class="col-md-1">
              <hr id="vr">
            </div> -->

            <div class="col-md-6">
              <span class="font-weight-bold">Rx:</span><br>
              <p class="ml-5">
                <span id="med">1. NAPA EXTRA TAH.</span>
                <!-- span class="font-weight-bold">1-0-1 Day after Meal -(Qty : 14)</span><br><br>
                <span class="">2. CAMERON.</span>
                <span class="font-weight-bold">1-1-1 Day before Meal -(Qty : 14)</span><br> -->
              </p>
            </div>


          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Edit</button>
          <button type="button" id="previewSubmitButton" class="btn btn-primary">Confirm</button>
        </div>
      
    </div>
  </div>
</div>






<script type="text/javascript">
var base_url = "<?php echo base_url(); ?>";


$('#complaint').tagEditor({
   autocomplete: {
        delay: 0, // show suggestions immediately
        position: { collision: 'flip' }, // automatic menu position up/down
        
        source: function( request, response ) {
         // Fetch data
         $.ajax({
           url:base_url + 'searchcomplaint',
          type: 'post',
          dataType: "json",
          data: {
           search: request.term
          },
          success: function( data ) {
           response( data );
          }
         });
        },
        select: function (event, ui) {
         // Set selection
         $('#complaint').val(ui.item.label); // display the selected text
         $('#cc').text(ui.item.label); // display the selected text
         //$('#medicineID').val(ui.item.value); // save selected id to input
         return false;
        }
    },
    forceLowercase: false,
    placeholder: '@Complaints'
});


$('#examination').tagEditor({
  autocomplete: {
        delay: 0, // show suggestions immediately
        position: { collision: 'flip' }, // automatic menu position up/down
        
        source: function( request, response ) {
         // Fetch data
         $.ajax({
           url:base_url + 'searchexamination',
          type: 'post',
          dataType: "json",
          data: {
           search: request.term
          },
          success: function( data ) {
           response( data );
          }
         });
        },
        select: function (event, ui) {
         // Set selection
         $('#examination').val(ui.item.label); // display the selected text
         $('#ef').text(ui.item.label); // display the selected text
         //$('#medicineID').val(ui.item.value); // save selected id to input
         return false;
        }
    },
    forceLowercase: false,
    placeholder: '@Examinations'
});
$('#diagnosis').tagEditor({
  autocomplete: {
        delay: 0, // show suggestions immediately
        position: { collision: 'flip' }, // automatic menu position up/down
        
        source: function( request, response ) {
         // Fetch data
         $.ajax({
           url:base_url + 'searchdiagnosis',
          type: 'post',
          dataType: "json",
          data: {
           search: request.term
          },
          success: function( data ) {
           response( data );
          }
         });
        },
        select: function (event, ui) {
         // Set selection
         $('#diagnosis').val(ui.item.label); // display the selected text
         $('#cd').text(ui.item.label); // display the selected text
         //$('#medicineID').val(ui.item.value); // save selected id to input
         return false;
        }
    },
    forceLowercase: false,
    placeholder: '@Diagnosis'
});
$('#investigation').tagEditor({
  autocomplete: {
        delay: 0, // show suggestions immediately
        position: { collision: 'flip' }, // automatic menu position up/down
        
        source: function( request, response ) {
         // Fetch data
         $.ajax({
           url:base_url + 'searchinvestigation',
          type: 'post',
          dataType: "json",
          data: {
           search: request.term
          },
          success: function( data ) {
           response( data );
          }
         });
        },
        select: function (event, ui) {
         // Set selection
         $('#investigation').val(ui.item.label); // display the selected text
         $('#inv').text(ui.item.label); // display the selected text
         //$('#medicineID').val(ui.item.value); // save selected id to input
         return false;
        }
    },
    forceLowercase: false,
    placeholder: '@Investigation'
});


$('#advice').tagEditor({
  autocomplete: {
        delay: 0, // show suggestions immediately
        position: { collision: 'flip' }, // automatic menu position up/down
        
        source: function( request, response ) {
         // Fetch data
         $.ajax({
           url:base_url + 'searchadvice',
          type: 'post',
          dataType: "json",
          data: {
           search: request.term
          },
          success: function( data ) {
           response( data );
          }
         });
        },
        select: function (event, ui) {
         // Set selection
         $('#advice').val(ui.item.label); // display the selected text
         $('#adv').text(ui.item.label); // display the selected text
         //$('#medicineID').val(ui.item.value); // save selected id to input
         return false;
        }
    },
    forceLowercase: false,
    placeholder: '@Advices'
});


$('#medicine').tagEditor({
  autocomplete: {
        delay: 0, // show suggestions immediately
        position: { collision: 'flip' }, // automatic menu position up/down
        
        source: function( request, response ) {
         // Fetch data
         $.ajax({
           url:base_url + 'searchmedicine',
          type: 'post',
          dataType: "json",
          data: {
           search: request.term
          },
          success: function( data ) {
           response( data );
          }
         });
        },
        select: function (event, ui) {
         // Set selection
         $('#medicine').val(ui.item.label); // display the selected text
         $('#med').text(ui.item.label); // display the selected text
         //$('#medicineID').val(ui.item.value); // save selected id to input
         return false;
        }
    },
    forceLowercase: false,
    placeholder: '@Medicine-Doses-Instructions-Duration'
});


  $("#previewSubmitButton").click(function(){        
        $("#prescription").submit(); // Submit the form
  });
</script>

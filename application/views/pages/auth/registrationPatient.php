<?php echo form_open('patientregister');?>
	<div class="container-fluid mt-5" style="">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6" style="border: 2px solid #42B3A1; padding: 2rem 2rem 3rem 2rem; border-radius: 100px;">

				<div class="row mb-2">
					<div class="col-sm-4"></div>
					<div class="col-sm-4 text-center">
						<img src="<?php echo base_url().'assets/images/telemedicine.png';?>" height="60px" width="60px">
						
						<!-- <i class="fas fa-school fa-3x" style="color: #DC3545"></i> -->
					</div>
					<div class="col-sm-4"></div>
				</div>
				<h3 class="text-center mb-3 ">Patient Register Form</h3>
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
					<p class="pName"></p>

				</div>
					
				<!-- <select class="form-control mb-2 mt-2" id="registerType" name="registerType" required style="height:35px !important;">
					<option selected value="">Register Type</option>
					<option value="1">Doctor</option>
					<option value="2">Patient</option>
				</select>-->

				<input type="text" autocomplete="off" name="name" id="name" class="form-control" placeholder="@Your Full Name" style="height:35px !important;" required autofocus value="<?php echo set_value('name'); ?>">

				<input type="text" autocomplete="off" name="navyID" id="navyID" class="form-control mb-2 mt-2" placeholder="@Your Navy ID (Only Navy ID)" style="height:35px !important;" required value="<?php echo set_value('navyID'); ?>">

				<div class="row mb-2 mt-2">
					<div class="col-6">
						<!-- <label for="category">Type/Category</label> -->
						<select required class="form-control select_group" id="category" name="category">
                          <option value="" selected>Type/Category</option>
                          <?php foreach ($category as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>" <?php echo set_select('category', $v['id']); ?>><?php echo $v['name'] ?></option>
                          <?php endforeach ?>
                        </select>
					    
					</div>
					<div class="col-6">
						<!-- <label for="rank">Rank</label> -->
					    <select required class="form-control select_group" id="rank" name="rank">
                          <option value="" selected>Rank</option>
                          <?php foreach ($rank as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>" <?php echo set_select('rank', $v['id']); ?>><?php echo $v['name'] ?></option>
                          <?php endforeach ?>
                        </select>
					</div>
				</div>
				<div class="row mb-2 mt-2">
					<div class="col-6 pmId1">
                        <span class="input-group-addon pmId2" style="display:none;"></span>
						<input onkeyup="checkAvailable();" type="text" autocomplete="off" name="mobile" id="mobile" class="form-control" placeholder="@Mobile No" style="height:35px !important;" required minlength="11" maxlength="11" pattern="\d*" value="<?php echo set_value('navyID'); ?>">
						<!-- <p class="help-block pName"></p> -->
					</div>

					<div class="col-6">
						<select onchange="checkAvailable();" required class="form-control select_group" id="relation" name="relation">
                          <option value="" selected>Relation</option>
                          <?php foreach ($relation as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>" <?php echo set_select('relation', $v['id']); ?>><?php echo $v['name'] ?></option>
                          <?php endforeach ?>
                        </select>
					</div>
					
				</div>
				<div class="row mb-2 mt-2">
					<div class="col-6">
						<!-- <label for="gender">Gender</label> -->
					    <select class="form-control" id="gender" name="gender" required>
					      <option selected value="">Gender</option>
					      <option value="1" <?php echo set_select('gender', 1); ?>>Male</option>
					      <option value="2" <?php echo set_select('gender', 2); ?>>Female</option>
					      <!-- <option value="3" <?php echo set_select('gender', 3); ?>>Other</option> -->
					    </select>
					</div>
					<div class="col-6">
						<input  type="number" autocomplete="off" id="age" name="age" min="1" class="form-control" placeholder="@Age" style="height:35px !important;" required value="<?php echo set_value('age'); ?>">
					</div>
				</div>
				<div class="row mb-2 mt-2">
					<div class="col-6">
						<input type="mail" autocomplete="off" name="mail" id="mail" class="form-control" placeholder="@email" style="height:35px !important;" value="<?php echo set_value('mail'); ?>">
					</div>
					<div class="col-6">
						<input type="password" autocomplete="off" id="password" name="password" class="form-control" placeholder="@Password" minlength="6" maxlength="12" style="height:35px !important;" required value="<?php echo set_value('password'); ?>">
					</div>
				</div>
				<textarea class="form-control" id="address" name="address" placeholder="@Address" style="height: 100px;"><?php echo set_value('address'); ?></textarea>
				
				<div class="row mb-1">
					<div class="col-2"></div>
					<div class="col-8">
						<button id="submitButton" class="btn btn-outline-success font-weight-bold btn-block mt-2" style="color: black;">Register&nbsp;<i class="fas fa-sign-in-alt"></i></button>
					</div>
					<div class="col-2"></div>
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

</script>-->


<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";
	$(document).ready(function() {
    	$(".select_group").select2();
    });


    $(document).on('focus', '.select2', function (e) {
    if (e.originalEvent) {
	        var s2element = $(this).siblings('select');
	        s2element.select2('open');
	        // Set focus back to select2 element on closing.
	        s2element.on('select2:closing', function (e) {
	            s2element.select2('focus');
	       });
    	}
	});

    function checkAvailable() {

	  var mobile = $("#mobile").val();
	  var relation = $("#relation").val();

	  if(mobile != '' && relation!=''){
	    $('.pmId1').addClass('input-group');
	    $('.pmId2').show();
	    $('.pmId2').html('<img style="height: 20px;" src="<?=base_url('assets/images/ajax-loader.gif');?>">');
	    $.ajax({
	      dataType : "json",
	       url:base_url + 'patientphone',
	       method:"POST",
	       //dataType: "json",
	      data:{mobile:mobile,relation:relation},
	       success:function(data)
	       {
	         if(data.status == 1)

	                {
	                  //alert('Member Id verified : '+data.json_ar['name']); '+data.json_ar['name']+'
	                 $('.pName').html('<span style="color:red;">This phone & relation combination is already registerd. </span>');

	                  $('.pmId2').html('<img style="height: 20px;" src="<?=base_url('assets/images/cross_mark.jpg');?>">');
	                  $("#submitButton").attr("disabled", true);
	                  }else{

	                  // $('.pName').html('<span style="color:green;">Phone Number is Available</span>'); 

	                  $('.pmId2').html('<img style="height: 20px;" src="<?=base_url('assets/images/green_checkmark.jpg');?>">');
	                  $("#submitButton").attr("disabled", false);

	                }
	       },

	       error: function (jqXHR, status, err) {

	             // alert("Local error callback.");

	            }
	      });
	  }else{

	    $('.pmId1').removeClass('input-group');

	    $('.pmId2').hide();

	    $('.pName').html(''); 

	  }
	};


</script>

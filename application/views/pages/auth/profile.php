<?php echo form_open_multipart('profile');?>
	<div class="container-fluid mt-3" style="">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8" style="border: 2px solid #42B3A1; padding: 2rem 2rem 3rem 2rem; border-radius: 100px;">
				<div class="row mb-2">
					<div class="col-sm-4"></div>
					<div class="col-sm-4 text-center">
						<img src="<?php echo base_url().'assets/images/telemedicine.png';?>" height="60px" width="60px">
						<!-- <i class="fas fa-school fa-3x" style="color: #DC3545"></i> -->
					</div>
					<div class="col-sm-4"></div>
				</div>
				
				<h3 class="text-center mb-3 ">Profile</h3>
				<div class="mb-2 text-center">
					<font color="red"><?php echo validation_errors(); ?></font>
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
				</div>

				<input type="text" autocomplete="off" name="name" class="form-control mt-2 mb-2" placeholder="@Your Name" style="height:35px !important;" required autofocus value="<?php echo $user_data['name']; ?>">

				<input type="text" autocomplete="off" name="mobile" class="form-control mt-2 mb-2" placeholder="@Mobile No" style="height:35px !important;" disabled minlength="11" maxlength="11" pattern="\d*" value="<?php echo $user_data['phone']; ?>">
				
				<?php if ($user_group['id']==4): ?>
					<input type="text" autocomplete="off" name="navyID" id="navyID" class="form-control mb-2 mt-2" placeholder="@Your Navy ID (Only Navy ID)" style="height:35px !important;" required value="<?php echo $userDetails['navyID']; ?>">
					<div class="row mb-2 mt-3">
						<div class="col-4">
						    <select class="form-control select_group" id="category" name="category" required>
						      	<option selected value="">Type/Category</option>
						      	<?php foreach ($category as $k => $v): ?>
                            		<option value="<?php echo $v['id'] ?>" <?php if($userDetails['pcategory'] == $v['id']) { echo 'selected="selected"'; } ?> ><?php echo $v['name'] ?></option>
                          		<?php endforeach ?>
						    </select>
						</div>
						<div class="col-4">
						    <select class="form-control select_group" id="rank" name="rank" required>
						      <option value="" selected>Rank</option>
	                          <?php foreach ($rank as $k => $v): ?>
	                            <option value="<?php echo $v['id'] ?>" <?php if($userDetails['prank'] == $v['id']) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
	                          <?php endforeach ?>
						    </select>
						</div>
						<div class="col-4">
						    <select class="form-control select_group" id="relation" name="relation" required>
						       <option value="" selected>Relation</option>
	                          <?php foreach ($relation as $k => $v): ?>
	                            <option value="<?php echo $v['id'] ?>" <?php if($userDetails['prelation'] == $v['id']) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
	                          <?php endforeach ?>
						    </select>
						</div>
					</div>
				<?php endif ?>
				<!-- Additional Information -->

				<?php if ($user_group['id']==3): ?>
					<input type="text" autocomplete="off" name="qualification" id="qualification" class="form-control mb-2 mt-2" placeholder="@Your Qualification" style="height:35px !important;" required autofocus  value="<?php echo $userDetails['qualification']; ?>">

					<input type="text" autocomplete="off" name="designation" id="designation" class="form-control mb-2 mt-2" placeholder="@Your Designation" style="height:35px !important;" required autofocus  value="<?php echo $userDetails['designation']; ?>">
					
					<input type="text" autocomplete="off" name="speciality" id="speciality" class="form-control mb-2 mt-2" placeholder="@Your Speciality" style="height:35px !important;" required autofocus  value="<?php echo $userDetails['speciality']; ?>">

					<input type="text" autocomplete="off" name="mobile" class="form-control mt-2 mb-2" placeholder="@Emergency Mobile No" style="height:35px !important;" minlength="11" maxlength="11" pattern="\d*" value="<?php echo $userDetails['emContact']; ?>">
				<?php endif ?>
				
				
				

				<?php if ($user_group['id']==3 || $user_group['id']==4): ?>
					<div class="row mb-2 mt-2">
						<div class="col-6">
							<input type="mail" autocomplete="off" name="mail" class="form-control" placeholder="@email" style="height:35px !important;" value="<?php echo $userDetails['email']; ?>">
						</div>
						<div class="col-3">
							<select class="form-control" id="gender" name="gender" required>
								<option selected value="">Gender</option>
							    <option value="1" <?php if($userDetails['gender'] == 1) { echo 'selected="selected"'; } ?>>Male</option>
							    <option value="2" <?php if($userDetails['gender'] == 2) { echo 'selected="selected"'; } ?>>Female</option>
							    <option value="3" <?php if($userDetails['gender'] == 3) { echo 'selected="selected"'; } ?>>Other</option>
							</select>
						</div>

						<div class="col-3">
							<input required  min="1" type="number" autocomplete="off" name="age" id="age" class="form-control" placeholder="@Age" style="height:35px !important;" value="<?php echo $userDetails['age']; ?>">
						</div>
					</div>
					
					<textarea id="address" name="address" class="form-control mt-2" placeholder="@address" style="height: 100px;"><?php echo $userDetails['address']; ?></textarea>

					<div class="row mt-2 mb-2">
						<div class="col-8">
							<label class="">Your Image</label>
							<input type="file" name="profileimage" id="profileimage" class="form-control" style="padding: 0">
						</div>
						<div class="col-4">
							<img style="border-radius: 50%" width="100px" height="100px" src="<?php echo base_url() . $userDetails['image'] ?>">
						</div>
					</div>
					
				<?php endif ?>

				<?php if ($user_group['id']==3): ?>
				<div class="row mt-2 mb-2">
					<div class="col-8">
						<label class="">Your Signature Image</label>
						<input type="file" name="signatureimage" id="signatureimage" class="form-control" style="padding: 0">
					</div>
					<div class="col-4">
						<img style="border-radius: 50%" width="100px" height="100px" src="<?php echo base_url() . $userDetails['signature_image'] ?>" class="img-circle">
					</div>
				</div>
				<?php endif ?>
				
				
				<div class="alert alert-info alert-dismissible mb-2 mt-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      Leave the password field empty if you don't want to change.
                </div>

                <div class="row mb-2 mt-2">
					<div class="col-6 pmId1">
                        <span class="input-group-addon pmId2" style="display:none;"></span>
						<input type="password" autocomplete="off" name="prePass" id="prePass" class="form-control" placeholder="@Current Password" style="height:35px !important;"  minlength="6" maxlength="12">
					</div>

					<div class="col-6">
						<input type="password" autocomplete="off" name="password" class="form-control" placeholder="@New Password" style="height:35px !important;" minlength="6" maxlength="12">
					</div>
				</div>

				<div class="row mb-1">
					<div class="col-2"></div>
					<div class="col-8">
						<button id="submitButton" class="btn btn-outline-secondary font-weight-bold btn-block mt-2" style="color: black;">Update Information&nbsp;<i class="fas fa-sign-in-alt"></i></button>
					</div>
					<div class="col-2"></div>
				</div>
			</div>
			<div class="col-2"></div>
		</div>
	</div>
</form>


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




    $("#prePass").keyup('on',function(){

	  var prePass = $("#prePass").val();

	  if(prePass != ''){
	    $('.pmId1').addClass('input-group');
	    $('.pmId2').show();
	    $('.pmId2').html('<img style="height: 20px;" src="<?=base_url('assets/images/ajax-loader.gif');?>">');
	    $.ajax({
	      dataType : "json",
	       url:base_url + 'passcheck',
	       method:"POST",
	       //dataType: "json",
	      data:{prePass:prePass},
	       success:function(data)
	       {
	         if(data.status == 1)

	                {
	                  //alert('Member Id verified : '+data.json_ar['name']); '+data.json_ar['name']+'
	                 // $('.pName').html('<span style="color:red;">Phone Number is Registered with : '+data.json_ar['name']+'</span>');
		                $('.pmId2').html('<img style="height: 20px;" src="<?=base_url('assets/images/green_checkmark.jpg');?>">');
		                $("[name='password']").attr("required", true);
		                $("#submitButton").attr("disabled", false);
		                
		                
	                 }else{

	                  // $('.pName').html('<span style="color:green;">Phone Number is Available</span>'); 

	                  $('.pmId2').html('<img style="height: 20px;" src="<?=base_url('assets/images/cross_mark.jpg');?>">');
	                  $("#submitButton").attr("disabled", true);
		              $("[name='password']").attr("required", false);

	                }
	       },

	       error: function (jqXHR, status, err) {

	             // alert("Local error callback.");

	            }
	      });
	  }else{

	    $('.pmId1').removeClass('input-group');

	    $('.pmId2').hide();

	    // $('.mName').html(''); 
	    $("#submitButton").attr("disabled", false);
		$("[name='password']").attr("required", false);

	  }
	});


</script>
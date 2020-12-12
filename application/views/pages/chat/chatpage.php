<style type="text/css">

	.block {
	  border: 2px solid #000000;
	  background-color: #f1f1f1;
	  border-radius: 0px 15px 15px 15px;
	  padding: 10px;
	  margin: 10px 0;
	  width: 75%;
	  float: left;
	}

	.darker {
	  border: 2px solid #000000;
	  background-color: #8ab7f2;
	  border-radius: 15px 15px 0px 15px;
	  float: right;
	}

	.block::after {
	  content: "";
	  clear: both;
	  display: table;
	}

	.block i {
	  float: left;
	  max-width: 50px;
	  width: 100%;
	}
	
	.maindiv{
		height: 69vh;
		overflow-y: scroll;
		width: 100%;
		overflow-x: hidden;
	}

	.animated {
	  -webkit-animation: animateThis .5s ease;
	  animation: animateThis .5s ease;
	  -webkit-animation-fill-mode: forwards;
	  animation-fill-mode: forwards;
	}

	::-webkit-scrollbar {
    	display: none;
	}
	
	.attachmentImgCls{ width:450px; margin-left: -25px; cursor:pointer; }
	
	.btn:focus, .btn:active {
	  outline: none !important;
	  box-shadow: none !important;
	}
	
	.templatemodal {
	  top: 430px;
	  /*margin: 0px;*/
	}

	.btn-circle {
	  width: 30px;
	  height: 30px;
	  /*text-align: center;*/
	  /*padding: 0px 0;*/
	  font-size: 12px;
	  line-height: 1.428571429;
	  border-radius: 15px;
	}

	.btn-circle.btn-xl {
	  width: 70px;
	  height: 70px;
	  padding: 5px 5px;
	  line-height: 1.33;
	  border-radius: 35px;
	}

</style>


<div class="container">
	<h5 id="ReciverName_txt"><?php echo $receiver['name'];?></h5>
	<!-- <button style="position: fixed; display: block; top: 50px; right: 20px;" class="btn btn-danger">Prescribe & Quit</button> -->
	<input type="hidden" id="ReciverId_txt" value="<?php echo $receiver['id'];?>">
	<input type="hidden" id="appointID" value="<?php echo $appoinments['id'];?>">
	<input type="hidden" id="visited" value="<?php echo $appoinments['visited'];?>">


	<textarea id="complaintHidden" name="complaintHidden" style="display:none;"></textarea>
	<textarea id="examinationHidden" name="examinationHidden" style="display:none;"></textarea>
	<textarea id="diagnosisHidden" name="diagnosisHidden" style="display:none;"></textarea>
	<textarea id="investigationHidden" name="investigationHidden" style="display:none;"></textarea>
	<textarea id="adviceHidden" name="adviceHidden" style="display:none;"></textarea>
	<textarea id="medicineHidden" name="medicineHidden" style="display:none;"></textarea>

	<div class="maindiv animated" id="maindiv">
		<div id="chatDiv"></div>
	</div>
	<!-- Message Section -->
	<div style="height: 5vh;">
		<div class="row" style="vertical-align: center;">

			<div class="col-1 text-center pr-0 mr-0 ml-0 pl-0">
			<?php if ($this->session->userdata('group')!=4): ?>

				<button  id="navButton" class="btn btn-circle pr-0 mr-0 ml-0 pl-0" onclick="design();" style="background-color: black;">
					<i class="fas fa-plus" style="color: #fff;"></i>
				</button>
			<?php endif ?>
				
			</div>

			<div class="text-center col-8 ml-0 pl-0 mr-0 pr-0">
				<textarea autofocus id="textmsg" class="form-control message ml-0 pl-0 mr-0 pr-0" style="max-height: 50px; width: 100%;"></textarea>
			</div>
			
			<div class="col-1 pr-0 mr-0 ml-0 pl-0 text-center">
				<button title="Send" id="sendButton" class="btn btn-circle pr-0 mr-0 ml-0 pl-0 btnSend" style="background-color: blue; ">
					<i class="fas fa-share" style="color: #fff;"></i>
				</button>
			</div>

			<div class="col-1 pr-0 mr-0 ml-0 pl-0 text-center">
				<button title="Attach File" id="fileview" class="btn btn-circle pr-0 mr-2 ml-0 pl-0" style="background-color: green; ">
					<i class="fas fa-upload" style="color: #fff;"></i>
				</button>
				<input type="file" name="file" id="file" class="upload_attachmentfile" style="display:none;"/>
			</div>

			
			<div class="col-1 text-center pr-0 mr-0 ml-0 pl-0">
				<?php if ($this->session->userdata('group')!=4): ?>
				<button  id="prescribe" title="Prescription" class="btn btn-circle pr-0 mr-0 ml-0 pl-0" style="background-color: red; " disabled>
					<i class="fas fa-prescription" style="color: #fff;"></i>
				</button>
			<?php endif ?>

			</div>
		</div>
	</div>

	<!-- Hidden Div -->
	<div style="display: none; height: 20vh; margin-bottom: 91px;" id="attachmentdiv">
		<div class="row mt-4 text-center">
			<div class="col-4">
				<button class="btn btn-circle btn-xl" type="button" data-toggle="modal" data-target="#complaintModal" style="background-color: #a01414;">
					<i class="fas fa-stethoscope fa-4x" style="color: #fff;"></i><br>
				</button><br>
				Cheif Complaint
			</div>
			<div class="col-4">
				<button class="btn btn-circle btn-xl" type="button" data-toggle="modal" data-target="#examinationModal" style="background-color: #c900d3; ">
					<i class="fas fa-clipboard-list fa-4x" style="color: #fff;"></i><br>
				</button><br>Examination Findings
			</div>
			<div class="col-4">
				<button class="btn btn-circle btn-xl" type="button" data-toggle="modal" data-target="#diagnosisModal" style="background-color: #db5f00; ">
					<i class="fas fa-diagnoses fa-4x" style="color: #fff;"></i><br>
				</button><br>Clinical Diagnosis
			</div>
			
		</div>
		<div class="row mt-3 text-center">
			<div class="col-4">
				<button class="btn btn-circle btn-xl" type="button" data-toggle="modal" data-target="#investigationModal" style="background-color: #333300; ">
					<i class="fas fa-file-medical-alt fa-4x" style="color: #fff;"></i><br>
					
				</button><br>Investigataion
			</div>
			<div class="col-4">
				<button class="btn btn-circle btn-xl" type="button" data-toggle="modal" data-target="#adviceModal" style="background-color: #00776d; ">
					<i class="fas fa-comment-medical fa-4x" style="color: #fff;"></i><br>
					
				</button><br>Advices
			</div>
			<div class="col-4">
				<button class="btn btn-circle btn-xl" type="button" data-toggle="modal" data-target="#medicineModal" style="background-color: #00176b; ">
					<i class="fas fa-pills fa-4x" style="color: #fff;"></i><br>
					
				</button><br>Medicines
			</div>
			
		</div>
	</div>

</div>


<div class="modal fade animated bounceIn" id="myModalImg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modelTitle">Image Preview</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <img id="modalImgs" src="" class="img-thumbnail" alt="">
        </div>
        
        <!-- Modal footer -->
         
        
      </div>
    </div>
  </div>


 <div class="modal fade animated bounceIn" id="complaintModal" tabindex="-1" role="dialog" aria-labelledby="complaintModalLabel" aria-hidden="true">
  <div class="modal-dialog templatemodal" role="document">
    <div class="modal-content">
      <div class="modal-body container">
        <div id="compmessge"></div>
			<div class="row">
				<div class="col-10 mr-0">
					<p class="form-control"  style="padding: 0; overflow-y:scroll;  height: 80px; border-radius: 5px; border: 1px solid #000;">
              			<textarea autofocus class="form-control" id="complaint" name="complaint" placeholder="@Complaint"></textarea>
            		</p>
				</div>
				<div class="col-2 pl-0 ml-0">
					<button class="btn" id="complaintSend" name="complaintSend" style="margin-top: 50%">
						<i class="fas fa-caret-square-right fa-2x"></i>
					</button>
				</div>
			</div>
            <span style="color: red;" class="text-center">Use of Comma (,) between the text in the following box will separate it. Please Use Dash (-) instead of Comma (,)</span>
      </div>
    </div>
  </div>
</div>


<div class="modal fade animated bounceIn" id="examinationModal" tabindex="-1" role="dialog" aria-labelledby="examinationModalLabel" aria-hidden="true">
  <div class="modal-dialog templatemodal" role="document">
    <div class="modal-content">
      <div class="modal-body container">
            <div id="exammessge"></div>
			<div class="row">
				<div class="col-10 mr-0">
	            	<p class="form-control"  style="padding: 0; overflow-y:scroll;  height: 80px; border-radius: 5px; border: 1px solid #000;">
	              		<textarea autofocus class="form-control" id="examination" name="examination" placeholder="@Examination"></textarea>
	            	</p>
	            </div>
				<div class="col-2 pl-0 ml-0">
	            	<button class="btn" id="examinationSend" name="examinationSend">
	            		<i class="fas fa-caret-square-right fa-2x" style="margin-top: 50%;"></i>
	            		<br>
	            	</button>
	        	</div>
	        </div>
	        <span style="color: red;" class="text-center">Use of Comma (,) between the text in the following box will separate it. Please Use Dash (-) instead of Comma (,)</span>
      </div>
    </div>
  </div>
</div>


<div class="modal fade animated bounceIn" id="diagnosisModal" tabindex="-1" role="dialog" aria-labelledby="diagnosisModalLabel" aria-hidden="true">
  <div class="modal-dialog templatemodal" role="document">
    <div class="modal-content">
      <div class="modal-body container">
            <div id="diagmessge"></div>
			<div class="row">
				<div class="col-10 mr-0">
	            	<p class="form-control pr-0 mr-0"  style="padding: 0; overflow-y:scroll;  height: 80px; border-radius: 5px; border: 1px solid #000;">
	              		<textarea autofocus class="form-control " id="diagnosis" name="diagnosis" placeholder="@Diagnosis"></textarea>
	            	</p>
	            </div>
				<div class="col-2 pl-0 ml-0">
	            	<button class="btn" id="diagnosisSend" name="diagnosisSend" style="margin-top: 50%;">
	            		<i class="fas fa-caret-square-right fa-2x"></i>
	            	</button>
	            </div>
            </div>
            <span style="color: red;" class="text-center">Use of Comma (,) between the text in the following box will separate it. Please Use Dash (-) instead of Comma (,)</span>
      </div>
    </div>
  </div>
</div>


<div class="modal fade animated bounceIn" id="investigationModal" tabindex="-1" role="dialog" aria-labelledby="investigationModalLabel" aria-hidden="true">
  <div class="modal-dialog templatemodal" role="document"  style="width: 100%;">
    <div class="modal-content">
      <div class="modal-body container">
        <div id="investmessge"></div>
		<div class="row">
			<div class="col-10 mr-0">
            	<p class="form-control pr-0 mr-0"  style="padding: 0; overflow-y:scroll;  height: 80px; border-radius: 5px; border: 1px solid #000;">
              		<textarea autofocus class="form-control" id="investigation" name="investigation" placeholder="@Investigation"></textarea>
            	</p>
            </div>
			<div class="col-2 pl-0 ml-0">
            	<button class="btn" type="button" id="investigationSend" name="investigationSend"><i class="fas fa-caret-square-right fa-2x" style="margin-top: 50%;"></i><br></button>
        	</div>
    	</div>
        	<span style="color: red;" class="text-center">Use of Comma (,) between the text in the following box will separate it. Please Use Dash (-) instead of Comma (,)</span>
      </div>
    </div>
  </div>
</div>



<div class="modal fade animated bounceIn" id="adviceModal" tabindex="-1" role="dialog" aria-labelledby="adviceModalLabel" aria-hidden="true">
  <div class="modal-dialog templatemodal" role="document">
    <div class="modal-content">
      <div class="modal-body ">
        <div id="advicemessge"></div>
		<div class="row">
			<div class="col-10 mr-0">
	            <p class="form-control pr-0 mr-0"  style="padding: 0; overflow-y:scroll;  height: 80px; border-radius: 5px; border: 1px solid #000;">
	              <textarea autofocus class="form-control" id="advice" name="advice" placeholder="@Advice"></textarea>
	            </p>
			</div>
			<div class="col-2 pl-0 ml-0">	            
            	<button class="btn" id="adviceSend" name="adviceSend" style="margin-top: 50%;">
            		<i class="fas fa-caret-square-right fa-2x"></i>
            	</button>
        	</div>
    	</div>
    	<span style="color: red;" class="text-center">Use of Comma (,) between the text in the following box will separate it. Please Use Dash (-) instead of Comma (,)</span>
           
      </div>
    </div>
  </div>
</div>


<div class="modal fade animated bounceIn" id="medicineModal" tabindex="-1" role="dialog" aria-labelledby="medicineModalLabel" aria-hidden="true">
  <div class="modal-dialog templatemodal" role="document">
    <div class="modal-content">
      <div class="modal-body ">

        <div id="medicinemessge"></div>
		<div class="row">
			<div class="col-10 mr-0">
	            <p class="form-control" style="padding: 0; overflow-y:scroll;  height: 80px; border-radius: 5px; border: 1px solid #000;">
	              <textarea autofocus class="form-control" id="medicine" name="medicine" placeholder="@Medicine"></textarea>
	            </p>
            </div>
			<div class="col-2 pl-0 ml-0">
            	<button class="btn" id="medicineSend" name="medicineSend" style="margin-top: 50%;">
            		<i class="fas fa-caret-square-right fa-2x" style=""></i>
            	</button>
        	</div>
    	</div>
    	<span style="color: red;" class="text-center">Use of Comma (,) between the text in the following box will separate it. Please Use Dash (-) instead of Comma (,)</span>
 
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">

	var base_url = "<?php echo base_url(); ?>"
	// var group = "<?php echo $this->session->userdata('group') ?>";

	$(document).ready(function() {
		var element = document.getElementById("maindiv");
		element.scroll({
			top: 9000000000000,
		  	behavior: 'smooth'
		});


		GetChatHistory($('#ReciverId_txt').val());

		if ($('#visited').val()==1) {
			ChatSection(0);
		}
		else{
			ChatSection(1);
		}
    });



	$("#fileview").click(function () {
    	$("#file").trigger('click');
	});

	function design(){
		var ob = document.getElementById("attachmentdiv");
		var pos = ob.style.display;
		if(pos == 'none'){
			/*Reduce upper div height*/
			document.getElementById("maindiv").style.height = '39vh';
			var element = document.getElementById("maindiv");
			element.scroll({
				top: 9000000000000,
			  	behavior: 'smooth'
			});
			/*Making div visible*/
			$("#navButton").html('<i class="fas fa-times" style="color: #fff;"></i>');
			document.getElementById("attachmentdiv").style.display = '';
		}else{
			/*Increase upper div height*/
			document.getElementById("maindiv").style.height = '69vh';
			var element = document.getElementById("maindiv");
			element.scroll({
				top: 90000000000000,
			  	behavior: 'smooth'
			});
			/*Making div invisible*/
			$("#navButton").html('<i class="fas fa-plus" style="color: #fff;"></i>');

			document.getElementById("attachmentdiv").style.display = 'none';
		}
	}

    function GetChatHistory(receiver_id){
		$.ajax({
			//dataType : "json",
  			url: base_url + 'chathistory/'+receiver_id,
			success:function(data)
			{
  				$('#chatDiv').html(data);
				//ScrollDown();	 
			},
			error: function (jqXHR, status, err) {
 				// alert('Local error callback');
			 }
 		});
	}

	setInterval(function(){ 
		var receiver_id = $('#ReciverId_txt').val();
		if(receiver_id!=''){
			GetChatHistory(receiver_id);
		}
	}, 3000);

	function ScrollDown(){
		var elmnt = document.getElementById("maindiv");
	    var h = elmnt.scrollHeight;
	   		$('#maindiv').animate({scrollTop: h}, 1000);
	}
	window.onload = ScrollDown();


	$('.message').keypress(function(event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
	    if(keycode == '13'){
	       sendTxtMessage($(this).val());
	    }
	});

	$('.btnSend').click(function(){
	    sendTxtMessage($('.message').val());
	});


	function sendTxtMessage(message){
		var messageTxt = message.trim();
		if(messageTxt!=''){
			//console.log(message);
	 		DisplayMessage(messageTxt);
			
					var receiver_id = $('#ReciverId_txt').val();
					var appointID = $('#appointID').val();
					$.ajax({
							  dataType : "json",
							  type : 'post',
							  data : {messageTxt : messageTxt, receiver_id : receiver_id, appointID : appointID },
							  url: base_url + 'sendtext',
							  success:function(data)
							  {
	  							GetChatHistory(receiver_id)		 
							  },
							  error: function (jqXHR, status, err) {
	 							 // alert('Local error callback');
							  }
	 					});
			
			ScrollDown();
			$('#textmsg').val('');
			$('.message').focus();
		}else{
			$('.message').focus();
		}
	}


	$('.upload_attachmentfile').change(function(){
	
		DisplayMessage('<div class="spiner"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
		ScrollDown();
		
		var file_data = $('.upload_attachmentfile').prop('files')[0];
		var receiver_id = $('#ReciverId_txt').val();   
	    var appointID = $('#appointID').val();
	    var form_data = new FormData();
	    form_data.append('attachmentfile', file_data);
		form_data.append('type', 'Attachment');
		form_data.append('receiver_id', receiver_id);
		form_data.append('appointID', appointID);
		
		$.ajax({
	                url: base_url	+ 'sendtext', 
	                dataType: 'json',  
	                cache: false,
	                contentType: false,
	                processData: false,
	                data: form_data,                        
	                type: 'post',
	                success: function(response){
						
						$('.upload_attachmentfile').val('');
						GetChatHistory(receiver_id);
					},
					error: function (jqXHR, status, err) {
	 							 // alert('Local error callback');
					}
		 });
		
	});




	function DisplayMessage(message){
		//var Sender_Name = $('#Sender_Name').val();
		//var Sender_ProfilePic = $('#Sender_ProfilePic').val();
		
			var str = '<div class="block darker text-right">'+
						'<i class="fas fa-user-circle fa-2x float-right"></i><p class="ml-2">'+message;
					str+='</p><span class="float-left"></span></div>';
			$('#chatDiv').append(str);
	}


	

	function ViewAttachmentImage(image_url,imageTitle){
		$('#modelTitle').html(imageTitle); 
		$('#modalImgs').attr('src',image_url);
		$('#myModalImg').modal('show');
	}

	function ChatSection(status){
	//chatSection
		if(status==0){
			//$('#chatSection :input').attr('disabled', true);
			$('#textmsg').attr('disabled', true);
			$('#navButton').attr('disabled', true);
			$('#fileview').attr('disabled', true);
			$('#sendButton').attr('disabled', true);
			$('#prescribe').attr('disabled', true);
	    } else {
	        //$('#chatSection :input').removeAttr('disabled');
			$('#textmsg').attr('disabled', false);
			$('#navButton').attr('disabled', false);
			$('#fileview').attr('disabled', false);
			$('#sendButton').attr('disabled', false);
			// $('#prescribe').attr('disabled', false);
	    }   
	}



	// $('.ClearChat').click(function(){
	//        var receiver_id = $('#ReciverId_txt').val();
	//   	 			$.ajax({
	// 						  //dataType : "json",
	//   						  url: 'chat-clear?receiver_id='+receiver_id,
	// 						  success:function(data)
	// 						  {
	//   							 GetChatHistory(receiver_id);		 
	// 						  },
	// 						  error: function (jqXHR, status, err) {
	//  							 // alert('Local error callback');
	// 						  }
	//  					});
	 				
	// });


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
        position: { my: "left top", at: "left bottom", collision: 'custom' }, // automatic menu position up/down
        
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
         //$('#medicineID').val(ui.item.value); // save selected id to input
         return false;
        }
    },
    forceLowercase: false,
    placeholder: '@Medicine-Doses-Instructions-Duration'
});


	$('#complaintSend').click(function(){
		if($('#complaint').val() != ''){
			var message= 'Cheif Complaints: '+$('#complaint').val();
		    sendTxtMessage(message);
		    $("#complaintModal").modal('hide');


		    var complaintHidden= $('#complaintHidden').val();
			var complaint= $('#complaint').val();
			if(complaintHidden!=''){
				$('#complaintHidden').val(complaintHidden+ ',' + complaint);
			}
			else{
				$('#complaintHidden').val(complaint);
			}

			var tags = $('#complaint').tagEditor('getTags')[0].tags;
			for (i = 0; i < tags.length; i++) { $('#complaint').tagEditor('removeTag', tags[i]); }

			
			//$('#complaintHidden').append(',' + $('#complaint').val());
			$('#complaint').val('');
			$('#compmessge').html('');

		}
		else{
			$('#compmessge').html('<p style="color:red">Please Select Atleast One Complaint</p>');
		}
	});


	$('#examinationSend').click(function(){
		if($('#examination').val() != ''){
			var message= 'Examinations Findings: '+$('#examination').val();
		    sendTxtMessage(message);
		    $("#examinationModal").modal('hide');

		    var examinationHidden= $('#examinationHidden').val();
			var examination= $('#examination').val();
			if(examinationHidden!=''){
				$('#examinationHidden').val(examinationHidden+ ',' + examination);
			}
			else{
				$('#examinationHidden').val(examination);
			}

			var tags = $('#examination').tagEditor('getTags')[0].tags;
			for (i = 0; i < tags.length; i++) { $('#examination').tagEditor('removeTag', tags[i]); }
			$('#examinationHidden').append(','+$('#examination').val());
			$('#examination').val('');
			$('#exammessge').html('');

		}
		else{
			$('#exammessge').html('<p style="color:red">Please Select Atleast One Examination</p>');
		}
	});


	$('#diagnosisSend').click(function(){
		if($('#diagnosis').val() != ''){
			var message= 'Clinical Diagnosis: '+$('#diagnosis').val();
		    sendTxtMessage(message);
		    $("#diagnosisModal").modal('hide');

		    var diagnosisHidden= $('#diagnosisHidden').val();
			var diagnosis= $('#diagnosis').val();
			if(diagnosisHidden!=''){
				$('#diagnosisHidden').val(diagnosisHidden+ ',' + diagnosis);
			}
			else{
				$('#diagnosisHidden').val(diagnosis);
			}

			var tags = $('#diagnosis').tagEditor('getTags')[0].tags;
			for (i = 0; i < tags.length; i++) { $('#diagnosis').tagEditor('removeTag', tags[i]); }
			$('#diagnosisHidden').append(','+$('#diagnosis').val());
			$('#diagnosis').val('');
			$('#diagmessge').html('');

		}
		else{
			$('#diagmessge').html('<p style="color:red">Please Select Atleast One Clinical Diagnosis</p>');
		}
	});



	$('#investigationSend').click(function(){
		if($('#investigation').val() != ''){
			var message= 'Investigations: '+$('#investigation').val();
		    sendTxtMessage(message);
		    $("#investigationModal").modal('hide');

		    var investigationHidden= $('#investigationHidden').val();
			var investigation= $('#investigation').val();
			if(investigationHidden!=''){
				$('#investigationHidden').val(investigationHidden+ ',' + investigation);
			}
			else{
				$('#investigationHidden').val(investigation);
			}


			var tags = $('#investigation').tagEditor('getTags')[0].tags;
			for (i = 0; i < tags.length; i++) { $('#investigation').tagEditor('removeTag', tags[i]); }
			$('#investigationHidden').append(','+$('#investigation').val());
			$('#investigation').val('');
			$('#investmessge').html('');

		}
		else{
			$('#investmessge').html('<p style="color:red">Please Select Atleast One Investigataion</p>');
		}
	});


	$('#adviceSend').click(function(){
		if($('#advice').val() != ''){
			var message= 'Advices: '+$('#advice').val();
		    sendTxtMessage(message);
		    $("#adviceModal").modal('hide');

		    var adviceHidden= $('#adviceHidden').val();
			var advice= $('#advice').val();
			if(adviceHidden!=''){
				$('#adviceHidden').val(adviceHidden+ ',' + advice);
			}
			else{
				$('#adviceHidden').val(advice);
			}

			var tags = $('#advice').tagEditor('getTags')[0].tags;
			for (i = 0; i < tags.length; i++) { $('#advice').tagEditor('removeTag', tags[i]); }
			$('#adviceHidden').append(','+$('#advice').val());
			$('#advice').val('');
			$('#advicemessge').html('');

		}
		else{
			$('#advicemessge').html('<p style="color:red">Please Select Atleast One Advice</p>');
		}
	});


	$('#medicineSend').click(function(){
		if($('#medicine').val() != ''){
			var message= 'Medicines: '+$('#medicine').val();
		    sendTxtMessage(message);
		    $("#medicineModal").modal('hide');

		    var medicineHidden= $('#medicineHidden').val();
			var medicine= $('#medicine').val();
			if(medicineHidden!=''){
				$('#medicineHidden').val(medicineHidden+ ',' + medicine);
			}
			else{
				$('#medicineHidden').val(medicine);
			}
			var tags = $('#medicine').tagEditor('getTags')[0].tags;
			for (i = 0; i < tags.length; i++) { $('#medicine').tagEditor('removeTag', tags[i]); }
			$('#medicineHidden').append(','+$('#medicine').val());
			$('#medicine').val('');
			$('#medicinemessge').html('');
			$('#prescribe').attr('disabled', false);

		}
		else{
			$('#medicinemessge').html('<p style="color:red">Please Select Atleast One Medicine</p>');
		}
	});


	$('#prescribe').click(function(){

		var complaint = $('#complaintHidden').val();
		var examination = $('#examinationHidden').val();
		var diagnosis = $('#diagnosisHidden').val();
		var investigation = $('#investigationHidden').val();
		var advice = $('#adviceHidden').val();
		var medicine = $('#medicineHidden').val();
		var id = $('#appointID').val();
		
		 $.ajax({
           	url:base_url + 'prescribe',
          	type: 'post',
          	dataType: "json",
          	data: {
          		id :id,
          		complaint: complaint, 
          		examination: examination, 
          		diagnosis: diagnosis, 
          		investigation: investigation, 
          		advice: advice, 
          		medicine : medicine
          	},
          	success: function(response) {
           	DisplayMessage('<div class="spiner"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
			ScrollDown();
			GetChatHistory(receiver_id);
          }
         });
	});

</script>
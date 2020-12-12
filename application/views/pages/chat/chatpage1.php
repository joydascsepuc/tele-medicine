<style type="text/css">
	::-webkit-scrollbar {
	  width: 0px;  /* Remove scrollbar space */
	  background: transparent;  /* Optional: just make scrollbar invisible */
	}

	.attachmentImgCls{ width:450px; margin-left: -25px; cursor:pointer; }

	.hiddenNav {
	  height: 0; /* 100% Full-height */
	  width: 65%; /* 0 width - change this with JavaScript */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Stay on top */
	  bottom: 80px; /* Stay at the top */
	  /*left: 5px;*/
	  background-color: #ffffff; /* Black*/
	  overflow-x: hidden; /* Disable horizontal scroll */
	  /*padding-top: 10px;
	  padding-right: 5px;*/ /* Place content 60px from the top */
	  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
	}

	#main {
		transition: margin-bottom .5s;
	  	padding: 10px;
	}

</style>

<div class="container" style="height: 85vh;">
	<div class="row">
		<div class="col-1"></div>
		<div class="col-10" id="chatSection">
			<div id="main" class="" style="height: 80vh;">
				<h3 class="box-title" id="ReciverName_txt"><?php echo $receiver['name'];?></h3>
				<input type="hidden" id="ReciverId_txt" value="<?php echo $receiver['id'];?>">
				<input type="hidden" id="appointID" value="<?php echo $appoinments['id'];?>">
				<input type="hidden" id="visited" value="<?php echo $appoinments['visited'];?>">
				
				<div class="" style="height: 85%; overflow-y: scroll;" id="content">
					<div id="chatDiv"></div>
				</div>
				

				<div class="" style="height: 15%;">
					<div class="row pt-1" style="align-items: center;">
						<div class="col-2">
							<a type="button" href='javascript:;' onclick='openNav();' class="btn bg-primary"><i class="fas fa-plus"></i></a>
						</div>
						<div class="col-8" style="padding: 0px; margin: 0px;">
							<textarea autofocus id="textmsg" class="form-control message"></textarea>
						</div>
						<div class="col-2">
							<button class="btn btn-primary btnSend" id="nav_down" style="border-radius: 10px 10px 10px 10px;">Send</button>
								
                            <input type="file" name="file" class="upload_attachmentfile"/>
						</div>
					</div>
				</div>
			</div>
			

			<div class="hiddenNav" id="mySidenav">
			  <div class="">
			    <button class="btn btn-outline-primary"><i class="fab fa-searchengin"></i></button>
			  </div>
			</div>
			

		</div>
		<div class="col-1"></div>
	</div>


</div>


<!-- For Add Additional Files -->
<div class="modal fade animated bounceInUp" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Files</h4>
      </div>

      <form role="form" action="" method="post" id="addForm">
        <div class="modal-body">
          <div id="messages"></div>
          <div class="form-group">
            <label for="option">File</label>
            <input type="file" class="form-control" name="option" style="padding: 0;">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="myModalImg">
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


<script type="text/javascript">

	var base_url = "<?php echo base_url(); ?>"

	$(document).ready(function() {
		GetChatHistory($('#ReciverId_txt').val());

		if ($('#visited').val()==1) {
			ChatSection(0);
		}
		else{
			ChatSection(1);
		}


    });

    function GetChatHistory(receiver_id){
		$.ajax({
			//dataType : "json",
  			url: base_url + 'chathistory/'+receiver_id,
			success:function(data)
			{
  				$('#chatDiv').html(data);
				ScrollDown();	 
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
		var elmnt = document.getElementById("content");
	    var h = elmnt.scrollHeight;
	   		$('#content').animate({scrollTop: h}, 1000);
	}
	window.onload = ScrollDown();


	$('.message').keypress(function(event){
	    var keycode = (event.keyCode ? event.keyCode : event.which);
	    if(keycode == '13'){
	       sendTxtMessage($(this).val());
	    	$('.message').val('');
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
		var Sender_Name = $('#Sender_Name').val();
		var Sender_ProfilePic = $('#Sender_ProfilePic').val();
		
		var str = '<div class="mt-2" style="border: 1px solid black; width: 75%; float: right; padding: 5px; text-align: left; border-radius: 15px 0px 15px 15px">'+message;
				str+='<br><span style="float: right;"></span>';
				str+='</span></div>';
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
			$('#chatSection :input').attr('disabled', true);
			$('#textmsg').attr('disabled', true);
	    } else {
	        $('#chatSection :input').removeAttr('disabled');
			$('#textmsg').attr('disabled', false);
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


	function openNav() {
	  document.getElementById("mySidenav").style.height = "6vh";
	  document.getElementById("main").style.height = "74vh";
	}

	function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	  document.getElementById("main").style.height = "80vh";
	}

</script>
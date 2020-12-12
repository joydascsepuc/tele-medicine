<style type="text/css">
	.block {
	  /*border: 2px solid #dedede;*/
	  /*background-color: #f1f1f1;*/
	  /*border-radius: 5px;*/
	  padding: 10px;
	  margin: 10px 0;
	}
	.darker {
	  border-color: #ccc;
	  background-color: #ddd;
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
		height: 80vh;
		overflow-y: scroll;
		width: 100%;
		overflow-x: hidden;
	}
	/*.fa-file-medical:before {
	    padding-left: 24px;
	}*/

	.animated {
	  -webkit-animation: animateThis .5s ease;
	  animation: animateThis .5s ease;
	  -webkit-animation-fill-mode: forwards;
	  animation-fill-mode: forwards;
	}

	.mine{
		float: right;
		width: 95%;
		padding: 1px 10px;
		/*border: 2px solid #dedede;*/
		border-radius: 15px 0px 15px 15px;
	}

	.yours{
		float: left;
		width: 95%;
		padding: 1px 10px;
		/*border: 2px solid #dedede;*/
		border-radius: 0px 15px 15px 15px;
	}

	.fa-copy, .fa-trash{
		font-size: 20px !important;
		border-radius: 50%;
	}

	.btn-circle {
		background-color: white;
		border: 1px solid black;
		padding: 5px;
		width: 30px;
		height: 30px;
		font-size: 12px;
		line-height: 1.428571429;
		border-radius: 15px;
	}
</style>

<div class="container">
	<div class="maindiv animated" id="maindiv">
		<div class="block">
			<div class="yours">
				<i class="fas fa-user-circle fa-2x"></i>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
				<span class="float-right">11:00</span>
			</div>
		</div>

		<div class="block">
			<div class="row">
				<div class="col-2 d-flex text-right" style="margin: 0px; padding: 0px 0px 0px 5px;">
					<div class="row justify-content-center align-self-center">
						<div class="col-12">
							<button class="btn btn-circle">
								<i class="fas fa-copy"></i>
							</button>
						</div>
						<div class="w-100">
							<br>
						</div>
						<div class="col-12">
							<button class="btn btn-circle">
								<i class="fas fa-trash"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="col-10" style="margin: 0px; padding: 0px;">
					<div class="mine darker">
						<i class="fas fa-user-circle fa-2x float-right"></i>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
						<span class="float-left">11:00</span>
					</div>	
				</div>
			</div>
		</div>
	</div>
	<!-- Message Section -->
	<div style="height: 5vh;">
		<div class="row pr-2" style="vertical-align: center;">
			<div class="col-8 mr-0 pr-0">
				<textarea class="form-control" style="max-height: 38px; width: 100%;"></textarea>
			</div>
			<div class="col-2 text-center pr-0 mr-0 ml-0 pl-0">
				<button class="btn pr-0 mr-0 ml-0 pl-0" onclick="design();">
					<i class="fas fa-paperclip fa-2x" style="color: red;"></i>
				</button>
			</div>
			<div class="col-2 ml-0 pl-0">
				<button class="btn ml-0 pl-0">
					<i class="fas fa-paper-plane fa-2x" style="color: blue;"></i>
				</button>
			</div>
		</div>
	</div>

	<!-- Hidden Div -->
	<div style="display: none; height: 20vh;" id="attachmentdiv">
		<div class="row mt-4 text-center">
			<div class="col-3">
				<button class="btn" type="button" data-toggle="modal" data-target="#questionModal">
					<i class="fas fa-question-circle fa-2x"></i><br>
					Questions
				</button>
			</div>
			<div class="col-3">
				<button class="btn" type="button" data-toggle="modal" data-target="#questionModal">
					<i class="fas fa-clipboard-list fa-2x"></i><br>
					Report
				</button>
			</div>
			<div class="col-3 m-0 p-0">
				<button class="btn" type="button" data-toggle="modal" data-target="#questionModal">
					<i class="fas fa-file-medical fa-2x"></i><br>
					Prescription
				</button>
			</div>
			<div class="col-3">
				<button class="btn" type="button" data-toggle="modal" data-target="#questionModal">
					<i class="fas fa-chart-bar fa-2x"></i><br>
					Advice
				</button>
			</div>
		</div>
		<div class="row mt-3 text-center">
			<div class="col-3">
				<button class="btn" type="button" data-toggle="modal" data-target="#questionModal">
					<i class="fas fa-file-medical-alt fa-2x"></i><br>
					Document
				</button>
			</div>
			<div class="col-3">
				<button class="btn" type="button" data-toggle="modal" data-target="#questionModal">
					<i class="fas fa-video fa-2x"></i><br>
					Video
				</button>
			</div>
			<div class="col-3">
				<button class="btn" type="button" data-toggle="modal" data-target="#questionModal">
					<i class="fas fa-map-marker-alt fa-2x"></i><br>
					Location
				</button>
			</div>
			<div class="col-3">
				<button class="btn" type="button" data-toggle="modal" data-target="#questionModal">
					<i class="fas fa-id-badge fa-2x"></i><br>
					Contact
				</button>
			</div>
		</div>
	</div>

</div>


<script type="text/javascript">

	$(document).ready(function() {
		var element = document.getElementById("maindiv");
		element.scroll({
			top: 9000000000000,
		  	behavior: 'smooth'
		});
    });

	function design(){
		var ob = document.getElementById("attachmentdiv");
		var pos = ob.style.display;
		if(pos == 'none'){
			/*Reduce upper div height*/
			document.getElementById("maindiv").style.height = '56vh';
			var element = document.getElementById("maindiv");
			element.scroll({
				top: 9000000000000,
			  	behavior: 'smooth'
			});
			/*Making div visible*/
			document.getElementById("attachmentdiv").style.display = '';
		}else{
			/*Increase upper div height*/
			document.getElementById("maindiv").style.height = '80vh';
			var element = document.getElementById("maindiv");
			element.scroll({
				top: 90000000000000,
			  	behavior: 'smooth'
			});
			/*Making div invisible*/
			document.getElementById("attachmentdiv").style.display = 'none';
		}
	}

</script>


<!--Question Modal -->

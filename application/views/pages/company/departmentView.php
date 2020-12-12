<!DOCTYPE HTML>
<html lang="zxx">
<head><!-- head tag -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Brother, This is page reload. -->
    <meta http-equiv="refresh" content="30">

	

	<!-- CSS Integration -->

	<!-- bootstrap  stylesheet-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/css/bootstrap.min.css') ?>"> <!-- bootstrap.min.css -->
	
	<!-- font awesome  stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/css/all.min.css') ?>"> <!-- all.min.css -->
	
	<!-- owl carousel  stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/css/owl.carousel.min.css') ?>"> <!-- owl.carousel.min.css -->
	
	<!-- animate  stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/css/animate.css') ?>"> <!-- animate.css -->
	
	<!-- slicknav  stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/css/slicknav.css') ?>"> <!-- slicknav.css -->
	
	<!-- fake Loader  stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/css/fakeLoader.css') ?>"> <!-- fakeLoader.css -->
	
	<!-- Main style  stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/css/style.css') ?>"> <!-- style.css -->
	
	<!-- responsive stylesheet -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/css/responsive.css') ?>"> <!-- responsive.css -->

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatable/jquery.dataTables.css') ?>"> 
	<!-- jquery library Integration-->

	<script src="<?php echo base_url('assets/assets/js/jquery-1.12.4.min.js') ?>"></script> <!-- jquery-1.12.4.min.js -->

	<style type="text/css">
		div > label{
			display: none !important;
		}
		.dataTables_paginate{
			display: none !important;
		}
		.dataTables_info{
			display: none !important;
		}

		.table,tr,td{
			color: white !important;
			background-color: #0B3A94 !important;
			font-weight: bold;
			font-size: 1.3rem;
			text-align: center;
		}

	</style>

	<title>Company Details</title>

</head><!--  head tag end -->
<body bgcolor="#E6E6FA"> <!-- body tag -->

	<?php 
    	
    	$datalimit = 10;
    	$data = array_chunk($department, $datalimit, true);	
    ?>

	<audio id="audio" src="<?php echo base_url('assets/audio/eventually.mp3'); ?>" preload="auto"></audio>
	<script type="text/javascript">
		window.onload = function() {
	    document.getElementById("audio").play();
	}
	</script>

	<div class="container-fluid">
		<div style="width: 60%; margin-left: 25%;">
			<marquee behavior="scroll" direction="left" vspace ="20" scrollamount = "10" class = "font-weight-bold text-danger" style = "font-size: 2rem;">সিরিয়াল নম্বর কোনো পূর্ববর্তী নোটিশ ছাড়াই পরিবর্তন হতে পারে।</marquee>
		</div>

		<div class="table-responsive">
			<table class="table" id="datatable">
			  <thead>
			    <tr>
			      <th scope="col">Dept. Name</th>
			      <th scope="col">Now</th>
			      <th scope="col">Next</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($data as $key => $value): ?>
				  	<?php foreach($value as $k => $v): ?>
				  		<?php 
				  		$now=$next='N/A';
				  		foreach ($visitList as $kk => $vv) {
				  			if ($vv['id']==$v['now']) {
				  				$now=$vv['serialcode'];
				  			}
				  			if ($vv['id']==$v['next']) {
				  				$next=$vv['serialcode'];	
				  			}
				  		} ?>
					    <tr>				      
					      <!-- <td><?php echo $k+1 ?></td> -->
					      <td><?php echo $v['name'] ?></td>
					      <td><?php echo $now ?></td>
					      <td><?php echo $next ?></td>
					    </tr>
					   <?php endforeach; ?>
					<?php endforeach; ?>			
				</tbody>
			</table>
		</div>
	</div>






<!-- ======================================================== -->

<!-- ======================================================== -->




	<!-- footer-section section starts here -->

	<!--  section end here -->


<!-- ======================================================== -->

<!-- site content end here -->

<!-- ======================================================== -->
	<!-- JS Integration-->

	<script src="<?php echo base_url('assets/datatable/jquery.dataTables.js') ?>"></script>
	<!-- bootstrap  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/bootstrap.min.js') ?>"></script> <!-- bootstrap.min.js -->

	<!-- Brother, This is datatable and chaning values -->
	<script type="text/javascript">
		$(document).ready( function () {
		  var table = $('#datatable').DataTable({
		    pageLength: 10
		  });
		   
		  // Get the page info, so we know what the last is
		  var pageInfo = table.page.info(),
		       
		      // Set the ending interval to the last page
		      endInt = pageInfo.end,
		      
		       
		      // Current page
		      currentInt = 0,
		   
		      // Start an interval to go to the "next" page every 3 seconds
		      interval = setInterval(function(){
		          // "Next" ...
		          table.page( currentInt ).draw( 'page' );
		         
		          // Increment the current page int
		          currentInt++;
		           
		          // If were on the last page, reset the currentInt to the first page #
		          if ( currentInt ===  endInt)
		          	 currentInt = 0;

		          	
		      }, 3000); // 3 seconds

		    /*var time = console.log(pageInfo.pages);
		    var iNum = parseInt(pageInfo.pages);
		    reload = time*1000;
		    console.log(reload);
		    console.log(time);
		    console.log(jquery.type(iNum));*/
			/*setTimeout(function(){
		   		window.location.reload(1);
			}, time1);*/

		} );


	</script>

	

	
	<!-- font awesome  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/all.min.js') ?>"></script> <!-- all.min.js -->
	
	<!-- owl carousel  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/owl.carousel.js') ?>"></script> <!-- owl.carousel.js -->
	
	<!-- cdnjs.cloudflare.com  JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> <!-- waypoints.min.js -->
	
	<!-- counter up  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/jquery.counterup.min.js') ?>"></script> <!-- jquery.counterup.min.js -->
	
	<!-- easing  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/jquery.easing.min.js') ?>"></script> <!-- jquery.easing.min.js -->
	
	<!-- wow  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/wow.js') ?>"></script> <!-- wow.js -->
	
	<!-- slicknav  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/jquery.slicknav.min.js') ?>"></script> <!-- jquery.slicknav.min.js -->
	
	<!-- fake Loader  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/fakeLoader.min.js') ?>"></script> <!-- fakeLoader.min.js -->
	
	<!-- scroll Up  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/jquery.scrollUp.js') ?>"></script> <!-- jquery.scrollUp.js -->
	
	<!-- main  JavaScript -->
	<script src="<?php echo base_url('assets/assets/js/main.js') ?>"></script> <!-- main.js -->

	
	

</body> <!--  body tag end -->

</html> <!--  html tag end -->



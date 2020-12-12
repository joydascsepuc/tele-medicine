<div class="container mt-3">
	<div class="row">
		<div class="col-md-12">
			<!-- Suru -->
			<?php if ($availableDoctor): ?>
			<?php foreach ($availableDoctor as $key => $value): ?>
			<h4 class="mb-5 text-center">Available Doctors at <?=$department['name']?></h4>
			
						<div class="row mb-2 mt-1">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<div class="row" style="border-bottom: solid;  padding: 5px; max-height: 100px; padding: 5px; overflow-y: hidden; overflow-x: hidden;  text-align: center; border-radius: 3px; vertical-align: middle;">
									<div class="col-2">
										<i class="fas fa-user-md fa-3x" style="color: blue"></i>
									</div>
									<div class="col-5">
										<span class="font-weight-bold" style="color:black; vertical-align: middle;"><?=$value['users']['name']?></span><br>
										<span class="" style="overflow-y: hidden;"><?=$value['usersdetails']['qualification']?>, <?=$value['usersdetails']['designation']?>, <?=$value['usersdetails']['speciality']?></span>
									</div>
									<div class="col-5 float-right">
										<a href="tel:<?=$value['usersdetails']['emContact']?>" class="btn btn-outline-success"><i class="fas fa-phone-volume fa-2x"></i></a>
										<a href="<?php echo base_url()?>.patient/placeserial/<?=$value['users']['id']?>/<?=$department['id']?>" class="btn btn-outline-primary"><i class="fas fa-sms fa-2x"></i></a>
									</div>
									
								</div>
							</div>
							<div class="col-md-2"></div>
						</div>		
			
		
		<?php endforeach ?>
		<?php else:?>
			<h4 class="mb-3 text-center">No Available Doctors at <?=$department['name']?></h4>
		<?php endif ?>
		
			
			
			

		</div>
	</div>
</div>





<script type="text/javascript">

setInterval(function(){
	window.location.reload(true);
}, 600000);

</script>
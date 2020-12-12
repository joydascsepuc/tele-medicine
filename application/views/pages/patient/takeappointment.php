<div class="container">
	<div class="row">
		<div class="col-12 mt-3">

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
		<!-- <font color="red"><?php echo validation_errors(); ?></font> -->
			<!-- Suru -->
		<?php foreach ($department as $key => $value): ?>
			<div style=" border-bottom: solid; max-height: 100px; overflow-y: hidden; overflow-x: hidden;" class="mb-2 mt-1">
				<a href="<?php echo base_url('doctoronline/'.$value['id'])?>" style="color: green; text-decoration: none;">
					<div class="row">
						<div class="col-sm-1"></div>
						<div class="col-sm-10">
							<div class="row">
								<div class="col-1">
									<i class="far fa-building fa-2x"></i>
								</div>
								<div class="col-7">
									<span class="font-weight-bold" style="font-size: 20pt; color:black; vertical-align: middle;"><?=$value['name']?></span><br>
								</div>
								<div class="col-4">
									<span class="font-weight-bold" style="color: black"><?=$value['timing']?></span>
								</div>
							</div>
							<!-- <span class="" style="overflow-y: hidden;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet.</span> -->
						</div>
						<div class="col-sm-1"></div>
					</div>
				</a>
			</div>
		<?php endforeach ?>
			
			
			
			
			

		</div>
	</div>
</div>
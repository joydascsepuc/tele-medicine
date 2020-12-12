<div class="container-fluid mt-5">
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

        <form role="form" action="<?php base_url('company/update') ?>" method="post">
          <input type="text" autocomplete="off" name="company_name" id="company_name" class="form-control mb-2 mt-2" placeholder="@Company Name" style="height:35px !important;" required autofocus value="<?php echo $company_data['company_name']?>">
          
          <textarea class="form-control mb-2" id="address" name="address" placeholder="@Address" style="height: 100px;"><?php echo $company_data['address'] ?></textarea>


          <input type="text" autocomplete="off" name="phone" id="phone" class="form-control" placeholder="@Company Phone" style="height:35px !important;" required autofocus minlength="11" maxlength="11" pattern="\d*" value="<?php echo $company_data['phone']?>">

          <div class="row mb-1">
            <div class="col-2"></div>
            <div class="col-8">
              <button id="submitButton" class="btn btn-outline-success font-weight-bold btn-block mt-2" style="color: black;">Save</button>
            </div>
            <div class="col-2"></div>
          </div>

        </form>
</div>
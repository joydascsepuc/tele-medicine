<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="<?php echo base_url().'assets/images/telemedicine.png';?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/fontawsome/css/all.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/jquery/jquery-ui.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.min.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/font.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/fontawsome/css/all.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/font.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.min.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/animate.css';?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/select2/dist/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstraptoggle/css/bootstrap-toggle.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/tagEditor/jquery.tag-editor.css') ?>">
    



    <script src="<?php echo base_url().'assets/js/jquery-3.3.1.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.bundle.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/jquery/jquery-ui.js'; ?>"></script>
    <script src="<?php echo base_url('assets/select2/dist/js/select2.full.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstraptoggle/js/bootstrap-toggle.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/multifile/jquery.MultiFile.js') ?>"></script>
    <script src="<?php echo base_url('assets/tagEditor/jquery.tag-editor.js') ?>"></script>
    <script src="<?php echo base_url('assets/tagEditor/jquery.caret.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrapautocomplete/dist/latest/bootstrap-autocomplete.js') ?>"></script>
    
    
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/simple-sidebar.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/style.css';?>">
    
    <title>
      <?php if ($title !=''){
        echo $title;
      }
      else{
        echo "HOME";
      }
      ?>
      | Tele-Medicine</title>
</head>
<body>

      <!-- Side Navbar -->
    <div class="d-flex" id="wrapper">

      <!-- Sidebar -->
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
          <img src="<?php echo base_url().'assets/images/telemedicine.png';?>" height="38px" width="38px">
        </div>
        <div class="list-group list-group-flush">
          <?php if ($this->session->userdata('logged_in')): ?>
            <?php if ($this->session->userdata('group')==3): ?>
              <div class="list-group-item list-group-item-action bg-light">
                <input class="list-group-item list-group-item-action bg-light" type="checkbox" data-toggle="toggle" data-on="Online" data-off="Offline" data-onstyle="success" data-offstyle="danger" id="available" name="available"
                <?php if($is_available) { echo 'checked="checked"'; }?>>
              </div>

              <a href="<?php echo base_url('dochome')?>" class="list-group-item list-group-item-action bg-light">My Dashboard</a>
            <?php endif ?>

            <?php if($this->session->userdata('group')==4): ?>
              <a href="<?php echo base_url('patienthome')?>" class="list-group-item list-group-item-action bg-light">My Dashboard</a>
              <a href="<?php echo base_url('takeappointment')?>" class="list-group-item list-group-item-action bg-light">Take Appointment</a>
            <?php endif ?>
            
            <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              <a href="<?php echo base_url('users')?>" class="list-group-item list-group-item-action bg-light">Users</a>
            <?php endif ?>
            
            <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <a class="bg-light text-left dropdown-toggle list-group-item list-group-item-action" data-toggle="collapse" href="#Groups" role="button" aria-expanded="false" aria-controls="collapse">Groups</a>
            <div class="collapse" id="Groups">
              <?php if(in_array('createGroup', $user_permission)): ?>
              <a href="<?php echo base_url('newgroups')?>" class="nav-link nav-custom list-group-item-action"><i class="fas fa-dot-circle"></i>&nbsp;&nbsp;Add Group</a>
              <?php endif ?>
              <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
              <a href="<?php echo base_url('groups')?>" class="nav-link nav-custom list-group-item-action"><i class="fas fa-dot-circle"></i>&nbsp;&nbsp;All Groups</a>
              <?php endif ?>
            </div>
            <?php endif ?>

            <?php if(in_array('createDepartment', $user_permission) || in_array('updateDepartment', $user_permission) || in_array('viewDepartment', $user_permission) || in_array('deleteDepartment', $user_permission) || in_array('createNotice', $user_permission) || in_array('updateNotice', $user_permission) || in_array('viewNotice', $user_permission) || in_array('deleteNotice', $user_permission) || in_array('createSlider', $user_permission) || in_array('updateSlider', $user_permission) || in_array('viewSlider', $user_permission) || in_array('deleteSlider', $user_permission)): ?>
            <a class="bg-light text-left dropdown-toggle list-group-item list-group-item-action" data-toggle="collapse" href="#Menus" role="button" aria-expanded="false" aria-controls="collapse">Menus</a>
            <div class="collapse" id="Menus">
              <?php if(in_array('createDepartment', $user_permission) || in_array('updateDepartment', $user_permission) || in_array('viewDepartment', $user_permission) || in_array('deleteDepartment', $user_permission)): ?>
              <a href="<?php echo base_url('department')?>" class="nav-link nav-custom list-group-item-action"><i class="fas fa-dot-circle"></i>&nbsp;&nbsp;Department</a>
              <?php endif ?>

            
              <?php if(in_array('createNotice', $user_permission) || in_array('updateNotice', $user_permission) || in_array('viewNotice', $user_permission) || in_array('deleteNotice', $user_permission)): ?>
              <a href="<?php echo base_url('notice')?>" class="nav-link nav-custom list-group-item-action"><i class="fas fa-dot-circle"></i>&nbsp;&nbsp;Notice</a>
              <?php endif ?>

              <?php if(in_array('createSlider', $user_permission) || in_array('updateSlider', $user_permission) || in_array('viewSlider', $user_permission) || in_array('deleteSlider', $user_permission)): ?>
              <a href="<?php echo base_url('slider')?>" class="nav-link nav-custom list-group-item-action"><i class="fas fa-dot-circle"></i>&nbsp;&nbsp;Slider</a>
              <?php endif ?>
            </div>
            <?php endif ?>
            
            <?php if(in_array('updateCompany', $user_permission)): ?>
            <a href="<?php echo base_url('company')?>" class="list-group-item list-group-item-action bg-light">Hospital Details</a>
            <?php endif ?>
            
            <a href="<?php echo base_url('profile')?>" class="list-group-item list-group-item-action bg-light">Profile</a>
            <a href="<?php echo base_url()?>pages/hp" class="list-group-item list-group-item-action bg-light">Home Page</a>
            <a href="<?php echo base_url()?>pages/chatpage" class="list-group-item list-group-item-action bg-light">Chat Page</a>
            <a href="<?php echo base_url('signout')?>" class="list-group-item list-group-item-action bg-light">Log Out</a>
            <?php endif ?>
            
            <?php if (!$this->session->userdata('logged_in')): ?>
              <a class="list-group-item list-group-item-action bg-light" href="<?php echo base_url('signin')?>">Sign In</a>
            <?php endif ?>    

        </div>
      </div>
      <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

        <button class="btn btn-outline-danger" id="menu-toggle">||||</button> &nbsp;&nbsp;&nbsp;

        <a  class="text-right navbar-brand" href="<?php echo base_url();?>">
          Tele Medicine
          <img src="<?php echo base_url().'assets/images/telemedicine.png';?>" height="40px" width="40px">
        </a>

        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->

        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <?php if(!$this->session->userdata('logged_in')):?>
              <li class="nav-item active">
                <a class="nav-link font-weight-bold" href="<?php echo base_url('signin')?>">Sign In</a>
              </li>
            <?php endif;?>
          </ul>
        </div> -->
      </nav>


    <!-- Navbar Top -->
  <!--   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?php echo base_url();?>">Tele-Medicine</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if($this->session->userdata('logged_in')){?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <?php }else{ ?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link font-weight-bold" href="<?php echo base_url()?>Pages/login">Sign In</a>
          </li>
        </ul>
        <?php } ?>
      </div>
    </nav> -->



      
    
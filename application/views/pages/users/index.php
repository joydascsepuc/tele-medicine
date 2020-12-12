<div class="container">
	
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


	<div id="messages"></div>
  <div class="table-responsive">
  	<table class="table text-center" id="userTable">
  		<thead>
  			<tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Group</th>
        <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
          <th>Action</th>
        <?php endif; ?>
      	</tr>
  		</thead>
  		<tbody>
              <?php if($user_data): ?>
                  <?php foreach ($user_data as $k => $v): ?>
                     <tr>
                       <td><?php echo $v['user_info']['name']; ?></td>
                       <td><?php echo $v['user_info']['phone']; ?></td>
                       <td><?php echo $v['user_group']['group_name']; ?></td>
                       <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                       <td>
                       <?php if(in_array('updateUser', $user_permission)): ?>
                          <a onclick="return confirm('Are You Sure?')" title="Reset Password" href="<?php echo base_url('passreset/'.$v['user_info']['id']) ?>" class="btn btn-default"><i class="fa fa-key"></i></a>
                       <?php endif; ?>
                       <?php if(in_array('deleteUser', $user_permission)): ?>
                          <a title="Delete User" href="<?php echo base_url('rmvuser/'.$v['user_info']['id']) ?>" class="btn btn-default"><i class="far fa-trash-alt"></i></a>
                       <?php endif; ?>
                       </td>
                       <?php endif; ?>
                     </tr>
                  <?php endforeach ?>
              <?php endif; ?>
          </tbody>
  	</table>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      $('#userTable').DataTable({
        'order' : [],
        });
	});
  </script>
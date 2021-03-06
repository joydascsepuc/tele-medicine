<div class="container">
	
	<?php if(in_array('createDepartment', $user_permission)): ?>
	<div class="row mb-5">
		<div class="col-12 text-right">
			<a type="button" class="btn btn-warning" data-toggle="modal" data-target="#addModal">Add Department</a>
		</div>
	</div>
  <?php endif; ?>

	<div id="messages"></div>
  <div class="table-responsive">
  	<table class="table" id="manageTable">
  		<thead>
  			<tr>
            <th>Sl No</th>
            <th>Department name</th>
            <th>Priority</th>
            <th>Service Timing</th>
            <th>Status</th>
            <?php if(in_array('updateDepartment', $user_permission) || in_array('deleteDepartment', $user_permission)): ?>
            <th>Action</th>
            <?php endif; ?>
        </tr>
  		</thead>
  		<tbody>

  		</tbody>
  	</table>
  </div>
</div>

<?php if(in_array('createDepartment', $user_permission)): ?>
<!-- For Add an Option -->
<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Add Department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('newdepartment') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="department_name">Department Name</label>
            <input required type="text" class="form-control" id="department_name" name="department_name" placeholder="Enter department name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="timing">Service Timing (24 hours format)</label>
            <input required type="text" class="form-control" id="timing" name="timing" placeholder="Start - End Timing" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<?php endif; ?>
<!-- edit department modal -->
<?php if(in_array('updateDepartment', $user_permission)): ?>
<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('editdepartment');?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
           <label for="department_name">Department Name</label>
            <input required type="text" class="form-control" id="edit_department_name" name="edit_department_name" placeholder="Enter department name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="edit_priority">Priority</label>
            <select required class="form-control" id="edit_priority" name="edit_priority" >

            </select>
          </div>

          <div class="form-group">
            <label for="edit_timing">Service Timing (24 hours format)</label>
            <input required type="text" class="form-control" id="edit_timing" name="edit_timing" placeholder="Start - End Timing" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>

    </div>
  </div>
</div>
<?php endif; ?>
<!-- remove department modal -->
<?php if(in_array('deleteDepartment', $user_permission)): ?>

<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Remove Department</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('rmvdepartment') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>






<script type="text/javascript">
	var manageTable;
	var base_url = "<?php echo base_url(); ?>";

	$(document).ready(function() {
	  // $("#masterClass").addClass('active');
	  // initialize the datatable
	  manageTable = $('#manageTable').DataTable({
	    'ajax': base_url + 'departments',
	    'order': []
	  });


	  $.ajax({
	        url:base_url + 'priority',
	        type: "POST",
	        // data: {'department_id' : department_id},
	        dataType: 'json',
	        success: function(data){
	        $('#edit_priority').html(data);
	      },
	    });

	  // submit the create from
	  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false);

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
          $("#addModal").modal('hide');

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');

              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      }
    });

    return false;
  });

});

	function editFunc(id)
{
  $.ajax({
    url: base_url + 'priorityid/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_department_name").val(response.name);
      $("#edit_active").val(response.active);
      $("#edit_priority").val(response.priority);
      $("#edit_timing").val(response.priority);
      
      // submit the edit from
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false);

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');

                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
          }
        });

        return false;
      });

    }
  });
}

// remove functions
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { department_id:id },
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false);
          // hide the modal
            $("#removeModal").modal('hide');

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');



          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
      });

      return false;
    });
  }
}
	
</script>
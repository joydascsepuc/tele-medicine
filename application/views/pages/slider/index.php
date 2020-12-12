<div class="container">
	
	<?php if(in_array('createSlider', $user_permission)): ?>
	<div class="row mb-3">
		<div class="col-12 text-right">
			<a type="button" class="btn btn-warning" data-toggle="modal" data-target="#addModal">Add Slider</a>
		</div>
	</div>
    <?php endif; ?>

	<div id="messages"></div>
  <div class="table-responsive">
  	<table class="table" id="manageTable">
  		<thead>
  			<tr>
            <th>Sl No</th>
            <th>Title</th>
            <th>Note</th>
            <th>Status</th>
            <?php if(in_array('updateSlider', $user_permission) || in_array('deleteSlider', $user_permission)): ?>
            <th>Action</th>
            <?php endif; ?>
        </tr>
  		</thead>
  		<tbody>

  		</tbody>
  	</table>
  </div>
</div>

<?php if(in_array('createSlider', $user_permission)): ?>
<!-- For Add an Option -->
<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Slider</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" enctype="multipart/form-data" action="<?php echo base_url('newslider') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="title">Slider</label>
            <input type="text" class="form-control" id="title" placeholder="Slider Title" name="title" required autocomplete="off">
          </div>

          <div class="form-group">
            <label for="note">Note</label>
            <textarea class="form-control" id="note" placeholder="Slider Note" name="note" style="height: 10rem;" required autocomplete="off"></textarea>
          </div>
          <div class="form-group">
            <label>Slider Image</label>
            <input name="img" id="img" type="file" size="20" required>
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
<?php if(in_array('updateSlider', $user_permission)): ?>
<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Slider</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" enctype="multipart/form-data" action="<?php echo base_url('editslider');?>" method="post" id="updateForm">

        <div class="modal-body">
          <div id="messages"></div>

          <div class="form-group">
            <label for="slider">Slider</label>
            <input type="text" class="form-control" id="edit_title" placeholder="Slider Title" name="edit_title" required autocomplete="off">
          </div>

          <div class="form-group">
            <label for="note">Note</label>
            <textarea class="form-control" id="edit_note" placeholder="Slider Note" name="edit_note" style="height: 10rem;" required autocomplete="off"></textarea>
          </div>

          <div class="form-group">
            <label>Slider Image</label>
            <input name="edit_img" id="edit_img" type="file" size="20" required>
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
<?php if(in_array('deleteSlider', $user_permission)): ?>

<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Remove Slider</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('rmvslider') ?>" method="post" id="removeForm">
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
	    'ajax': base_url + 'sliders',
	    'order': []
	  });


	  // submit the create from
	  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);
    var formData = new FormData(form[0]);
    // var data = form.serialize();
    // data.append('img', $('#img')[0].files);
    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: formData, // /converting the form data into array and sending it to server
      dataType: 'json',
      processData: false,
      contentType: false,
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
    url: base_url + 'sliderid/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_title").val(response.title);
      $("#edit_note").val(response.note);
      $("#edit_active").val(response.active);
      //$("#edit_priority").val(response.priority);
      
      // submit the edit from
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var formData = new FormData(form[0]);
        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
         // enctype: 'multipart/form-data',
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: formData, // /converting the form data into array and sending it to server
          dataType: 'json',
          processData: false,
          contentType: false,
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
        data: { slider_id:id },
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
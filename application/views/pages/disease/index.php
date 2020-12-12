<div class="container p-5">
  
  <?php if(in_array('createDisease', $user_permission)): ?>
  <div class="row mb-5">
    <div class="col-12 text-right">
      <a type="button" class="btn btn-warning" href="<?php echo base_url('newdisease') ?>">Add Template</a>
    </div>
  </div>
  <?php endif; ?>

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

  <table class="table text-center table table-responsive" id="manageTable">
    <thead>
      <tr>
                <th>Disease Name</th>
                <th>Cheif Complaint</th>
                <th>Examination Finding</th>
                <th>Clinical Diagnosis</th>
                <th>Investigation</th>
                <th>Advice</th>
                <?php if(in_array('updateDisease', $user_permission) || in_array('deleteDisease', $user_permission)): ?>
                <th>Action</th>
                <?php endif; ?>

              </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</div>

<?php if(in_array('deleteDisease', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Remove Disease</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('rmvdisease') ?>" method="post" id="removeForm">
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
  // $("#partClass").addClass('active');
  // initialize the datatable
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'fetchdisease',
    'order': []
  });

});

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
        data: { product_id:id },
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false);

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');

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
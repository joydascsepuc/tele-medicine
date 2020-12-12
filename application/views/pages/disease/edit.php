<?php
  $complaint_name = array();
  $complaint_id = array();
  if ($disease['complaint']!=''){
    $complaints = explode(',',$disease['complaint']);

    foreach ($complaint as $k => $v){
      if(in_array($v['id'], $complaints)){
        $complaint_name[] = $v['name'];
          $complaint_id[] = $v['id'];
        }
      }

      $complaint_name = implode(', ', $complaint_name);
      $complaint_id = implode(', ', $complaint_id);
    }
    else {
      $complaint_name = '';
      $complaint_id = '';
    }


  $examination_name = array();
  $examination_id = array();
  if ($disease['examination']!=''){
    $examinations = explode(',',$disease['examination']);
    foreach ($examination as $k => $v){
      if(in_array($v['id'], $examinations)){
        $examination_name[] = $v['name'];
        $examination_id[] = $v['id'];
      }
    }
      $examination_name = implode(', ', $examination_name);
      $examination_id = implode(', ', $examination_id);
  }
  else {
    $examination_name = '';
    $examination_id = '';
  }


  $diagnosis_name = array();
  $diagnosis_id = array();
  if ($disease['diagnosis']!=''){
    $diagnosiss = explode(',',$disease['diagnosis']);
    foreach ($diagnosis as $k => $v){
      if(in_array($v['id'], $diagnosiss)){
        $diagnosis_name[] = $v['name'];
        $diagnosis_id[] = $v['id'];
      }
    }
      $diagnosis_name = implode(', ', $diagnosis_name);
      $diagnosis_id = implode(', ', $diagnosis_id);
  }
  else {
    $diagnosis_name = '';
    $diagnosis_id = '';
  }

  $investigation_name = array();
  $investigation_id = array();
  if ($disease['investigation']!=''){
    $investigations = explode(',',$disease['investigation']);
    foreach ($investigation as $k => $v){
      if(in_array($v['id'], $investigations)){
        $investigation_name[] = $v['name'];
        $investigation_id[] = $v['id'];
      }
    }
      $investigation_name = implode(', ', $investigation_name);
      $investigation_id = implode(', ', $investigation_id);
  }
  else {
    $investigation_name = '';
    $investigation_id = '';
  }


  $advice_name = array();
  $advice_id = array();
  if ($disease['advice']!=''){
    $advices = explode(',',$disease['advice']);
    foreach ($advice as $k => $v){
      if(in_array($v['id'], $advices)){
        $advice_name[] = $v['name'];
        $advice_id[] = $v['id'];
      }
    }
      $advice_name = implode(', ', $advice_name);
      $advice_id = implode(', ', $advice_id);
  }
  else {
    $advice_name = '';
    $advice_id = '';
  }
?>




  <style>
    .prothom{
      cursor: pointer;
      max-height:150px; 
      overflow-y:scroll;
    }

    #medicineResult li, #instructionResult li,#instructionResult2 li,#dayResult li,#amountResult li {
      background-color: white;
    }
    
    #medicineResult li:hover, #instructionResult li:hover,#instructionResult2 li:hover,#dayResult li:hover,#amountResult li:hover
    {
      background-color: #4584E8;
    }

    ::-webkit-scrollbar {
      display: none;
    }

  </style>
  <form role="form" action="<?php base_url('editdisease') ?>" method="post">
  
  <div class="container-fluid mt-5" style="">
        
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
          <font color="red"><?php echo validation_errors(); ?></font>

          
        <input type="text" autocomplete="off" name="disease_name" id="disease_name" class="form-control mb-2 mt-2" placeholder="@Disease Name" style="height:35px !important;" required autofocus value="<?php echo !empty($this->input->post('disease_name')) ?:$disease['name'] ?>">
        
        <input type="text" autocomplete="off" readonly class="form-control mb-2 mt-2" placeholder="@Chief Complaints" style="height:35px !important;" autofocus id="complaint" name="complaint" data-toggle="modal" data-target="#complaintModal" value="<?php echo $complaint_name; ?>" />
        <input type="hidden" class="form-control" id="complaintID" name="complaintID" value="<?php echo $complaint_id; ?>"/>

        <input type="text" autocomplete="off" readonly class="form-control mb-2 mt-2" placeholder="@Examination Findings" style="height:35px !important;" autofocus id="examination" name="examination" data-toggle="modal" data-target="#examinationModal" value="<?php echo $examination_name; ?>"/>
        <input type="hidden" class="form-control" id="examinationID" name="examinationID" value="<?php echo $examination_id; ?>"/>
        
        <input type="text" autocomplete="off" readonly class="form-control mb-2 mt-2" placeholder="@Clinical Diagnosis" style="height:35px !important;" autofocus id="diagnosis" name="diagnosis" data-toggle="modal" data-target="#diagnosisModal"  value="<?php echo $diagnosis_name; ?>" />
        <input type="hidden" class="form-control" id="diagnosisID" name="diagnosisID" value="<?php echo $diagnosis_id; ?>"/>
        
        <input type="text" autocomplete="off" readonly class="form-control mb-2 mt-2" placeholder="@Investigation" style="height:35px !important;" autofocus id="investigation" name="investigation" data-toggle="modal" data-target="#investigationModal" value="<?php echo $investigation_name; ?>"/>
        <input type="hidden" class="form-control" id="investigationID" name="investigationID"  value="<?php echo $investigation_id; ?>"/>
        
        <input type="text" autocomplete="off" readonly class="form-control mb-2 mt-2" placeholder="@Advice" style="height:35px !important;" autofocus id="advice" name="advice" data-toggle="modal" data-target="#adviceModal"  value="<?php echo $advice_name; ?>"/>
        <input type="hidden" class="form-control" id="adviceID" name="adviceID" value="<?php echo $advice_id; ?>"/>
        
        <textarea class="form-control mb-2" id="cause" name="cause" placeholder="@Cause" style="height: 50px;"><?php echo $disease['cause'] ?></textarea>

        <div style="position: relative;">
          <input style="width: 100%" type="text" class="form-control mb-2" id="medicine" name="medicine" placeholder="Medicine Name" autocomplete="off">
          <button style="position: absolute; top: 0; right: 0" type="button" onclick="newMedicine();" title="Save Medicine" class="btn btn-default" ><i class="far fa-save "></i></button>
        </div>  
        <input type="hidden" id="medicineID" name="medicineID">        
        <div style="position: relative;" id="medicineResult"></div>
              
        <input type="text" class="form-control  mb-2" id="instruction" name="instruction" placeholder="Doses" autocomplete="off">
        <input type="hidden" id="instructionID" name="instructionID">
        <div style="position: relative;" id="instructionResult"></div>


        <input type="text" class="form-control  mb-2" id="instruction2" name="instruction2" placeholder="Instruction" autocomplete="off">
        <input type="hidden" id="instructionID2" name="instructionID2">
        <div style="position: relative;" id="instructionResult2"></div>


        <input type="text" class="form-control  mb-2" id="amount" name="amount" placeholder="Amount" autocomplete="off">
        <div style="position: relative;" id="amountResult"></div>
              
        <input type="text" class="form-control  mb-2" id="day" name="day" placeholder="Day" autocomplete="off">
        <div style="position: relative;" id="dayResult"></div>

        <a href="#" class="btn btn-primary" id="input"><i class="fa fa-plus"></i></a>

        <table class="table">
          
          <tbody id="cartItem">
              <tr>
              </tr>
            <?php foreach ($cart as $key => $value): ?>
              <tr class="cart-value" id="<?php echo $key ?>">
                <td><?php echo $value['name'] ?></td>
                  <td><?php echo $value['instruction'] ?></td>
                  <td><?php echo $value['instruction2'] ?></td>
                  <td><?php echo $value['day'] ?></td>
                  <td><?php echo $value['amount'] ?></td>
                  <td><span class="btn btn-danger btn-sm delete-item" data-cart="<?php echo $key ?>">x</span></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="row mb-1">
          <div class="col-2"></div>
          <div class="col-8">
            <button type="submit" class="btn btn-outline-success font-weight-bold btn-block mt-2" style="color: black;">Save</button>
            <a href="<?php echo base_url('diseasehome') ?>" class="btn btn-outline-warning font-weight-bold btn-block mt-2">Back</a>
          </div>
          <div class="col-2"></div>
        </div>
  </div>
</form>


<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="complaintModal">
  <div class="modal-dialog" role="document" style="max-width: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Chief Complaint</h4>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <button type="button" id="complaintSubmitButton" class="btn btn-primary">Select & Close</button>
      </div>

        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="comp_name" name="comp_name" onkeyup="complaintSearch()" placeholder="@Search Complaint" autocomplete="off" autofocus>
            
          </div>
          <table id="complaintTable" class="text-left table table-responsive">
            <tbody>
            <?php $complaints = explode(',',$disease['complaint']); ?>

             <?php foreach ($complaint as $k => $v): ?>
              <?php if($k%2==0): ?>
                <tr>
                </tr>
              <?php endif; ?>
                <td>
                  <label><input name="complaintName" type="checkbox" id="<?php echo $v['id'] ?>" value="<?php echo $v['name']?>" <?php if(in_array($v['id'], $complaints)) { echo 'checked="checked"'; } ?>/><?php echo $v['name'] ?></label>
                </td>
              <?php endforeach ?>
                <tr class='notfound' style="display:none">
                  <td colspan='2'>No record found</td>
                </tr>
            </tbody>
          </table>
        </div>

        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="complaintSubmitButton" class="btn btn-primary">Go</button>
        </div> -->
      
    </div>
  </div>
</div>

<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="examinationModal">
  <div class="modal-dialog" role="document" style="max-width: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Examination Findings</h4>
        <button type="button" id="examinationSubmitButton" class="btn btn-primary">Select & Close</button>
        
      </div>

        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="examination_name" name="examination_name" onkeyup="examinationSearch()" placeholder="@Search Examination Findings" autocomplete="off" autofocus>
            <input type="hidden" class="form-control" id="examination_id" name="examination_id" autocomplete="off">
          </div>
          <table id="examinationTable" class="text-left table table-responsive">
            <tbody>
            <?php $examinations = explode(',',$disease['examination']); ?>
             <?php foreach ($examination as $k => $v): ?>
              <?php if($k%2==0): ?>
                <tr>
                </tr>
              <?php endif; ?>
                <td>
                  <label><input name="examinationName" type="checkbox" id="<?php echo $v['id'] ?>" value="<?php echo $v['name']?><?php if(in_array($v['id'], $examinations)) { echo 'checked="checked"'; } ?>"/><?php echo $v['name'] ?></label>
                </td>
              <?php endforeach ?>
                <tr class='notfound' style="display:none">
                  <td colspan='2'>No record found</td>
                </tr>
                
            </tbody>
          </table>
        </div>

        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="examinationSubmitButton" class="btn btn-primary">Go</button>
        </div> -->
      
    </div>
  </div>
</div>


<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="diagnosisModal">
  <div class="modal-dialog" role="document" style="max-width: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Clinical Diagnosis</h4>
        <button type="button" id="diagnosisSubmitButton" class="btn btn-primary">Select & Close</button>
        
      </div>

        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="diagnosis_name" name="diagnosis_name" onkeyup="diagnosisSearch()" placeholder="@Search Clinical Diagnosis" autocomplete="off" autofocus>
          </div>
          <table id="diagnosisTable" class="text-left table table-responsive">
            <tbody>
            <?php $diagnosises = explode(',',$disease['diagnosis']); ?>
             <?php foreach ($diagnosis as $k => $v): ?>
              <?php if($k%2==0): ?>
                <tr>
                </tr>
              <?php endif; ?>
                <td>
                  <label><input name="diagnosisName" type="checkbox" id="<?php echo $v['id'] ?>" value="<?php echo $v['name']?>"  <?php if(in_array($v['id'], $diagnosises)) { echo 'checked="checked"'; } ?>/><?php echo $v['name'] ?></label>
                </td>
              <?php endforeach ?>
                <tr class='notfound' style="display:none">
                  <td colspan='2'>No record found</td>
                </tr>
                
            </tbody>
          </table>
        </div>

        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="examinationSubmitButton" class="btn btn-primary">Go</button>
        </div> -->
      
    </div>
  </div>
</div>


<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="investigationModal">
  <div class="modal-dialog" role="document" style="max-width: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Investigation</h4>
        <button type="button" id="investigationSubmitButton" class="btn btn-primary">Select & Close</button>
        
      </div>

        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="investigation_name" name="investigation_name" onkeyup="investigationSearch()" placeholder="@Search Investigation" autocomplete="off" autofocus>
          </div>
          <table id="investigationTable" class="text-left table table-responsive">
            <tbody>
            <?php $investigations = explode(',',$disease['investigation']); ?>
             <?php foreach ($investigation as $k => $v): ?>
              <?php if($k%2==0): ?>
                <tr>
                </tr>
              <?php endif; ?>
                <td>
                  <label><input name="investigationName" type="checkbox" id="<?php echo $v['id'] ?>" value="<?php echo $v['name']?>" <?php if(in_array($v['id'], $investigations)) { echo 'checked="checked"'; } ?>/><?php echo $v['name'] ?></label>
                </td>
              <?php endforeach ?>
                <tr class='notfound' style="display:none">
                  <td colspan='2'>No record found</td>
                </tr>
                
            </tbody>
          </table>
        </div>

        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="examinationSubmitButton" class="btn btn-primary">Go</button>
        </div> -->
      
    </div>
  </div>
</div>

<div class="modal fade animated bounceIn" tabindex="-1" role="dialog" id="adviceModal">
  <div class="modal-dialog" role="document" style="max-width: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Advice</h4>
        <button type="button" id="adviceSubmitButton" class="btn btn-primary">Select & Close</button>
        
      </div>

        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="advice_name" name="advice_name" onkeyup="adviceSearch()" placeholder="@Search Advice" autocomplete="off" autofocus>
          </div>
          <table id="adviceTable" class="text-left table table-responsive">
            <tbody>
            <?php $advices = explode(',',$disease['advice']); ?>
             <?php foreach ($advice as $k => $v): ?>
              <?php if($k%2==0): ?>
                <tr>
                </tr>
              <?php endif; ?>
                <td>
                  <label><input name="adviceName" type="checkbox" id="<?php echo $v['id'] ?>" value="<?php echo $v['name']?>"  <?php if(in_array($v['id'], $advices)) { echo 'checked="checked"'; } ?>/><?php echo $v['name'] ?></label>
                </td>
              <?php endforeach ?>
                <tr class='notfound' style="display:none">
                  <td colspan='2'>No record found</td>
                </tr>
                
            </tbody>
          </table>
        </div>

        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="examinationSubmitButton" class="btn btn-primary">Go</button>
        </div> -->
      
    </div>
  </div>
</div>


<script type="text/javascript">
var manageTable;
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
  // $("#partClass").addClass('active');
  // initialize the datatable
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'fetchdisease',
    'order': [],
    'responsive': true
  });

});


//outside click
$(document).click(function(){
    $("#medicineResult, #instructionResult, #instructionResult2, #dayResult,#amountResult").fadeOut();
});


//new medicine
function newMedicine() {
    var medicine = $('#medicine').val();
    var medicineID = $('#medicineID').val();
    $.ajax({
      url: base_url + 'savemedicine',
      type: 'post',
      data: {medicine : medicine, medicineID : medicineID},
      dataType: 'json',
      success:function(response) {

        if(response.success === true) {
          //$('#medicineID').val('');
          $('#medicineID').val(response.id);
        }
      }
    });

  }



//Medicine Search
$('#medicine').keyup(function(){
     var search = $(this).val();

     if(search != '')
     {
      $.ajax({
       url:base_url + 'searchmedicine',
       method:"POST",
       //dataType: "json",
       data:{search:search},
       success:function(data)
       {
         $('#medicineResult').fadeIn();
         $('#medicineResult').html(data);
       },
       error:function(){
        $('#medicineResult').fadeOut();
        $('#medicineResult').html("");
       } 
      });
     }
     else {
       $('#medicineResult').fadeOut();
       $('#medicineResult').html("");
     }
});

    $(document).on('click','#medi li',function() {
      var genID= $(this).attr('id');
      if (genID!='') {
        $.ajax({
         url:base_url + 'findmedicine',
         method:"POST",
         dataType: "json",
         data:{genID:genID},
         success:function(response)
         {
           $('#medicine').val(response.name);
           $('#medicineID').val(response.id);
           $('#medicineResult').fadeOut();
         }
        });
      }
      else {
        $('#medicine').val("");
        $('#medicineID').val("");
        $('#medicineResult').fadeOut();
      }

    });

//Instruction Search
    $('#instruction').keyup(function(){
     var search = $(this).val();

     if(search != '')
     {
       $.ajax({
        url:base_url + 'searchdoses',
        method:"POST",
        //dataType: "json",
        data:{search:search},
        success:function(data)
        {
          $('#instructionResult').fadeIn();
          $('#instructionResult').html(data);
        }
       });
     }
     else {
       $('#instructionResult').fadeOut();
       $('#instructionResult').html("");
     }

    });


    $(document).on('click','#instruct li',function() {
      var genID= $(this).attr('id');
      if (genID!='') {
        $.ajax({
         url:base_url + 'finddoses',
         method:"POST",
         dataType: "json",
         data:{genID:genID},
         success:function(response)
         {
           $('#instruction').val(response.doses);
           $('#instructionID').val(response.id);
           $('#instructionResult').fadeOut();
         }
        });
      }
      else {
        $('#instruction').val("");
        $('#instructionID').val('');
        $('#instructionResult').fadeOut();
      }

    });


//Medicine2 Search
    $('#instruction2').keyup(function(){
     var search = $(this).val();

     if(search != '')
     {
       $.ajax({
        url:base_url + 'searchinstruction',
        method:"POST",
        //dataType: "json",
        data:{search:search},
        success:function(data)
        {
          $('#instructionResult2').fadeIn();
          $('#instructionResult2').html(data);
        }
       });
     }
     else {
       $('#instructionResult2').fadeOut();
       $('#instructionResult2').html("");
     }

    });

    

    $(document).on('click','#instruct2 li',function() {
      var genID= $(this).attr('id');
      if (genID!='') {
        $.ajax({
         url:base_url + 'findinstruction',
         method:"POST",
         dataType: "json",
         data:{genID:genID},
         success:function(response)
         {
           $('#instruction2').val(response.instruction);
           $('#instructionID2').val(response.id);
           $('#instructionResult2').fadeOut();
         }
        });
      }
      else {
        $('#instruction2').val("");
        $('#instructionID2').val('');
        $('#instructionResult2').fadeOut();
      }

    });


    $('#day').keyup(function(){
     var search = $(this).val();

     if(search != '')
     {
       $.ajax({
        url:base_url + 'searchday',
        method:"POST",
        //dataType: "json",
        data:{search:search},
        success:function(data)
        {
          $('#dayResult').fadeIn();
          $('#dayResult').html(data);
        }
       });
     }
     else {
       $('#dayResult').fadeOut();
       $('#dayResult').html("");
     }

    });


    $(document).on('click','#dayUL li',function() {
      var genID= $(this).attr('id');
      if (genID!='') {
        $.ajax({
         url:base_url + 'findday',
         method:"POST",
         dataType: "json",
         data:{genID:genID},
         success:function(response)
         {
           $('#day').val(response.day);
           // $('#instructionID').val(response.id);
           $('#dayResult').fadeOut();
         }
        });
      }
      else {
        $('#day').val("");
        // $('#instructionID').val('');
        $('#dayResult').fadeOut();
      }

    });


    $('#amount').keyup(function(){
     var search = $(this).val();

     if(search != '')
     {
       $.ajax({
        url:base_url + 'searchamount',
        method:"POST",
        //dataType: "json",
        data:{search:search},
        success:function(data)
        {
          $('#amountResult').fadeIn();
          $('#amountResult').html(data);
        }
       });
     }
     else {
       $('#amountResult').fadeOut();
       $('#amountResult').html("");
     }

    });


    $(document).on('click','#amountUL li',function() {
      var genID= $(this).attr('id');
      if (genID!='') {
        $.ajax({
         url:base_url + 'findamount',
         method:"POST",
         dataType: "json",
         data:{genID:genID},
         success:function(response)
         {
           $('#amount').val(response.amount);
           // $('#instructionID').val(response.id);
           $('#amountResult').fadeOut();
         }
        });
      }
      else {
        $('#amount').val("");
        // $('#instructionID').val('');
        $('#amountResult').fadeOut();
      }

    });



//Complaint Search
function complaintSearch() {
var search = $('#comp_name').val();

    // Hide all table tbody rows
    $('#complaintTable tbody tr').hide();

    // Count total search result
    var len = $('#complaintTable tbody tr:not(.notfound) td:contains("'+search+'")').length;

    if(len > 0){
      // Searching text in columns and show match row
      $('#complaintTable tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
        $(this).closest('tr').show();
      });
    }else{
      $('.notfound').show();
    }
}


function examinationSearch() {

  var search = $('#examination_name').val();

    // Hide all table tbody rows
    $('#examinationTable tbody tr').hide();

    // Count total search result
    var len = $('#examinationTable tbody tr:not(.notfound) td:contains("'+search+'")').length;

    if(len > 0){
      // Searching text in columns and show match row
      $('#examinationTable tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
        $(this).closest('tr').show();
      });
    }else{
      $('.notfound').show();
    }

}

function diagnosisSearch() {

  var search = $('#diagnosis_name').val();

    // Hide all table tbody rows
    $('#diagnosisTable tbody tr').hide();

    // Count total search result
    var len = $('#diagnosisTable tbody tr:not(.notfound) td:contains("'+search+'")').length;

    if(len > 0){
      // Searching text in columns and show match row
      $('#diagnosisTable tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
        $(this).closest('tr').show();
      });
    }else{
      $('.notfound').show();
    }
}


function investigationSearch() {

   var search = $('#investigation_name').val();

    // Hide all table tbody rows
    $('#investigationTable tbody tr').hide();

    // Count total search result
    var len = $('#investigationTable tbody tr:not(.notfound) td:contains("'+search+'")').length;

    if(len > 0){
      // Searching text in columns and show match row
      $('#investigationTable tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
        $(this).closest('tr').show();
      });
    }else{
      $('.notfound').show();
    }
}


function adviceSearch() {

  var search = $('#advice_name').val();

    // Hide all table tbody rows
    $('#adviceTable tbody tr').hide();

    // Count total search result
    var len = $('#adviceTable tbody tr:not(.notfound) td:contains("'+search+'")').length;

    if(len > 0){
      // Searching text in columns and show match row
      $('#adviceTable tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
        $(this).closest('tr').show();
      });
    }else{
      $('.notfound').show();
    }
}


$("#complaintSubmitButton").click(function(){

            var complaint = [];
            var complaintID = [];
            $.each($("input[name='complaintName']:checked"), function(){
                complaint.push($(this).val());
                complaintID.push($(this).attr('id'));
            });

            $('#complaint').val(complaint.join(", "));
            $('#complaintID').val(complaintID.join(","));
            $("#complaintModal").modal('hide');
            //alert("My favourite sports are: " + favorite.join(", "));
    });

    $("#examinationSubmitButton").click(function(){

            var examination = [];
            var examinationID = [];
            $.each($("input[name='examinationName']:checked"), function(){
                examination.push($(this).val());
                examinationID.push($(this).attr('id'));
            });
            $('#examination').val(examination.join(", "));
            $('#examinationID').val(examinationID.join(","));
            $("#examinationModal").modal('hide');
            //alert("My favourite sports are: " + favorite.join(", "));
  });

  $("#diagnosisSubmitButton").click(function(){

          var diagnosis = [];
          var diagnosisID = [];
          $.each($("input[name='diagnosisName']:checked"), function(){
              diagnosis.push($(this).val());
              diagnosisID.push($(this).attr('id'));
          });

          $('#diagnosis').val(diagnosis.join(", "));
          $('#diagnosisID').val(diagnosisID.join(","));
          $("#diagnosisModal").modal('hide');
          //alert("My favourite sports are: " + favorite.join(", "));
});
$("#investigationSubmitButton").click(function(){

        var investigation = [];
        var investigationID = [];
        $.each($("input[name='investigationName']:checked"), function(){
            investigation.push($(this).val());
            investigationID.push($(this).attr('id'));
        });

        $('#investigation').val(investigation.join(", "));
        $('#investigationID').val(investigationID.join(","));
        $("#investigationModal").modal('hide');
        //alert("My favourite sports are: " + favorite.join(", "));
});

$("#adviceSubmitButton").click(function(){

        var advice = [];
        var adviceID = [];
        $.each($("input[name='adviceName']:checked"), function(){
            advice.push($(this).val());
            adviceID.push($(this).attr('id'));
        });

        $('#advice').val(advice.join(", "));
        $('#adviceID').val(adviceID.join(","));
        $("#adviceModal").modal('hide');
        //alert("My favourite sports are: " + favorite.join(", "));
});



$("#input").on("click",function(){

        var medicineID = $("#medicineID").val();
        var medicine = $("#medicine").val();
        var instruction = $("#instruction").val();
        var instructionID = $("#instructionID").val();
        var instruction2 = $("#instruction2").val();
        var instructionID2 = $("#instructionID2").val();
        var day = $("#day").val();
        var amount = $("#amount").val();

        if(medicineID !== null && medicine !== null){
            $.ajax({
                url: base_url + 'cartmedicine',
                data: {
                    'medicineID' : medicineID,
                    'medicine' : medicine,
                    'instruction' : instruction,
                    'instructionID' : instructionID,
                    'instruction2' : instruction2,
                    'instructionID2' : instructionID2,
                    'day' : day,
                    'amount' : amount,

                },
                type: 'POST',
                success: function(data){
                  var html="";
                    var res = $.parseJSON(data);
                    $(".cart-value").remove();
                      $(".check").remove();
                    $.each(res.data, function(key,value) {
                        var row_2 = "";

                        var display = '<tr class="cart-value" id="'+ key +'">' +
                                    '<td>'+ value.name +'</td>' +
                                    '<td>'+ value.instruction +'</td>' +
                                    '<td>'+ value.instruction2 +'</td>' +
                                    '<td>'+ value.day +'</td>' +
                                    '<td>'+ value.amount +'</td>' +
                                    '<td><span class="btn btn-success btn-xs edit-item" data-cart="'+ key +'">o</span> <span class="btn btn-danger btn-xs delete-item" data-cart="'+ key +'">x</span></td>' +
                                    '</tr>';
                        $("#cartItem tr:last").after(display);
                        
                    });

                    $("#cartItem").find("input[type=text], input[type=hidden]").val("");
                    //$("#preview").html(html);

                    $('#medicineResult').fadeOut();
                    $('#instructionResult').fadeOut();
                    $('#instructionResult2').fadeOut();
                    $('#dayResult').fadeOut();
                    $('#amountResult').fadeOut();
                    

                },
                error: function(){
                    alert('Something Error');
                }
            });
        }

        else{
            alert("Please fill in all boxes");
        }
    });


    $(document).on("click",".delete-item",function(e){
        var rowid = $(this).attr("data-cart");
        //$el.faLoading();
        $.get(base_url + 'cartmedicinedelete'+rowid,
            function(data,status){
                if(status == 'success'  && data != 'false'){
                    $("#"+rowid).remove();
                    $("#preview tr#"+rowid).remove();
                }
            }
        );
    });

    $(document).on("click",".edit-item",function(e){
        var rowid = $(this).attr("data-cart");
        //$el.faLoading();
        $.get(base_url + 'cartmedicineedit/'+rowid,
            function(data,status){
                if(status == 'success'  && data != 'false'){
                    var res = $.parseJSON(data);
                  
                    // $("#"+rowid).remove();
                    // $("#preview tr#"+rowid).remove();
                    $("#medicineID").val(res.id);
                    $("#medicine").val(res.name);
                    $("#instruction").val(res.instruction);
                    $("#instructionID").val(res.instructionID);
                    $("#instruction2").val(res.instruction2);
                    $("#instructionID2").val(res.instructionID2);
                    $("#day").val(res.day);
                    $("#amount").val(res.amount);
                }
            }
        );
    });



</script>
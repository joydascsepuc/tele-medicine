
  <div class="container text-center">

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Group</h3>
            </div>
            <form role="form" action="<?php base_url('editgroups') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" value="<?php echo $group_data['group_name']; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="permission">Permission</label>

                  <?php $serialize_permission = unserialize($group_data['permission']); ?>

                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Users</td>
                        <td>-</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" <?php
                        if($serialize_permission) {
                          if(in_array('updateUser', $serialize_permission)) { echo "checked"; }
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" <?php
                        if($serialize_permission) {
                          if(in_array('viewUser', $serialize_permission)) { echo "checked"; }
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" <?php
                        if($serialize_permission) {
                          if(in_array('deleteUser', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" <?php
                        if($serialize_permission) {
                          if(in_array('createGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" <?php
                        if($serialize_permission) {
                          if(in_array('updateGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" <?php
                        if($serialize_permission) {
                          if(in_array('viewGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" <?php
                        if($serialize_permission) {
                          if(in_array('deleteGroup', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Department</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDepartment" <?php
                        if($serialize_permission) {
                          if(in_array('createDepartment', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateDepartment" <?php
                        if($serialize_permission) {
                          if(in_array('updateDepartment', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewDepartment" <?php
                        if($serialize_permission) {
                          if(in_array('viewDepartment', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteDepartment" <?php
                        if($serialize_permission) {
                          if(in_array('deleteDepartment', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>

                      <tr>
                        <td>Medicine</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createMedicine" <?php
                        if($serialize_permission) {
                          if(in_array('createMedicine', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateMedicine" <?php
                        if($serialize_permission) {
                          if(in_array('updateMedicine', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewMedicine" <?php
                        if($serialize_permission) {
                          if(in_array('viewMedicine', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteMedicine" <?php
                        if($serialize_permission) {
                          if(in_array('deleteMedicine', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>
                      
                      <tr>
                        <td>Notice</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createNotice" <?php
                        if($serialize_permission) {
                          if(in_array('createNotice', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateNotice" <?php
                        if($serialize_permission) {
                          if(in_array('updateNotice', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewNotice" <?php
                        if($serialize_permission) {
                          if(in_array('viewNotice', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteNotice" <?php
                        if($serialize_permission) {
                          if(in_array('deleteNotice', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>

                      <tr>
                        <td>Slider</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSlider" <?php
                        if($serialize_permission) {
                          if(in_array('createSlider', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSlider" <?php
                        if($serialize_permission) {
                          if(in_array('updateSlider', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSlider" <?php
                        if($serialize_permission) {
                          if(in_array('viewSlider', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSlider" <?php
                        if($serialize_permission) {
                          if(in_array('deleteSlider', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                      </tr>

                      <tr>
                        <td>Disease</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createDisease" <?php
                        if($serialize_permission) {
                          if(in_array('createDisease', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                         <td><input type="checkbox" name="permission[]" id="permission" value="updateDisease" <?php
                         if($serialize_permission) {
                           if(in_array('updateDisease', $serialize_permission)) { echo "checked"; }
                         }
                          ?>></td>


                          <td><input type="checkbox" name="permission[]" id="permission" value="viewDisease" <?php
                          if($serialize_permission) {
                            if(in_array('viewDisease', $serialize_permission)) { echo "checked"; }
                          }
                           ?>></td>

                           <td><input type="checkbox" name="permission[]" id="permission" value="deleteDisease" <?php
                           if($serialize_permission) {
                             if(in_array('deleteDisease', $serialize_permission)) { echo "checked"; }
                           }
                            ?>></td>
                      </tr>

                  

                      <tr>
                        <td>Patient</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPatient" <?php
                        if($serialize_permission) {
                          if(in_array('createPatient', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                         <td><input type="checkbox" name="permission[]" id="permission" value="updatePatient" <?php
                         if($serialize_permission) {
                           if(in_array('updatePatient', $serialize_permission)) { echo "checked"; }
                         }
                          ?>></td>


                          <td><input type="checkbox" name="permission[]" id="permission" value="viewPatient" <?php
                          if($serialize_permission) {
                            if(in_array('viewPatient', $serialize_permission)) { echo "checked"; }
                          }
                           ?>></td>

                           <td><input type="checkbox" name="permission[]" id="permission" value="deletePatient" <?php
                           if($serialize_permission) {
                             if(in_array('deletePatient', $serialize_permission)) { echo "checked"; }
                           }
                            ?>></td>
                      </tr>

                      <tr>
                        <td>Prescription</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createVisit" <?php
                        if($serialize_permission) {
                          if(in_array('createVisit', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                         <td><input type="checkbox" name="permission[]" id="permission" value="updateVisit" <?php
                         if($serialize_permission) {
                           if(in_array('updateVisit', $serialize_permission)) { echo "checked"; }
                         }
                          ?>></td>


                          <td><input type="checkbox" name="permission[]" id="permission" value="viewVisit" <?php
                          if($serialize_permission) {
                            if(in_array('viewVisit', $serialize_permission)) { echo "checked"; }
                          }
                           ?>></td>

                           <td><input type="checkbox" name="permission[]" id="permission" value="deleteVisit" <?php
                           if($serialize_permission) {
                             if(in_array('deleteVisit', $serialize_permission)) { echo "checked"; }
                           }
                            ?>></td>
                      </tr>

                      



                      <tr>
                        <td>Report</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReport" <?php
                        if($serialize_permission) {
                          if(in_array('viewReport', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" <?php
                        if($serialize_permission) {
                          if(in_array('updateCompany', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" <?php
                        if($serialize_permission) {
                          if(in_array('viewProfile', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" <?php
                        if($serialize_permission) {
                          if(in_array('updateSetting', $serialize_permission)) { echo "checked"; }
                        }
                         ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update Changes</button>
                <a href="<?php echo base_url('groups') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $(document).ready(function() {
      // $('#topMainNav').addClass('active');
      // $('#groupMainNav').addClass('active');
      // $('#manageGroupSubMenu').addClass('active');
    });
  </script>

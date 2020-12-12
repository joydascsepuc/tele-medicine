  <div class="container text-center">

    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">

        
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Group</h3>
            </div>
            <form role="form" action="<?php base_url('newgroups') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name">Group Name</label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="permission">Permissions</label>
                  <div class="table-responsive">
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
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateUser"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewUser"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser"></td>
                        </tr>
                        <tr>
                          <td>Groups</td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="createGroup"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup"></td>
                        </tr>
                        <tr>
                          <td>Department</td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="createDepartment"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateDepartment"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewDepartment"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deleteDepartment"></td>
                        </tr>

                        <tr>
                          <td>Medicine</td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="createMedicine"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateMedicine"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewMedicine"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deleteMedicine"></td>
                        </tr>

                        <tr>
                          <td>Notice</td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="createNotice"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateNotice"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewNotice"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deleteNotice"></td>
                        </tr>


                        <tr>
                          <td>Slider</td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="createSlider"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateSlider"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewSlider"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deleteSlider"></td>
                        </tr>

                    

                        <tr>
                          <td>Disease</td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="createDisease"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateDisease"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewDisease"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deleteDisease"></td>
                        </tr>

                        
                        <tr>
                          <td>Patient</td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="createPatient"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updatePatient"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewPatient"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deletePatient"></td>
                        </tr>

                       
                        <tr>
                          <td>Prescription</td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="createVisit"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateVisit"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewVisit"></td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="deleteVisit"></td>
                        </tr>

                        <tr>
                          <td>Report</td>
                          <td> - </td>
                          <td> - </td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewReport"></td>
                          <td> - </td>
                        </tr>
                        <tr>
                          <td>Company</td>
                          <td> - </td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany"></td>
                          <td> - </td>
                          <td> - </td>
                        </tr>
                        <tr>
                          <td>Profile</td>
                          <td> - </td>
                          <td> - </td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile"></td>
                          <td> - </td>
                        </tr>
                        <tr>
                          <td>Setting</td>
                          <td> - </td>
                          <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting"></td>
                          <td> - </td>
                          <td> - </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
      // $('#createGroupSubMenu').addClass('active');
    });
  </script>

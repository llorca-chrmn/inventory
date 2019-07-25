
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="page-title">
              <div class="title_left">
              <h3>Account Settings</h3><br>
              </div>
          </div>

          
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="clearfix"></div>
                  <form id="btnSubmitSettings">
                    <div class="form-row">
                      <div class="form-group col-md-1" hidden>
                        <label>id:</label>
                        <span class="text-danger"></span>
                        <input type="text" value="<?php echo $this->session->userdata('userinfo_id');?>" class="form-control" />
                      </div>

                      <div class="form-group col-md-3">
                        <label>Username:</label>
                        <span class="text-danger"></span>
                        <input type="text" value="<?php echo $this->session->userdata('username');?>" class="form-control" />
                      </div>

                      <div class="form-group col-md-4">
                        <label>Change Password:</label>
                        <span class="text-danger"></span>
                        <input type="password" value="<?php echo $this->session->userdata('password');?>" class="form-control" />
                      </div> 

                      <div class="form-group col-md-4">
                        <label>Retype Password:</label>
                        <span class="text-danger"></span>
                        <input type="password" value="<?php echo $this->session->userdata('password');?>" class="form-control" />
                      </div>  
                    </div>  
                    
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label>Firstname:</label>
                        <span class="text-danger"></span>
                        <input type="text" name="firstname" class="form-control"  value="<?php echo $this->session->userdata('firstname');?>" />
                      </div>

                      <div class="form-group col-md-4">
                        <label>Middlename:</label>
                        <span class="text-danger"></span>
                        <input type="text" name="middlename" class="form-control" value="<?php echo $this->session->userdata('middlename');?>" />
                      </div>

                      <div class="form-group col-md-4">
                        <label>Lastname:</label>
                        <span class="text-danger"></span>
                        <input type="text" name="lastname" class="form-control" value="<?php echo $this->session->userdata('lastname');?>"  />
                      </div>
                    </div> 

                    <div class="form-row">
                      <div class="form-group col-md-2">
                        <label>Age:</label>
                        <span class="text-danger"></span>
                        <input type="text" name="age" class="form-control" value="<?php echo $this->session->userdata('age');?>" />
                      </div>

                      <div class="form-group col-md-3">
                        <label>Date of Birth:</label>
                        <span class="text-danger"></span>
                        <input name="DOB" class="form-control" value="<?php echo date($this->session->userdata('DOB'));?>" type ="date" />
                      </div>

                      <div class="form-group col-md-3">
                        <label>Contact:</label>
                        <span class="text-danger"></span>
                        <input type="text" name="contact" class="form-control" value="<?php echo $this->session->userdata('contact');?>"  minlength="7" maxlength="11" />
                      </div>

                      <div class="form-group col-md-4">
                        <label>Email:</label>
                        <span class="text-danger"></span>
                        <input type="text" name="email" class="form-control" value="<?php echo $this->session->userdata('email');?>" />
                      </div>
                    </div>

                      <div class="form-group col-md-4">
                        <label>Profile Picture:</label>
                        <span class="text-danger"></span>
                        <input type="file" name="profile_pic" class="form-control" value="<?php echo $this->session->userdata('image');?>"/><br>
                      </div>
                    
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


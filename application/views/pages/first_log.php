    <div>
      <div class="login_wrapper" style="margin-top: 0">
        <div class="animated fadeInRight">
          <section class="login_content">
            <form id="frmFirstlog" autocomplete="off">
            <!-- <form id="frmFirstlog" enctype="multipart/form-data" method="post" accept-charset="utf-8" autocomplete="off"> -->

              <h1>Update Form</h1>
              <div>
                <span class="text-danger"></span>
                <input type="text" value="<?php echo $this->session->userdata('username');?>" class="form-control" disabled />
              </div>
              <div>
                <span class="text-danger"></span>
                <input type="text" name="firstname" class="form-control" placeholder="Firstname"  value="" />
              </div>
              <div>
                <span class="text-danger"></span>
                <input type="text" name="middlename" class="form-control" placeholder="Middlename" value=""/>
              </div>
              <div>
                <span class="text-danger"></span>
                <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="" />
              </div>
              <div>
                <span class="text-danger"></span>
                <input type="date" name="DOB" class="form-control" placeholder="Date of Birth" /><br>
              </div>
              <div>
                <span class="text-danger"></span>
                <input type="text" name="age" class="form-control" placeholder="Age"/>
              </div>
              <div>
                <span class="text-danger"></span>
                <input type="text" name="contact" class="form-control" placeholder="Contact" minlength="7" maxlength="11" />
              </div>
              <div>
                <span class="text-danger"></span>
                <input type="text" name="email" class="form-control" placeholder="Email Address"/>
              </div>
              <div>
                <span class="text-danger"></span>
                <input type="file" name="profile_pic" class="form-control"/><br>
              </div>
              <div>
                <button class="btn btn-default" type="submit">Update</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-hand-pointer-o"></i> ClickableBrand, Inc.</h1>
                  <p>© 2018 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
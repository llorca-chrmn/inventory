  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3><?=$page?> Page</h3>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            <button id="btnComp" class="btn btn-success">Add Computer</button>
            <button id="btnLaptop" class="btn btn-success">Add Laptop</button>
              <div class="clearfix"></div>
            </div>
             <!-- Computer Modal -->
            <div class="x_content">
                <div id="modalComputer" class="modal fade">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                      <h3 class="modal-title text-center">.modal-title</h3>
                      </div>
                      <div class="modal-body">
                        <form id="frmComputer" class="form-horizontal form-label-left" method = "post">
                        <input type="text" name="id" hidden>
                        <label class="control-label">ASSET LOCATION:</label>
                          <div class="row">
                            <div class="form-group group-line" style="margin-left:10px;margin-right:10px">
                              <label class="control-label col-md-1">Row</label>
                                <div class="col-md-2">                            
                                  <select name ="row" id = "rowID" class="form-control" required>
                                    <option hidden value="">-Row-</option>
                                    <?php 
                                      $num = 1;
                                      while($num <= 15){
                                        echo "<option>". $num++ ."</option>";
                                      }
                                    ?>
                                  </select>
                                </div>               
                                <label name = "hostname" id = "hostnameID" class="control-label col-md-1">Hostname</label>
                                <div class="col-md-2">
                                  <input class="form-control" type ="text" name="hostname" disabled>
                                </div>
                              <label class="control-label col-md-1">Serial</label>
                                <div class="col-md-2">
                                  <input class="form-control" type="text" name="serial"disabled>
                                </div>
                            </div>
                          </div>
                        <!-- ASSET DETAIL CODE-->
                          <label class="control-label">ASSET DETAILS:</label>
                          <div class="group-line">
                            <div class="form-group">
                               <label class="control-label col-md-3">Motherboard</label> 
                                <div class="col-md-6">  
                                  <select id = "motherboardID" name="motherboard" class="form-control" required>
                                      <option hidden value = "">-Motherboard-</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">Processor</label>
                                <div class="col-md-3">
                                  <select id = "processorID" name="processor" class="form-control" required>
                                      <option hidden value = "">-Processor-</option>
                                  </select>   
                                </div>
                              <label class="control-label col-md-1">RAM</label>
                                <div class="col-md-2"> 
                                   <select id = "ramID" name="RAM" class="form-control" required>
                                      <option hidden value = "">-Model-</option>
                                  </select>    
                                 </div> 
                              <label class ="control-label col-md-2">Disk Drive </label>
                                 <div class="col-md-2"> 
                                  <select id = "diskdriveID" name="Diskdrive" class="form-control" required>
                                      <option hidden value = "">-Model-</option>
                                  </select>    
                                 </div> 
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">Video Card</label>
                                <div class="col-md-3">
                                  <select id = "videocardID" name="videocard" class="form-control" required>
                                      <option hidden value= "">-Video Card-</option>
                                  </select>   
                                </div>
                              <label class="control-label col-md-2">Location</label>
                                <div class="col-md-3">
                                  <select name="space" class="form-control" required>
                                      <option hidden value = "">-Location-</option>
                                      <option>Room 1</option>
                                      <option>Room 2</option>
                                  </select>
                                </div>
                            </div>
                            <div class="form-group">
                                  <label class="control-label text-center">Remarks</label>
                                      <textarea rows="4" class="form-control" name="remarks" style="resize:none"></textarea>
                            </div>
                          </div>
                          <!--MORE -->
                        <!--SUBMIT BUTTON-->
                      </div>
                        <div class="modal-footer">
                          <button id="frmSubmit" class="btn btn-success btn-submit-item">Submit</button>
                          <button id="btnClose" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </form>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- End Computer Modal content -->
                <!-- Laptop Modal -->
                <div class="x_content">
                <div id="modalLaptop" class="modal fade">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                      <h3 class="modal-title text-center">Laptops</h3>
                      </div>
                      <div class="modal-body">
                        <form id="frmLaptop" class="form-horizontal form-label-left" method = "post">
                        <input type="text" name="id" hidden>
                        <label class="control-label">ASSET LOCATION:</label>
                          <div class="row">
                            <div class="form-group group-line" style="margin-left:10px;margin-right:10px">
                              <label class="control-label col-md-1">Row</label>
                                <div class="col-md-2">                            
                                  <select name ="row_Lp" id = "rowID" class="form-control" required>
                                    <option hidden value="">-Row-</option>
                                    <?php 
                                      $num = 1;
                                      while($num <= 15){
                                        echo "<option>". $num++ ."</option>";
                                      }
                                    ?>
                                  </select>
                                </div>               
                                <label name = "hostname_Lp" id = "hostnameID" class="control-label col-md-1">Hostname</label>
                                <div class="col-md-2">
                                  <input class="form-control" type ="text" name="hostname_Lp" disabled>
                                </div>
                                <label class="control-label col-md-1">Serial</label>
                                <div class="col-md-2">
                                  <input class="form-control" type="text" name="serial_Lp" disabled>
                                </div> 
                              <label class="control-label col-md-1">Location</label>
                                <div class="col-md-2">
                                  <select name="space_Lp" class="form-control" required>
                                      <option hidden value = "">-Location-</option>
                                      <option>Room 1</option>
                                      <option>Room 2</option>
                                  </select>
                                </div>
                                <div class="form-group" style = "margin-top:50px">
                                  <label class="control-label col-md-2">Laptop Model</label>
                                  <div class="col-md-3">
                                  <select name="laptop" class="form-control" id="laptopID" required>
                                      <option hidden value = "">-Laptop-</option>
                                  </select>
                                </div>
                               </div>
                              </div>
                            </div>
                            <div class="form-group">
                                  <label class="control-label text-center">Remarks</label>
                                      <textarea rows="4" class="form-control" name="remarks_Lp" style="resize:none"></textarea>
                            </div>
                          </div>
                            <div class="modal-footer">
                              <button id="frmSubmit_laptop" class="btn btn-success btn-submit-item">Submit</button>
                              <button id="btnClose_Laptop" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </form>
                            </div>
                          </div>
                        </div>
                    </div>
                <!-- End Laptop Modal content -->
                <!-- Additional Modal -->
                <div class="x_content">
                <div id="modalAdditional" class="modal fade">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                      <h1 class="modal-title"></h1>
                      </div>
                      <div class="modal-body">
                        <form id="frmAdditional" class="form-horizontal form-label-left" method = "post">
                            <div class="form-group group-line" style="margin-left:10px;margin-right:10px">
                                <div class="form-group">
                                  <label class="control-label col-md-2">Additional</label>
                                  <div class="col-md-6">
                                  <select name="additional" class="form-control" id="laptopID" required>
                                      <option hidden value = "">-Select Peripheral-</option>
                                  </select>
                               </div>
                              </div>
                            </div>
                            <div>
                                  <div class="form-group group-line" style="margin-left:10px;margin-right:10px;">
                                  <h4>Peripheral List</h4>
                                  <table id="tbl_view" class="table table-striped bulk_action">
                                    <thead style="background-color:#3f5367">
                                        <tr class= "headings">
                                          <th>#</th>
                                          <th>ID</th>
                                          <th>Brand</th>
                                          <th>Model</th>
                                        </tr>
                                      </thead>
                                      <tbody id = "info_id">
                                      </tbody>
                                  </table>
                                </div>
                            </div>
                          </div>
                            <div class="modal-footer">
                              <button id="frmSubmit_addition" class="btn btn-success btn-submit-item">Submit</button>
                              <button id="btnClose_additional" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </form>
                            </div>
                          </div>
                        </div>
                    </div>
                <!-- End Additional Modal -->
                <!-- Deletion in Additional Modal -->
                <div class="x_content">
                <div id="modalAdditional_Del" class="modal fade">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                      <h1 class="modal-title"></h1>
                      </div>
                      <div class="modal-body">
                        <form id="frmAdditional_Del" class="form-horizontal form-label-left" method = "post">
                            <div class="form-group group-line" style="margin-left:10px;margin-right:10px">
                                <div class="form-group">
                                  <label class="control-label col-md-2">Delete</label>
                                  <div class="col-md-6" id = "div_delID" name = "div_del">
                                  <select name="additional_Del" class="form-control" id="add_DelID" required>
                                      <option hidden value = "">-Select Peripheral-</option>
                                  </select>
                               </div>
                              </div>
                            </div>
                            <div>
                                <button name="delALL_Peri" id="DelAll_ID" style="margin-left:10px;margin-right:10px"class="btn btn-primary btn-submit-item">
                                            Delete ALL Additional Peripheral/s</button>
                            </div>
                          </div>
                            <div class="modal-footer">
                              <button id="frmSubmit_additionDel" class="btn btn-success btn-submit-item">Submit</button>
                              <button id="btnClose_DelADD" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </form>
                            </div>
                          </div>
                        </div>
                    </div>
                <!-- End Code for Deletion in Additional Modal -->
                <!-- id	type	row	hostname	serial	motherboard	processor	RAM	HDD	VDCard	space	remarks	date_added	application_id -->
                <div class="table table-responsive">  
                  <table id="tbl_computers" class="table table-striped bulk_action" style= "width:100%">
                    <thead style="background-color:#3f5367">
                      <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>xRow</th>
                        <th>Hostname</th>
                        <th>xSerial</th>
                        <th>Motherboard</th>
                        <th>Processor </th>
                        <th>RAM Model</th>
                        <th>Disk Drive Model</th>
                        <th>VDCard</th>
                        <th>Laptop Model</th>
                        <th>XLocation</th>
                        <th>xRemarks</th>
                        <th>xDate Added</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- /page content -->

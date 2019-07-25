<?php
defined('BASEPATH') OR exit('');
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
              <div class="row latestStuffs">
                <div class="col-sm-4">
                    <div class="panel panel-info">
                        <div class="panel-body latestStuffsBody" style="background-color: #5cb85c">
                            <div class="pull-left"><i class="fa fa-exchange"></i></div>
                            <div class="pull-right">
                                <div id="totalSpare"></div>
                                <div class="latestStuffsText">Spare Items</div>
                            </div>
                        </div>
                        <div class="panel-footer text-center" style="color:#5cb85c">Number of Spare Items in Stock</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-info">
                        <div class="panel-body latestStuffsBody" style="background-color: #f0ad4e">
                            <div class="pull-left"><i class="fa fa-tasks"></i></div>
                            <div class="pull-right">
                                <div id="totalDeployed"></div>
                                <div class="latestStuffsText pull-right">Deployed Items</div>
                            </div>
                        </div>
                        <div class="panel-footer text-center" style="color:#f0ad4e">All-time Deployed Items</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-info">
                        <div class="panel-body latestStuffsBody" style="background-color: #ca2222">
                            <div class="pull-left"><i class="fa fa-shopping-cart"></i></div>
                            <div class="pull-right">
                                <div id="totalDefected"></div>
                                <div class="latestStuffsText pull-right">Defected Items</div>
                            </div>
                        </div>
                        <div class="panel-footer text-center" style="color:#ca2222">Total Number of Defected Items</div>
                    </div>
                </div>
              </div>
              
            <div class="clearfix"></div>

            <div class="row margin-top-5">
                <div class="col-sm-6">
                    <div class="panel panel-hash">
                      <div class="panel-heading dashboard" style="background-color:#3f5367" ><i class="fa fa-desktop"></i> Number of Computers</div>
                        <div class="panel-body panel-height">
                          <div class="clearfix"></div>
                          <!-- Items List Table -->
                          <table id = "locationReport" class="table table-striped table-responsive table-hover">
                              <thead>
                                  <tr >
                                    <th>Location</th>
                                    <th>Quantity</th>
                                    <th>Desktop</th>
                                    <th>Laptop</th>
                                  </tr>
                              </thead>
                              <tbody>
                              </tbody>
                          </table>
                        </div>
                    </div>
                  </div>
                  

                <div class="col-sm-6">
                    <div class="panel panel-hash">
                      <div class="panel-heading dashboard" style="background-color:#3f5367" ><i class="fa fa-plug"></i> Total Number of Items per Category</div>
                        <div class="panel-body scroll panel-height">
                          <div class="clearfix"></div>
                          <!-- Items List Table -->
                          
                          <table id = "categoryReport" class="table table-striped table-responsive table-hover">
                              <thead>
                                  <tr >
                                    <th>Category</th>
                                    <th>Quantity</th>
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
        
        <!-- /page content -->


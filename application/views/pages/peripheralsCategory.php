
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
                <div class="title_left">
                    <h3><?=$page?> Category</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <button id="btnfrmAdd" class="btn btn-primary">Add Category</button>
                            
                        
                            <!-- <div class="form-inline pull-right">
                                <label for='itemSearch'><i class="fa fa-search"></i></label>
                                <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                            </div> -->
                            <div class="clearfix"></div>
                        </div>

                        <!-- Items List Table -->
                        <div class="table table-responsive">
                            <table id= "tb2_peripherals" class="table table-striped bulk_action" style= "width:100%">
                                <thead style="background-color:#3f5367">
                                    <tr >
                                        <th>ID</th>
                                        <th>CATEGORY NAME</th>
                                        <th>SPARE</th>
                                        <th>DEFECTIVE</th>
                                        <th>DEPLOYED</th>
                                        <th>ACTION</th>
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
        <!-- /page content -->
        
<!-- MODAL PERIPHERAL -->
<div id="frmPeripheral" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Peripheral Category</h1>
            </div>

            <div class="modal-body">
                <form id="frmAdd" class="form-horizontal form-label-left" autocomplete="on">

                    <div class="col-md-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name="asset_name" placeholder="Category" required>
                        <span class="fa fa-cogs form-control-feedback left"></span>
                        <span class="text-danger"></span>
                    </div>
            </div>

            <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="btnSubmit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- //MODAL PERIPHERAL -->
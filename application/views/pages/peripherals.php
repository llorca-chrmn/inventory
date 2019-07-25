
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
                <div class="title_left">
                    <h3><?=$page?> Item</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <button id="frmInfo" class="btn btn-success">Add Item</button>
                            
                            <!-- <div class="form-inline pull-right">
                                <label for='itemSearch'><i class="fa fa-search"></i></label>
                                <input type="search" id="itemSearch" class="form-control" placeholder="Search Items">
                            </div> -->
                            <div class="clearfix"></div>
                        </div>

                        <!-- Items List Table -->
                        <div class="table table-responsive">
                            <table id= "tbl_peripherals" class="table table-striped bulk_action" style= "width:100%">
                                <thead style="background-color:#3f5367">
                                    <tr >
                                        <th>ID</th>
                                        <th>CATEGORY</th>
                                        <th>ITEM BRAND</th>
                                        <th>SERIAL NUMBER</th>
                                        <th>MODEL</th>
                                        <th>PORT TYPE</th>
                                        <th>REMARKS</th>
                                        <th>UNIT COST</th>
                                        <th></th>
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

<!-- MODAL INFO -->

<div id="frmPeripheralInfo" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Peripheral Item</h1>
            </div>

            <div class="modal-body">
                <form id="frm" class="form-horizontal" autocomplete="on">
                
                    <label class="control-label">PERIPHERAL</label>
                    <div class="peripheral-line">
                        <div class="form-group">
                            <label class="control-label col-md-1">Category:</label>
                                <div class="col-md-3">
                                    <!-- <input id="autoPer" type="text" name="peripheral_id" class="form-control"> -->
                                    <select name="peripheral_id" class="form-control" id="autoPer" required>
                                        <option value="">Select Category</option>
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                            <label class="control-label col-md-4">(PHP) Unit Cost:</label>
                                <div class="col-md-2">
                                    <input required="required" type="number" id="unit_cost" placeholder="0.00" name="unit_cost" step="0.01" class="form-control">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description (Optional):</label>
                            <textarea rows="4" name="description" id="description" placeholder="Optional Peripheral Description" class="form-control"></textarea>
                        </div>
                    </div>

                    <label class="control-label">PERIPHERAL INFORMATION</label>
                    <div class="peripheral-line">
                        <div class="form-group">
                            <label class="control-label col-md-2">Brand:</label>
                                <div class="col-md-4">
                                    <input required="required" autocomplete="on" type="text" id="brand" placeholder="Brand" name="brand" class="form-control" value="">
                                </div>
                            <label class="control-label col-md-2">Model:</label>
                                <div class="col-md-4">
                                    <input required="required" autocomplete="on" type="text" id="model" name="model" placeholder="Model"class="form-control">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Serial:</label>
                                <div class="col-md-4">
                                    <input required="required" autocomplete="on" type="text" id="serial" placeholder="S/N" name="serial" class="form-control">
                                </div>
                            <label class="control-label col-md-2">Port type:</label>
                                <div class="col-md-4">
                                    <input required="required" autocomplete="on" type="text" id="port_type" placeholder="Port Type" name="port_type" class="form-control">
                                </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success id="btnSubmit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /MODAL -->
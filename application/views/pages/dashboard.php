
        <!-- page content -->
        <div class="right_col" role="main">
            
                <div class="page-title">
                    <div class="title_left">
                        <h3><?=$page?> Page</h3>
                    </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            
                            <!-- Items List Table -->
                            <div class="table table-responsive">
                                <table id= "tbl_viewLogs" class="table table-striped bulk_action" style= "width:100%">
                                    <thead style="background-color:#3f5367">
                                        <tr >
                                            <th hidden>ID</th>
                                            <th hidden>computer_id</th>
                                            <th hidden>peripheral_id</th>
                                            <th>ITEM BRAND</th>
                                            <th>SERIAL NUMBER</th>
                                            <th>MODEL</th>
                                            <th>RECORDS</th>
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

         <!-- MODAL -->
<div id="frmViewLogs" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-body">
                <form id="frmView" class="form-horizontal" autocomplete="on">
                <div class="table table-responsive">
                    <table id= "tb2_viewLogs" class="table table-striped bulk_action" style= "width:100%">
                        <thead>
                            <tr>
                                <th hidden>SAMPLE</th>
                                <th>SERIAL</th>
                                <th>ITEM BRAND</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
            </div>
            

            <div class="modal-footer">
                <button type="button" id="btnCloseRec" class="btn btn-primary">OK</button>
                </form>
            </div>
        </div>
    </div> 
</div>    


<?php
defined('BASEPATH') OR exit('');
?>
        <!-- page content -->
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3><?=$page?> Page</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    

                    <div class="x_content">
                        <div class="table table-responsive">
                            <table id="tbl_users" class="table table-striped bulk_action">
                                <thead style="background-color:#3f5367">
                                    <tr class="headings">
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>User Type</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
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

    <!-- MODAL EDIT TYPE -->
<div id="frmEditType" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Change User Type</h1>
            </div>

            <div class="modal-body">
                <form id="frmEdit" class="form-horizontal form-label-left" autocomplete="on">

                    <div class="col-md-12 form-group has-feedback">
                        <select name="usertype" class="form-control" required>
                            <option value="">---</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
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
<!-- //MODAL EDIT TYPE -->


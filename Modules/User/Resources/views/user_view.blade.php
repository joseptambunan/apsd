<!doctype html>
<html lang="en">

    @include("user::header")

    <body data-sidebar="colored">
        <input type="hidden" id="csrf_token">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            @include("navbar")


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <a class="btn btn-info" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add User</a>
                                        <hr/>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <td>Username</td>
                                                        <td>Email</td>
                                                        <td>Phone</td>
                                                        <td>Detail Transaksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="listUser">
                                                    
                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        
        <!--  Modal content for the above example -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td>Username</td>
                                    <td>Password</td>
                                    <td>Email</td>
                                    <td>Phone</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="user_name" id="user_name"></td>
                                    <td><input type="password" class="form-control" name="password" id="password"></td>
                                    <td><input type="text" class="form-control" name="email" id="email"></td>
                                    <td><input type="text" class="form-control" name="phone" id="phone"></td>
                                    <td><button class="btn btn-warning" type="button" onClick="createUser();">Submit</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <!--  Modal content for the above example -->
        <div class="modal fade bs-detail-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Detail Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Qty</td>
                                    <td>Created At</td>
                                </tr>
                            </thead>
                            <tbody id="historyStockTransaksi">
                                
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

                             
        @include("user::footer");
        @include("user::user_js");
    </body>
</html>

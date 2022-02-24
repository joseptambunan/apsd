<!doctype html>
<html lang="en">

    @include("stock::header")

    <body data-sidebar="colored">
        <input type="hidden" id="csrf_token">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            @include("stock::navbar")


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
                                        <a class="btn btn-info" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Add Stock</a>
                                        <center><h3>History</h3></center>
                                        <hr/>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <td>Product Name</td>
                                                        <td>SKU</td>
                                                        <td>Stock</td>
                                                        <td>Detail Transaksi</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="historyTransaksi">
                                                    
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
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Stock</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>SKU</td>
                                    <td>QTY</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="product_name" id="product_name"></td>
                                    <td><input type="text" class="form-control" name="sku" id="sku"></td>
                                    <td><input type="text" class="form-control" name="qty" id="qty"></td>
                                    <td><button class="btn btn-warning" type="button" onClick="createStock();">Submit</button></td>
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
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">History Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Username</td>
                                    <td>Stock</td>
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

                             
        @include("stock::footer");
        @include("stock::stock_js");
    </body>
</html>

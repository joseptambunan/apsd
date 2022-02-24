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
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <td>Product Name</td>
                                                        <td>User Name</td>
                                                        <td>QTY</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select class="form-select" id="product_list"></select>
                                                        </td>
                                                        <td>
                                                            <select class="form-select" id="user_list"></select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="qty" id="qty">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info" type="button" onClick="createTransaction();">Simpan</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <center><h3>History</h3></center>
                                        <hr/>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <td>Product Name</td>
                                                        <td>User Name</td>
                                                        <td>QTY</td>
                                                        <td>Created at</td>
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

        

                             
        @include("stock::footer");
        @include("stock::js");
    </body>
</html>

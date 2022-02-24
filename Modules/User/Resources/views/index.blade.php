<!doctype html>
<html lang="en">

    
        @include("user::header")


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="account-pages mt-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-5 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" value="{{ csrf_token()}}" name="csrf_login">

                                <div class="p-3">

                                    <div class="mb-3">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" placeholder="Enter username" autocomplete="off">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password" autocomplete="off">
                                    </div>

                                    <div class="row mt-4">
                                        
                                        <span style="color: red;" id="message-login"><strong></strong></span>
                                        <div class="col-sm-6 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit" id="btn-login">Log In</button>
                                        </div>
                                    </div>
    
                                </div>
    
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

                             
        

    </body>
    @include("user::footer")
    @include("user::js")
</html>

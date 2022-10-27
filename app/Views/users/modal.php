    
    <!-- Country Modal Start -->
    <div class="modal fade" id="countryModal" tabindex="-1" role="dialog" aria-labelledby="countryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="mb-4 text-center">
                        <h2>Sign In</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Country Modal End -->


    <!-- Login Modal Start -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="mb-4 text-center">
                        <h2>Sign In</h2>
                    </div>
                    <div id="loginError" class="text-danger" style="position: absolute; margin-top: -12px;"></div>
                    <form method="POST" action="javascript:;" class="authForm" id="loginForm" novalidate="novalidate">
                        <div class="input-group mt-5 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="email" class="form-control" name="loginEmail" id="loginEmail" placeholder="Email" aria-label="Email">
                            <small id="loginEmailError" class="text-danger" style="position: absolute; top: 40px; left: 50px;"></small>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name="loginPassword" id="loginPassword" placeholder="Password" aria-label="Password">
                            <small id="loginPasswordError" class="text-danger" style="position: absolute; top: 40px; left: 50px;"></small>
                        </div>
                        <div class="mt-5 mb-4">
                            <button class="btn btn-primary btn-block text-white py-2 px-4" type="submit">Login</button>
                        </div>
                    </form>
                    <div class="mb-4 text-center">
                        <a href="javascript:;">Forgot Password?</a>
                    </div>
                    <hr>
                    <div class="mb-4 text-center">
                        Don't have an account? <a href="javascript:;" class="showRegisterModal">Create one</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Modal End -->


    <!-- Register Modal Start -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="mb-4 text-center">
                        <h2>Sign Up</h2>
                    </div>
                    <div id="registerError" class="text-danger" style="position: absolute; margin-top: -12px;"></div>
                    <form method="POST" action="javascript:;" class="authForm" id="registerForm" novalidate="novalidate">
                        <div class="input-group mt-5 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="registerName" id="registerName" placeholder="Name" aria-label="Name">
                            <small id="registerNameError" class="text-danger" style="position: absolute; top: 40px; left: 50px;"></small>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" name="registerEmail" id="registerEmail" placeholder="Email" aria-label="Email">
                            <small id="registerEmailError" class="text-danger" style="position: absolute; top: 40px; left: 50px;"></small>
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name="registerPassword" id="registerPassword" placeholder="Password" aria-label="Password">
                            <small id="registerPasswordError" class="text-danger" style="position: absolute; top: 40px; left: 50px;"></small>
                        </div>
                        <div class="mt-3 mb-4">
                            <button class="btn btn-primary btn-block text-white py-2 px-4" type="submit">Register</button>
                        </div>
                    </form>
                    <hr>
                    <div class="mb-4 text-center">
                        Already having an account? <a href="javascript:;" class="showLoginModal">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Modal End -->
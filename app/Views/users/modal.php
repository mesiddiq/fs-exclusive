    
    <!-- Country Modal Start -->
    <div class="modal fade" id="countryModal" tabindex="-1" role="dialog" aria-labelledby="countryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="text-center mt-4">
                        <h4>Select Location</h4>
                    </div>
                    <div class="row my-5">
                        <div class="col-6 text-center">
                            <a href="javascript:;">
                                <img src="<?php echo site_url('assets/img/london.png'); ?>" class="setCountry img-fluid" data-country="1" width="100px">
                                <p class="text-dark mt-3">United Kingdom</p>
                            </a>
                        </div>
                        <div class="col-6 text-center">
                            <a href="javascript:;">
                                <img src="<?php echo site_url('assets/img/malaysia.png'); ?>" class="setCountry img-fluid" data-country="2" width="100px">
                                <p class="text-dark mt-3">Malaysia</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Country Modal End -->


    <!-- Cart Modal Start -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="text-center mt-4">
                        <h4><i class="fa fa-check-circle"></i></h4>
                        <h4>Added to cart</h4>
                        <button class="btn btn-primary text-white my-4" onclick="location.reload()" aria-label="Close">Got it!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Modal End -->


    <!-- Delete Modal Start -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="text-center mt-4">
                        <h4 class="text-danger mb-20">
                            <i class="fa fa-exclamation-triangle"></i>
                        </h4>
                        <h4>Do you want to delete?</h4>
                        <div class="action d-flex flex-wrap justify-content-center">
                            <button id="deleteCartItem" class="btn btn-danger text-white my-4">Delete</button>
                            <button class="btn btn-primary text-white ml-2 my-4" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal End -->


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


    <!-- Address Modal Start -->
    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="mb-3 text-center">
                        <h2>Add New Address</h2>
                    </div>
                    <form method="POST" action="javascript:;" id="addressForm">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label class="text-dark">Name</label>
                                <input class="form-control" type="text" name="name" oninput="this.className='form-control'" placeholder="John">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Email</label>
                                <input class="form-control" type="text" name="email" oninput="this.className='form-control'" placeholder="example@email.com">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Mobile</label>
                                <input class="form-control" type="text" name="contact" oninput="this.className='form-control'" placeholder="+123 456 789">
                            </div>
                            <div class="col-12 form-group">
                                <label class="text-dark">Address Line 1</label>
                                <input class="form-control" type="text" name="address" oninput="this.className='form-control'" placeholder="House No., Building Name">
                            </div>
                            <div class="col-12 form-group">
                                <label class="text-dark">Address Line 2 (Optional)</label>
                                <input class="form-control" type="text" name="address2" placeholder="Road Name, Area, Colony">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">City</label>
                                <input class="form-control" type="text" name="city" oninput="this.className='form-control'" placeholder="Albany">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">State</label>
                                <input class="form-control" type="text" name="state" oninput="this.className='form-control'" placeholder="New York">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">ZIP Code</label>
                                <input class="form-control" type="text" name="zipcode" oninput="this.className='form-control'" placeholder="12345">
                            </div>
                        </div>
                        <div class="my-4">
                            <button class="btn btn-primary btn-block text-white py-2 px-4" type="submit">Save Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Address Modal End -->


    <!-- Order Modal Start -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="text-center mt-4">
                        <h4><i class="fa fa-handshake"></i></h4>
                        <h4>Thank You</h4>
                        <p>Your order has been successfully placed</p>
                        <a href="<?php echo site_url(strtolower($sessCountry["code"])); ?>"><button class="btn btn-primary text-white my-4" aria-label="Close">Got it!</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Modal End -->
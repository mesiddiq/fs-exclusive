    
    <!-- Cart Modal Start -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="text-center mt-4">
                        <h4><i class="fa fa-check-circle"></i></h4>
                        <h4>Added to cart</h4>
                        <a href="javascript:;"><button class="btn btn-primary text-white my-4" onclick="location.reload()">Got it!</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Modal End -->


    <!-- Wishlist Modal Start -->
    <div class="modal fade" id="wishlistModal" tabindex="-1" role="dialog" aria-labelledby="wishlistModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="text-center mt-4">
                        <h4><i class="fa fa-check-circle"></i></h4>
                        <h4 id="wishlistModalMessage"></h4>
                        <button class="btn btn-primary text-white my-4" onclick="location.reload()">Got it!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Modal End -->


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
                        <a href="javascript:;" class="showForgotModal">Forgot Password?</a>
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
                    <div id="registerError" style="position: absolute; margin-top: -12px;"></div>
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


    <!-- Forgot Password Modal Start -->
    <div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="mb-4 text-center">
                        <h2>Forgot Password</h2>
                    </div>
                    <form method="POST" action="javascript:;" class="authForm" id="forgotForm" novalidate="novalidate">
                        <div class="input-group mt-5 mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="email" class="form-control" name="email" id="forgotEmail" placeholder="Email" aria-label="Email">
                            <small id="forgotEmailError" class="text-danger" style="position: absolute; top: 40px; left: 50px;"></small>
                        </div>
                        <div id="forgotError" style="position: absolute; margin-top: -12px;"></div>
                        <div class="mt-5 mb-4">
                            <button class="btn btn-primary btn-block text-white py-2 px-4" type="submit">Submit</button>
                        </div>
                    </form>
                    <hr>
                    <div class="mb-4 text-center">
                        Go back to <a href="javascript:;" class="showLoginModal">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgot Password Modal End -->


    <!-- Reset Password Modal Start -->
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="text-center mt-4">
                        <h4 id="resetModalIcon"><i class="fa fa-check-circle"></i></h4>
                        <h4 id="resetModalMessage"></h4>
                        <a href="<?php echo site_url(); ?>"><button class="btn btn-primary text-white my-4" aria-label="Close">Got it!</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reset Password Modal End -->


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
                    <form method="POST" action="javascript:;" id="addressForm" novalidate="novalidate">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label class="text-dark">Name</label>
                                <input class="form-control" type="text" name="name" id="addressName" oninput="this.className='form-control'" placeholder="John">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Email</label>
                                <input class="form-control" type="email" name="email" id="addressEmail" oninput="this.className='form-control'" placeholder="example@email.com">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Mobile</label>
                                <input class="form-control" type="text" name="contact" id="addressContact" oninput="this.className='form-control'" placeholder="+123 456 789">
                            </div>
                            <div class="col-12 form-group">
                                <label class="text-dark">Address Line 1</label>
                                <input class="form-control" type="text" name="address" id="addressAddress" oninput="this.className='form-control'" placeholder="House No., Building Name">
                            </div>
                            <div class="col-12 form-group">
                                <label class="text-dark">Address Line 2 (Optional)</label>
                                <input class="form-control" type="text" name="address2" id="addressAddress2" placeholder="Road Name, Area, Colony">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">City</label>
                                <input class="form-control" type="text" name="city" id="addressCity" oninput="this.className='form-control'" placeholder="Albany">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">State</label>
                                <input class="form-control" type="text" name="state" id="addressState" oninput="this.className='form-control'" placeholder="New York">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">ZIP Code</label>
                                <input class="form-control" type="text" name="zipcode" id="addressZipcode" oninput="this.className='form-control'" placeholder="12345">
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


    <!-- Custom Product Modal Start -->
    <div class="modal fade" id="customProductModal" tabindex="-1" role="dialog" aria-labelledby="customProductModalLabel" aria-hidden="true">
        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header pb-0" style="border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="mb-3 text-center">
                        <h2>Create Your Product</h2>
                    </div>
                    <form method="POST" action="<?php echo site_url('customProduct'); ?>" id="customProductForm" novalidate="novalidate" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6 form-group">
                                <label class="text-dark">Name</label>
                                <input class="form-control" type="text" name="name" id="customProductName" oninput="this.className='form-control'" placeholder="John">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Email</label>
                                <input class="form-control" type="email" name="email" id="customProductEmail" oninput="this.className='form-control'" placeholder="example@email.com">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Mobile</label>
                                <input class="form-control" type="text" name="contact" id="customProductContact" oninput="this.className='form-control'" placeholder="+123 456 789">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Alternate Mobile (Optional)</label>
                                <input class="form-control" type="text" name="contact2" id="customProductContact2" oninput="this.className='form-control'" placeholder="+123 456 789">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Address Line 1</label>
                                <input class="form-control" type="text" name="address" id="customProductAddress" oninput="this.className='form-control'" placeholder="House No., Building Name">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Address Line 2 (Optional)</label>
                                <input class="form-control" type="text" name="address2" id="customProductAddress2" placeholder="Road Name, Area, Colony">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">City</label>
                                <input class="form-control" type="text" name="city" id="customProductCity" oninput="this.className='form-control'" placeholder="Albany">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">State</label>
                                <input class="form-control" type="text" name="state" id="customProductState" oninput="this.className='form-control'" placeholder="New York">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Country</label>
                                <input class="form-control" type="text" name="country" id="customProductCountry" oninput="this.className='form-control'" placeholder="United States">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">ZIP Code</label>
                                <input class="form-control" type="text" name="zipcode" id="customProductZipcode" oninput="this.className='form-control'" placeholder="12345">
                            </div>
                            <div class="col-6 form-group">
                                <label class="text-dark">Upload <small>(Only JPG/PNG images)</small></label>
                                <input class="form-control" type="file" name="images[]" id="customProductImage"  oninput="this.className='form-control'" accept="image/jpg, image/jpeg, image/png" multiple>
                            </div>
                        </div>
                        <div class="my-4">
                            <button id="customProductFormBtn" class="btn btn-primary text-white py-2 px-4" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Custom Product Modal End -->


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
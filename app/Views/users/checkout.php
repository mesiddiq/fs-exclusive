


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px;">
            <h1 class="font-weight-semi-bold text-uppercase my-3">Checkout</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-12">
                            <!-- <p>Already having an account? <a href="javascript:;" data-toggle="modal" data-target="#loginModal">Login</a></p> -->
                            <style type="text/css">
                                .checkout-accordion-header {
                                    background-color: #000000;
                                    padding: 17px 15px 10px 15px;
                                    cursor: pointer;
                                }
                                .checkout-accordion-header h4 {
                                    color: #ffffff;
                                    padding-left: 10px;
                                }
                            </style>
                            <div class="checkout-accordion">
                                <?php if (!$this->session->get("logged_in")): ?>
                                <div class="checkout-accordion-header">
                                    <h4><span class="mr-3">1.</span> Are You A New Customer?</h4>
                                </div>
                                <div class="checkout-accordion-body" id="checkoutBody1">
                                    <div class="card card-body">
                                        <div class="row">
                                            <div class="col-6 offset-3">
                                                <div class="mb-4 text-center">
                                                    <h2>Sign In</h2>
                                                </div>
                                                <div class="row">
                                                    <div class="btn__google">
                                                        <i class="fab fa-google-plus"></i> Login with Google
                                                    </div>
                                                    <div class="btn__facebook">
                                                        <i class="fab fa-facebook"></i> Login with Facebook
                                                    </div>
                                                </div>
                                                <div class="text-center w-100 py-3">or</div>
                                                <div id="loginError" class="text-danger" style="position: absolute; margin-top: -39px;"></div>
                                                <form method="POST" action="javascript:;" class="authForm" id="loginForm" novalidate="novalidate">
                                                    <div class="input-group mb-4">
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
                                                    <div class="input-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="loginAcceptance" id="loginAcceptance" value="1">
                                                            <label class="custom-control-label" for="loginAcceptance"><small>By signing in, I acknowledge <a href="<?php echo site_url('terms'); ?>" target="_blank" style="text-decoration: underline;">Terms</a> and <a href="<?php echo site_url('privacy-policy'); ?>" target="_blank" style="text-decoration: underline;">Privacy Policy</a></small></label>
                                                        </div>
                                                    </div>
                                                    <div class="my-4">
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
                                <div class="checkout-accordion-header">
                                    <h4><span class="mr-3">2.</span> Delivery Address</h4>
                                </div>
                                <?php else: ?>
                                <div class="checkout-accordion-header">
                                    <h4><span class="mr-3">1.</span> Account Details</h4>
                                </div>
                                <div class="checkout-accordion-body" id="checkoutBody1">
                                    <div class="card card-body">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td><strong class="text-dark">Name</strong></td>
                                                    <td class="text-dark"><?php echo $_SESSION['userName']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong class="text-dark">Email</strong></td>
                                                    <td class="text-dark"><?php echo $_SESSION['userEmail']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="checkout-accordion-header">
                                    <h4><span class="mr-3">2.</span> Delivery Address</h4>
                                </div>
                                <div class="checkout-accordion-body" id="checkoutBody2">
                                    <div class="card card-body">
                                        <?php if (count($addresses) > 0) { ?>
                                        <h4 class="font-weight-semi-bold mb-4">Select Address</h4>
                                        <?php } ?>
                                        <div class="row mb-2">
                                            <?php foreach ($addresses as $key => $address): ?>
                                            <div class="col-6 mb-4">
                                                <div class="select-address">
                                                    <input type="radio" name="deliveryAddress" id="address<?php echo $address["id"]; ?>" value="<?php echo $address['id']; ?>" <?php echo $key == 0 ? 'checked' : ''; ?>>
                                                    <label for="address<?php echo $address["id"]; ?>"><strong><?php echo $address["name"]; ?></strong><br>
                                                    <?php echo $address["address"]; ?>
                                                    <?php echo $address["address2"] != NULL ? ", " . $address["address2"] . ", " : ", "; ?>
                                                    <?php echo $address["city"] . ", "; ?>
                                                    <?php echo $address["state"] . " - "; ?>
                                                    <?php echo $address["zipcode"]; ?><br>
                                                    <?php echo $address["email"]; ?><br>
                                                    <?php echo $address["contact"]; ?></label><br>
                                                    <a href="javascript:;" class="showEditAddressModal" data-addressid="<?php echo $address['id']; ?>">Edit</a>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" id="showAddAddressModal" class="btn btn-primary text-white font-weight-bold my-3 py-3 px-4"><i class="fa fa-plus-circle pr-2"></i> Add New Address</button>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <?php
                        if ($this->session->get("isCoupon") != Null) {
                            $discount = floatval($this->session->get("couponDiscount"));
                        } else {
                            $discount = 0;
                        }
                        
                        $subTotal = 0;
                        $weight = 0;
                        $shipping = 0;
                        $size = "";
                        $color = "";

                        if ($this->session->get("logged_in")):
                        foreach ($cart as $key => $cart):
                        if ($cart["productType"] != 0):
                        $product = $this->db->table("products")->where("id", $cart["productId"])->get()->getRowArray();
                        
                        if ($product["isDiscount"] == 1) {
                            $subTotal += $cart["productQty"] * $product["discountedPrice"];
                        } else {
                            $subTotal += $cart["productQty"] * $product["price"];
                        }

                        if ($product["type"] == "2") {
                            if ($cart["productSize"] != NULL) {
                                $size = $this->db->table("productattributesvariants")->where("id", $cart["productSize"])->get()->getRow()->name;
                            }

                            if ($cart["productColor"] != NULL) {
                                $color = $this->db->table("productattributesvariants")->where("id", $cart["productColor"])->get()->getRow()->name;
                            }
                        }

                        $weight += $cart["productQty"] * $product["weight"];
                        ?>
                        <div class="d-flex justify-content-between">
                            <p>
                                <?php echo $product["name"] . " x " . $cart["productQty"]; ?>
                                <?php if ($product["type"] == "2" && $size != "" && $color != ""): ?>
                                <br>
                                <small><em>Size: <?php echo $size; ?> Color: <?php echo $color; ?></em></small>
                                <?php endif; ?>
                            </p>
                            <?php if ($product["isDiscount"] == 1): ?>
                            <p><?php echo $this->session->get("countryCurrency") . ($cart["productQty"] * $product["discountedPrice"]); ?></p>
                            <?php else: ?>
                            <p><?php echo $this->session->get("countryCurrency") . ($cart["productQty"] * $product["price"]); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <?php
                        if ($this->session->get("cartItems")):
                        foreach ($this->session->get("cartItems") as $key => $sessCart):
                        if ($sessCart["productType"] != 0):
                        $sessCartproduct = $this->db->table("products")->where("id", $sessCart["productId"])->get()->getRowArray();
                        
                        if ($sessCartproduct["isDiscount"] == 1) {
                            $subTotal += $sessCart["productQty"] * $sessCartproduct["discountedPrice"];
                        } else {
                            $subTotal += $sessCart["productQty"] * $sessCartproduct["price"];
                        }

                        if ($sessCartproduct["type"] == "2") {
                            if ($sessCart["productSize"] != NULL) {
                                $size = $this->db->table("productattributesvariants")->where("id", $sessCart["productSize"])->get()->getRow()->name;
                            }

                            if ($sessCart["productColor"] != NULL) {
                                $color = $this->db->table("productattributesvariants")->where("id", $sessCart["productColor"])->get()->getRow()->name;
                            }
                        }

                        $weight = $sessCart["productQty"] * $sessCartproduct["weight"];
                        ?>
                        <div class="d-flex justify-content-between">
                            <p>
                                <?php echo $sessCartproduct["name"] . " x " . $sessCart["productQty"]; ?>
                                <?php if ($sessCartproduct["type"] == "2" && $size != "" && $color != ""): ?>
                                <br>
                                <small><em>Size: <?php echo $size; ?> Color: <?php echo $color; ?></em></small>
                                <?php endif; ?>
                            </p>
                            <?php if ($sessCartproduct["isDiscount"] == 1): ?>
                            <p><?php echo $this->session->get("countryCurrency") . ($sessCart["productQty"] * $sessCartproduct["discountedPrice"]); ?></p>
                            <?php else: ?>
                            <p><?php echo $this->session->get("countryCurrency") . ($sessCart["productQty"] * $sessCartproduct["price"]); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium"><?php echo $this->session->get("countryCurrency"); ?><span name="subtotal"><?php echo $subTotal; ?></span></h6>
                        </div>
                        <?php if ($weight > 0): ?>
                        <span class="d-none" name="weight" id="shippingWeight"><?php echo $weight; ?></span>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <?php if ($this->session->get("logged_in") == true): ?>
                            <h6 class="font-weight-medium"><?php echo $this->session->get("countryCurrency"); ?><span name="shipping" id="shippingCost"></span></h6>
                            <?php else: ?>
                            <h6 class="font-weight-medium"><?php echo $this->session->get("countryCurrency"); ?>0</h6>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Discount
                            </h6>
                            <h6 class="font-weight-medium"><?php echo $this->session->get("countryCurrency"); ?><span name="discount" id="shippingDiscount"><?php echo $discount; ?></span></h6>
                        </div>
                        <div class="<?php echo $this->session->get("isCoupon") == True ? 'd-flex' : 'd-none'; ?> justify-content-between">
                            <small id="cartCouponCode" class="text-dark" style="text-decoration: underline;">PROMOCODE: <?php echo $this->session->get("couponCode") ?></small>
                            <small><a href="javascript:;" class="text-dark" id="removeCoupon"><i class="fa fa-trash-alt"></i></a></small>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"><?php echo $this->session->get("countryCurrency"); ?><span name="total" id="shippingTotal"><?php echo ($subTotal + $shipping - $discount); ?></span></h5>
                        </div>
                        <?php if ($this->session->get("logged_in")): ?>
                        <button type="button" id="placeOrder" class="btn btn-lg btn-block btn-primary text-white font-weight-bold my-3 py-3">Place Order</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
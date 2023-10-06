


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
                    <div class="row">
                        <div class="col-12">
                            <?php if (!$this->session->get("logged_in")): ?>
                            <p>Already having an account? <a href="javascript:;" data-toggle="modal" data-target="#loginModal">Login</a></p>
                            <?php endif; ?>
                            <button type="button" id="showAddAddressModal" class="btn btn-primary text-white font-weight-bold my-3 py-3 px-4"><i class="fa fa-plus-circle pr-2"></i> Add New Address</button>
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
                        <button type="button" id="placeOrder" class="btn btn-lg btn-block btn-primary text-white font-weight-bold my-3 py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
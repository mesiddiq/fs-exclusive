


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
                        <div class="col-6">
                            <div class="select-address">
                                <input type="radio" name="deliveryAddress" value="<?php echo $address['id']; ?>" <?php echo $key == 0 ? 'checked' : ''; ?>>
                                <label for="address1"><strong><?php echo $address["name"]; ?></strong><br>
                                1/1, Test address street, Chennai, Tamil Nadu - 600001<br>
                                <?php echo $address["contact"]; ?></label>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary text-white font-weight-bold my-3 py-3 px-4" data-toggle="modal" data-target="#addressModal"><i class="fa fa-plus-circle pr-2"></i> Add New Address</button>
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
                        $subTotal = 0;
                        $discount = 0;
                        foreach ($cart as $key => $cart):
                        $product = $this->db->table("products")->where("id", $cart["productId"])->get()->getRowArray();
                        if ($product["isDiscount"] == 1) {
                            $subTotal += $cart["productQty"] * $product["discountedPrice"];
                        } else {
                            $subTotal += $cart["productQty"] * $product["price"];
                        }
                        ?>
                        <div class="d-flex justify-content-between">
                            <p><?php echo $product["name"] . " x " . $cart["productQty"]; ?></p>
                            <?php if ($product["isDiscount"] == 1): ?>
                            <p><?php echo $sessCountry["currency"] . ($cart["productQty"] * $product["discountedPrice"]); ?></p>
                            <?php else: ?>
                            <p><?php echo $sessCountry["currency"] . ($cart["productQty"] * $product["price"]); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium"><?php echo $sessCountry["currency"]; ?><span name="subtotal"><?php echo $subTotal; ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Discount</h6>
                            <h6 class="font-weight-medium"><?php echo $sessCountry["currency"]; ?><span name="discount"><?php echo $discount; ?></h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"><?php echo $sessCountry["currency"]; ?><span name="total"><?php echo ($subTotal - $discount); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="paymentMethod" value="COD" checked>
                                <label class="custom-control-label" for="paypal">Cash on Delivery</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="button" id="placeOrder" class="btn btn-lg btn-block btn-primary text-white font-weight-bold my-3 py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->



    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px;">
            <h1 class="font-weight-semi-bold text-uppercase my-3">Cart</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0" id="cart">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th colspan="2">Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <!-- <th>Total</th> -->
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        if ($this->session->get("isCoupon") != Null) {
                            $discount = floatval($this->session->get("couponDiscount"));
                        } else {
                            $discount = 0;
                        }
                        
                        $subTotal = 0;
                        $weight = 0;
                        $shipping = 0;
                        
                        if ($this->session->get("logged_in")):
                        if (count($cart) > 0):
                        foreach ($cart as $key => $cart):
                        $product = $this->db->table("products")->where("id", $cart["productId"])->get()->getRowArray();
                        
                        if ($product["isDiscount"] == 1) {
                            $subTotal += $cart["productQty"] * $product["discountedPrice"];
                        } else {
                            $subTotal += $cart["productQty"] * $product["price"];
                        }

                        if ($product["type"] == "2") {
                            $size = $this->db->table("productattributesvariants")->where("id", $cart["productSize"])->get()->getRow()->name;
                            $color = $this->db->table("productattributesvariants")->where("id", $cart["productColor"])->get()->getRow()->name;
                        }

                        $weight += $cart["productQty"] * $product["weight"];
                        $productImage = $this->db->table("productimages")->orderBy("featured DESC")->where("productID", $product["id"])->get()->getRowArray();
                        ?>
                        <tr>
                            <td class="align-middle">
                                <img src="<?php echo site_url('uploads/products/'.$productImage['name']); ?>" alt="<?php echo $product["name"]; ?>" style="width: 50px;">
                            </td>
                            <td class="text-left align-middle">
                                <a href="<?php echo site_url('product/'.$product['slug'].'/'.$product['id']); ?>"><?php echo $product["name"]; ?></a>
                                <?php if ($product["type"] == "2"): ?>
                                <div>
                                    <small><em>Size: <?php echo $size; ?> Color: <?php echo $color; ?></em></small>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <?php if ($product["isDiscount"] == 1): ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $product["discountedPrice"]; ?></strong><del class="text-muted ml-2"><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></del>
                                <?php else: ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></strong>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 75px;">
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" value="<?php echo $cart["productQty"]; ?>" readonly>
                                </div>
                            </td>
                            <!-- <td class="align-middle">
                                <?php if ($product["isDiscount"] == 1): ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . "<span id='row" . $cart['id'] . "'>" . $cart["productPrice"] . "</span>"; ?></strong>
                                <?php else: ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . "<span id='row" . $cart['id'] . "'>" . $cart["productPrice"] . "</span>"; ?></strong>
                                <?php endif; ?>
                            </td> -->
                            <td class="align-middle"><button class="btn btn-sm btn-primary removeFromCart text-white" data-id="<?php echo $cart["id"]; ?>"><i class="fa fa-times"></i></button></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5">No products found</td>
                        </tr>
                        <?php endif; ?>
                        <!-- DB Count Cart Endif -->
                        <?php else: ?>
                        <?php
                        if ($this->session->get("cartItems")):
                        foreach ($this->session->get("cartItems") as $key => $sessCart):
                        $sessCartproduct = $this->db->table("products")->where("id", $sessCart["productId"])->get()->getRowArray();
                        
                        if ($sessCartproduct["isDiscount"] == 1) {
                            $subTotal += $sessCart["productQty"] * $sessCartproduct["discountedPrice"];
                        } else {
                            $subTotal += $sessCart["productQty"] * $sessCartproduct["price"];
                        }

                        if ($sessCartproduct["type"] == "2") {
                            $size = $this->db->table("productattributesvariants")->where("id", $sessCart["productSize"])->get()->getRow()->name;
                            $color = $this->db->table("productattributesvariants")->where("id", $sessCart["productColor"])->get()->getRow()->name;
                        }

                        $weight = $sessCart["productQty"] * $sessCartproduct["weight"];
                        $sessCartproductImage = $this->db->table("productimages")->orderBy("featured DESC")->where("productID", $sessCartproduct["id"])->get()->getRowArray();
                        ?>
                        <tr>
                            <td class="align-middle">
                                <img src="<?php echo site_url('uploads/products/'.$sessCartproductImage['name']); ?>" alt="<?php echo $sessCartproduct["name"]; ?>" style="width: 50px;">
                            </td>
                            <td class="text-left align-middle">
                                <a href="<?php echo site_url('product/'.$sessCartproduct['slug'].'/'.$sessCartproduct['id']); ?>"><?php echo $sessCartproduct["name"]; ?></a>
                                <?php if ($sessCartproduct["type"] == "2"): ?>
                                <div>
                                    <small><em>Size: <?php echo $size; ?> Color: <?php echo $color; ?></em></small>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <?php if ($sessCartproduct["isDiscount"] == 1): ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $sessCartproduct["discountedPrice"]; ?></strong><del class="text-muted ml-2"><?php echo $this->session->get("countryCurrency") . $sessCartproduct["price"]; ?></del>
                                <?php else: ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $sessCartproduct["price"]; ?></strong>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <!-- <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary text-white btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div> -->
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" value="<?php echo $sessCart["productQty"]; ?>" readonly>
                                    <!-- <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary text-white btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div> -->
                                </div>
                            </td>
                            <!-- <td class="align-middle">
                                <?php if ($sessCartproduct["isDiscount"] == 1): ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $sessCart["productPrice"]; ?></strong>
                                <?php else: ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $sessCart["productPrice"]; ?></strong>
                                <?php endif; ?>
                            </td> -->
                            <td class="align-middle"><button class="btn btn-sm btn-primary removeFromSessionCart text-white" data-id="<?php echo $sessCart["tempId"]; ?>"><i class="fa fa-times"></i></button></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5">No products found</td>
                        </tr>
                        <?php endif; ?>
                        <!-- Session Count Cart Endif -->
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-6">
                        <form id="applyCoupon" class="my-5" action="javascript:;">
                            <div class="input-group">
                                <input type="text" class="form-control p-4" name="couponCode" id="couponCode" placeholder="Coupon Code" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary text-white">Apply Coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <a href="<?php // echo site_url('shop'); ?>"><button class="btn btn-primary text-white my-3">Continue Shopping</button></a> -->
            </div>
            <?php if ($subTotal > 0): ?>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium"><?php echo $this->session->get("countryCurrency") . "<span id='cartSubTotal'>" . $subTotal . "</span>"; ?></h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"><?php echo $this->session->get("countryCurrency"); ?><span id='cartShipping'>0</span></h6>
                        </div>
                        <?php if ($weight > 0): ?>
                        <!-- <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <?php
                            // $shipping = $this->db->table('shipping')->where("country", $this->session->get("countryId"))->where("minimum <=", $weight)->where("maximum >", $weight)->where("status", 1)->get()->getRow()->price;
                            ?>
                            <h6 class="font-weight-medium"><?php // echo $this->session->get("countryCurrency") . "<span id='cartShipping'>" . $shipping . "</span>"; ?></h6>
                            <h6 class="font-weight-medium"><?php // echo $this->session->get("countryCurrency") . "<span id='cartShipping'>0</span>"; ?></h6>
                        </div> -->
                        <?php endif; ?>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Discount
                            </h6>
                            <h6 class="font-weight-medium"><?php echo $this->session->get("countryCurrency"); ?><span id='cartDiscount'><?php echo $discount; ?></span></h6>
                        </div>
                        <div class="<?php echo $this->session->get("isCoupon") == True ? 'd-flex' : 'd-none'; ?> justify-content-between">
                            <small id="cartCouponCode" class="text-dark" style="text-decoration: underline;">PROMOCODE: <?php echo $this->session->get("couponCode") ?></small>
                            <small><a href="javascript:;" class="text-dark" id="removeCoupon"><i class="fa fa-trash-alt"></i></a></small>
                        </div>
                        
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"><?php echo $this->session->get("countryCurrency"); ?>
                                <span id='cartTotal'>
                                    <?php if ($this->session->get("isCoupon") != Null) {
                                        echo "<del>" . $subTotal . "</del>" . ($subTotal + $shipping - $discount);
                                    } else {
                                        echo ($subTotal + $shipping - $discount);
                                    } ?>
                                </span>
                            </h5>
                        </div>
                        <a href="<?php echo site_url('checkout'); ?>"><button class="btn btn-block btn-primary text-white my-3 py-3">Proceed To Checkout</button></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Cart End -->
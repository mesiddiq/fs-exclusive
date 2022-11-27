


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
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $subTotal = 0;
                        $discount = 0;
                        if ($this->session->get("logged_in")):
                        if (count($cart) > 0):
                        foreach ($cart as $key => $cart):
                        $product = $this->db->table("products")->where("id", $cart["productId"])->get()->getRowArray();
                        if ($product["isDiscount"] == 1) {
                            $subTotal += $cart["productQty"] * $product["discountedPrice"];
                        } else {
                            $subTotal += $cart["productQty"] * $product["price"];
                        }
                        $productImage = $this->db->table("productimages")->orderBy("featured DESC")->where("productID", $product["id"])->get()->getRowArray();
                        ?>
                        <tr>
                            <td class="text-left align-middle"><img src="<?php echo site_url('uploads/products/'.$productImage['name']); ?>" alt="<?php echo $product["name"]; ?>" style="width: 50px;"> <a href="<?php echo site_url('product/'.$product['slug'].'/'.$product['id']); ?>"><?php echo $product["name"]; ?></a></td>
                            <td class="align-middle">
                                <?php if ($product["isDiscount"] == 1): ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $product["discountedPrice"]; ?></strong><del class="text-muted ml-2"><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></del>
                                <?php else: ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></strong>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary text-white btn-minus" data-cartid="<?php echo $cart["id"]; ?>">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" value="<?php echo $cart["productQty"]; ?>" readonly>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary text-white btn-plus" data-cartid="<?php echo $cart["id"]; ?>">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">
                                <?php if ($product["isDiscount"] == 1): ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . "<span id='row" . $cart['id'] . "'>" . $cart["productPrice"] . "</span>"; ?></strong>
                                <?php else: ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . "<span id='row" . $cart['id'] . "'>" . $cart["productPrice"] . "</span>"; ?></strong>
                                <?php endif; ?>
                            </td>
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
                        $sessCartproductImage = $this->db->table("productimages")->orderBy("featured DESC")->where("productID", $sessCartproduct["id"])->get()->getRowArray();
                        ?>
                        <tr>
                            <td class="text-left align-middle"><img src="<?php echo site_url('uploads/products/'.$sessCartproductImage['name']); ?>" alt="<?php echo $sessCartproduct["name"]; ?>" style="width: 50px;"> <a href="<?php echo site_url('product/'.$sessCartproduct['slug'].'/'.$sessCartproduct['id']); ?>"><?php echo $sessCartproduct["name"]; ?></a></td>
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
                            <td class="align-middle">
                                <?php if ($sessCartproduct["isDiscount"] == 1): ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $sessCart["productPrice"]; ?></strong>
                                <?php else: ?>
                                <strong class="text-dark"><?php echo $this->session->get("countryCurrency") . $sessCart["productPrice"]; ?></strong>
                                <?php endif; ?>
                            </td>
                            <td class="align-middle"><button class="btn btn-sm btn-primary removeFromSessionCart text-white" data-id="<?php echo $key; ?>"><i class="fa fa-times"></i></button></td>
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
                <a href="<?php echo site_url('shop'); ?>"><button class="btn btn-primary text-white my-3">Continue Shopping</button></a>
            </div>
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
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Discount</h6>
                            <h6 class="font-weight-medium"><?php echo $this->session->get("countryCurrency") . "<span id='cartDiscount'>" . $discount . "</span>"; ?></h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold"><?php echo $this->session->get("countryCurrency") . "<span id='cartTotal'>" . ($subTotal - $discount) . "</span>"; ?></h5>
                        </div>
                        <a href="<?php echo site_url('checkout'); ?>"><button class="btn btn-block btn-primary text-white my-3 py-3">Proceed To Checkout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
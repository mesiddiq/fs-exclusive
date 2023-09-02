
    
        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">

                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30 pb-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title">
                                <h2><?php echo $page_title; ?></h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6 text-end">
                            <a href="javascript:;" onclick="javascript:printDiv('printablediv')" class="main-btn danger-btn btn-sm btn-hover">Download Invoice</a>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
                
                <!-- ========== invoice-wrapper start ========== -->
                <div class="invoice-wrapper" id="printablediv">
                    <div class="row">
                        <div class="col-12">
                            <div class="invoice-card card-style mb-30">
                                <div class="invoice-header">
                                    <div class="invoice-for mt-4">
                                        <h2 class="mb-10">Order ID</h2>
                                        <h3><?php echo $order["paymentOrderId"]; ?></h3>
                                        
                                    </div>
                                    <div class="invoice-logo mt-4">
                                        <img src="<?php echo site_url('assets/img/logo.png'); ?>" alt="" />
                                    </div>
                                    <div class="invoice-date mt-4 pt-2">
                                        <p><span>Order Date:</span> <?php echo date("d-M-Y", $order["createdAt"]); ?></p>
                                        <p><span>Order Time:</span> <?php echo date("h:i A", $order["createdAt"]); ?></p>
                                    </div>
                                </div>
                                <?php
                                $user = $this->db->table("users")->where("id", $order["userId"])->get()->getRowArray();
                                $address = $this->db->table("address")->where("id", $order["addressId"])->get()->getRowArray();
                                $country = $this->db->table("country")->where("id", $order["country"])->get()->getRowArray();
                                ?>
                                <div class="row">
                                    <div class="col-12 col-lg-8">
                                        <div class="invoice-address">
                                            <div class="address-item">
                                                <h5 class="text-bold">To</h5>
                                                <h1><?php echo $user["name"]; ?></h1>
                                                <p class="text-sm">
                                                    <?php
                                                    echo $address["address"];
                                                    if ($address["address2"] != NULL) {
                                                        echo ", " . $address["address2"] . ", ";
                                                    } ?>
                                                    <br>
                                                    <?php echo $address["city"] . ", " . $address["state"] . " - " . $address["zipcode"]; ?>
                                                </p>
                                                <p class="text-sm">
                                                    <span class="text-medium">Email:</span>
                                                    <?php echo $address["email"]; ?>
                                                </p>
                                                <p class="text-sm">
                                                    <span class="text-medium">Phone:</span>
                                                    <?php echo $address["contact"]; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="invoice-address">
                                            <div class="address-item">
                                                <?php if ($order["orderStatus"] == 4 && $order["orderNote"] != ""): ?>
                                                <h5 class="text-bold">Order Note</h5>
                                                <p><?php echo $order["orderNote"]; ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="invoice-table table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <h6 class="text-sm text-medium">#</h6>
                                                </th>
                                                <th>
                                                    <h6 class="text-sm text-medium">Product</h6>
                                                </th>
                                                <th class="float-end">
                                                    <h6 class="text-sm text-medium">Amount</h6>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (json_decode($order["products"]) as $key => $product):
                                            $productInfo = $this->db->table("products")->where("id", $product->productId)->get()->getRowArray();

                                            if ($product->productType == "2") {
                                                $size = $this->db->table("productattributesvariants")->where("id", $product->productSize)->get()->getRow()->name;
                                                $color = $this->db->table("productattributesvariants")->where("id", $product->productColor)->get()->getRow()->name;
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <p class="text-sm"><?php echo $key+1; ?></p>
                                                </td>
                                                <td>
                                                    <?php echo $productInfo["name"] . " x " . $product->productQty; ?>
                                                    <?php if ($product->productType == "2"): ?>
                                                    <br>
                                                    <small><em>Size: <?php echo $size; ?> Color: <?php echo $color; ?></em></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="float-end">
                                                    <p class="text-sm"><?php echo $country["currency"] . $product->productPrice; ?></p>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td></td>
                                                <td class="text-end">
                                                    <h6 class="text-sm text-medium">Subtotal</h6>
                                                </td>
                                                <td class="float-end">
                                                    <h6 class="text-sm text-bold"><?php echo $country["currency"] . $order["subtotal"]; ?></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="text-end">
                                                    <h6 class="text-sm text-medium">Shipping</h6>
                                                </td>
                                                <td class="float-end">
                                                    <h6 class="text-sm text-bold"><?php echo $country["currency"] . $order["shipping"]; ?></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="text-end">
                                                    <h6 class="text-sm text-medium">Discount</h6>
                                                </td>
                                                <td class="float-end">
                                                    <h6 class="text-sm text-bold"><?php echo $country["currency"] . $order["discount"]; ?></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="text-end">
                                                    <h4>Total</h4>
                                                </td>
                                                <td class="float-end">
                                                    <h4><?php echo $country["currency"] . $order["total"]; ?></h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>
                <!-- ========== invoice-wrapper end ========== -->
                <div class="card-style mb-30">
                    <h4 class="mb-25">Summary</h4>
                    <form method="POST" action="<?php echo site_url('admin/orders/update/'.$order['id']); ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 10px;">Status</label>
                                <div class="form-check radio-style mb-20">
                                    <input class="form-check-input" type="radio" name="orderStatus" value="1" id="status1" <?php echo $order["orderStatus"] == 1 ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status1">Processing</label>
                                </div>
                                <div class="form-check radio-style mb-20">
                                    <input class="form-check-input" type="radio" name="orderStatus" value="2" id="status2" <?php echo $order["orderStatus"] == 2 ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status2">Shipped</label>
                                </div>
                                <div class="form-check radio-style mb-20">
                                    <input class="form-check-input" type="radio" name="orderStatus" value="3" id="status3" <?php echo $order["orderStatus"] == 3 ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status3">Delivered</label>
                                </div>
                                <div class="form-check radio-style mb-20">
                                    <input class="form-check-input" type="radio" name="orderStatus" value="4" id="status4" <?php echo $order["orderStatus"] == 4 ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status4">Returned</label>
                                </div>
                                <!-- end radio -->
                            </div>
                            <!-- End Col -->
                            <div class="col-lg-6">
                                <div class="input-style-1">
                                    <label>Comments</label>
                                    <textarea class="bg-transparent" name="orderNote" rows="5"><?php echo $order["orderNote"]; ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="activity-wrapper">
                                            <ul>
                                                <?php if ($order["userEmail"] == 1) { ?>
                                                <li class="single-activity success">
                                                    <div class="icon">
                                                        <i class="lni lni-checkmark-circle"></i>
                                                    </div>
                                                    <h4 style="margin-top: 12px;">User Email</h4>
                                                </li>
                                                <?php } else { ?>
                                                <li class="single-activity danger">
                                                    <div class="icon">
                                                        <i class="lni lni-close"></i>
                                                    </div>
                                                    <h4 style="margin-top: 12px;">User Email</h4>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="activity-wrapper">
                                            <ul>
                                                <?php if ($order["adminEmail"] == 1) { ?>
                                                <li class="single-activity success">
                                                    <div class="icon">
                                                        <i class="lni lni-checkmark-circle"></i>
                                                    </div>
                                                    <h4 style="margin-top: 12px;">Admin Email</h4>
                                                </li>
                                                <?php } else { ?>
                                                <li class="single-activity danger">
                                                    <div class="icon">
                                                        <i class="lni lni-close"></i>
                                                    </div>
                                                    <h4 style="margin-top: 12px;">Admin Email</h4>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Col -->
                            <div class="col-12">
                                <button type="submit" class="main-btn primary-btn btn-hover">Submit</button>
                            </div>
                        </div>
                        <!-- End Row -->
                    </form>
                </div>
                
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <script type="text/javascript">
            function printDiv(divID) {
                // Get the HTML of div
                var divElements = document.getElementById(divID).innerHTML;
                // Get the HTML of whole page
                var oldPage = document.body.innerHTML;
                // Reset the page's HTML with div's HTML only
                document.body.innerHTML = 
                  "<html><head><title></title></head><body>" + 
                  divElements + "</body>";
                // Print Page
                window.print();
                // Restore orignal HTML
                document.body.innerHTML = oldPage;
            }
        </script>
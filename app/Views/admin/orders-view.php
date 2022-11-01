
    
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
                                        <h3>#FS<?php echo date("dmy", $order["orderDate"]). $order["id"]; ?></h3>
                                        
                                    </div>
                                    <div class="invoice-logo">
                                        <img src="<?php echo site_url('assets/img/logo.png'); ?>" alt="" />
                                    </div>
                                    <div class="invoice-date mt-4 pt-2">
                                        <p><span>Order Date:</span> <?php echo date("d-M-Y", $order["orderDate"]); ?></p>
                                        <p><span>Order Time:</span> <?php echo date("h:i A", $order["orderDate"]); ?></p>
                                    </div>
                                </div>
                                <?php
                                $user = $this->db->table("users")->where("id", $order["userId"])->get()->getRowArray();
                                $address = $this->db->table("address")->where("id", $order["addressId"])->get()->getRowArray();
                                $country = $this->db->table("country")->where("id", $order["country"])->get()->getRowArray();
                                ?>
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
                                            ?>
                                            <tr>
                                                <td>
                                                    <p class="text-sm"><?php echo $key+1; ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-sm"><?php echo $productInfo["name"] . " x " . $product->productQty; ?></p>
                                                </td>
                                                <td class="float-end">
                                                    <p class="text-sm"><?php echo $country["currency"] . $product->productPrice; ?></p>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <h6 class="text-sm text-medium">Subtotal</h6>
                                                </td>
                                                <td class="float-end">
                                                    <h6 class="text-sm text-bold"><?php echo $country["currency"] . $order["subtotal"]; ?></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <h6 class="text-sm text-medium">Discount</h6>
                                                </td>
                                                <td class="float-end">
                                                    <h6 class="text-sm text-bold"><?php echo $country["currency"] . $order["discount"]; ?></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
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
                <div class="invoice-action">
                    <ul class="d-flex flex-wrap align-items-center">
                        <li class="m-2">
                            <a href="javascript:;" onclick="javascript:printDiv('printablediv')" class="main-btn primary-btn-outline btn-hover">Download Invoice</a>
                        </li>
                    </ul>
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
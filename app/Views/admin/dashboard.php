
    
        <style type="text/css">
            .icon-card {
                cursor: pointer;
            }
            .icon-card .icon {
                position: relative;
                margin-top: -10px;
            }
            .dataTable-top {
                display: none;
            }
        </style>
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
                
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-card mb-30">
                            <div class="icon purple">
                                <i class="lni lni-cart-full"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10">Orders</h6>
                                <h3 class="text-bold mb-10">
                                <?php
                                $ordersCount = $this->db->table("orders")->countAllResults();
                                echo number_format($ordersCount, 0);
                                ?>
                                </h3>
                            </div>
                        </div>
                        <!-- End Icon Cart -->
                    </div>
                    <!-- End Col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-card mb-30">
                            <div class="icon success">
                                <i class="lni lni-folder"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10">Categories</h6>
                                <h3 class="text-bold mb-10">
                                <?php
                                $categoryCount = $this->db->table("category")->countAllResults();
                                echo number_format($categoryCount, 0);
                                ?>
                                </h3>
                            </div>
                        </div>
                        <!-- End Icon Cart -->
                    </div>
                    <!-- End Col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-card mb-30">
                            <div class="icon primary">
                                <i class="lni lni-wheelbarrow"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10">Products</h6>
                                <h3 class="text-bold mb-10">
                                <?php
                                $productsCount = $this->db->table("products")->countAllResults();
                                echo number_format($productsCount, 0);
                                ?>
                                </h3>
                            </div>
                        </div>
                        <!-- End Icon Cart -->
                    </div>
                    <!-- End Col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-card mb-30">
                            <div class="icon orange">
                                <i class="lni lni-user"></i>
                            </div>
                            <div class="content">
                                <h6 class="mb-10">Users</h6>
                                <h3 class="text-bold mb-10">
                                <?php
                                $usersCount = $this->db->table("users")->countAllResults();
                                echo number_format($usersCount, 0);
                                ?>
                                </h3>
                            </div>
                        </div>
                        <!-- End Icon Cart -->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <div class="title d-flex flex-wrap align-items-center justify-content-between">
                                <div class="left">
                                    <h6 class="text-medium mb-30">Recent Orders</h6>
                                </div>
                            </div>
                            <!-- End Title -->
                            <div class="table-responsive">
                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><h6>#</h6></th>
                                            <th><h6>Date</h6></th>
                                            <th><h6>Name</h6></th>
                                            <th><h6>Email</h6></th>
                                            <th><h6>Amount</h6></th>
                                            <th><h6>Status</h6></th>
                                            <th class="text-center"><h6>Action</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($orders as $key => $order):
                                        $user = $this->db->table("users")->where("id", $order["userId"])->get()->getRowArray();
                                        $country = $this->db->table("country")->where("id", $order["country"])->get()->getRowArray();
                                        ?>
                                        <tr>
                                            <td class="text-center align-middle"><?php echo $key+1; ?></td>
                                            <td class="align-middle"><?php echo date("d-M-Y", $order["createdAt"]); ?></td>
                                            <td class="align-middle"><?php echo $user["name"]; ?></td>
                                            <td class="align-middle"><?php echo $user["email"]; ?></td>
                                            <td class="align-middle"><?php echo $country["currency"] . $order["total"]; ?></td>
                                            <td class="align-middle">
                                                <?php if ($order["orderStatus"] == 0) { ?>
                                                <span class="status-btn warning-btn">Pending</span>
                                                <?php } elseif ($order["orderStatus"] == 1) { ?>
                                                <span class="status-btn success-btn">Verified</span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="action">
                                                    <a href="<?php echo site_url('admin/orders/view/'.$order['id']); ?>" target="_blank">
                                                        <button class="text-dark link-btn">
                                                            <i class="lni lni-eye"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <!-- End Table -->
                            </div>
                        </div>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->
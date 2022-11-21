
    
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
                
                <!-- ========== tables-wrapper start ========== -->
                <div class="tables-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-style mb-30">
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
                                                <td class="align-middle"><?php echo date("d-M-Y", $order["orderDate"]); ?></td>
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
                                                        <a href="<?php echo site_url('admin/orders/view/'.$order['id']); ?>">
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
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== tables-wrapper end ========== -->
                
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->
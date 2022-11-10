


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase my-3">Orders</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">

            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <table class="table table-bordered">
                        <thead>
                            <th class="text-dark">#</th>
                            <th class="text-dark">Date</th>
                            <th class="text-dark">Name</th>
                            <th class="text-dark">Email</th>
                            <th class="text-dark">Payment</th>
                            <th class="text-dark">Status</th>
                            <th class="text-dark"></th>
                        </thead>
                        <tbody>
                            <?php
                            if (count($orders) > 0):
                            foreach (array_reverse($orders) as $key => $order):
                            $user = $this->db->table("users")->where("id", $order["userId"])->get()->getRowArray();
                            ?>
                            <tr>
                                <td>#FS<?php echo date("dmy", $order["orderDate"]). $order["id"]; ?></td>
                                <td><?php echo date("d-M-Y", $order["orderDate"]); ?></td>
                                <td><?php echo $user["name"]; ?></td>
                                <td><?php echo $user["email"]; ?></td>
                                <td><?php echo $order["paymentMethod"]; ?></td>
                                <td class="align-middle">
                                    <?php if ($order["orderStatus"] == 1) { ?>
                                    <span class="status-btn warning-btn">Processed</span>
                                    <?php } elseif ($order["orderStatus"] == 2) { ?>
                                    <span class="status-btn success-btn">Shipped</span>
                                    <?php } elseif ($order["orderStatus"] == 3) { ?>
                                    <span class="status-btn success-btn">Delivered</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="action justify-content-end">
                                        <a href="<?php echo site_url(strtolower('orders/view/' . $order['id']); ?>" target="_blank">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr><td colspan="6">Sorry..!<br>No orders found</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
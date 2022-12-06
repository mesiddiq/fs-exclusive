


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase my-3">Orders</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">

            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <table class="table table-bordered text-center">
                    <thead class="bg-secondary text-dark">
                        <th class="text-dark">#</th>
                        <th class="text-dark">Date</th>
                        <th class="text-dark">Order ID</th>
                        <th class="text-dark">Amount</th>
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
                            <td class="align-middle"><?php echo $key+1; ?></td>
                            <td class="align-middle"><?php echo date("d-M-Y", $order["createdAt"]); ?></td>
                            <td class="align-middle"><?php echo $order["paymentOrderId"]; ?></td>
                            <td class="align-middle">
                                <?php if ($order["paymentStatus"] == 1) { ?>
                                <span class="rounded px-2 py-2 badge badge-success">Paid</span>
                                <?php } elseif ($order["paymentStatus"] == 2) { ?>
                                <span class="rounded px-2 py-2 badge badge-warning text-white">Pending</span>
                                <?php } elseif ($order["paymentStatus"] == 3) { ?>
                                <span class="rounded px-2 py-2 badge badge-danger">Failed</span>
                                <?php } ?>
                            </td>
                            <td class="align-middle"><strong class="text-dark"><?php echo getCurrency($order["country"]) . $order["total"]; ?></strong></td>
                            <td class="align-middle">
                                <?php if ($order["orderStatus"] == 1) { ?>
                                <span class="rounded px-2 py-2 badge badge-info">Processing</span>
                                <?php } elseif ($order["orderStatus"] == 2) { ?>
                                <span class="rounded px-2 py-2 badge badge-warning text-white">Shipped</span>
                                <?php } elseif ($order["orderStatus"] == 3) { ?>
                                <span class="rounded px-2 py-2 badge badge-success">Delivered</span>
                                <?php } ?>
                            </td>
                            <td class="text-center align-middle">
                                <div class="action justify-content-end">
                                    <a href="<?php echo site_url(strtolower('orders/view/' . $order['id'])); ?>" target="_blank">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr><td colspan="7">Sorry..!<br>No orders found</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
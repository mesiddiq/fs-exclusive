
    
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
                        <div class="col-md-6">
                            <div class="add-task-button float-end">
                                <a href="<?php echo site_url('admin/coupons/add'); ?>"><button class="btn primary-btn"><i class="lni lni-plus"></i> Add New</button></a>
                            </div>
                        </div>
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
                                                <th><h6>Coupon</h6></th>
                                                <th><h6>Type</h6></th>
                                                <th><h6>Amount</h6></th>
                                                <th><h6>Country</h6></th>
                                                <th class="text-center"><h6>Status</h6></th>
                                                <th class="text-center"><h6>Action</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($coupons as $key => $coupon):
                                            $country = $this->db->table("country")->where("id", $coupon["country"])->get()->getRowArray();
                                            $used = $this->db->table("orders")->where(array("coupon" => $coupon["code"], "country" => $coupon["country"]))->get()->getResultArray();
                                            ?>
                                            <tr>
                                                <td class="text-center align-middle"><?php echo $key+1; ?></td>
                                                <td class="align-middle"><?php echo $coupon["code"]; ?></td>
                                                <td class="align-middle">
                                                    <?php if ($coupon["type"] == "1") { ?>
                                                    <span class="status-btn active-btn">Fixed</span>
                                                    <?php } elseif ($coupon["type"] == "2") { ?>
                                                    <span class="status-btn success-btn">Percentage</span>
                                                    <?php } ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php
                                                    if ($coupon["type"] == "1") {
                                                        echo $country["currency"] . $coupon["value"];
                                                    } elseif ($coupon["type"] == "2") {
                                                        echo $coupon["value"] . "%";
                                                    } ?>
                                                </td>
                                                <td class="align-middle"><?php echo $country["name"]; ?></td>
                                                <td class="text-center align-middle">
                                                    <?php
                                                    $now = strtotime(date('d-M-Y'));
                                                    if (($coupon["expiry"] != "") && ($now > $coupon["expiry"])) { ?>
                                                    <span class="status-btn danger-btn">Expired</span>
                                                    <?php } else { ?>
                                                    <?php if ($coupon["status"] == 0) { ?>
                                                    <span class="status-btn warning-btn">Pending</span>
                                                    <?php } elseif ($coupon["status"] == 1) { ?>
                                                    <span class="status-btn success-btn">Active</span>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </td>
                                                <td class="float-end align-middle">
                                                    <div class="action">
                                                        <a href="<?php echo site_url('admin/coupons/edit/'.$coupon['id']); ?>">
                                                            <button class="text-dark link-btn">
                                                                <i class="lni lni-pencil"></i>
                                                            </button>
                                                        </a>
                                                        <a href="javascript:;" onclick="deleteModal('<?php echo site_url('admin/coupons/delete/'.$coupon['id']); ?>')">
                                                            <button class="text-dark delete-btn ml-10">
                                                                <i class="lni lni-trash-can"></i>
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
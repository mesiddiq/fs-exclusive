
    
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style settings-card-2 mb-30">
                            <form method="POST" action="<?php echo site_url('admin/coupons/update/'.$coupon['id']); ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Coupon</label>
                                            <input type="text" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="code" placeholder="Coupon" value="<?php echo $coupon['code']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="select-style-1">
                                            <label>Type</label>
                                            <div class="select-position">
                                                <select name="type" required>
                                                    <option value="1" <?php echo $coupon['type'] == 1 ? 'selected' : ''; ?>>Fixed</option>
                                                    <option value="2" <?php echo $coupon['type'] == 2 ? 'selected' : ''; ?>>Percentage</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Value</label>
                                            <input type="number" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="value" placeholder="Value" value="<?php echo $coupon['value']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="select-style-1">
                                            <label>Country</label>
                                            <div class="select-position">
                                                <select name="country" required>
                                                    <?php foreach ($countries as $key => $country): ?>
                                                    <option value="<?php echo $country['id']; ?>" <?php echo $coupon['country'] == $country['id'] ? 'selected' : ''; ?>><?php echo $country["name"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <style type="text/css">
                                            .select2.select2-container, .select2.select2-container .selection {
                                                width: 100% !important;
                                            }
                                            .select2.select2-container .selection .select2-selection .select2-selection__rendered {
                                                width: 100% !important;
                                                height: 49px !important;
                                                overflow-y: auto;
                                            }
                                            .select2-container--default .select2-search--inline .select2-search__field {
                                                padding: 10px;
                                                padding-right: 38px;
                                            }
                                        </style>
                                        <div class="input-style-1">
                                            <label>Product</label>
                                            <select class="select2-multiple" name="product[]" id="couponProducts" multiple="multiple" >
                                                <?php
                                                $products = $this->db->table('products')->where(array('country' => $coupon['country'], 'status' => 1))->get()->getResultArray();
                                                foreach ($products as $key => $product):
                                                ?>
                                                <option value="<?php echo $product['id']; ?>" <?php echo in_array($product['id'], json_decode($coupon['product'])) ? 'selected' : ''; ?>><?php echo $product["name"] . "-" . $product['id']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Expiry</label>
                                            <input type="date" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="expiry" placeholder="Value" value="<?php echo $coupon['expiry'] != "" ? date('Y-m-d', $coupon['expiry']) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 20px;">Status</label>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="0" name="status" id="status0" <?php echo $coupon["status"] == 0 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status0">Pending</label>
                                        </div>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="1" name="status" id="status1" <?php echo $coupon["status"] == 1 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status1">Publish</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="main-btn primary-btn btn-hover">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <!-- ========== tables-wrapper end ========== -->
                
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->
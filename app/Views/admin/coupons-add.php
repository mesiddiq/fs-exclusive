
    
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
                            <form method="POST" action="<?php echo site_url('admin/coupons/create'); ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Coupon</label>
                                            <input type="text" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="code" placeholder="Coupon" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="select-style-1">
                                            <label>Type</label>
                                            <div class="select-position">
                                                <select name="type" required>
                                                    <option value="">Select</option>
                                                    <option value="1">Fixed</option>
                                                    <option value="2">Percentage</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Value</label>
                                            <input type="number" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="value" placeholder="Value" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="select-style-1">
                                            <label>Country</label>
                                            <div class="select-position">
                                                <select name="country" required>
                                                    <option value="">Select</option>
                                                    <?php foreach ($countries as $key => $country): ?>
                                                    <option value="<?php echo $country['id']; ?>"><?php echo $country["name"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="select-style-1">
                                            <label>Product</label>
                                            <div class="select-position">
                                                <select name="product">
                                                    <option value="">Select</option>
                                                    <?php foreach ($products as $key => $product): ?>
                                                    <option value="<?php echo $product['id']; ?>"><?php echo $product["name"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Expiry</label>
                                            <input type="date" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="expiry" placeholder="Value">
                                        </div>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 20px;">Status</label>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="0" name="status" id="status0" checked>
                                            <label class="form-check-label" for="status0">Pending</label>
                                        </div>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="1" name="status" id="status1">
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
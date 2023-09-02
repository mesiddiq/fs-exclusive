
    
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
                    <div class="col-lg-6">
                        <div class="card-style settings-card-2 mb-30">
                            <form method="POST" action="<?php echo site_url('admin/shipping/price/update/'.$shipping["id"]); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Name</label>
                                            <input type="text" class="bg-transparent" name="name" placeholder="100 to 200 grams" value="<?php echo $shipping['name']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="select-style-1">
                                            <label>Country</label>
                                            <div class="select-position">
                                                <select name="country" class="form-required" onchange="this.className = 'form-required'" required>
                                                    <?php
                                                    $countries = $this->db->table("shippingcountry")->where(array("location" => $shipping["location"], "status" => 1))->get()->getResultArray();
                                                    foreach ($countries as $key => $country):
                                                    ?>
                                                    <option value="<?php echo $country['id']; ?>" <?php echo $country['id'] == $shipping['country'] ? 'selected' : ''; ?>><?php echo $country["country"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Minimum (grams)</label>
                                            <input type="number" class="bg-transparent" name="minimum" min="1" placeholder="100" value="<?php echo $shipping['minimum']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-style-1">
                                            <label>Maximum (grams)</label>
                                            <input type="number" class="bg-transparent" name="maximum" min="1" placeholder="100" value="<?php echo $shipping['maximum']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Price</label>
                                            <input type="number" class="bg-transparent" name="price" placeholder="100" value="<?php echo $shipping['price']; ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 10px;">Status</label>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="1" name="status" id="status1" <?php echo $shipping["status"] == 1 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="0" name="status" id="status0" <?php echo $shipping["status"] == 0 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status0">Pending</label>
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
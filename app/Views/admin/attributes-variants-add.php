
    
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
                            <form method="POST" action="<?php echo site_url('admin/attributes/variants/create'); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- <div class="col-12 mb-4">
                                        <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 10px;">Country</label>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="1" name="country" checked>
                                            <label class="form-check-label" for="country">United Kingdom</label>
                                        </div>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="2" name="country">
                                            <label class="form-check-label" for="country">Malaysia</label>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="select-style-1">
                                            <label>Category</label>
                                            <div class="select-position">
                                                <select name="category" required>
                                                    <option value="">Select</option>
                                                    <?php
                                                    $categories = $this->db->table("productattributescategory")->where(array("status" => 1))->get()->getResultArray();
                                                    foreach ($categories as $key => $category):
                                                    ?>
                                                    <option value="<?php echo $category['id']; ?>"><?php echo $category["name"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Name</label>
                                            <input type="text" class="bg-transparent" name="name" placeholder="Name" required />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check checkbox-style mb-20">
                                            <input class="form-check-input" type="checkbox" value="1" name="isColor" id="isColor">
                                            <label class="form-check-label" for="isColor">Check if Color</label>
                                        </div>
                                    </div>
                                    <div class="col-12" id="isColorInput" style="display: none;">
                                        <div class="input-style-1">
                                            <label>Color</label>
                                            <input type="color" class="bg-transparent" name="colorCode" placeholder="Name" required style="height: 75px;" />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 10px;">Status</label>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="1" name="status" checked>
                                            <label class="form-check-label" for="status">Publish</label>
                                        </div>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="0" name="status">
                                            <label class="form-check-label" for="status">Pending</label>
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

    
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
                            <form method="POST" action="<?php echo site_url('admin/categories/update/'.$category['id']); ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Name</label>
                                            <input type="text" class="bg-transparent" name="name" placeholder="Name" value="<?php echo $category['name']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="select-style-1">
                                            <label>Parent</label>
                                            <div class="select-position">
                                                <select name="parent">
                                                    <option value="">Select</option>
                                                    <?php
                                                    $categories = $this->db->table("category")->where('parent', NULL)->get()->getResultArray();
                                                    foreach ($categories as $key => $categoryy):
                                                    ?>
                                                    <option value="<?php echo $categoryy['id']; ?>" <?php echo $categoryy["id"] == $category["parent"] ? 'selected' : ''; ?>><?php echo $categoryy["name"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 10px;">Status</label>
                                        <div class="form-check radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="1" name="status" <?php echo $category["status"] == 1 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status">Active</label>
                                        </div>
                                        <div class="form-check radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="0" name="status" <?php echo $category["status"] == 0 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status">Not Active</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="main-btn primary-btn btn-hover">Update</button>
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
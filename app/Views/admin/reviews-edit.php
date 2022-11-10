
    
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
                            <form method="POST" action="<?php echo site_url('admin/reviews/update/'.$review['id']); ?>">
                                <?php
                                $user = $this->db->table("users")->where("id", $review["userId"])->get()->getRowArray();
                                $product = $this->db->table("products")->where("id", $review["productId"])->get()->getRowArray();
                                ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Name</label>
                                            <input type="text" class="bg-transparent" value="<?php echo $user['name']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Product</label>
                                            <input type="text" class="bg-transparent" value="<?php echo $product['name']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="select-style-1">
                                            <label>Rating</label>
                                            <div class="select-position">
                                                <select name="rating">
                                                    <option value="1" <?php echo $review["rating"] == 1 ? 'selected' : ''; ?>>1</option>
                                                    <option value="2" <?php echo $review["rating"] == 2 ? 'selected' : ''; ?>>2</option>
                                                    <option value="3" <?php echo $review["rating"] == 3 ? 'selected' : ''; ?>>3</option>
                                                    <option value="4" <?php echo $review["rating"] == 4 ? 'selected' : ''; ?>>4</option>
                                                    <option value="5" <?php echo $review["rating"] == 5 ? 'selected' : ''; ?>>5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Review</label>
                                            <textarea class="bg-transparent" name="review"><?php echo $review['review']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label style="font-size: 14px; font-weight: 500; color: #262d3f; display: block; margin-bottom: 10px;">Status</label>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="0" name="status" <?php echo $review["status"] == 0 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status">Pending</label>
                                        </div>
                                        <div class="form-check form-check-inline radio-style mb-20">
                                            <input class="form-check-input" type="radio" value="1" name="status" <?php echo $review["status"] == 1 ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="status">Published</label>
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
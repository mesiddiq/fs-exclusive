
    
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
                        <div class="card-style mb-30">
                            <form method="POST" action="<?php echo site_url('admin/testimonials/create'); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Images (500px X 400px)</label>
                                            <input type="file" class="bg-transparent form-required" oninput="this.className = 'bg-transparent form-required'" name="image[]" multiple />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <button class="main-btn primary-btn btn-hover">Submit</button>
                                    </div>
                                    <?php
                                    $images = $this->db->query("SELECT * FROM `testimonialimages` ORDER BY `order` IS NULL, `order` ASC")->getResultArray();
                                    if (count($images) > 0):
                                    foreach ($images as $key => $image): ?>
                                    <div class="col-3 mb-4 text-center" id="image<?php echo $image['id']; ?>">
                                        <img src="<?php echo site_url("uploads/testimonials/".$image['name']) ?>" class="img-fluid px-2 py-2 border">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="javascript:;" class="deleteTestimonialImage" data-imageid="<?php echo $image["id"]; ?>"><button type="button" class="btn danger-btn mt-2"><small>Delete</small></button></a>
                                            </div>
                                            <style type="text/css">
                                                .select-style-1 .select-position select {
                                                    padding: 6.3px;
                                                    border-radius: .25rem;
                                                }
                                                .select-style-1 .select-position::after {
                                                    margin-top: -8px !important;
                                                }
                                            </style>
                                            <div class="col-6 text-end">
                                                <div class="select-style-1 mt-2">
                                                    <div class="select-position">
                                                        <select name="testimonialImageOrder" class="form-required testimonialImageOrder" data-imageid="<?php echo $image["id"]; ?>" onchange="this.className = 'form-required'">
                                                            <option value="">Select</option>
                                                            <option value="1" <?php echo $image["order"] == 1 ? "selected" : ""; ?>>1</option>
                                                            <option value="2" <?php echo $image["order"] == 2 ? "selected" : ""; ?>>2</option>
                                                            <option value="3" <?php echo $image["order"] == 3 ? "selected" : ""; ?>>3</option>
                                                            <option value="4" <?php echo $image["order"] == 4 ? "selected" : ""; ?>>4</option>
                                                            <option value="5" <?php echo $image["order"] == 5 ? "selected" : ""; ?>>5</option>
                                                            <option value="6" <?php echo $image["order"] == 6 ? "selected" : ""; ?>>6</option>
                                                            <option value="7" <?php echo $image["order"] == 7 ? "selected" : ""; ?>>7</option>
                                                            <option value="8" <?php echo $image["order"] == 8 ? "selected" : ""; ?>>8</option>
                                                            <option value="9" <?php echo $image["order"] == 9 ? "selected" : ""; ?>>9</option>
                                                            <option value="10" <?php echo $image["order"] == 10 ? "selected" : ""; ?>>10</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
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
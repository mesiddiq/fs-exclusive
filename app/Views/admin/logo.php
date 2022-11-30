
    
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
                    <div class="col-lg-4">
                        <div class="card-style-1 mb-30">
                            <div class="text-center px-5 pb-4">
                                <img src="<?php echo site_url('uploads/logo.png'); ?>" height="95px">
                            </div>
                            <div class="card-content">
                                <h4 class="mb-2">Header Logo</h4>
                                <form method="POST" action="<?php echo site_url('admin/logo/header'); ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <input type="file" class="bg-transparent" name="headerLogo" accept="image/png" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="main-btn primary-btn btn-hover">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card-style-1 mb-30">
                            <div class="text-center px-5 pb-4">
                                <img src="<?php echo site_url('uploads/footer_logo.png'); ?>" height="95px">
                            </div>
                            <div class="card-content">
                                <h4 class="mb-2">Footer Logo</h4>
                                <form method="POST" action="<?php echo site_url('admin/logo/footer'); ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <input type="file" class="bg-transparent" name="footerLogo" accept="image/png" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="main-btn primary-btn btn-hover">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card-style-1 mb-30">
                            <div class="text-center px-5 pb-4">
                                <img src="<?php echo site_url('uploads/favicon.png'); ?>" height="95px">
                            </div>
                            <div class="card-content">
                                <h4 class="mb-2">Favicon</h4>
                                <form method="POST" action="<?php echo site_url('admin/logo/favicon'); ?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-style-1">
                                                <input type="file" class="bg-transparent" name="favicon" accept="image/png" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="main-btn primary-btn btn-hover">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
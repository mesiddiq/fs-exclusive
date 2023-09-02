
    
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
                        <div class="card-style mb-30">
                            <form method="POST" action="<?php echo site_url('admin/social-links/update'); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Facebook</label>
                                            <input type="url" class="bg-transparent" name="facebookLink" placeholder="https://www.facebook.com" value="<?php echo getSettings('facebookLink') != NULL ? getSettings('facebookLink') : '';  ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Twitter</label>
                                            <input type="url" class="bg-transparent" name="twitterLink" placeholder="https://www.twitter.com" value="<?php echo getSettings('twitterLink') != NULL ? getSettings('twitterLink') : '';  ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Instagram</label>
                                            <input type="url" class="bg-transparent" name="instagramLink" placeholder="https://www.instagram.com" value="<?php echo getSettings('instagramLink') != NULL ? getSettings('instagramLink') : '';  ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Linkedin</label>
                                            <input type="url" class="bg-transparent" name="linkedinLink" placeholder="https://www.linkedin.com" value="<?php echo getSettings('linkedinLink') != NULL ? getSettings('linkedinLink') : '';  ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Youtube</label>
                                            <input type="url" class="bg-transparent" name="youtubeLink" placeholder="https://www.youtube.com" value="<?php echo getSettings('youtubeLink') != NULL ? getSettings('youtubeLink') : '';  ?>" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Tiktok</label>
                                            <input type="url" class="bg-transparent" name="tiktokLink" placeholder="https://www.tiktok.com" value="<?php echo getSettings('tiktokLink') != NULL ? getSettings('tiktokLink') : '';  ?>" />
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
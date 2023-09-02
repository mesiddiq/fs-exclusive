
    
    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark">
        <div class="row px-xl-5 pt-5 text-center">
            <div class="col-lg-12 mb-5 pr-3 pr-xl-5">
                <a href="<?php echo site_url(); ?>"><img class="img-fluid py-3" src="<?php echo site_url('uploads/footer_logo.png'); ?>" width="140px"></a>
                <div class="align-items-center mt-3">
                    <?php if (getSettings("facebookLink") != ""): ?>
                    <a class="text-dark px-2" href="<?php echo getSettings("facebookLink"); ?>" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (getSettings("twitterLink") != ""): ?>
                    <a class="text-dark px-2" href="<?php echo getSettings("twitterLink"); ?>" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (getSettings("instagramLink") != ""): ?>
                    <a class="text-dark px-2" href="<?php echo getSettings("instagramLink"); ?>" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (getSettings("linkedinLink") != ""): ?>
                    <a class="text-dark px-2" href="<?php echo getSettings("linkedinLink"); ?>" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (getSettings("youtubeLink") != ""): ?>
                    <a class="text-dark px-2" href="<?php echo getSettings("youtubeLink"); ?>" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (getSettings("tiktokLink") != ""): ?>
                    <a class="text-dark px-2" href="<?php echo getSettings("tiktokLink"); ?>" target="_blank">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <?php endif; ?>
                </div>
                <div class="align-items-center mt-3">
                    <a class="text-dark px-2" href="<?php echo site_url('privacy-policy'); ?>">
                        Privacy Policy
                    </a>
                    |
                    <a class="text-dark px-2" href="<?php echo site_url('terms'); ?>">
                        Terms of Service
                    </a>
                    |
                    <a class="text-dark px-2" href="<?php echo site_url('refund-policy'); ?>">
                        Refund Policy
                    </a>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <?php echo date("Y"); ?> <a class="text-dark font-weight-semi-bold" href="#">FS Exclusive</a> | All Rights Reserved<!-- | Designed by <a class="text-dark font-weight-semi-bold" href="https://sparkztechin.com" target="_blank">Sparkz Tech</a>-->
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="<?php echo site_url('assets/img/payments.png'); ?>" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="javascript:;" class="btn btn-primary text-white back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- Back to Top -->
    <!-- <a href="javascript:;" class="btn text-white custom-product" id="showcustomProductModal">Pre-Order</a> -->
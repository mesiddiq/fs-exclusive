


    <!-- Shop Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">

            <!-- Shop Product Start -->
            <div class="col-lg-6 offset-lg-3">
                <div class="card bg-secondary text-center">
                    <div class="card-body px-5 py-5">
                        <?php if ($paymentStatus == "1") { ?>
                        <h4 class="card-title mb-4">Your order has been received</h4>
                        <span class="text-success"><i class="fa fa-check-circle fa-3x"></i></span>
                        <p class="card-text mt-4">Your Order ID: <strong class="text-dark"><?php echo $paymentOrderId; ?></strong></p>
                        <p class="card-text mt-3">You will receive an order confirmation email with details of your order.</p>
                        <a href="<?php echo site_url(); ?>" class="btn btn-primary text-white">Continue Shopping</a>
                        <?php } else if ($paymentStatus == "3") { ?>
                        <h4 class="card-title mb-4">Oops..! Something went wrong</h4>
                        <span class="text-danger"><i class="fa fa-window-close fa-3x"></i></span>
                        <p class="card-text mt-4">Your Order ID: <strong class="text-dark"><?php echo $paymentOrderId; ?></strong></p>
                        <p class="card-text mt-3">Your payment has been failed due to some techinal issues</p>
                        <a href="<?php echo site_url('checkout'); ?>" class="btn btn-primary text-white">Try again</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
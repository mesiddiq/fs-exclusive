<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | FS Exclusive</title>

    <link type="image/x-icon" href="<?php echo site_url('assets/img/favicon.png'); ?>" rel="icon">

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?php echo site_url('admin/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/LineIcons.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/quill/bubble.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/quill/snow.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/fullcalendar.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/morris.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/datatable.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/main.css'); ?>" />
</head>
<body>
    <!-- ========== signin-section start ========== -->
    <section class="signin-section">
        <div class="container-fluid">
            <div class="row g-0 auth-row">
                <div class="col-lg-6">
                    <div class="auth-cover-wrapper bg-primary-100">
                        <div class="auth-cover">
                            <div class="title text-center">
                                <h1 class="text-primary mb-10">Welcome Back</h1>
                                <p class="text-medium">Sign in to your account to continue</p>
                            </div>
                            <div class="cover-image">
                                <img src="<?php echo site_url('admin/images/auth/signin-image.svg'); ?>" alt="" />
                            </div>
                            <div class="shape-image">
                                <img src="<?php echo site_url('admin/images/auth/shape.svg'); ?>" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    <div class="signin-wrapper">
                        <div class="form-wrapper">
                            <form action="#">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Email</label>
                                            <input type="email" placeholder="Email" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="button-group d-flex justify-content-center flex-wrap">
                                            <button class="main-btn primary-btn btn-hover w-100 text-center">Sign In</button>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-12 mt-3">
                                        <div class="text-center mb-30">
                                            Forgot your password? <a href="javascript:;" class="hover-underline">click here</a>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </section>
    <!-- ========== signin-section end ========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="<?php echo site_url('admin/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/Chart.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/apexcharts.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/dynamic-pie-chart.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/moment.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/fullcalendar.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/jvectormap.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/world-merc.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/polyfill.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/quill.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/datatable.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/Sortable.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/main.js'); ?>"></script>
</body>
</html>

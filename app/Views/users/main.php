<?php
$this->db = \Config\Database::connect();
$this->session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FS Exclusive</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?php echo site_url('assets/img/favicon.png'); ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo site_url('assets/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo site_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row top-bar py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-light px-2" href="javascript:;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-light px-2" href="javascript:;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-light px-2" href="javascript:;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-light px-2" href="javascript:;">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <select id="ccnge" class="mx-auto pl-2" style="border: none; border-radius: 5px;" onchange="countrychange();">
                        <?php
                        $countries = $this->db->table("country")->get()->getResultArray();
                        foreach ($countries as $country):
                            $country_id = 1; ?>
                            <option value="<?php echo $country['id'] ?>" <?php echo ($country_id == $country['id'] ? 'selected' : '') ?>><?php echo $country['code'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($this->session->get("logged_in") == true): ?>
                    <div class="nav-item dropdown">
                        <a href="javascript:;" class="nav-link dropdown-toggle text-light py-0" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->get("userName"); ?></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <?php if ($this->session->get("userRole") === "1"): ?>
                            <a href="<?php echo site_url("admin/dashboard"); ?>" class="dropdown-item"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url("logout"); ?>" class="dropdown-item"><i class="fa fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                    <?php else: ?>
                    <a class="text-light px-2 ml-3 show-modal" href="javascript:;" data-toggle="modal" data-target="#loginModal">
                        <i class="fa fa-user"></i> Login
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <div class="container-fluid py-2 px-xl-5">
        <div class="row justify-content-between">
            <div class="col-md-8 order-md-last">
                <div class="row">
                    <div class="col-4 col-md-6 text-center">
                        <a href="<?php echo site_url(); ?>" class="text-decoration-none"><img src="<?php echo site_url('assets/img/logo.png'); ?>"></a>
                    </div>
                    <div class="col-md-6 d-md-flex justify-content-end my-auto">
                        <form action="search-result.php" class="searchform order-lg-last">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control pl-3" placeholder="Search" style="height: auto;">
                                <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8 col-md-4 d-flex my-auto justify-content-start py-3">
                <a href="javascript:;" class="btn border mr-1">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="javascript:;" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>
        
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light bg-dark" id="ftco-navbar">
        <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav m-auto">
                    <a href="<?php echo site_url(); ?>" class="nav-item nav-link active">Home</a>
                    <a href="<?php echo site_url('/shop'); ?>" class="nav-item nav-link">Shop</a>
                    <div class="nav-item dropdown">
                        <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                    </div>
                    <a href="<?php echo site_url('contact'); ?>" class="nav-item nav-link">Contact</a>
                </div>
            </div>
        </div>
    </nav>    
    
    <!-- Carousel Start -->
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div id="abaya-video" class="abay-1" data-ride="l">
                    <video id="abaya-video" src="assets/img/FS Exclusive Fashion Video HD.m4v" loop muted playsinline autoplay style="width: 100%;"></video>
                </div>
            </div>
        </div>
        <!-- <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a> -->
    </div>
    <!-- Carousel End -->

    <!-- ========== footer start =========== -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 order-last order-md-first">
                    <div class="copyright text-center text-md-start">
                        <p class="text-sm">
                            Designed and Developed by
                            <a
                                href="https://sparkztechin.com/"
                                rel="nofollow"
                                target="_blank"
                                >
                                Sparkztechin
                            </a>
                        </p>
                    </div>
                </div>
                <!-- end col-->
                <div class="col-md-6">
                    <div class="terms d-flex justify-content-center justify-content-md-end">
                        <a href="#0" class="text-sm">Term & Conditions</a>
                        <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </footer>
    <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo site_url('assets/lib/easing/easing.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>

    <!-- Template Javascript -->
    <script src="<?php echo site_url('assets/js/main.js'); ?>"></script>

    <?php include 'modal.php'; ?>

    <script type="text/javascript">
        $("#countryModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    </script>
    
</body>
</html>
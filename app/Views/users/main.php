<?php
$this->db = \Config\Database::connect();
$this->session = \Config\Services::session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>FS Exclusive | From Dubai To Your Doorsteps</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="">
    <meta name="description" content="We are online based in Malaysia and United Kingdom. We take pride Alhamdulillah for strong customers supporting us not only in Malaysia, but also across UK, Singapore and Brunei. Our products are made to last. We have wide variety of styles and colours to choose from. We can ship them right to you, wherever you are in the world.">

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
                    <a class="text-light px-2 ml-3 show-modal" href="javascript:;" data-toggle="modal" data-target="#loginModal">
                        <i class="fa fa-user"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <div class="container-fluid py-2 px-xl-5">
        <div class="row justify-content-between">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12 col-md-4 d-flex justify-content-center justify-content-lg-start">
                        <a href="<?php echo site_url(); ?>"><img class="img-fluid py-3" src="<?php echo site_url('uploads/logo.png'); ?>" width="120px"></a>
                    </div>
                    <div class="col-md-8 d-md-flex justify-content-center my-auto">
                        <form method="GET" action="<?php echo site_url('search'); ?>" class="searchform order-lg-last">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control pl-3" name="keyword" placeholder="Search" style="height: auto;">
                                <button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex my-auto justify-content-center justify-content-lg-end py-3">
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
                    <a href="<?php echo site_url('about'); ?>" class="nav-item nav-link">About</a>
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
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo site_url('assets/lib/easing/easing.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>

    <!-- Template Javascript -->
    <script src="<?php echo site_url('assets/js/main.js'); ?>"></script>

    <script type="text/javascript">
        // $(document).ready(function(){
        //     if (navigator.geolocation){
        //         navigator.geolocation.getCurrentPosition(showLocation);
        //     } else{ 
        //         $('#location').html('Geolocation is not supported by this browser.');
        //     }
        // });

        function showLocation(position){
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            alert(latitude);
            alert(longitude);
            // $.ajax({
            //     type:'POST',
            //     url:'<?php echo site_url('home/getLocation'); ?>',
            //     data:'latitude='+latitude+'&longitude='+longitude,
            //     success:function(msg){
            //         // if(msg){
            //         //    $("#location").html(msg);
            //         // }else{
            //         //     $("#location").html('Not Available');
            //         // }
            //         alert(msg);
            //     }
            // });
        }
    </script>

    <!-- Country Modal Start -->
    <div class="modal fade" id="countryModal" tabindex="-1" role="dialog" aria-labelledby="countryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body px-5">
                    <div class="text-center mt-4">
                        <h4>Select Location</h4>
                    </div>
                    <div class="row my-5">
                        <div class="col-6 text-center">
                            <a href="javascript:;">
                                <img src="<?php echo site_url('assets/img/london.png'); ?>" class="setCountry img-fluid" data-country="1" width="100px">
                                <p class="text-dark mt-3">United Kingdom</p>
                            </a>
                        </div>
                        <div class="col-6 text-center">
                            <a href="javascript:;">
                                <img src="<?php echo site_url('assets/img/malaysia.png'); ?>" class="setCountry img-fluid" data-country="2" width="100px">
                                <p class="text-dark mt-3">Malaysia</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Country Modal End -->

    <script type="text/javascript">
        $("#countryModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    </script>
    
</body>
</html>
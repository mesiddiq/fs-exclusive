<div class="container-fluid py-2 px-xl-5">
        <div class="row justify-content-between">
            <div class="col-md-8 order-md-last">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <a href="<?php echo site_url(); ?>" class="text-decoration-none"><img src="assets/img/100 x 100 FS LOGO.png"></a>
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
            <div class="col-md-4 d-flex my-auto justify-content-start py-3">
                <div class="social-media">
                    <p class="mb-0 d-flex">
                        <a href="javascript:;" class="d-flex align-items-center justify-content-center"><span class="fas fa-heart"><i class="sr-only"></i></span></a>
                        <a href="my-javascript:;" class="d-flex align-items-center justify-content-center"><span class="fas fa-shopping-cart"><i class="sr-only"></i></span></a>
                        <a href="javascript:;" class="d-flex align-items-center justify-content-center"><span class="fa fa-user"><i class="sr-only"></i></span></a>
                        <a href="javascript:;" class="d-flex align-items-center justify-content-center"><span class="fas fa-sign-out-alt"></span><i class="sr-only"></i></a>
                    </p>
                </div>
                <select id="ccnge" class="mx-auto px-3" style="border: none; border-radius: 30px; background: #f5f5ef;" onchange="countrychange();">
                    <?php
                    $countries = $db->table("country")->get()->getResultArray();
                    foreach ($countries as $country):
                        $country_id = 1; ?>
                        <option value="<?php echo $country['id'] ?>" <?php echo ($country_id == $country['id'] ? 'selected' : '') ?>><?php echo $country['country_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
        
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar" style="background-color:#996680">
        <div class="container-fluid">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav m-auto">
                    <a href="<?php echo site_url(); ?>" class="nav-item nav-link active">Home</a>
                    <a href="<?php echo site_url('shop'); ?>" class="nav-item nav-link">Shop</a>
                    <div class="nav-item dropdown">
                        <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="javascript:;" class="dropdown-item">Kids</a>
                            <a href="javascript:;" class="dropdown-item">Teens</a>
                            <a href="javascript:;" class="dropdown-item">Womens</a>
                        </div>
                    </div>
                    <a href="<?php echo site_url('contact'); ?>" class="nav-item nav-link">Contact</a>
                </div>
            </div>
        </div>
    </nav>
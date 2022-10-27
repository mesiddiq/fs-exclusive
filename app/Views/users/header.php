
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="javascript:;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="javascript:;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="javascript:;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="javascript:;">
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
                            <option value="<?php echo $country['id'] ?>" <?php echo ($country_id == $country['id'] ? 'selected' : '') ?>><?php echo $country['country_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if ($this->session->get("logged_in") == true): ?>
                    <div class="nav-item dropdown">
                        <a href="javascript:;" class="nav-link dropdown-toggle text-dark py-0" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $this->session->get("userName"); ?></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <?php if ($this->session->get("userRole") === "1"): ?>
                            <a href="<?php echo site_url("admin/dashboard"); ?>" class="dropdown-item"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
                            <?php endif; ?>
                            <a href="<?php echo site_url("logout"); ?>" class="dropdown-item"><i class="fa fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                    <?php else: ?>
                    <a class="text-dark px-2 ml-3 show-modal" href="javascript:;" data-toggle="modal" data-target="#loginModal">
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
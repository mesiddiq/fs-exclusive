    
    
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
    

    <!-- Featured Start -->
    <!-- <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <?php foreach ($categories as $key => $category): ?>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4">
                    <!-- <p class="text-right">15 Products</p> -->
                    <a href="<?php echo site_url('category/' . $category['slug'] . '/' . $category['id']); ?>" class="cat-img position-relative overflow-hidden">
                        <img class="img-fluid" src="<?php echo site_url('uploads/category/' . $category['image']); ?>" alt="<?php echo $category["name"]; ?>">
                    </a>
                </div>
                <h5 class="font-weight-semi-bold m-0 text-center"><?php echo $category["name"]; ?></h5>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Categories End -->


    <!-- Offer Start -->
    <!-- <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-4 px-4">
                    <img src="assets/img/offer-1.png" alt="">
                    <div class="position-relative text-right" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                        <a href="<?php echo site_url('shop'); ?>" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-4 px-4">
                    <img src="assets/img/offer-2.png" alt="">
                    <div class="position-relative text-left" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                        <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                        <a href="<?php echo site_url('shop'); ?>" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Offer End -->


    <?php foreach ($categories as $key => $category): ?>
    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2"><?php echo $category["name"]; ?></span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            $products = $this->db->table("products")->where(array("category" => $category["id"], "country" => $this->session->get("countryId"), "isTopProduct" => 1))->get()->getResultArray();
            foreach ($products as $key => $product): ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <a href="<?php echo site_url('product/' . $product['slug'] . '/' . $product['id']); ?>">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <?php
                            $featuredimage = $this->db->table("productimages")->where(array("productId" => $product["id"], "featured" => 1))->get()->getResultArray();
                            if (count($featuredimage) > 0): ?>
                            <img class="img-fluid w-100" src="<?php echo site_url('uploads/products/' . $featuredimage[0]['name']); ?>" alt="<?php echo $product["name"]; ?>">
                            <?php else:
                            $image = $this->db->table("productimages")->where(array("productId" => $product["id"]))->get()->getResultArray();
                            ?>
                            <img class="img-fluid w-100" src="<?php echo site_url('uploads/products/' . $image[0]['name']); ?>" alt="<?php echo $product["name"]; ?>">
                            <?php endif; ?>
                            <?php if ($product["isOutOfStock"] == 1): ?>
                            <div style="position: absolute; bottom: 5px; width: 100%; background-color: rgba(255, 255, 255, .9); text-align: center; padding: 5px 0; font-weight: 700;">OUT OF STOCK</div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3"><?php echo $product["name"]; ?></h6>
                            <div class="d-flex justify-content-center">
                                <?php if ($product["isDiscount"] == 1): ?>
                                <h6><?php echo $this->session->get("countryCurrency") . $product["discountedPrice"]; ?></h6><h6 class="text-muted ml-2"><del><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></del></h6>
                                <?php else: ?>
                                <h6><?php echo $this->session->get("countryCurrency") . $product["price"]; ?></h6>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="<?php echo site_url('product/' . $product['slug'] . '/' . $product['id']); ?>" class="btn btn-sm text-dark m-auto"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Products End -->
    <?php endforeach; ?>


    <!-- Subscribe Start -->
    <!-- <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary text-white px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <!-- Subscribe End -->


    <?php
    $images = $this->db->query("SELECT * FROM `testimonialimages` ORDER BY `order` IS NULL, `order` ASC")->getResultArray();
    if (count($images) > 0):
    ?>
    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Testimonials</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <?php foreach ($images as $key => $image): ?>
                    <div class="vendor-item border p-4">
                        <img src="<?php echo site_url("uploads/testimonials/".$image["name"]) ?>" alt="<?php echo $image["name"]; ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
    <?php endif; ?>
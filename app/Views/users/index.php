<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($page_name == "main" || $page_name == "home"): ?>
    <title>FS Exclusive | From Dubai To Your Doorsteps</title>
    <?php else: ?>
    <title><?php echo ucfirst($page_name); ?> | FS Exclusive</title>
    <?php endif; ?>
    <meta name="keywords" content="">
    <meta name="description" content="We are online based in Malaysia and United Kingdom. We take pride Alhamdulillah for strong customers supporting us not only in Malaysia, but also across UK, Singapore and Brunei. Our products are made to last. We have wide variety of styles and colours to choose from. We can ship them right to you, wherever you are in the world.">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo site_url('uploads/favicon.png'); ?>">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Libraries Stylesheet -->
    <link href="<?php echo site_url('assets/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo site_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
    <?php
    $this->db = \Config\Database::connect();
    $this->session = \Config\Services::session();
    include 'header.php';
    include $page_name . '.php';
    include 'footer.php';
    ?>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo site_url('assets/lib/easing/easing.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>

    <!-- Template Javascript -->
    <script src="<?php echo site_url('assets/js/main.js'); ?>"></script>

    <?php include 'modal.php'; ?>

    <!-- Recent Sales -->
    <?php
    $recentSales = $this->db->table("orders")->orderBy("id DESC")->limit(10)->get()->getResultArray();
    $recentSalesArr = array();
    if (count($recentSales) > 0):
        foreach ($recentSales as $key => $recentSale):
            $recentSalesAddress = $this->db->table("address")->where("id", $recentSale["addressId"])->get()->getRowArray();
            foreach (json_decode($recentSale["products"]) as $key => $value) {
                if ($key == 0) {
                    $recentSalesProduct = $this->db->table("products")->where("id", $value->productId)->get()->getRowArray();
                    $recentSalesProductImage = $this->db->table("productimages")->orderBy("featured DESC")->limit(1)->where(array("productId" => $value->productId))->get()->getRowArray();
                    array_push($recentSalesArr, array("name" => $recentSalesAddress["name"], "country" => $recentSalesAddress["country"], "productId" => $recentSalesProduct["id"], "productName" => $recentSalesProduct["name"], "productSlug" => $recentSalesProduct["slug"], "productImage" => $recentSalesProductImage["name"]));
                }
            }
        endforeach;
    ?>
    <section class="custom-social-proof">
        <div class="custom-notification">
            <div class="custom-notification-container">
                <div class="custom-notification-image-wrapper">
                    <a href="" class="purchasedProductLink" target="_blank">
                        <img id="purchasedProductImage" src="" style="width: 50px; height: 50px">
                    </a>
                </div>
                <div class="custom-notification-content-wrapper">
                    <a href="" class="purchasedProductLink" target="_blank">
                        <p class="custom-notification-content">
                            <!--<span id="purchasedUser"></span> from <span id="purchasedCountry"></span>--> Someone purchased a<br><strong class="text-dark"><span id="purchasedProduct"></span></strong>
                        </p>
                    </a>
                </div>
            </div>
            <div class="custom-close"></div>
        </div>
    </section>

    <script type="text/javascript">
        // if ($recentSalesArr != "") {
            var r_text = new Array ();
            r_text[0] = "<?php echo $recentSalesArr[0]["name"] ?>";
            r_text[1] = "<?php echo $recentSalesArr[1]["name"] ?>";
            r_text[2] = "<?php echo $recentSalesArr[2]["name"] ?>";
            r_text[3] = "<?php echo $recentSalesArr[3]["name"] ?>";
            r_text[4] = "<?php echo $recentSalesArr[4]["name"] ?>";
            r_text[5] = "<?php echo $recentSalesArr[5]["name"] ?>";
            r_text[6] = "<?php echo $recentSalesArr[6]["name"] ?>";
            r_text[7] = "<?php echo $recentSalesArr[7]["name"] ?>";
            r_text[8] = "<?php echo $recentSalesArr[8]["name"] ?>";
            r_text[9] = "<?php echo $recentSalesArr[9]["name"] ?>";
     
            var r_country = new Array ();
            r_country[0] = "<?php echo $recentSalesArr[0]["country"] ?>";
            r_country[1] = "<?php echo $recentSalesArr[1]["country"] ?>";
            r_country[2] = "<?php echo $recentSalesArr[2]["country"] ?>";
            r_country[3] = "<?php echo $recentSalesArr[3]["country"] ?>";
            r_country[4] = "<?php echo $recentSalesArr[4]["country"] ?>";
            r_country[5] = "<?php echo $recentSalesArr[5]["country"] ?>";
            r_country[6] = "<?php echo $recentSalesArr[6]["country"] ?>";
            r_country[7] = "<?php echo $recentSalesArr[7]["country"] ?>";
            r_country[8] = "<?php echo $recentSalesArr[8]["country"] ?>";
            r_country[9] = "<?php echo $recentSalesArr[9]["country"] ?>";

            var r_product = new Array ();
            r_product[0] = "<?php echo $recentSalesArr[0]["productName"] ?>";
            r_product[1] = "<?php echo $recentSalesArr[1]["productName"] ?>";
            r_product[2] = "<?php echo $recentSalesArr[2]["productName"] ?>";
            r_product[3] = "<?php echo $recentSalesArr[3]["productName"] ?>";
            r_product[4] = "<?php echo $recentSalesArr[4]["productName"] ?>";
            r_product[5] = "<?php echo $recentSalesArr[5]["productName"] ?>";
            r_product[6] = "<?php echo $recentSalesArr[6]["productName"] ?>";
            r_product[7] = "<?php echo $recentSalesArr[7]["productName"] ?>";
            r_product[8] = "<?php echo $recentSalesArr[8]["productName"] ?>";
            r_product[9] = "<?php echo $recentSalesArr[9]["productName"] ?>";
            
            var r_productImage = new Array ();
            r_productImage[0] = "<?php echo site_url("uploads/products/".$recentSalesArr[0]["productImage"]); ?>";
            r_productImage[1] = "<?php echo site_url("uploads/products/".$recentSalesArr[1]["productImage"]); ?>";
            r_productImage[2] = "<?php echo site_url("uploads/products/".$recentSalesArr[2]["productImage"]); ?>";
            r_productImage[3] = "<?php echo site_url("uploads/products/".$recentSalesArr[3]["productImage"]); ?>";
            r_productImage[4] = "<?php echo site_url("uploads/products/".$recentSalesArr[4]["productImage"]); ?>";
            r_productImage[5] = "<?php echo site_url("uploads/products/".$recentSalesArr[5]["productImage"]); ?>";
            r_productImage[5] = "<?php echo site_url("uploads/products/".$recentSalesArr[5]["productImage"]); ?>";
            r_productImage[7] = "<?php echo site_url("uploads/products/".$recentSalesArr[7]["productImage"]); ?>";
            r_productImage[8] = "<?php echo site_url("uploads/products/".$recentSalesArr[8]["productImage"]); ?>";
            r_productImage[9] = "<?php echo site_url("uploads/products/".$recentSalesArr[9]["productImage"]); ?>";

            var r_productLink = new Array ();
            r_productLink[0] = "<?php echo site_url("product/".$recentSalesArr[0]["productSlug"]."/".$recentSalesArr[0]["productId"]); ?>";
            r_productLink[1] = "<?php echo site_url("product/".$recentSalesArr[1]["productSlug"]."/".$recentSalesArr[1]["productId"]); ?>";
            r_productLink[2] = "<?php echo site_url("product/".$recentSalesArr[2]["productSlug"]."/".$recentSalesArr[2]["productId"]); ?>";
            r_productLink[3] = "<?php echo site_url("product/".$recentSalesArr[3]["productSlug"]."/".$recentSalesArr[3]["productId"]); ?>";
            r_productLink[4] = "<?php echo site_url("product/".$recentSalesArr[4]["productSlug"]."/".$recentSalesArr[4]["productId"]); ?>";
            r_productLink[5] = "<?php echo site_url("product/".$recentSalesArr[5]["productSlug"]."/".$recentSalesArr[5]["productId"]); ?>";
            r_productLink[6] = "<?php echo site_url("product/".$recentSalesArr[6]["productSlug"]."/".$recentSalesArr[6]["productId"]); ?>";
            r_productLink[7] = "<?php echo site_url("product/".$recentSalesArr[7]["productSlug"]."/".$recentSalesArr[7]["productId"]); ?>";
            r_productLink[8] = "<?php echo site_url("product/".$recentSalesArr[8]["productSlug"]."/".$recentSalesArr[8]["productId"]); ?>";
            r_productLink[9] = "<?php echo site_url("product/".$recentSalesArr[9]["productSlug"]."/".$recentSalesArr[9]["productId"]); ?>";

            setInterval(function() {
                $(".custom-social-proof").stop().slideToggle('slow'); 
            }, 6000);
            
            $(".custom-close").click(function() {
                $(".custom-social-proof").stop().slideToggle('slow');
            });

            var counter = 0;
            var i = setInterval(function() {
                $(".purchasedProductLink").attr("href", r_productLink[counter]);
                $("#purchasedProductImage").attr("src", r_productImage[counter]);
                $('#purchasedUser').text(r_text[counter]);
                $('#purchasedCountry').text(r_country[counter]);
                $('#purchasedProduct').text(r_product[counter]);
                counter++;

                if (counter === 9) {
                    // clearInterval(i);
                    counter = 0;
                }
            }, 6000);
        // }
    </script>
    <?php endif; ?>
    
</body>
</html>
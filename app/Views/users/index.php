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
    $recentSales = $this->db->table("orders")
        ->where("country", $this->session->get("countryId"))
        ->orderBy("id DESC")
        ->limit(10)
        ->get()
        ->getResultArray();

    $recentSalesArr = array();
    
    if (!empty($recentSales)) {
        foreach ($recentSales as $recentSale) {
            $recentSalesAddress = $this->db->table("address")
                ->where("id", $recentSale["addressId"])
                ->get()
                ->getRowArray();

            $products = json_decode($recentSale["products"]);

            if (!empty($products[0])) {
                $productId = $products[0]->productId;
                $recentSalesProduct = $this->db->table("products")
                    ->where("id", $productId)
                    ->get()
                    ->getResultArray();

                if (count($recentSalesProduct) > 0) {
                    $recentSalesProductImage = $this->db->table("productimages")
                        ->orderBy("featured DESC")
                        ->limit(1)
                        ->where(["productId" => $productId])
                        ->get()
                        ->getRowArray();

                    $recentSalesArr[] = [
                        "name"          => $recentSalesAddress["name"],
                        "country"       => $recentSalesAddress["country"],
                        "productId"     => $recentSalesProduct[0]["id"],
                        "productName"   => $recentSalesProduct[0]["name"],
                        "productSlug"   => $recentSalesProduct[0]["slug"],
                        "productImage"  => $recentSalesProductImage["name"]
                    ];
                }
            }
        }
    }

    if (!empty($recentSalesArr)):
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
        <?php if (!empty($recentSalesArr)): ?>
            var r_text = <?php echo json_encode(array_column($recentSalesArr, 'name')); ?>;
            var r_country = <?php echo json_encode(array_column($recentSalesArr, 'country')); ?>;
            var r_product = <?php echo json_encode(array_column($recentSalesArr, 'productName')); ?>;
            var r_productImage = <?php echo json_encode(array_map(function($img) {
                return site_url("uploads/products/" . $img);
            }, array_column($recentSalesArr, 'productImage'))); ?>;
            var r_productLink = <?php echo json_encode(array_map(function($slug, $id) {
                return site_url("product/$slug/$id");
            }, array_column($recentSalesArr, 'productSlug'), array_column($recentSalesArr, 'productId'))); ?>;
        <?php endif; ?>

        $(document).ready(function() {
            var counter = 0;
            var totalSales = <?php echo count($recentSalesArr); ?>;

            if (totalSales > 0) {
                setInterval(function() {
                    $(".custom-social-proof").stop().slideToggle('slow');
                }, 6000);

                $(".custom-close").click(function() {
                    $(".custom-social-proof").stop().slideToggle('slow');
                });

                var i = setInterval(function() {
                    $(".purchasedProductLink").attr("href", r_productLink[counter]);
                    $("#purchasedProductImage").attr("src", r_productImage[counter]);
                    $('#purchasedUser').text(r_text[counter]);
                    $('#purchasedCountry').text(r_country[counter]);
                    $('#purchasedProduct').text(r_product[counter]);
                    counter++;

                    if (counter === totalSales) {
                        counter = 0;
                    }
                }, 6000);
            }
        });
    </script>
    <?php endif; ?>
    
</body>
</html>
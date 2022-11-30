<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($page_name == "main" || $page_name == "home"): ?>
    <title>FS Exclusive</title>
    <?php else: ?>
    <title><?php echo ucfirst($page_name); ?> | FS Exclusive</title>
    <?php endif; ?>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo site_url('uploads/favicon.png'); ?>">

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

    <!-- Recent Sold -->
    <?php
    $recentSold = $this->db->table("orders")->orderBy("id DESC")->limit(1)->get()->getRowArray();
    if ($recentSold != NULL):
    $recentSoldUser = $this->db->table("users")->where("id", $recentSold["userId"])->get()->getRowArray();
    ?>
    <div class="card recent-sold">
        <div class="card-body">
            <p><strong class="text-dark"><?php echo $recentSoldUser["name"]; ?></strong> purchased our product</p>
            <small>
                <em id="recent-sold-date">
                    <script type="text/javascript">
                        var timestamp = new Date("<?php echo date("Y-m-d", $recentSold["orderDate"]); ?>").getTime();
                        const rtf = new Intl.RelativeTimeFormat('en', {
                            numeric: 'auto',
                        });
                        const oneDayInMs = 1000 * 60 * 60 * 24;
                        const daysDifference = Math.round(
                            (timestamp - new Date().getTime()) / oneDayInMs,
                        );

                        document.write(rtf.format(daysDifference, 'day'));
                    </script>
                </em>
            </small>
        </div>
    </div>
    <?php endif; ?>
    
</body>
</html>
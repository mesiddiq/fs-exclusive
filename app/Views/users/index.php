<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php if ($page_name == "main" || $page_name == "home"): ?>
    <title>FS Exclusive</title>
    <?php else: ?>
    <title><?php echo ucfirst($page_name); ?> | FS Exclusive</title>
    <?php endif; ?>
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
    <?php
    $this->db = \Config\Database::connect();
    $this->session = \Config\Services::session();
    if ($this->session->get("country") != NULL) {
        $sessCountry = $this->db->table("country")->where("id", $this->session->get("country"))->get()->getRowArray();
    } else {
        $sessCountry = "";
    }
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
    
    <?php if ($page_name == "main"): ?>
    <script type="text/javascript">
        $("#countryModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    </script>
    <?php endif; ?>
    
</body>
</html>
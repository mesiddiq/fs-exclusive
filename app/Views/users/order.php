<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order | FS Exclusive</title>
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
    <style type="text/css">
        h4, h6 {
            margin-top: 0.5rem;
        }
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .invoice-for {
            text-align: left;
        }
        .invoice-logo {
            text-align: center;
        }
        .invoice-date {
            text-align: right;
        }
        .address-item {
            padding-top: 30px;
        }
        .invoice-table {
            margin-bottom: 0 !important;
        }
        .invoice-table th:first-child, .invoice-table td:first-child {
            text-align: center;
        }
        .invoice-table th:last-child, .invoice-table td:last-child {
            width: 25%;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php
    $this->db = \Config\Database::connect();
    $this->session = \Config\Services::session();
    ?>
    <div class="container">
        <div class="card" id="printablediv">
            <div class="card-body">
                <div class="row">
                    <div class="col-4 invoice-for mt-4">
                        <h2 class="mb-10">Order ID</h2>
                        <h3>#FS<?php echo date("dmy", $order["createdAt"]). $order["id"]; ?></h3>
                        
                    </div>
                    <div class="col-4 invoice-logo">
                        <img class="img-fluid py-3" src="<?php echo site_url('assets/img/logo.png'); ?>" width="120px">
                    </div>
                    <div class="col-4 invoice-date mt-4 pt-2">
                        <p><span>Order Date:</span> <?php echo date("d-M-Y", $order["createdAt"]); ?></p>
                        <p><span>Order Time:</span> <?php echo date("h:i A", $order["createdAt"]); ?></p>
                    </div>
                </div>
                <?php
                $user = $this->db->table("users")->where("id", $order["userId"])->get()->getRowArray();
                $address = $this->db->table("address")->where("id", $order["addressId"])->get()->getRowArray();
                ?>
                <div class="address-item">
                    <p class="text-sm mb-0">To,</p>
                    <h5 class="font-weight-bold"><?php echo $address["name"]; ?></h5>
                    <p class="text-sm">
                        <?php
                        echo $address["address"];
                        if ($address["address2"] != NULL) {
                            echo ", " . $address["address2"] . ", ";
                        } ?>
                        <br>
                        <?php echo $address["city"] . ", " . $address["state"] . " - " . $address["zipcode"]; ?>
                    </p>
                    <p class="text-sm">
                        <span class="text-medium">Email:</span>
                        <?php echo $address["email"]; ?>
                        <br>
                        <span class="text-medium">Contact:</span>
                        <?php echo $address["contact"]; ?>
                    </p>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered invoice-table">
                    <thead>
                        <tr>
                            <th class="text-dark">#</th>
                            <th class="text-dark">Product</th>
                            <th class="text-dark">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach (json_decode($order["products"]) as $key => $product):
                        $productInfo = $this->db->table("products")->where("id", $product->productId)->get()->getRowArray();
                        ?>
                        <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><?php echo $productInfo["name"] . " x " . $product->productQty; ?></td>
                            <td><?php echo getCurrency($order["country"]) . $product->productPrice; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td></td>
                            <td>
                                <h6 class="text-sm text-medium">Subtotal</h6>
                            </td>
                            <td>
                                <h6 class="text-sm text-bold"><?php echo getCurrency($order["country"]) . $order["subtotal"]; ?></h6>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <h6 class="text-sm text-medium">Discount</h6>
                            </td>
                            <td class="float-end">
                                <h6 class="text-sm text-bold"><?php echo getCurrency($order["country"]) . $order["discount"]; ?></h6>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <h4>Total</h4>
                            </td>
                            <td class="float-end">
                                <h4><?php echo getCurrency($order["country"]) . $order["total"]; ?></h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Card -->
        <button type="button" class="btn btn-primary text-white mt-4" onclick="javascript:printDiv('printablediv')">Download Invoice</button>
        <a href="javascript:;"  class="main-btn primary-btn-outline btn-hover"></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        function printDiv(divID) {
            // Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            // Get the HTML of whole page
            var oldPage = document.body.innerHTML;
            // Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";
            // Print Page
            window.print();
            // Restore orignal HTML
            document.body.innerHTML = oldPage;
        }
    </script>

</body>
</html>
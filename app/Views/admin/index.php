<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $page_title; ?> | FS Exclusive</title>

    <link type="image/x-icon" href="<?php echo site_url('assets/img/favicon.png'); ?>" rel="icon">

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="<?php echo site_url('admin/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/LineIcons.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/quill/bubble.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/quill/snow.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/fullcalendar.css'); ?>" />
    <link rel="stylesheet" href="<?php echo site_url('admin/css/morris.css'); ?>" />
    <?php if ($page_name == "dashboard" || $page_name == "coupons" || $page_name == "products" || $page_name == "attributes" || $page_name == "orders" || $page_name == "reviews" || $page_name == "countries" || $page_name == "shipping" || $page_name == "shipping-country" || $page_name == "shipping-price" || $page_name == "requirements" || $page_name == "users") { ?>
    <link rel="stylesheet" href="<?php echo site_url('admin/css/datatable.css'); ?>" />
    <?php } ?>
    <link rel="stylesheet" href="<?php echo site_url('admin/css/main.css'); ?>" />
</head>
<body>
    
    <?php
    $this->db = \Config\Database::connect();
    $this->session = \Config\Services::session();
    include 'navigation.php';
    include 'header.php';
    include $page_name . '.php';
    include 'footer.php';
    ?>


    <!-- ========= All Javascript files linkup ======== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo site_url('admin/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/Chart.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/apexcharts.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/dynamic-pie-chart.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/moment.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/fullcalendar.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/jvectormap.min.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/world-merc.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/polyfill.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/quill.min.js'); ?>"></script>
    <?php if ($page_name == "dashboard" || $page_name == "coupons" || $page_name == "products" || $page_name == "attributes" || $page_name == "orders" || $page_name == "reviews" || $page_name == "countries" || $page_name == "shipping" || $page_name == "shipping-country" || $page_name == "shipping-price" || $page_name == "requirements" || $page_name == "users") { ?>
    <script src="<?php echo site_url('admin/js/datatable.js'); ?>"></script>
    <script src="<?php echo site_url('admin/js/Sortable.min.js'); ?>"></script>
    <?php } ?>
    <script src="<?php echo site_url('admin/js/main.js'); ?>"></script>

    <?php include 'modal.php'; ?>

    <?php if ($page_name == "products-edit") { ?>
    <script type="text/javascript">
        // Delete product image
        $(".deleteProductImage").on("click", function() {
            var id = $(this).data("imageid");

            $.ajax({
                method: "POST",
                url: "<?php echo site_url('admin/products/deleteImage'); ?>",
                data: {id: id},
                success: function(res) {
                    if (res) {
                        $("#image" + id).remove();
                    } else {
                        alert("Something went wrong");
                    }
                }
            });
        });

        // Set image featured
        $(".setImageFeatured").on("click", function() {
            var id = $(this).data("imageid");
            var productid = $(this).data("productid");

            $.ajax({
                method: "POST",
                url: "<?php echo site_url('admin/products/setImageFeatured'); ?>",
                data: {id: id, productID: productid},
                success: function(res) {
                    if (res) {
                        $("#image" + id + " .text-end").html('<a href="javascript:;"><button type="button" class="btn success-btn mt-2"><small><i class="lni lni-checkmark"></i> Featured</small></button></a>');
                    } else {
                        alert("Something went wrong");
                    }
                }
            });
        });
    </script>
    <?php } ?>

    <?php if ($page_name == "testimonials") { ?>
    <script type="text/javascript">
        // Delete testimonial image
        $(".deleteTestimonialImage").on("click", function() {
            var id = $(this).data("imageid");

            $.ajax({
                method: "POST",
                url: "<?php echo site_url('admin/testimonials/deleteImage'); ?>",
                data: {id: id},
                success: function(tesRes) {
                    if (tesRes) {
                        $("#image" + id).remove();
                    } else {
                        alert("Something went wrong");
                    }
                }
            });
        });

        // Set testimonial image order
        $(".testimonialImageOrder").on("change", function() {
            var id = $(this).data("imageid");
            var order = $(this).val();
            
            $.ajax({
                method: "POST",
                url: "<?php echo site_url('admin/testimonials/updateOrder'); ?>",
                data: {id: id, order: order},
                success: function(orderRes) {
                    if (orderRes) {
                        // $("#image" + id).remove();
                        location.reload();
                    } else {
                        alert("Something went wrong");
                    }
                }
            });
        });
    </script>
    <?php } ?>

    <?php if ($page_name == "dashboard") { ?>
    <script type="text/javascript">
        // ======== jvectormap activation
        var markers = [
            { name: "Egypt", coords: [26.8206, 30.8025] },
            { name: "Russia", coords: [61.524, 105.3188] },
            { name: "Canada", coords: [56.1304, -106.3468] },
            { name: "Greenland", coords: [71.7069, -42.6043] },
            { name: "Brazil", coords: [-14.235, -51.9253] },
        ];

        var jvm = new jsVectorMap({
            map: "world_merc",
            selector: "#map",
            zoomButtons: true,

            regionStyle: {
                initial: {
                    fill: "#d1d5db",
                },
            },

            labels: {
                markers: {
                    render: (marker) => marker.name,
                },
            },

            markersSelectable: true,
            selectedMarkers: markers.map((marker, index) => {
                var name = marker.name;

                if (name === "Russia" || name === "Brazil") {
                    return index;
                }
            }),
            markers: markers,
            markerStyle: {
                initial: { fill: "#4A6CF7" },
                selected: { fill: "#ff5050" },
            },
            markerLabelStyle: {
                initial: {
                    fontWeight: 400,
                    fontSize: 14,
                },
            },
        });

        // ====== calendar activation
        document.addEventListener("DOMContentLoaded", function () {
            var calendarMiniEl = document.getElementById("calendar-mini");
            var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
                initialView: "dayGridMonth",
                headerToolbar: {
                    end: "today prev,next",
                },
            });
            calendarMini.render();
        });

        // =========== chart one start
        const ctx1 = document.getElementById("Chart1").getContext("2d");
        const chart1 = new Chart(ctx1, {
            // The type of chart we want to create
            type: "line", // also try bar or other graph types

            // The data for our dataset
            data: {
                labels: [
                    "Jan",
                    "Fab",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                // Information about the dataset
                datasets: [
                    {
                        label: "",
                        backgroundColor: "transparent",
                        borderColor: "#4A6CF7",
                        data: [
                            600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
                        ],
                        pointBackgroundColor: "transparent",
                        pointHoverBackgroundColor: "#4A6CF7",
                        pointBorderColor: "transparent",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 5,
                        pointBorderWidth: 5,
                        pointRadius: 8,
                        pointHoverRadius: 8,
                    },
                ],
            },

            // Configuration options
            defaultFontFamily: "Inter",
            options: {
                tooltips: {
                    callbacks: {
                        labelColor: function (tooltipItem, chart) {
                            return {
                                backgroundColor: "#ffffff",
                            };
                        },
                    },
                    intersect: false,
                    backgroundColor: "#f9f9f9",
                    titleFontFamily: "Inter",
                    titleFontColor: "#8F92A1",
                    titleFontColor: "#8F92A1",
                    titleFontSize: 12,
                    bodyFontFamily: "Inter",
                    bodyFontColor: "#171717",
                    bodyFontStyle: "bold",
                    bodyFontSize: 16,
                    multiKeyBackground: "transparent",
                    displayColors: false,
                    xPadding: 30,
                    yPadding: 10,
                    bodyAlign: "center",
                    titleAlign: "center",
                },

                title: {
                    display: false,
                },

                legend: {
                    display: false,
                },

                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                                max: 1200,
                                min: 500,
                            },
                        },
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    ],
                },
            },
        });
        // =========== chart one end

        // =========== chart two start
        const ctx2 = document.getElementById("Chart2").getContext("2d");
        const chart2 = new Chart(ctx2, {
            // The type of chart we want to create
            type: "bar", // also try bar or other graph types
            // The data for our dataset
            data: {
                labels: [
                    "Jan",
                    "Fab",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                // Information about the dataset
                datasets: [
                    {
                        label: "",
                        backgroundColor: "#4A6CF7",
                        barThickness: 6,
                        maxBarThickness: 8,
                        data: [
                            600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
                        ],
                    },
                ],
            },
            // Configuration options
            options: {
                borderColor: "#F3F6F8",
                borderWidth: 15,
                backgroundColor: "#F3F6F8",
                tooltips: {
                    callbacks: {
                        labelColor: function (tooltipItem, chart) {
                            return {
                                backgroundColor: "rgba(104, 110, 255, .0)",
                            };
                        },
                    },
                    backgroundColor: "#F3F6F8",
                    titleFontColor: "#8F92A1",
                    titleFontSize: 12,
                    bodyFontColor: "#171717",
                    bodyFontStyle: "bold",
                    bodyFontSize: 16,
                    multiKeyBackground: "transparent",
                    displayColors: false,
                    xPadding: 30,
                    yPadding: 10,
                    bodyAlign: "center",
                    titleAlign: "center",
                },

                title: {
                    display: false,
                },

                legend: {
                    display: false,
                },

                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                                max: 1200,
                                min: 0,
                            },
                        },
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: false,
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    ],
                },
            },
        });
        // =========== chart two end

        // =========== chart three start
        const ctx3 = document.getElementById("Chart3").getContext("2d");
        const chart3 = new Chart(ctx3, {
            // The type of chart we want to create
            type: "line", // also try bar or other graph types

            // The data for our dataset
            data: {
                labels: [
                    "Jan",
                    "Fab",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                // Information about the dataset
                datasets: [
                    {
                        label: "Revenue",
                        backgroundColor: "transparent",
                        borderColor: "#4a6cf7",
                        data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
                        pointBackgroundColor: "transparent",
                        pointHoverBackgroundColor: "#4a6cf7",
                        pointBorderColor: "transparent",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 3,
                        pointBorderWidth: 5,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                    },
                    {
                        label: "Profit",
                        backgroundColor: "transparent",
                        borderColor: "#9b51e0",
                        data: [
                        120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
                        ],
                        pointBackgroundColor: "transparent",
                        pointHoverBackgroundColor: "#9b51e0",
                        pointBorderColor: "transparent",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 3,
                        pointBorderWidth: 5,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                    },
                    {
                        label: "Order",
                        backgroundColor: "transparent",
                        borderColor: "#f2994a",
                        data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
                        pointBackgroundColor: "transparent",
                        pointHoverBackgroundColor: "#f2994a",
                        pointBorderColor: "transparent",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 3,
                        pointBorderWidth: 5,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                    },
                ],
            },

            // Configuration options
            options: {
                tooltips: {
                    intersect: false,
                    backgroundColor: "#fbfbfb",
                    titleFontColor: "#8F92A1",
                    titleFontSize: 16,
                    titleFontFamily: "Inter",
                    titleFontStyle: "400",
                    bodyFontFamily: "Inter",
                    bodyFontColor: "#171717",
                    bodyFontSize: 16,
                    multiKeyBackground: "transparent",
                    displayColors: false,
                    xPadding: 30,
                    yPadding: 15,
                    borderColor: "rgba(143, 146, 161, .1)",
                    borderWidth: 1,
                    title: false,
                },

                title: {
                    display: false,
                },

                layout: {
                    padding: {
                        top: 0,
                    },
                },

                legend: false,

                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                                max: 300,
                                min: 50,
                            },
                        },
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    ],
                },
            },
        });
        // =========== chart three end

        // ================== chart four start
        const ctx4 = document.getElementById("Chart4").getContext("2d");
        const chart4 = new Chart(ctx4, {
            // The type of chart we want to create
            type: "bar", // also try bar or other graph types
            
            // The data for our dataset
            data: {
                labels: ["Jan", "Fab", "Mar", "Apr", "May", "Jun"],
                // Information about the dataset
                datasets: [
                    {
                        label: "",
                        backgroundColor: "#4A6CF7",
                        barThickness: "flex",
                        maxBarThickness: 8,
                        data: [600, 700, 1000, 700, 650, 800],
                    },
                    {
                        label: "",
                        backgroundColor: "#d50100",
                        barThickness: "flex",
                        maxBarThickness: 8,
                        data: [690, 740, 720, 1120, 876, 900],
                    },
                ],
            },
            // Configuration options
            options: {
                borderColor: "#F3F6F8",
                borderWidth: 15,
                backgroundColor: "#F3F6F8",
                tooltips: {
                    callbacks: {
                        labelColor: function (tooltipItem, chart) {
                            return {
                                backgroundColor: "rgba(104, 110, 255, .0)",
                            };
                        },
                    },
                    backgroundColor: "#F3F6F8",
                    titleFontColor: "#8F92A1",
                    titleFontSize: 12,
                    bodyFontColor: "#171717",
                    bodyFontStyle: "bold",
                    bodyFontSize: 16,
                    multiKeyBackground: "transparent",
                    displayColors: false,
                    xPadding: 30,
                    yPadding: 10,
                    bodyAlign: "center",
                    titleAlign: "center",
                },

                title: {
                    display: false,
                },

                legend: {
                    display: false,
                },

                scales: {
                    yAxes: [
                        {
                            gridLines: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                                max: 1200,
                                min: 0,
                            },
                        },
                    ],
                    xAxes: [
                        {
                            gridLines: {
                                display: false,
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    ],
                },
            },
        });
        // =========== chart four end
    </script>
    <?php } ?>
    <?php if ($page_name == "products-add" || $page_name == "products-edit") { ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code', 'link', 'bulletedList', 'numberedList',
                        '|', 'todoList', 'outdent', 'indent',
                        '|', 'alignment',
                    ],
                    shouldNotGroupWhenFull: true
                }
            }).then(editor => {
                window.editor = editor;
            }).catch(err => {
                console.error( err.stack );
            });
    </script>
    <?php } ?>

</body>
</html>
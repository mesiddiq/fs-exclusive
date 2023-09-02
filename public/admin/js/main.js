(function () {

    var site_url = "http://fs.localhost/";

    /* ========= sidebar toggle ======== */
    const sidebarNavWrapper = document.querySelector(".sidebar-nav-wrapper");
    const mainWrapper = document.querySelector(".main-wrapper");
    const menuToggleButton = document.querySelector("#menu-toggle");
    const menuToggleButtonIcon = document.querySelector("#menu-toggle i");
    const overlay = document.querySelector(".overlay");

    // menuToggleButton.addEventListener("click", () => {
    //     sidebarNavWrapper.classList.toggle("active");
    //     overlay.classList.add("active");
    //     mainWrapper.classList.toggle("active");

    //     if (document.body.clientWidth > 1200) {
    //         if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
    //             menuToggleButtonIcon.classList.remove("lni-chevron-left");
    //             menuToggleButtonIcon.classList.add("lni-menu");
    //         } else {
    //             menuToggleButtonIcon.classList.remove("lni-menu");
    //             menuToggleButtonIcon.classList.add("lni-chevron-left");
    //         }
    //     } else {
    //         if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
    //             menuToggleButtonIcon.classList.remove("lni-chevron-left");
    //             menuToggleButtonIcon.classList.add("lni-menu");
    //         }
    //     }
    // });
    overlay.addEventListener("click", () => {
    sidebarNavWrapper.classList.remove("active");
    overlay.classList.remove("active");
    mainWrapper.classList.remove("active");
    });

    // Enabling bootstrap tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );

    $(document).ready(function() {
        // Toggle Product Special Price
        $("#isDiscount").on("change", function() {
            if ($(this).is(":checked")) {
                $(".special-price").show();
                $(".special-price input").addClass("form-required");
            } else {
                $(".special-price").hide();
                $(".special-price input").removeClass("form-required");
            }
        });
        // Toggle Product Type
        $("#regForm [name='type']").on("change", function() {
            var type = $("[name='type']").val();
            
            if (type == "1") {
                $("#simple-product-info").show();
                $("#variable-product-info").hide();
            } else if (type == "2") {
                $("#simple-product-info").hide();
                $("#variable-product-info").show();
            }
        });
        // Toggle Attributes Color
        $("#isColor").on("change", function() {
            if ($(this).is(":checked")) {
                $("#isColorInput").show();
            } else {
                $("#isColorInput").hide();
            }
        });
        // 
        $("#addAttributeBtn").on("click", function() {
            var size = $("#size").val();
            var color = $("#color").val();

            if (size == "" && color == "") {
                alert("Select size");
                alert("Select color");
            } else if (size == "") {
                alert("Select size");
            } else if (color == "") {
                alert("Select color");
            } else {
                $("#size").prop("selectedIndex", 0);
                $("#color").prop("selectedIndex", 0);
                $.ajax({
                    method: "POST",
                    url: site_url + "admin/products/variants/add",
                    data: {size: size, color: color},
                    success: function(catRes) {
                        catRes = JSON.parse(catRes);
                        console.log(catRes);
                        var htmlText = "";
                        for (var i = 0; i < catRes.length; i++) {
                            htmlText += '<div class="accordion-item mb-3">' +
                                            '<h2 class="accordion-header" id="heading' + catRes[i].id +'">' +
                                                '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' + catRes[i].id +'" aria-expanded="false" aria-controls="collapse' + catRes[i].id +'">' +
                                                catRes[i].size + "/" + catRes[i].color +
                                                '</button>' +
                                            '</h2>' +
                                            '<div id="collapse' + catRes[i].id +'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">' +
                                                '<div class="accordion-body">' +
                                                    '<input type="hidden" name="id" value="' + catRes[i].id + '" />' +
                                                    '<input type="hidden" name="productId" value="' + catRes[i].productId + '" />' +
                                                    '<div class="col-6">' +
                                                        '<div class="input-style-1">' +
                                                            '<label>Quantity</label>' +
                                                            '<input type="number" class="bg-transparent" name="quantity" id="quantity' + catRes[i].id + '" placeholder="Quantity" value="' + catRes[i].quantity + '" min="0" />' +
                                                        '</div>' +
                                                    '</div>' +
                                                    '<div class="col-12">' +
                                                        '<button type="button" class="btn primary-btn" id="productVariantUpdateBtn" data-id="' + catRes[i].id + '">Update</button>' +
                                                        '<button type="button" class="btn danger-btn" id="productVariantDeleteBtn" data-id="' + catRes[i].id + '">Delete</button>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                        }
                        $("#variantsCount").text(catRes.length);
                        $("#accordionExample").html(htmlText);
                    }
                });
            }
        });
    });

    // Delete product variant
    $(document).on("click", "#productVariantUpdateBtn", function() {
        var id = $(this).data("id");
        var formId = "#variantForm" + id;
        var qtyId = "#quantity" + id;
        var quantity = $(qtyId).val();

        $.ajax({
            method: "POST",
            url: site_url + "admin/products/variants/update",
            data: {id: id, quantity: quantity},
            success: function(varUpdateRes) {
                if (varUpdateRes == true) {
                    alert("Updated");
                }
            }
        });
    });

    // Delete product variant
    $(document).on("click", "#productVariantDeleteBtn", function() {
        var id = $(this).data("id");

        $.ajax({
            method: "POST",
            url: site_url + "admin/products/variants/delete",
            data: {id: id},
            success: function(catRes) {
                catRes = JSON.parse(catRes);
                console.log(catRes);
                var htmlText = "";
                for (var i = 0; i < catRes.length; i++) {
                    htmlText +=
                    '<div class="accordion-item mb-3">' +
                        '<h2 class="accordion-header" id="heading' + catRes[i].id +'">' +
                            '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' + catRes[i].id +'" aria-expanded="false" aria-controls="collapse' + catRes[i].id +'">' +
                            catRes[i].size + "/" + catRes[i].color +
                            '</button>' +
                        '</h2>' +
                        '<div id="collapse' + catRes[i].id +'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">' +
                            '<div class="accordion-body">' +
                                '<input type="hidden" name="id" value="' + catRes[i].id + '" />' +
                                '<input type="hidden" name="productId" value="' + catRes[i].productId + '" />' +
                                '<div class="col-6">' +
                                    '<div class="input-style-1">' +
                                        '<label>Quantity</label>' +
                                        '<input type="number" class="bg-transparent" name="quantity" placeholder="Quantity" value="' + catRes[i].quantity + '" min="0" />' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-12">' +
                                    '<button type="button" class="btn primary-btn" id="productVariantUpdateBtn" data-id="' + catRes[i].id + '">Update</button>' +
                                    '<button type="button" class="btn danger-btn" id="productVariantDeleteBtn" data-id="' + catRes[i].id + '">Delete</button>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
                }
                $("#variantsCount").text(catRes.length);
                $("#accordionExample").html(htmlText);
            }
        });
    });

    $(".addShippingPriceLocation").on("change", function() {
        var location = $("[name='location']:checked").val();

        $.ajax({
            method: "POST",
            url: site_url + "admin/shipping/price/countries",
            data: {location: location},
            success: function(shippingPriceCountryRes) {
                shippingPriceCountryRes = JSON.parse(shippingPriceCountryRes);
                var shippingPriceCountry = "<option value=''>Select</option>";

                for (var i = 0; i < shippingPriceCountryRes.length; i++) {
                    shippingPriceCountry += '<option value="' + shippingPriceCountryRes[i].id + '">' + shippingPriceCountryRes[i].country + '</option>';
                }

                $("#addShippingPriceCountries").html(shippingPriceCountry);
            }
        });
    })

    // Datatable
    const dataTable = new simpleDatatables.DataTable("#table", {
        searchable: true,
    });

})();

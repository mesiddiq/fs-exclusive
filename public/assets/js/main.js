(function ($) {
    "use strict";

    var site_url = "http://fs.localhost/";
    
    // Dropdown on mouse hover
    $(document).ready(function() {
        // setTimeout(function() {
        //     $('.recent-sold').fadeIn('slow');
        // }, 5000);
        // setTimeout(function() {
        //     $('.recent-sold').fadeOut('slow');
        // }, 15000);
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);

        $(".showForgotModal").on("click", function() {
            $("#loginModal").modal("hide");
            $("#forgotModal").modal("show");
        });

        $(".showRegisterModal").on("click", function() {
            $("#loginModal").modal("hide");
            $("#registerModal").modal("show");
        });

        $(".showLoginModal").on("click", function() {
            $("#registerModal").modal("hide");
            $("#forgotModal").modal("hide");
            $("#loginModal").modal("show");
        });

        $(".showAddressModal").on("click", function() {
            $("#addressModal").modal("show");
        });

        $("#showcustomProductModal").on("click", function() {
            $("#customProductModal").modal("show");
        });

        // Login Form
        $("#loginForm").on("submit", function(e) {
            e.preventDefault();
            var email = $("#loginEmail").val();
            var password = $("#loginPassword").val();
            var currLoc = $(location).attr('href');

            if (password == "") {
                $("#loginPassword").focus();
                $("#loginPasswordError").text("This field is required");
            } else {
                $("#loginPasswordError").text("");
            }

            if (email == "") {
                $("#loginEmail").focus();
                $("#loginEmailError").text("This field is required");
            } else {
                $("#loginEmailError").text("");
            }

            if (email != "" && password != "") {
                $.ajax({
                    method: "POST",
                    url: site_url + "login",
                    data: {email: email, password: password},
                    success: function(logRes) {
                        if (logRes) {
                            $("#loginError").text("");
                            window.location.replace(currLoc);
                        } else {
                            $("#loginError").text("Invalid credentials");
                        }
                    }
                });
            }
        });

        // Register Form
        $("#registerForm").on("submit", function(e) {
            e.preventDefault();
            var name = $("#registerName").val();
            var email = $("#registerEmail").val();
            var password = $("#registerPassword").val();
            var currLoc = $(location).attr('href');

            if (password == "") {
                $("#registerPassword").focus();
                $("#registerPasswordError").text("This field is required");
            } else {
                $("#registerPasswordError").text("");
            }

            if (email == "") {
                $("#registerEmail").focus();
                $("#registerEmailError").text("This field is required");
            } else {
                $("#registerEmailError").text("");
            }

            if (name == "") {
                $("#registerName").focus();
                $("#registerNameError").text("This field is required");
            } else {
                $("#registerNameError").text("");
            }

            if (name != "" && email != "" && password != "") {
                $.ajax({
                    method: "POST",
                    url: site_url + "register",
                    data: {name: name, email: email, password: password},
                    success: function(regRes) {
                        if (regRes == "Exists") {
                            $("#registerError").removeClass("text-success").addClass("text-danger").text("Email already exists");
                        } else if (regRes == "Wrong") {
                            $("#registerError").removeClass("text-success").addClass("text-danger").text("Something went wrong. Please try again");
                        } else if (regRes) {
                            $("#registerError").removeClass("text-danger").addClass("text-success").text("Please verify your email address");
                            setTimeout(function() {
                                window.location.replace(currLoc);
                            }, 5000);
                        }
                    }
                });
            }
        });

        // Forgot Password Form
        $("#forgotForm").on("submit", function(e) {
            e.preventDefault();
            var email = $("#forgotEmail").val();
            var currLoc = $(location).attr('href');

            if (email == "") {
                $("#forgotEmail").focus();
                $("#forgotEmailError").text("This field is required");
            } else {
                $("#forgotEmailError").text("");
            }

            if (email != "") {
                $.ajax({
                    method: "POST",
                    url: site_url + "forgot",
                    data: {email: email},
                    success: function(forRes) {
                        alert(forRes);
                        if (forRes == true) {
                            $("#forgotError").removeClass("text-danger").addClass("text-success").text("Email sent");
                        } else {
                            $("#forgotError").removeClass("text-success").addClass("text-danger").text(forRes);
                        }
                    }
                });
            }
        });

        // Reset Form
        $("#resetForm").on("submit", function(e) {
            e.preventDefault();
            var password = $("#resetPassword").val();
            var confirmPassword = $("#resetConfirmPassword").val();

            if (confirmPassword == "") {
                $("#resetConfirmPassword").focus();
                $("#resetConfirmPasswordError").text("* This field is required");
            } else {
                $("#resetConfirmPasswordError").text("");
            }

            if (password == "") {
                $("#resetPassword").focus();
                $("#resetPasswordError").text("* This field is required");
            } else {
                $("#resetPasswordError").text("");
            }

            if (password != "" && confirmPassword != "") {
                if (password != confirmPassword) {
                    $("#resetConfirmPasswordError").text("Password don't match");
                } else {
                    $.ajax({
                        method: "POST",
                        url: site_url + "change",
                        data: {password: password},
                        success: function(resRes) {
                            if (resRes) {
                                $("#resetPasswordError").text("");
                                $("#resetConfirmPasswordError").text("");
                                $("#resetModalIcon").show();
                                $("#resetModalMessage").text("Password updated");
                                $("#resetModal").modal("show");
                            } else {
                                $("#resetPasswordError").text("");
                                $("#resetConfirmPasswordError").text("");
                                $("#resetModalIcon").hide();
                                $("#resetModalMessage").text("Something went wrong. Try later");
                                $("#resetModal").modal("show");
                            }
                        }
                    });
                }
            }
        });

        // Custom Product Form
        $("#customProductFormBtn").on("click", function(e) {
            e.preventDefault();
            var name = $("#customProductName").val();
            var email = $("#customProductEmail").val();
            var contact = $("#customProductContact").val();
            var contact2 = $("#customProductContact2").val();
            var address = $("#customProductAddress").val();
            var address2 = $("#customProductAddress2").val();
            var city = $("#customProductCity").val();
            var state = $("#customProductState").val();
            var country = $("#customProductCountry").val();
            var zipcode = $("#customProductZipcode").val();
            var image = $("#customProductImage").val();
            var currLoc = $(location).attr('href');

            if (image == "") {
                $("#customProductImage").addClass("is-invalid");
                $("#customProductImage").focus();
            } else {
                $("#customProductImage").removeClass("is-invalid");
            }

            if (zipcode == "") {
                $("#customProductZipcode").addClass("is-invalid");
                $("#customProductZipcode").focus();
            } else {
                $("#customProductZipcode").removeClass("is-invalid");
            }

            if (country == "") {
                $("#customProductCountry").addClass("is-invalid");
                $("#customProductCountry").focus();
            } else {
                $("#customProductCountry").removeClass("is-invalid");
            }

            if (state == "") {
                $("#customProductState").addClass("is-invalid");
                $("#customProductState").focus();
            } else {
                $("#customProductState").removeClass("is-invalid");
            }

            if (city == "") {
                $("#customProductCity").addClass("is-invalid");
                $("#customProductCity").focus();
            } else {
                $("#customProductCity").removeClass("is-invalid");
            }

            if (address == "") {
                $("#customProductAddress").addClass("is-invalid");
                $("#customProductAddress").focus();
            } else {
                $("#customProductAddress").removeClass("is-invalid");
            }

            if (contact == "") {
                $("#customProductContact").addClass("is-invalid");
                $("#customProductContact").focus();
            } else {
                $("#customProductContact").removeClass("is-invalid");
            }

            if (email == "") {
                $("#customProductEmail").addClass("is-invalid");
                $("#customProductEmail").focus();
            } else {
                $("#customProductEmail").removeClass("is-invalid");
            }

            if (name == "") {
                $("#customProductName").addClass("is-invalid");
                $("#customProductName").focus();
            } else {
                $("#customProductName").removeClass("is-invalid");
            }

            if (name != "" && email != "" && contact != "" && address != "" && city != "" && state != "" && country != "" && zipcode != "") {
                $("#customProductForm").submit();
            //     $.ajax({
            //         method: "POST",
            //         url: site_url + "customProduct",
            //         data: {
            //             name: name,
            //             email: email,
            //             contact: contact,
            //             contact2: contact2,
            //             address: address,
            //             address2: address2,
            //             city: city,
            //             state: state,
            //             country: country,
            //             zipcode: zipcode,
            //         },
            //         success: function(cusRes) {
            //             if (cusRes) {
            //                 location.reload();
            //             }
            //         }
            //     });
            }
        });

        // Product Image Full Screen
        $("#product-carousel .carousel-item img").on("click", function() {
            var src = $(this).attr("src");
            $("<div>").css({
                background: "RGBA(0,0,0,.5) url(" + src + ") no-repeat center",
                backgroundSize: "contain",
                width:"100%", height:"100%",
                position:"fixed",
                zIndex:"10000",
                top:"0", left:"0",
                cursor: "zoom-out"
            }).click(function() {
                $(this).remove();
            }).appendTo("body");
        });

        $(".setCountry").on("click", function() {
            var country = $(this).data("country");
            $.ajax({
                method: "POST",
                url: site_url + "country",
                data: {country: country},
                success: function(res) {
                    console.log(res);
                    if (res == 1) {
                        window.location.replace(site_url + "uk");
                    } else if (res == 2) {
                        window.location.replace(site_url + "my");
                    }
                }
            });
        });

        $("#changeCountry").on("change", function() {
            var country = $(this).val();
            $.ajax({
                method: "POST",
                url: site_url + "country",
                data: {country: country},
                success: function(res) {
                    console.log(res);
                    if (res == 1) {
                        window.location.replace(site_url + "uk");
                    } else if (res == 2) {
                        window.location.replace(site_url + "my");
                    }
                }
            });
        });

        // Add Address
        $("#addressForm").on("submit", function() {
            var name = $("#addressName").val();
            var email = $("#addressEmail").val();
            var contact = $("#addressContact").val();
            var address = $("#addressAddress").val();
            var address2 = $("#addressAddress2").val();
            var city = $("#addressCity").val();
            var state = $("#addressState").val();
            var zipcode = $("#addressZipcode").val();

            if (zipcode == "") {
                $("#addressZipcode").addClass("is-invalid");
                $("#addressZipcode").focus();
            }

            if (state == "") {
                $("#addressState").addClass("is-invalid");
                $("#addressState").focus();
            }

            if (city == "") {
                $("#addressCity").addClass("is-invalid");
                $("#addressCity").focus();
            }

            if (address == "") {
                $("#addressAddress").addClass("is-invalid");
                $("#addressAddress").focus();
            }

            if (contact == "") {
                $("#addressContact").addClass("is-invalid");
                $("#addressContact").focus();
            }

            if (email == "") {
                $("#addressEmail").addClass("is-invalid");
                $("#addressEmail").focus();
            }

            if (name == "") {
                $("#addressName").addClass("is-invalid");
                $("#addressName").focus();
            }

            if (name != "" && email != "" && contact != "" && address != "" && city != "" && state != "" && zipcode != "") {
                $.ajax({
                    method: "POST",
                    url: site_url + "addAddress",
                    data: {
                        name: name,
                        email: email,
                        contact: contact,
                        address: address,
                        address2: address2,
                        city: city,
                        state: state,
                        zipcode: zipcode,
                    },
                    success: function(addRes) {
                        if (addRes) {
                            location.reload();
                        }
                    }
                });
            }
        });
    });


    // Slugify URL
    function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        //$text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
        return 'n-a';
        return $text;
    }
    

    // Back to top button
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });


    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:3
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $(".quantity button").on("click", function() {
        var button = $(this);
        var oldValue = button.parent().parent().find("input").val();
        if (button.hasClass("btn-plus")) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        button.parent().parent().find("input").val(newVal);
    });


    // Add to Cart
    $("#addToCart").on("click", function() {
        var productId = $(this).data("productid");
        var productQty = $("input[name='productQty']").val();
        $.ajax({
            method: "POST",
            url: site_url + "addToCart",
            data: {productId: productId, productQty: productQty},
            success: function(cartRes) {
                if (cartRes == "cart") {
                    $("#cartModal").modal("show");
                } else if (cartRes == "checkout") {
                    $("#cartModal button").removeAttr("onclick");
                    $("#cartModal a").attr("href", site_url + "checkout");
                    $("#cartModal").modal("show");
                }
            }
        });
    });


    // Toggle Wishlist
    $("#toggleWishlist, .toggleWishlist").on("click", function() {
        var productId = $(this).data("productid");
        var loggedIn = $(this).data("loggedin");

        if (loggedIn) {
            $.ajax({
                method: "POST",
                url: site_url + "toggleWishlist",
                data: {productId: productId},
                success: function(res) {
                    if (res == "added") {
                        $("#wishlistModalMessage").text("Added to Wishlist");
                        $("#wishlistModal").modal("show");
                    } else if (res == "removed") {
                        $("#wishlistModalMessage").text("Removed from Wishlist");
                        $("#wishlistModal").modal("show");
                    }
                }
            });
        } else {
            $("#loginModal").modal("show");
        }
    });


    // Remove from Cart
    $(".removeFromCart").on("click", function() {
        var button = $(this);
        var id = $(this).data("id");
        $("#deleteModal").modal("show");
        $("#deleteCartItem").on("click", function() {
            $.ajax({
                method: "POST",
                url: site_url + "removeFromCart",
                data: {id: id},
                success: function(res) {
                    if (res) {
                        location.reload();
                    }
                }
            });
        });
    });


    // Remove from Cart
    $(".removeFromSessionCart").on("click", function() {
        var button = $(this);
        var id = $(this).data("id");
        $("#deleteModal").modal("show");
        $("#deleteCartItem").on("click", function() {
            $.ajax({
                method: "POST",
                url: site_url + "removeFromSessionCart",
                data: {id: id},
                success: function(res) {
                    if (res) {
                        location.reload();
                    }
                }
            });
        });
    });


    // Place Order
    $("#placeOrder").on("click", function() {
        var addressId = $("[name='deliveryAddress']").val();
        var paymentMethod = $("[name='paymentMethod']").val();
        var subtotal = $("[name=subtotal]").text();
        var discount = $("[name=discount]").text();
        var total = $("[name=total]").text();

        if (addressId != "") {
            $.ajax({
                method: "POST",
                url: site_url + "placeOrder",
                data: {addressId: addressId, paymentMethod: paymentMethod, subtotal: subtotal, discount: discount, total: total},
                success: function(res) {
                    if (res) {
                        $.ajax({
                            method: "POST",
                            url: site_url + "deleteUserCart",
                            success: function(cartRes) {
                                if (cartRes) {
                                    $("#orderModal").modal("show");
                                }
                            }
                        });
                    }
                }
            });
        }
    });
    
})(jQuery);


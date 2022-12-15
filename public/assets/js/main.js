(function ($) {
    "use strict";

    var site_url = "http://fs.localhost/";
    
    // Dropdown on mouse hover
    $(document).ready(function() {
        setTimeout(function() {
            $('.recent-sold').fadeIn('slow');
        }, 5000);
        setTimeout(function() {
            $('.recent-sold').fadeOut('slow');
        }, 15000);

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

        $("#showAddAddressModal").on("click", function() {
            $("#addAddressModal").modal("show");
        });

        $(".showEditAddressModal").on("click", function() {
            var addressId = $(this).data("addressid");
            $.ajax({
                method: "POST",
                url: site_url + "getAddress",
                data: {addressId: addressId},
                success: function(getRes) {
                    console.log(getRes);
                    let address = JSON.parse(getRes);
                    $("#editAddressId").val(address.id);
                    $("#editAddressName").val(address.name);
                    $("#editAddressEmail").val(address.email);
                    $("#editAddressContact").val(address.contact);
                    $("#editAddressAddress").val(address.address);
                    $("#editAddressAddress2").val(address.address2);
                    $("#editAddressCity").val(address.city);
                    $("#editAddressState").val(address.state);
                    $("#editAddressCountry").val(address.country);
                    $("#editAddressZipcode").val(address.zipcode);
                    $("#editAddressModal").modal("show");
                }
            });
        });

        $("#showcustomProductModal").on("click", function() {
            $("#customProductModal").modal("show");
        });

        $(".addRating").on("click", function() {
            var rating = $(this).data("review");
            var result = '';

            for (var i = 0; i < rating; i++) {
                result += '<i class="fas fa-star addRating" data-review="' + (i+1) + '"></i>';
            }

            for (i=5; i > rating; i--) { 
                result += '<i class="far fa-star addRating" data-review="' + i + '"></i>';
            }

            alert(result);
            $(".product-reviews form .text-primary").html(result);
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
                        if (forRes == true) {
                            $("#forgotEmail").val("");
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

        // Add Address Form
        $("#addAddressForm").on("submit", function() {
            var name = $("#addAddressName").val();
            var email = $("#addAddressEmail").val();
            var contact = $("#addAddressContact").val();
            var address = $("#addAddressAddress").val();
            var address2 = $("#addAddressAddress2").val();
            var city = $("#addAddressCity").val();
            var state = $("#addAddressState").val();
            var country = $("#addAddressCountry").val();
            var zipcode = $("#addAddressZipcode").val();

            if (zipcode == "") {
                $("#addAddressZipcode").addClass("is-invalid");
                $("#addAddressZipcode").focus();
            }

            if (country == "") {
                $("#addAddressCountry").addClass("is-invalid");
                $("#addAddressCountry").focus();
            }

            if (state == "") {
                $("#addAddressState").addClass("is-invalid");
                $("#addAddressState").focus();
            }

            if (city == "") {
                $("#addAddressCity").addClass("is-invalid");
                $("#addAddressCity").focus();
            }

            if (address == "") {
                $("#addAddressAddress").addClass("is-invalid");
                $("#addAddressAddress").focus();
            }

            if (contact == "") {
                $("#addAddressContact").addClass("is-invalid");
                $("#addAddressContact").focus();
            }

            if (email == "") {
                $("#addAddressEmail").addClass("is-invalid");
                $("#addAddressEmail").focus();
            }

            if (name == "") {
                $("#addAddressName").addClass("is-invalid");
                $("#addAddressName").focus();
            }

            if (name != "" && email != "" && contact != "" && address != "" && city != "" && state != "" && country != "" && zipcode != "") {
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
                        country: country,
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

        // Edit Address Form
        $("#editAddressForm").on("submit", function() {
            var id = $("#editAddressId").val();
            var name = $("#editAddressName").val();
            var email = $("#editAddressEmail").val();
            var contact = $("#editAddressContact").val();
            var address = $("#editAddressAddress").val();
            var address2 = $("#editAddressAddress2").val();
            var city = $("#editAddressCity").val();
            var state = $("#editAddressState").val();
            var country = $("#editAddressCountry").val();
            var zipcode = $("#editAddressZipcode").val();

            if (zipcode == "") {
                $("#editAddressZipcode").addClass("is-invalid");
                $("#editAddressZipcode").focus();
            }

            if (country == "") {
                $("#editAddressCountry").addClass("is-invalid");
                $("#editAddressCountry").focus();
            }

            if (state == "") {
                $("#editAddressState").addClass("is-invalid");
                $("#editAddressState").focus();
            }

            if (city == "") {
                $("#editAddressCity").addClass("is-invalid");
                $("#editAddressCity").focus();
            }

            if (address == "") {
                $("#editAddressAddress").addClass("is-invalid");
                $("#editAddressAddress").focus();
            }

            if (contact == "") {
                $("#editAddressContact").addClass("is-invalid");
                $("#editAddressContact").focus();
            }

            if (email == "") {
                $("#editAddressEmail").addClass("is-invalid");
                $("#editAddressEmail").focus();
            }

            if (name == "") {
                $("#editAddressName").addClass("is-invalid");
                $("#editAddressName").focus();
            }

            if (name != "" && email != "" && contact != "" && address != "" && city != "" && state != "" && country != "" && zipcode != "") {
                $.ajax({
                    method: "POST",
                    url: site_url + "updateAddress",
                    data: {
                        id: id,
                        name: name,
                        email: email,
                        contact: contact,
                        address: address,
                        address2: address2,
                        city: city,
                        state: state,
                        country: country,
                        zipcode: zipcode,
                    },
                    success: function(editRes) {
                        if (editRes) {
                            location.reload();
                        }
                    }
                });
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
            }
        });

        // Review Form
        $("#reviewForm").on("submit", function(e) {
            e.preventDefault();
            var rating = $("[name='rating']:checked").val();
            var review = $("#review").val();
            var currLoc = $(location).attr('href');
            
            $.ajax({
                method: "POST",
                url: site_url + "review",
                data: {rating: rating, review: review},
                success: function(revRes) {
                    if (revRes) {
                        $("#review").val("");
                        $("#reviewMsg").removeClass("text-danger").addClass("text-success").text("Thank you! Review added");
                        // window.location.replace(currLoc);
                    } else {
                        $("#reviewMsg").removeClass("text-danger").addClass("text-success").text("Something went wrong");
                    }
                }
            });
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
                    if (res) {
                        window.location.replace(site_url);
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
                    if (res) {
                        window.location.replace(site_url);
                    }
                }
            });
        });

        $("#cart .input-group-btn .btn").on("click", function() {
            var cartId = $(this).data("cartid");
            var cartSubTotal = $("#cartSubTotal").text();
            var cartDiscount = $("#cartDiscount").text();
            var action = "";
            
            if ($(this).hasClass("btn-minus")) {
                action = "minus";
            } else if ($(this).hasClass("btn-plus")) {
                action = "plus";
            }

            $.ajax({
                method: "POST",
                url: site_url + "updateCart",
                data: {cartId: cartId, cartSubTotal: cartSubTotal, cartDiscount: cartDiscount, action: action},
                success: function(updateCartRes) {
                    console.log(updateCartRes);
                    var updateCartRes1 = JSON.parse(updateCartRes);
                    $("#cart #row"+updateCartRes1.id).text(updateCartRes1.productPrice);
                    $("#cartSubTotal").text(updateCartRes1.cartSubTotal);
                    $("#cartTotal").text(updateCartRes1.cartSubTotal - cartDiscount);
                }
            });
        });
    });
    

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
        var addressId = $("[name='deliveryAddress']:checked").val();
        // var paymentMethod = $("[name='paymentMethod']").val();
        var paymentMethod = "";
        var subtotal = $("[name=subtotal]").text();
        var discount = $("[name=discount]").text();
        var total = $("[name=total]").text();

        if (addressId != "") {
            $.ajax({
                method: "POST",
                url: site_url + "placeOrder",
                data: {addressId: addressId, paymentMethod: paymentMethod, subtotal: subtotal, discount: discount, total: total},
                success: function(res) {
                    res = JSON.parse(res);
                    if (res.payment == "stripe") {
                        window.location.href = res.response.url;
                    } else if (res.payment == "toyyib") {
                        if (res.response.status == "error") {
                            alert("Something went wrong. Please try again");
                        } else {
                            window.location.href = "https://dev.toyyibpay.com/" + res.response[0].BillCode;
                        }
                    }
                }
            });
        }
    });
    
})(jQuery);


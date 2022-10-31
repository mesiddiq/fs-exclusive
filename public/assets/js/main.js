(function ($) {
    "use strict";

    var site_url = "http://fs.localhost/";
    
    // Dropdown on mouse hover
    $(document).ready(function() {
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

        $(".showRegisterModal").on("click", function() {
            $("#loginModal").modal("hide");
            $("#registerModal").modal("show");
        });

        $(".showLoginModal").on("click", function() {
            $("#registerModal").modal("hide");
            $("#loginModal").modal("show");
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
                            window.location.replace(currLoc);
                            $("#loginError").text("");
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
                            $("#registerError").text("Email already exists");
                        } else if (regRes == "Wrong") {
                            $("#registerError").text("Something went wrong. Please try again");
                        } else if (regRes) {
                            window.location.replace(currLoc);
                            $("#registerError").text("");
                        }
                    }
                });
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
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
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
    $('.quantity button').on('click', function() {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });
    
})(jQuery);


(function () {
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

    $(".special-price").hide();
    $("#isDiscount").on("change", function() {
        if ($(this).is(":checked")) {
            $(".special-price").show();
            $(".special-price input").addClass("form-required");
        } else {
            $(".special-price").hide();
            $(".special-price input").removeClass("form-required");
        }
    });
    $("#quill-editor .ql-editor p").on("change", function() {
        alert("hi");
        var hvalue = $(this).html();
        alert(hvalue);
    });
    $(document).ready(function() {
        $('#productdemo').text('The replaced text.');

    });
})();

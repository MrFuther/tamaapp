document.addEventListener("DOMContentLoaded", function () {
    var sidebar = document.getElementById("sidebar");
    var toggleBtn = document.getElementById("sidebarToggle");
    var mobileBtn = document.getElementById("mobileMenuToggle");

    // Toggle sidebar di desktop
    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });
    }

    // Toggle sidebar di mobile
    if (mobileBtn) {
        mobileBtn.addEventListener("click", function () {
            sidebar.classList.toggle("show");
        });
    }
});

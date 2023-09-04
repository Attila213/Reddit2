$(document).ready(function () {
    $(".dropdown-toggle-1").click(function (e) {
        e.preventDefault();
        var dropdownMenu = $(this).siblings(".dropdown-menu");

        if (dropdownMenu.css("display") === "none") {
            dropdownMenu.css("display", "block");
            dropdownMenu.hide().fadeIn(400); // fadeIn animáció
        } else {
            dropdownMenu.fadeOut(400, function() {
                $(this).css("display", "none");
            });
        }
    });
});

/**
 * Cambiar color de lodos los inpits con clase transparent si los datos son incorrectos
 */
$(window).bind("load", function () {
    if ($("#error").val()) {
        $(".transparent").addClass("error");
    }
});
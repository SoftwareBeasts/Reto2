$(function () {
    if ($("#boton-seleccion-seleccionado").length == 0) {
        $("[name='recientes']").attr("id", "boton-seleccion-seleccionado");
        $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda="+$("#boton-seleccion-seleccionado").attr("name"));
    }
    ;
});

$(".boton-selector").click(cambiarBusqueda);

function cambiarBusqueda() {
    $("#boton-seleccion-seleccionado").removeAttr('id');
    $(this).attr("id", "boton-seleccion-seleccionado");
    $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda="+$("#boton-seleccion-seleccionado").attr("name"));
}


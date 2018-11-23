/*Evento1*/
/**
 * Comprueba que el modo de busqueda no sea por texto, si es por texto inicia ese modo de busqueda, si no, pulsa
 * automaticamente el boton recientes y hace la busqueda de ese modo
 */
$(function () {
    if ($("#modoBusquedaPorTexto").length > 0) {
        $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda=perso");
    }
    else if ($("#boton-seleccion-seleccionado").length == 0) {
        $("[name='recientes']").attr("id", "boton-seleccion-seleccionado");
        $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda=" + $("#boton-seleccion-seleccionado").attr("name"));
    }

});
/*EVENTOS*/
$(".boton-selector").click(cambiarBusqueda);
$(".boton-selector").click(function () {
    $(".boton-selector").removeAttr("disabled");
    $(this).attr("disabled", "disabled");
});

/*FUNCIONES*/
/**
 * Cambia el modo de busqueda
 */
function cambiarBusqueda() {
    $("#boton-seleccion-seleccionado").removeAttr('id');
    $(this).attr("id", "boton-seleccion-seleccionado");
    $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda=" + $("#boton-seleccion-seleccionado").attr("name"));
}

/**
 * Carga mas preguntas
 */
function cargarMasPreguntas() {
    $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda=" + $("#botonCargarMasPreguntas").val()
        + "&cargarMas=" + $("#botonCargarMasPreguntas").attr("name"));
}


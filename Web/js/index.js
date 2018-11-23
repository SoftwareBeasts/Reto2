/*AHAHHAA*/
$(function () {
    if ($("#modoBusquedaPorTexto").length>0){
        $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda=perso");
    }
    else if ($("#boton-seleccion-seleccionado").length == 0) {
        $("[name='recientes']").attr("id", "boton-seleccion-seleccionado");
        $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda="+$("#boton-seleccion-seleccionado").attr("name"));
    }

});
/*EVENTOS*/
$(".boton-selector").click(cambiarBusqueda);
$(".boton-selector").click(function () {
    $(".boton-selector").removeAttr("disabled");
    $(this).attr("disabled","disabled");
});

/*FUNCIONES*/
function cambiarBusqueda() {
    $("#boton-seleccion-seleccionado").removeAttr('id');
    $(this).attr("id", "boton-seleccion-seleccionado");
    $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda="+$("#boton-seleccion-seleccionado").attr("name"));
}


function cargarMasPreguntas(){
    $("#contenedor-preguntas-index").load("php/generar-preguntas.php?modoBusqueda="+$("#botonCargarMasPreguntas").val()
        +"&cargarMas="+$("#botonCargarMasPreguntas").attr("name"));
}


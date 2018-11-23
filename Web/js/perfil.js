/**
 * Para visualizar las preguntas y respuestas del perfil del usuario y no saturar el servidor porque el usuario clique
 * muchas veces en los botones de Preguntas y Respuestas.
 * Al cargar la página con PHP se cargan todas las preguntas y las respuestas del usuario y con Javascript
 * se visualizan las preguntas y ocultan las respuestas.
 * Al clicar en el botón Respuestas se visualizan las respuestas y ocultan las preguntas.
 * Al clicar en el botón Preguntas se visualizan las preguntas y ocultan las respuestas.
 */
$(function(){
    $("#contenedor-preguntas-perfil").show();
    $("#contenedor-respuestas-perfil").hide();

    $("[name='preguntas']").click(function() {
        $("#contenedor-preguntas-perfil").show();
        $("#contenedor-respuestas-perfil").hide();
    });
    $("[name='respuestas']").click(function() {
        $("#contenedor-preguntas-perfil").hide();
        $("#contenedor-respuestas-perfil").show();
    });
});
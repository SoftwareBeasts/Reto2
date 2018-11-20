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
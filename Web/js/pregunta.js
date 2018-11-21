$(document).ready( function () {
    $("[class=imagen-like]").on("click", function () {
        likeDislike(this, true);
    });
    $("[class=imagen-dislike]").on("click", function () {
        likeDislike(this, false);
    });
    $("[name=loginRequerido]").one("click",avisarLoginRequerido);
});

function cargarLogin(){
    window.location = "../pages/login.php";
}
function avisarLoginRequerido(){
    $("#requeridoLogearse").show();
    setTimeout(function () {
        $("#requeridoLogearse").fadeOut("slow");
    },2000);
    $("#boton-responder").click(cargarLogin);
}

function likeDislike(img, type){
    let idRespuesta = $(img).closest(".contenedor-respuesta").attr("id");
    let userId = getUserLogged();
    debugger;
    if(userId === ""){
        window.location.replace("/pages/login.php");
    }
    //Buscar el voto de la base de datos
    let encontrado = likeDislikeExists(idRespuesta, userId);
    if(!encontrado[0]){
        //No encontrado
        if(setLikeDislike(idRespuesta, userId, type)){
            $(img).attr("src", "../media/like_blue.png");
        }
    }
    else{
        if(encontrado[1] !== type){
            alert("ENTRA");
        }
    }

}

function getUserLogged() {
    let userId = null;
    $.ajax({
        type: "GET",
        async: false,
        url: "../php/getUserLogged.php"
    }).done(function (data) {
        userId = data;
    });
    return userId;
}

function likeDislikeExists(idRespuestaD, userIdD) {
    debugger;
    let encontrado = false;
    $.ajax({
        tyepe: "GET",
        async: false,
        url: "../php/db/dbUtils.php",
        data: {idRespuesta: idRespuestaD, userId: userIdD}
    }).done(function (data) {
        encontrado = data;
    });
    return encontrado;
}

function setLikeDislike(idRespuestaD, userIdD, typeD) {
    debugger;
    let encontrado = false;
    debugger;
    $.ajax({
        tyepe: "GET",
        async: false,
        url: "../php/db/dbUtils.php",
        data: {idRespuesta: idRespuestaD, userId: userIdD, type: typeD}
    }).done(function (data) {
        encontrado = data;
    });
    return encontrado;
}
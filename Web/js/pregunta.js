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
    if(userId === ""){
        window.location.replace("/pages/login.php");
    }
    //Buscar el voto de la base de datos
    let encontrado = likeDislikeExists(idRespuesta, userId);
    if(!encontrado[0]){
        //No encontrado
        if(setLikeDislike(idRespuesta, userId, type)){
            setInstantLike(img, idRespuesta, type);
        }
    }
    else{
        if(encontrado[1] !== type){
            if(setLikeDislike(idRespuesta, userId, type+"", "TRUE")){
                setInstantLike(img, idRespuesta, type, true);
            }
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
    let encontrado = "";
    $.ajax({
        tyepe: "GET",
        async: false,
        url: "../php/db/dbUtils.php",
        data: {idRespuesta: idRespuestaD, userId: userIdD}
    }).done(function (data) {
        encontrado = JSON.parse(data);
    });
    return encontrado;
}

function setLikeDislike(idRespuestaD, userIdD, typeD, alterD=false) {
    let encontrado = false;
    debugger;
    $.ajax({
        tyepe: "GET",
        async: false,
        url: "../php/db/dbUtils.php",
        data: {idRespuesta: idRespuestaD, userId: userIdD, type: typeD, alter: alterD}
    }).done(function (data) {
        encontrado = data;
    });
    debugger;
    return encontrado;
}

function setInstantLike(img, idRespuesta, type, alter){
    debugger;
    $(img).attr("src", "../media/like_blue.png");
    if(!alter){
        let clss;
        if(type)
           clss = ".numero-likes-respuesta";
        else
            clss = ".numero-dislikes-respuesta";

        let span = $("#"+idRespuesta).find(clss);
        let text = parseInt(span.text());
        text++;
        span.html(text);
    }
    else{
        
    }

}
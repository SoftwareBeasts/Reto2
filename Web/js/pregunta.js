/**
 * Eventos para las diferentes imágenes de like y dislike
 */
$(document).ready(function () {
    $("[class=imagen-like]").on("click", function () {
        likeDislike(this, true);
    });
    $("[class=imagen-dislike]").on("click", function () {
        likeDislike(this, false);
    });
    $("[name=loginRequerido]").one("click", avisarLoginRequerido);
});

/**
 * Redirigir a la pagina login.php
 */
function cargarLogin() {
    window.location = "../pages/login.php";
}

/**
 * La primera vez aparece un mensaje por pantalla y si se vuelve a pulsar el boton cargar página login
 */
function avisarLoginRequerido() {
    $("#requeridoLogearse").show();
    setTimeout(function () {
        $("#requeridoLogearse").fadeOut("slow");
    }, 2000);
    $("#boton-responder").click(cargarLogin);
}

/**
 * Verifica like o dislike en la base de datos y según el dato que encuentra hace introduce un like/dislike o lo altera
 * @param img imagen a la que se le ha hecho click
 * @param type tipo de like: true o false
 */
function likeDislike(img, type) {
    debugger;
    if ($(img).parent().attr("id") == "contenedor-likes-pregunta") {

        let userId = getUserLogged();
        if (userId === "") {
            cargarLogin();
        }
        let idPregunta = $("#contenedor-pregunta").attr("name");
        //Buscar el voto en la base de datos
        let encontrado = likeDislikeExistsP(idPregunta, userId);
        if (!encontrado[0]) {
            //No encontrado
            if (setLikeDislikeP(idPregunta, userId, type)) {
                setInstantLikeP(img, idPregunta, type);
            }
        } else {
            if (encontrado[1] !== type) {
                if (setLikeDislikeP(idPregunta, userId, type + "", "TRUE")) {
                    setInstantLikeP(img, idPregunta, type, true);
                }
            }
        }

    } else {
        let idRespuesta = $(img).closest(".contenedor-respuesta").attr("id");
        let userId = getUserLogged();
        if (userId === "") {
            window.location = "../pages/login.php";
        }
        //Buscar el voto de la base de datos
        let encontrado = likeDislikeExists(idRespuesta, userId);
        if (!encontrado[0]) {
            //No encontrado
            if (setLikeDislike(idRespuesta, userId, type)) {
                setInstantLike(img, idRespuesta, type);
            }
        } else {
            if (encontrado[1] !== type) {
                if (setLikeDislike(idRespuesta, userId, type + "", "TRUE")) {
                    setInstantLike(img, idRespuesta, type, true);
                }
            }
        }
    }
}

/**
 * Recoge el id del usuario logeado
 * @returns {*} el id del usuario
 */
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

/**
 * Verificar si existe el like o dislike para respuesta
 * @param idRespuestaD id de la respuesta a la que se le ha hecho click
 * @param userIdD id del usuario
 * @returns {array} array con true o false si lo ha encontrado y true o false del tipo de voto
 */
function likeDislikeExists(idRespuestaD, userIdD) {
    let encontrado = "";
    $.ajax({
        type: "GET",
        async: false,
        url: "../php/db/dbUtils.php",
        data: {idRespuesta: idRespuestaD, userId: userIdD}
    }).done(function (data) {
        encontrado = JSON.parse(data);
    });
    return encontrado;
}

/**
 * Verificar si existe el like o dislike para pregunta
 * @param idPreguntaD id de la pregunta a la que se le ha hecho click
 * @param userIdD id del usuario
 * @returns {array} array con true o false si lo ha encontrado y true o false del tipo de voto
 */
function likeDislikeExistsP(idPreguntaD, userIdD) {
    let encontrado = "";
    $.ajax({
        type: "GET",
        async: false,
        url: "../php/db/dbUtils.php",
        data: {idPregunta: idPreguntaD, userId: userIdD}
    }).done(function (data) {
        encontrado = JSON.parse(data);
    });
    return encontrado;
}

/**
 * Establece el voto en base de datos
 * @param idRespuestaD id de la respuesta a la que se le ha hecho click
 * @param userIdD id del usuario
 * @param typeD tipo de like: true o false
 * @param alterD si es una insert false, si es una update true
 * @returns {boolean} true si se ha introducido correctamente, false si no
 */
function setLikeDislike(idRespuestaD, userIdD, typeD, alterD = false) {
    let encontrado = false;
    $.ajax({
        type: "GET",
        async: false,
        url: "../php/db/dbUtils.php",
        data: {idRespuesta: idRespuestaD, userId: userIdD, type: typeD, alter: alterD}
    }).done(function (data) {
        encontrado = data;
    });
    return encontrado;
}

/**
 * Establece el voto en base de datos
 * @param idPreguntaD id de la pregunta a la que se le ha hecho click
 * @param userIdD id del usuario
 * @param typeD tipo de like: true o false
 * @param alterD si es una insert false, si es una update true
 * @returns {boolean} true si se ha introducido correctamente, false si no
 */
function setLikeDislikeP(idPreguntaD, userIdD, typeD, alterD = false) {
    let encontrado = false;
    $.ajax({
        type: "GET",
        async: false,
        url: "../php/db/dbUtils.php",
        data: {idPregunta: idPreguntaD, userId: userIdD, type: typeD, alter: alterD}
    }).done(function (data) {
        encontrado = data;
    });
    return encontrado;
}

/**
 * Añade el like en tiempo real modificando el color y cambiando el número
 * @param img imagen a la que se le ha dado click
 * @param idRespuesta id de la respuesta
 * @param type tipo de like: true o false
 * @param alter lo que se ha hecho anteriormente en base de datos
 */
function setInstantLike(img, idRespuesta, type, alter) {
    $(img).attr("src", "../media/like_blue.png");
    if (!alter) {
        let clss;
        if (type)
            clss = ".numero-likes-respuesta";
        else
            clss = ".numero-dislikes-respuesta";

        let span = $("#" + idRespuesta).find(clss);
        let text = parseInt(span.text());
        text++;
        span.html(text);
    } else {
        let sumar = ".numero-dislikes-respuesta";
        let restar = ".numero-likes-respuesta";
        let imagen = ".imagen-like";
        if (type) {
            sumar = ".numero-likes-respuesta";
            restar = ".numero-dislikes-respuesta";
            imagen = ".imagen-dislike";
        }
        let htmll = $("#" + idRespuesta);
        let span = htmll.find(sumar);
        let text = parseInt(span.text());
        text++;
        span.html(text);

        span = htmll.find(restar);
        text = parseInt(span.text());
        text--;
        span.html(text);
        span.siblings(imagen).attr("src", "../media/like.png");
    }

}

/**
 * Añade el like en tiempo real modificando el color y cambiando el número
 * @param img imagen a la que se le ha dado click
 * @param idPregunta id de la pregunta
 * @param type tipo de like: true o false
 * @param alter lo que se ha hecho anteriormente en base de datos
 */
function setInstantLikeP(img, idPregunta, type, alter) {
    $(img).attr("src", "../media/like_blue.png");
    if (!alter) {
        let clss;
        if (type)
            clss = "#numero-likes-pregunta";
        else
            clss = "#numero-dislikes-pregunta";
        let span = $("#contenedor-likes-pregunta").find(clss);
        let text = parseInt(span.text());
        text++;
        span.html(text);
    } else {
        let sumar = "#numero-dislikes-pregunta";
        let restar = "#numero-likes-pregunta";
        let imagen = ".imagen-like";
        if (type) {
            sumar = "#numero-likes-pregunta";
            restar = "#numero-dislikes-pregunta";
            imagen = ".imagen-dislike";
        }
        let htmll = $("#contenedor-likes-pregunta");
        let span = htmll.find(sumar);
        let text = parseInt(span.text());
        text++;
        span.html(text);

        span = htmll.find(restar);
        text = parseInt(span.text());
        text--;
        span.html(text);
        span.siblings(imagen).attr("src", "../media/like.png");
    }
}
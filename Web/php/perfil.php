<?php

require_once "db/dbUtils.php";

session_start();

function listaPreguntasUsuario() {

    $preguntas=buscarPreguntasRespuestasUsuario("Preguntas", $_SESSION["userLogged"]["idUsuario"]);
    foreach($preguntas as $clave=>$valor)
    {
        $usuario = encontrarUsuario("no",$valor['Usuario_idUsuario']);
        preguntaRespuestaUsuario($valor["idPregunta"], $usuario['nombreusu'], $valor["fecha"],$valor["titulo"]);
    }
}

function listaRespuestasUsuario() {

    $preguntas=buscarPreguntasRespuestasUsuario("Respuestas", $_SESSION["userLogged"]["idUsuario"]);
    foreach($preguntas as $clave=>$valor)
    {
        $usuario = encontrarUsuario("no",$valor['Usuario_idUsuario']);
        preguntaRespuestaUsuario($valor["idPregunta"], $usuario['nombreusu'], $valor["fecha"],$valor["titulo"]);
    }
}

function preguntaRespuestaUsuario($id, $usuario, $fecha, $titulo) {
    ?>
    <article class="pregunta-perfil">
        <span class="informacion-usuario-fecha-pregunta">por <a href="#" class="link-perfil-usuario"><?=$usuario?></a> a <?=$fecha?></span>
        <h2 class="titulo-pregunta"><a href="pregunta.php?preguntaid=<?=$id?>"><?=$titulo?></a></h2>
        <div id="contenedor-categorias-pregunta">
            <a href="#"><label>PHP</label></a>
        </div>
        <div id="contenedor-likes-pregunta">
            <a href="#" class="link-like-pregunta"><img src="../media/like.png" alt="imagen-like" class="imagen-like"></a>
            <span id="numero-likes-pregunta">11</span>
            <a href="#" class="link-dislike-pregunta"><img src="../media/like.png" alt="imagen-like" class="imagen-dislike"></a>
            <span id="numero-dislikes-pregunta">3</span>
        </div>
    </article>
    <?php
}
?>
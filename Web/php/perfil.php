<?php

require_once "db/dbUtils.php";

session_start();

function listaPreguntasUsuario() {

    $preguntas=buscarPreguntasRespuestasUsuario("Preguntas", $_SESSION["userLogged"]["idUsuario"]);
    foreach($preguntas as $clave=>$valor)
    {
        preguntaRespuestaUsuario($valor["Usuario_idUsuario"], $valor["fecha"],$valor["titulo"]);
    }
}

function listaRespuestasUsuario() {

    $preguntas=buscarPreguntasRespuestasUsuario("Respuestas", $_SESSION["userLogged"]["idUsuario"]);
    foreach($preguntas as $clave=>$valor)
    {
        preguntaRespuestaUsuario($valor["Usuario_idUsuario"], $valor["fecha"],$valor["titulo"]);
    }
}

function preguntaRespuestaUsuario($usuario, $fecha, $titulo) {
    ?>
    <article>
        <p>Por <span><?= $usuario ?></span>&nbsp;el <span><?= $fecha ?></span></p>
        <h3><?= $titulo ?></h3>
        <div>
            <div>
                <p>PHP</p>
            </div>
            <div>
                <p>&nbsp;-5&nbsp;</p>
            </div>
        </div>
    </article>
    <?php
}
?>
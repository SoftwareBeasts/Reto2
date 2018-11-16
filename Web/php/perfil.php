<?php

require_once "db/preguntaDB.php";
require_once "db/respuestaDB.php";
require_once "db/temaDB.php";
require_once "db/usuarioDB.php";

session_start();

function listaPreguntasUsuario() {

    $preguntas=findPreguntasByUsuario($_SESSION["userLogged"]["idUsuario"]);
    foreach($preguntas as $clave=>$valor)
    {
    ?>
    <article class="preguntasUsuario">
        <p>Por <span><?= $valor["Usuario_idUsuario"] ?></span>&nbsp;el <span><?= $valor["fecha"] ?></span></p>
        <h3><?= $valor["titulo"] ?></h3>
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
}

function listaRespuestasUsuario() {

    $respuestas=findRespuestasByUsuario($_SESSION["userLogged"]["idUsuario"]);
    foreach ($respuestas as $clave=>$valor)
    {
        $preguntas[]=findPreguntaById($valor["idRespuesta"]);
    }
    foreach($preguntas as $clave=>$valor)
    {
        ?>
        <article class="respuestasUsuario">
            <p>Por <span><?= $valor["Usuario_idUsuario"] ?></span>&nbsp;el <span><?= $valor["fecha"] ?></span></p>
            <h3><?= $valor["titulo"] ?></h3>
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
}

?>
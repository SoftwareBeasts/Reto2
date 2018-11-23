<?php

require_once "db/dbUtils.php";

session_start();

function listaPreguntasUsuario($idUsuario) {

    $preguntas=buscarPreguntasRespuestasUsuario("Preguntas", $idUsuario);
    foreach($preguntas as $clave=>$valor)
    {
        $usuario = encontrarUsuario("no",$valor['Usuario_idUsuario']);
        $tempListaVotos = puntuacionPreguntas($valor['votos']);
        preguntaRespuestaUsuario($valor["idPregunta"], $valor['Usuario_idUsuario'], $usuario['nombreusu'], $valor["fecha"],$valor["titulo"],$valor["temas"],$tempListaVotos);
    }
}

function listaRespuestasUsuario($idUsuario) {

    $preguntas=buscarPreguntasRespuestasUsuario("Respuestas", $idUsuario);
    foreach($preguntas as $clave=>$valor)
    {
        $usuario = encontrarUsuario("no",$valor['Usuario_idUsuario']);
        $tempListaVotos = puntuacionPreguntas($valor['votos']);
        preguntaRespuestaUsuario($valor["idPregunta"], $valor['Usuario_idUsuario'], $usuario['nombreusu'], $valor["fecha"],$valor["titulo"] ,$valor["temas"],$tempListaVotos);
    }
}

function preguntaRespuestaUsuario($id, $idUsuario, $usuario, $fecha, $titulo,$temas,$votos) {
    ?>
    <article class="pregunta-perfil">
        <span class="informacion-usuario-fecha-pregunta">por <a href="perfil.php?usuario=<?=$idUsuario?>" class="link-perfil-usuario"><?=$usuario?></a> a <?=$fecha?></span>
        <h2 class="titulo-pregunta"><a href="pregunta.php?preguntaid=<?=$id?>"><?=$titulo?></a></h2>
        <div id="contenedor-categorias-pregunta">
            <?php
                foreach ($temas as $clave=>$valor){
                    ?>
                        <a href="../index.php?busquedaPreguntas=<?=$valor['nombre']?>"><label><?=$valor['nombre']?></label></a>
                    <?php
                }
            ?>

        </div>
        <div id="contenedor-likes-pregunta">
            <div class="contenedor-likes-preguntas">
                <span class="puntuacion-pregunta-index"><?=$votos?></span>
            </div>
        </div>
    </article>
    <?php
}
function puntuacionPreguntas($listaVotos){
    $tempcontador = 0;
    foreach ($listaVotos['votos'] as $item=>$value){
        if ($value['tipo']==1){
            $tempcontador++;
        }else{
            $tempcontador--;
        }
    }
    return $tempcontador;
}
?>
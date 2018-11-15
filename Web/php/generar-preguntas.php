<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 12/11/2018
 * Time: 12:51
 */
require "db/dbUtils.php";
if(session_id()==''){
    session_start();
}
if(!isset($_SESSION['botonMasModo'])){
    $_SESSION['botonMasModo']="ninguno";
}
if (!isset($_SESSION['almacenPreguntas'])){
    $_SESSION['almacenPreguntas']=array();
}
$temp = $_GET['modoBusqueda'];


switch ($temp){
    case "recientes":
        $listaPreguntas = seleccionarRecientes();
        foreach ($listaPreguntas as $clave=>$valor){
            htmlPreguntaPre($valor['idPregunta'],$valor['Usuario_idUsuario'],$valor['fecha'],$valor['titulo']);
        }
        break;
    case "masvotadas":
        $listaPreguntas = seleccionarMasVotadas();
        foreach ($listaPreguntas as $clave=>$valor){
            htmlPreguntaPre($valor['idPregunta'],$valor['Usuario_idUsuario'],$valor['fecha'],$valor['titulo']);
        }
        break;
    case "sinresponder":
        $listaPreguntas = seleccionarSinResponder();
        foreach ($listaPreguntas as $clave=>$valor){
            htmlPreguntaPre($valor['idPregunta'],$valor['Usuario_idUsuario'],$valor['fecha'],$valor['titulo']);
        }

        break;
    case "respondidas":

        break;

}

function htmlPreguntaPre($id,$usuario,$fecha,$titulo)
{
    ?>
    <article class="pregunta-index" id="<?=$id?>">
        <span class="informacion-usuario-fecha-pregunta">por <a href="#" class="link-perfil-usuario"><?=$usuario?></a> a <?=$fecha?></span>
        <h2 class="titulo-pregunta"><a href="#"><?=$titulo?></a></h2>
        <div class="contenedor-categorias-pregunta">
            <a href="#"><label>PHP</label></a>
        </div>
        <div class="contenedor-likes-preguntas">
            <span class="puntuacion-pregunta-index">11</span>
        </div>
    </article>
    <?php
}
function htmlBotonMas($id){
    ?>



    <?php

}




?>



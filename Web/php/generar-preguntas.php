<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 12/11/2018
 * Time: 12:51
 */
require_once "db/dbUtils.php";
if(session_id()==''){
    session_start();
}

if(!isset($_SESSION['botonMasModo'])){
    $_SESSION['botonMasModo']="ninguno";
}

if (!isset($_SESSION['almacenPreguntas'])){
    $_SESSION['almacenPreguntas']=array();
}
$modoBusqueda = $_GET['modoBusqueda'];
 if($modoBusqueda!=$_SESSION['botonMasModo']){
     $_SESSION['botonMasModo']=$modoBusqueda;
     $_SESSION['almacenPreguntas']=array();
 }




switch ($modoBusqueda){
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
        if(isset($_GET['cargarMas'])){
            $id = $_GET['cargarMas'];
        }
        else{
            $id=null;
        }
        $listaPreguntas = seleccionarSinResponder($id);
        $preguntasTemp = $_SESSION['almacenPreguntas'];
        $_SESSION['almacenPreguntas'] = array_merge($preguntasTemp,$listaPreguntas);
        foreach ($_SESSION['almacenPreguntas'] as $clave=>$valor){
            htmlPreguntaPre($valor['idPregunta'],$valor['Usuario_idUsuario'],$valor['fecha'],$valor['titulo']);
        }
        if(sizeof($listaPreguntas)==10){
            htmlBotonMas(end($listaPreguntas)['idPregunta']+1,$modoBusqueda,$listaPreguntas);
        }

        break;
    case "respondidas":
        if(isset($_GET['cargarMas'])){
            $id = $_GET['cargarMas'];
        }
        else{
            $id=null;
        }
        $listaPreguntas = seleccionarRespondidas($id);
        $preguntasTemp = $_SESSION['almacenPreguntas'];
        $_SESSION['almacenPreguntas'] = array_merge($preguntasTemp,$listaPreguntas);
        foreach ($_SESSION['almacenPreguntas'] as $clave=>$valor){
            htmlPreguntaPre($valor['idPregunta'],$valor['Usuario_idUsuario'],$valor['fecha'],$valor['titulo']);
        }
        if(sizeof($listaPreguntas)==10){
            htmlBotonMas(end($listaPreguntas)['idPregunta']+1,$modoBusqueda,$listaPreguntas);
        }
        break;
    case "perso":

        $textoBusqueda = $_SESSION['busquedaRelevantes'];
        $temasBusquedaconID = filtrarTemas($textoBusqueda);
        $temasBusquedasinID = array();
        $textoFiltrado = array();
        foreach ($temasBusquedaconID as $clave=>$valor) {
            array_push($temasBusquedasinID,$valor);
        }


        break;

    default:
        echo "Error Desconocido";
}

function htmlPreguntaPre($id,$usuario,$fecha,$titulo)
{
    ?>
    <article class="pregunta-index" id="<?=$id?>">
        <span class="informacion-usuario-fecha-pregunta">por <a href="#" class="link-perfil-usuario"><?=$usuario?></a> a <?=$fecha?></span>
        <h2 class="titulo-pregunta"><a href="./pages/pregunta.php?preguntaid=<?=$id?>"><?=$titulo?></a></h2>
        <div class="contenedor-categorias-pregunta">
            <a href="#"><label>PHP</label></a>
        </div>
        <div id="contenedor-likes-pregunta">
            <a href="#" class="link-like-pregunta"><img src="./media/like.png" alt="imagen-like" class="imagen-like"></a>
            <span id="numero-likes-pregunta">11</span>
            <a href="#" class="link-dislike-pregunta"><img src="./media/like.png" alt="imagen-like" class="imagen-dislike"></a>
            <span id="numero-dislikes-pregunta">3</span>
        </div>
    </article>
    <?php
}

function htmlBotonMas($id,$modoBusqueda){
    $_SESSION['botonMasModo']=$modoBusqueda;


    ?>

        <button id="botonCargarMasPreguntas" value="<?=$modoBusqueda?>" name="<?=$id?>" onclick="cargarMasPreguntas()">Cargar M&aacute;s</button>

    <?php

}




?>



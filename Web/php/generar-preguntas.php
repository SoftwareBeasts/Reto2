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
            htmlPreguntaPre($valor['idPregunta'],$valor['nombre'],$valor['fecha'],$valor['titulo']);
        }
        break;
    case "masvotadas":
        $listaPreguntas = seleccionarMasVotadas();
        foreach ($listaPreguntas as $clave=>$valor){
            htmlPreguntaPre($valor['idPregunta'],$valor['nombre'],$valor['fecha'],$valor['titulo']);
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
            htmlPreguntaPre($valor['idPregunta'],$valor['nombre'],$valor['fecha'],$valor['titulo']);
        }
        if(sizeof($listaPreguntas)==10){
            htmlBotonMas(end($listaPreguntas)['idPregunta']+1,$modoBusqueda);
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
            htmlPreguntaPre($valor['idPregunta'],$valor['nombre'],$valor['fecha'],$valor['titulo']);
        }
        if(sizeof($listaPreguntas)==10){
            htmlBotonMas(end($listaPreguntas)['idPregunta']+1,$modoBusqueda);
        }
        break;
    case "perso":
        if(isset($_GET['cargarMas'])){
            $id = $_GET['cargarMas'];
        }else{
            $id=null;
        }
        $textoBusqueda = $_SESSION['busquedaRelevantes'];
        $temasBusquedaconID = filtrarTemas($textoBusqueda);
        $temasBusquedasinID = array();

        foreach ($temasBusquedaconID as $clave=>$valor) {

                array_push($temasBusquedasinID,$valor['nombre']);
        }

        $textoFiltrado = array_diff($textoBusqueda,$temasBusquedasinID);
        $regex = "/(\?)";
        if (sizeof($textoFiltrado)==0){
            $regex= $regex . "?";
        }else {
            foreach ($textoFiltrado as $item) {
                $regex = $regex . "|(" . $item . ")\b";
            }
        }
        $regex = $regex . "/";
        //echo $regex;
        if (sizeof($temasBusquedaconID)==0 && sizeof($textoFiltrado)==0){

        }
        else {
            $listaPreguntas = seleccionarPreguntasByTemaID($temasBusquedaconID, $regex, $id);
            $preguntasTemp = $_SESSION['almacenPreguntas'];
            $_SESSION['almacenPreguntas'] = array_merge($preguntasTemp, $listaPreguntas);
            foreach ($_SESSION['almacenPreguntas'] as $clave => $valor) {
                htmlPreguntaPre($valor['idPregunta'], $valor['nombre'], $valor['fecha'], $valor['titulo']);
            }
            if (sizeof($listaPreguntas) == 10) {
                htmlBotonMas(end($listaPreguntas)['idPregunta'] + 1, $modoBusqueda);
            }
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
        <div class="contenedor-likes-preguntas">
            <span class="puntuacion-pregunta-index">11</span>
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



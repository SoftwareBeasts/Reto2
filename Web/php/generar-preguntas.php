<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 12/11/2018
 * Time: 12:51
 */
require "db/generar-preguntasDB.php";
if(session_id()==''){
    session_start();
}

$temp = $_GET['modoBusqueda'];
$cargar = new DOMNodeList();

switch ($temp){
    case "recientes":

        break;
    case "masvotadas":

        break;
    case "sinresponder":

        break;
    case "respondidas":

        break;

}

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <article class="pregunta-index" >
        <span class="informacion-usuario-fecha-pregunta">por <a href="#" class="link-perfil-usuario">Unai Puelles</a> a 11 noviembre 2018</span>
        <h2 class="titulo-pregunta"><a href="#">Como usar PHP</a></h2>
        <div class="contenedor-categorias-pregunta">
            <a href="#"><label>PHP</label></a>
        </div>
        <div class="contenedor-likes-preguntas">
            <span class="puntuacion-pregunta-index">11</span>
        </div>
    </article>
    </body>
</html>

<?php


?>
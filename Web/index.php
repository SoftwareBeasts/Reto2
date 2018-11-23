<?php
session_start();
/*Cerrar Sesion*/
if (isset($_GET['logout'])) {
    if ($_GET['logout']) {
        session_destroy();
        session_start();
        header("location:index.php");
    }
}
require_once "php/db/dbUtils.php";
require "php/generar-nav-footer.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Aergibide S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-3.3.1.min.js"></script>
    <link href="css/grid-general.css" type="text/css" rel="stylesheet">
    <link href="css/index.css" type="text/css" rel="stylesheet">
</head>
<body>

<main id="contenedor-principal">
    <?php
    generarNav('./');
    ?>
    <section id="contenedor-selectores-preguntas-index">
        <?php
        /*Comprobar que la busqueda mediante la barra superior no ha cambiado, y en caso de que cambie eliminar las preguntas guardadas*/
        if (isset($_GET['busquedaPreguntas'])) {
            if (isset($_SESSION['nocopy'])) {
                if ($_SESSION['nocopy'] == $_GET['busquedaPreguntas'] || $_SESSION['nocopy'] != $_GET['busquedaPreguntas']) {
                    $_SESSION['almacenPreguntas'] = array();
                }
            }
            /*Recoger el texto introducio por el usuario, transformarlo en array y eliminar palabras "irrelevantes"*/
            $_SESSION['nocopy'] = $_GET['busquedaPreguntas'];
            $arraytextoBusquedaCompleto = explode(" ", $_GET['busquedaPreguntas']);
            $arraytextoBusquedaFiltrado = array();
            $irrelevantes = '/(en)\b|(la)\b|(de)\b|(que)\b|(y)\b|(como)\b|(para)\b/';
            foreach ($arraytextoBusquedaCompleto as $elemento) {
                if (!preg_match($irrelevantes, $elemento)) {
                    array_push($arraytextoBusquedaFiltrado, strtolower($elemento));
                }
            }
            $_SESSION['busquedaRelevantes'] = $arraytextoBusquedaFiltrado;
            ?>
            <div id="modoBusquedaPorTexto" style="display: none"></div>
            <hr>
            <?php
        } else {
            ?>
            <div id="contenedor-selectores-index">
                <button name="recientes" class="boton-selector">Recientes</button>
                <button name="masvotadas" class="boton-selector">M&aacute;s votadas</button>
                <button name="sinresponder" class="boton-selector">Sin Responder</button>
                <button name="respondidas" class="boton-selector">Respondidas</button>
            </div>
            <?php
        }
        ?>
        <div id="contenedor-preguntas-index">
            <!--<article class="pregunta-index" >
                <span class="informacion-usuario-fecha-pregunta">por <a href="#" class="link-perfil-usuario">Unai Puelles</a> a 11 noviembre 2018</span>
                <h2 class="titulo-pregunta"><a href="#">Como usar PHP</a></h2>
                <div class="contenedor-categorias-pregunta">
                    <a href="#"><label>PHP</label></a>
                </div>
                <div class="contenedor-likes-preguntas">
                    <span class="puntuacion-pregunta-index">11</span>
                </div>
            </article>-->
        </div>
        <hr>
    </section>

    <?php
    $listaTemas = seleccionarTodosTemas();
    generarAside(" ", $listaTemas);
    generarFooter(" ");
    ?>
</main>
</body>
</html>
<script src="js/index.js" type="text/javascript"></script>

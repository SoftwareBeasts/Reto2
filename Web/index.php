<?php
require "php/generar-nav-footer.php";
if(session_id() == '') {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aergibide S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/grid-general.css" type="text/css" rel="stylesheet">
    <link href="css/index.css" type="text/css" rel="stylesheet">
</head>
<body>

<main id="contenedor-principal">
    <?php
    generarNav('./');
    ?>

    <section id="contenedor-selectores-preguntas-index">
        <div id="contenedor-selectores-index">
            <button class="boton-selector">Recientes</button>
            <button class="boton-selector">M&aacute;s votadas</button>
            <button class="boton-selector">Sin Responder</button>
            <button class="boton-selector">Respondidas</button>
        </div>
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
    </section>

    <?php
    generarAside();
    generarFooter();
    ?>
</main>
</body>
</html>
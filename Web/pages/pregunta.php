<?php
require "../php/generar-nav-footer.php";
if(session_id() == '') {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aergibide S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/grid-general.css" type="text/css" rel="stylesheet">
    <link href="../css/pregunta.css" type="text/css" rel="stylesheet">
</head>
<body>

<main id="contenedor-principal">
    <?php
        generarNav('../')
    ?>
    <section id="contenedor-preguntas-respuestas">
        <div id="contenedor-pregunta">
            <span> por<a id="informacion-usuario-pregunta">Unai Puelles</a> a 11 de noviembre de 2018</span>
            <h2 id="titulo-pregunta">Como usar PHP</h2>
            <p id="contenido-pregunta">No se usar php, ayuda por favor</p>
            <div id="contenedor-categorias-pregunta">

            </div>
            <div id="contenedor-likes-pregunta">
                <button></button>
            </div>
        </div>
        <article class="contenedor-respuesta">

        </article>
        <div id="contenedor-responder-pregunta">
            <form action="#" method="post">
                <textarea></textarea>
            </form>
        </div>
    </section>

    <?php
    generarAside();
    generarFooter();
    ?>
</main>
</body>
</html>

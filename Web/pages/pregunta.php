<?php
session_start();
require "../php/generar-nav-footer.php";
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
            <span>por <a class="informacion-usuario-pregunta">Unai Puelles</a> a 11 de noviembre de 2018</span>
            <h2 id="titulo-pregunta">Como usar PHP</h2>
            <p id="contenido-pregunta">No se usar php, ayuda por favor</p>
            <div id="contenedor-categorias-pregunta">
                <label>PHP</label>
                <label>PHP</label>
            </div>
            <div id="contenedor-likes-pregunta">
                <a href="#" class="link-like-pregunta"><img src="../media/like.png" alt="imagen-like" class="imagen-like"></a>
                <span id="numero-likes-pregunta">11</span>
                <a href="#" class="link-dislike-pregunta"><img src="../media/like.png" alt="imagen-like" class="imagen-dislike"></a>
                <span id="numero-dislikes-pregunta">3</span>
            </div>
        </div>

        <article class="contenedor-respuesta">
            <span>por <a class="informacion-usuario-pregunta">Unai Puelles</a> a 11 de noviembre de 2018</span>
            <p class="respuesta-pregunta">Ya encontré la solucion en StackOverflow, muchas gracias btw</p>
            <div class="contenedor-likes-respuesta">
                <a href="#" class="link-like-respuesta"><img src="../media/like.png" alt="imagen-like" class="imagen-like"></a>
                <span class="numero-likes-respuesta">11</span>
                <a href="#" class="link-dislike-respuesta"><img src="../media/like.png" alt="imagen-like" class="imagen-dislike"></a>
                <span class="numero-dislikes-respuesta">3</span>
            </div>
        </article>
        <div id="contenedor-responder-pregunta">
            <form action="#" method="post">
                <textarea id="texto-respuesta"></textarea>
                <input type="submit"  id="boton-responder" value="Responder">
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

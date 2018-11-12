<?php
    require "php/generar-nav-footer.php";
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
                generarNav();
            ?>

            <section id="contenedor-selectores-preguntas-index">
                <div id="contenedor-selectores-index">
                    <button class="boton-selector">Recientes</button>
                    <button class="boton-selector">M&aacutes votadas</button>
                    <button class="boton-selector">Sin Responder</button>
                    <button class="boton-selector">Respondidas</button>
                </div>
                <div id="contenedor-preguntas-index">
                    <article class="pregunta-index">
                        <span class="informacion-usuario-fecha-pregunta"><a href="#" class="link-perfil-usuario">Unai Puelles</a></span>
                        <h2 class="titulo-pregunta">Como usar PHP</h2>
                        <div class="contenedor-likes-preguntas">
                            <button class="boton-like-pregunta"><img class="boton-like-imagen"></button>
                            <
                        </div>
                    </article>
                </div>
            </section>
            <aside id="barra-lateral-index">
                <div></div>
            </aside>
            <?php
                generarFooter();
            ?>
        </main>
    </body>
</html>
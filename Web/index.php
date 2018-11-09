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

            <section id="contenedor-preguntas-index">

            </section>
            <aside id="barra-lateral-index">

            </aside>
            <?php
                generarFooter();
            ?>
        </main>
    </body>
</html>
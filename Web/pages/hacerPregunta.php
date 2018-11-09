<?php
require "../php/generar-nav-footer.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Haz tu pregunta &#124; Aergibide S.L.</title>
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css" />
    <link rel="stylesheet" type="text/css" href="../css/hacerPregunta.css" />
</head>
<body>

<main id="contenedor-principal">
    <?php
    generarNav();
    ?>
    <section id="contenedor-hacer-preguntas">
        <h1>Haz tu pregunta</h1>
        <form action="" method="post">
            <ul>
                <li>
                    <label for="tituloPregunta">T&iacute;tulo:</label>
                    <input type="text" id="tituloPregunta" name="tituloPregunta" value="" />
                </li>
                <li>
                    <textarea id="descripcionPregunta" name="descripcionPregunta" rows="15"></textarea>
                </li>
                <li>
                    <label for="categoriasPregunta">Categor&iacute;as:</label>
                    <input type="text" id="categoriasPregunta" name="categoriasPregunta" value="" />
                </li>
                <li>
                    <input type="submit" id="enviarPregunta" value="Enviar" />
                </li>
            </ul>
        </form>
    </section>
    <aside id="barra-lateral-index">

    </aside>
    <?php
    generarFooter();
    ?>
</main>

</body>
</html>
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
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
            <ul>
                <li>
                    <input type="text" name="tituloPregunta" value="" placeholder="T&iacute;tulo" />
                </li>
                <li>
                    <textarea name="descripcionPregunta" rows="15" placeholder="Descripci&oacute;n"></textarea>
                </li>
                <li>
                    <input type="text" name="categoriasPregunta" value="" placeholder="Categor&iacute;as (separadas por comas)" />
                    <input type="submit" value="Enviar" />
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
<?php
require "../php/generar-nav-footer.php";

    if(session_id()==''){
        session_start();
    }

    if(!isset($_SESSION['userLogged']))
    {
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Haz tu pregunta &#124; Aergibide S.L.</title>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css" />
    <link rel="stylesheet" type="text/css" href="../css/hacerPregunta.css" />
</head>
<body>
<script language="JavaScript">
    function validarDatos() {
        try
        {
            var titulo=$("input[name='tituloPregunta']").val();
            if(titulo==="")
            {
                throw "Hacer pregunta: No se ha introducido el título.";
            }
            var descripcion=$("textarea").val();
            if(descripcion==="")
            {
                throw "Hacer pregunta: No se ha introducido la descripción.";
            }
            var categorias=$("input[name='categoriasPregunta']").val();
            if(categorias==="")
            {
                throw "Hacer pregunta: No se ha introducido ninguna categoría.";
            }
            return true;
        }
        catch(err)
        {
            console.log(err);
            return false;
        }
    }
</script>
<main id="contenedor-principal">
    <?php
    generarNav("../");
    ?>
    <section id="contenedor-hacer-preguntas">
        <h1>Haz tu pregunta</h1>
        <form action="../php/hacerPregunta.php" method="post" onsubmit="return validarDatos();">
            <ul>
                <li>
                    <input type="text" name="tituloPregunta" value="" placeholder="T&iacute;tulo" />
                </li>
                <hr />
                <li>
                    <textarea name="descripcionPregunta" rows="15" placeholder="Descripci&oacute;n"></textarea>
                </li>
                <li>
                    <input type="text" name="categoriasPregunta" value="" placeholder="Categor&iacute;as" />
                    <input type="submit" value="Enviar" />
                </li>
            </ul>
        </form>
    </section>
    <?php
    generarAside();
    generarFooter();
    ?>
</main>
</body>
</html>
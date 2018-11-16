<?php
require "../php/generar-nav-footer.php";
require "../php/perfil.php";

session_start();

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
    <title>Perfil de usuario &#124; Aergibide S.L.</title>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css" />
    <link rel="stylesheet" type="text/css" href="../css/perfil.css" />
</head>
<body>
<script language="JavaScript">
    // Para editar el nombre y la descripción del usuario
    $(document).ready(function()
    {
        $("#nombrePerfil").click(function()
        {
            var data = $(this).text();
            $(this).remove();

            $('<form action="perfil.php" method="post"><input id="nombrePerfil" name="nombrePerfil" type="text" value="'+data+'" /><input type="submit" value="Enviar"></form>').appendTo('#nombrePerfilDiv');
        });
        $("#descripcionPerfil").click(function()
        {
            var data = $(this).text();
            $(this).remove();

            $('<form action="perfil.php" method="post"><input id="descripcionPerfil" name="descripcionPerfil" type="text" value="'+data+'" /><input type="submit" value="Enviar"></form>').appendTo('#descripcionPerfilDiv');
        });
    });
</script>
<main id="contenedor-principal">
    <?php
    generarNav("../");
    ?>
    <section id="contenedor-perfil">
        <div>
            <h3 id="nombrePerfilDiv"><span id="nombrePerfil"><?= $_SESSION["userLogged"]["nombreusu"] ?></span></h3>
            <p>Preguntas realizadas: 1 &#124; Respuestas proporcionadas: 1</p>
            <p id="descripcionPerfilDiv"><span id="descripcionPerfil"><?= $_SESSION["userLogged"]["desc"] ?></span></p>
        </div>
        <ul>
            <li>Preguntas</li>
            <li>Respuestas</li>
        </ul>
        <?php
            listaPreguntasUsuario();
            listaRespuestasUsuario();
        ?>
    </section>
    <?php
    generarFooter();
    ?>
</main>
</body>
</html>
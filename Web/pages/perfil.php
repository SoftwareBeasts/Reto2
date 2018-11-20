<?php
require "../php/generar-nav-footer.php";
require "../php/perfil.php";

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
    <title>Perfil de <?= $_SESSION["userLogged"]["nombreusu"] ?> &#124; Aergibide S.L.</title>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/perfil.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css" />
    <link rel="stylesheet" type="text/css" href="../css/perfil.css" />
</head>
<body>
<main id="contenedor-principal">
    <?php
    generarNav("../");
    ?>
    <section id="contenedor-perfil">
        <div id="contenedor-perfil-usuario">
            <div>
                <img src="../media/usersImg/<?php if($_SESSION["userLogged"]["img"]!=""){echo $_SESSION["userLogged"]["img"];}else{echo "user_default.png";} ?>"  height="100" width="100" />
            </div>
            <div>
                <h3><?= $_SESSION["userLogged"]["nombreusu"] ?></h3>
                <p><?= $_SESSION["userLogged"]["correo"] ?></p>
                <p><?= $_SESSION["userLogged"]["desc"] ?></p>
            </div>
        </div>
        <div id="contenedor-selectores-perfil">
            <button name="preguntas">Preguntas</button>
            <button name="respuestas">Respuestas</button>
        </div>
        <div id="contenedor-preguntas-perfil">
            <?php
                listaPreguntasUsuario();
            ?>
        </div>
        <div id="contenedor-respuestas-perfil">
            <?php
                listaRespuestasUsuario();
            ?>
        </div>
    </section>
    <?php
    generarFooter();
    ?>
</main>
</body>
</html>
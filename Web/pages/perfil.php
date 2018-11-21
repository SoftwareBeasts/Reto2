<?php
require "../php/generar-nav-footer.php";
require "../php/perfil.php";
require_once "../php/db/dbUtils.php";

    if(session_id()==''){
        session_start();
    }
    $usuario=array();
    if(isset($_GET["usuario"]))
    {
        $usuario=encontrarUsuario("no", $_GET["usuario"]);
        if($usuario==NULL)
        {
            header('Location: ../index.php');
        }

    }
    elseif(isset($_SESSION['userLogged']))
    {
        $usuario=$_SESSION['userLogged'];
    }
    else
    {
        header('Location: ../index.php');
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Perfil de <?= $usuario["nombreusu"] ?> &#124; Aergibide S.L.</title>
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
                <img src="..<?php if($usuario["img"]!=""){echo $usuario["img"];}else{echo "/media/usersImg/user_default.png";} ?>"  height="100" width="100" />
            </div>
            <div>
                <h3><?= $usuario["nombreusu"] ?></h3>
                <p><?= $usuario["correo"] ?></p>
                <p><?= $usuario["desc"] ?></p>
            </div>
        </div>
        <div id="contenedor-selectores-perfil">
            <button name="preguntas">Preguntas</button>
            <button name="respuestas">Respuestas</button>
        </div>
        <div id="contenedor-preguntas-perfil">
            <?php
                listaPreguntasUsuario($usuario["idUsuario"]);
            ?>
        </div>
        <div id="contenedor-respuestas-perfil">
            <?php
                listaRespuestasUsuario($usuario["idUsuario"]);
            ?>
        </div>
    </section>
    <?php
    generarFooter();
    ?>
</main>
</body>
</html>
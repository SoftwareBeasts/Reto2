<?php
    require '../php/generar-nav-footer.php';
    require '../php/db/usuarioDB.php';

    session_start();

    if(!isset($_SESSION['userLogged'])){
        $_SESSION['userLogged'] = null;
    }
    $datosIncorrectos = false;
    if(isset($_SESSION['contador'])) {
        $_SESSION['contador']++;
    } else {
        $_SESSION['contador'] = 0;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aergibide S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
    <main id="contenedor-principal" onload="">
        <?php generarNav("../"); ?>
    <?php
    if(isset($_POST['usem']) && isset($_POST['pass'])){
        $usuario = findUsuario($_POST['usem']);
        if($usuario != null){
            if(password_verify($_POST['pass'], $usuario['pass']))
                $_SESSION['userLogged'] = $usuario;
            else
                $datosIncorrectos = true;
        }
        else{
            $datosIncorrectos = true;
        }
    }

    if(isset($_SESSION['userLogged']) || $_SESSION['contador'] == 0){
        ?>
        <div class="center">
            <form method="post" action="login.php">
        <?php
        if($_SESSION['userLogged'] == null){
            ?>
                    <div>
                        <label class="top" for="usem">Usuario o Email</label>
                        <input class="top" type="text" name="usem" id="usem" placeholder="Usuario o Email">
                    </div>
                    <div>
                        <label class="align center" for="pass">Contraseña</label>
                        <input class="align center" type="password" id="pass" name="pass" placeholder="···············">
                        <a href="#">Aún no estoy registrado</a>
                    </div>
                    <?php
                    if($_SESSION['contador'] > 2){
                        ?>
                        <input type="submit" value="Login" disabled="disabled">
                        <?php
                    }
                    elseif ($datosIncorrectos){
                        echo "Incorrecto";
                        ?>
                        <?php
                    }
                    else{
                        ?>
                        <input type="submit" value="Login">
                        <?php
                    }
                    ?>
            <?php
        }
        else{
            header("location:/index.php");
        }
        ?>
            </form>
        </div>
        <?php
    }
    ?>

        <?php generarFooter(); ?>
    </main>
    </body>
</html>
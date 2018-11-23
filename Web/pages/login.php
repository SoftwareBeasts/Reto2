<?php
require '../php/generar-nav-footer.php';
require_once '../php/db/dbUtils.php';

session_start();

//Vereficar si hay un usuario loggeado, si no se establece null
if (!isset($_SESSION['userLogged'])) {
    $_SESSION['userLogged'] = null;
}
$datosIncorrectos = false;

//Contador para
if (!isset($_SESSION['contador']))
    $_SESSION['contador'] = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aergibide S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/login.js"></script>
</head>
<body>
<main id="contenedor-principal">
    <?php generarNav("../"); ?>
    <?php
    /*
    * Recoger datos y verificarlos contra base de datos
    */
    if (isset($_POST['usem']) && isset($_POST['pass'])) {
        //Consulta a BBDD
        $usuario = encontrarUsuario($_POST['usem']);
        if ($usuario != null) {
            //Verificar contraseña encriptada
            if (password_verify($_POST['pass'], $usuario['pass']))
                $_SESSION['userLogged'] = $usuario;
            else
                $datosIncorrectos = true;
        } else {
            $datosIncorrectos = true;
        }
    }
    ?>
    <div class="center">
        <form method="post" action="login.php">
            <?php
            //Si no hay usuario loggeado
            if ($_SESSION['userLogged'] == null) {
                ?>
                <div>
                    <label class="login" for="usem">Email</label>
                    <input class="transparent" type="text" name="usem" id="usem" autofocus
                           placeholder="ejemplo@ejemplo.com">
                </div>
                <div>
                    <label class="login" for="pass">Contraseña</label>
                    <input class="transparent" type="password" id="pass" name="pass" placeholder="···············">
                    <a href="./registro.php">Aún no estoy registrado</a>
                </div>
                <?php
                //Limite de fallos excedido
                if ($_SESSION['contador'] > 3) {
                    ?>
                    <input class="submit limit" type="submit" value="Login" title="Límite de fallos excedido"
                           disabled="disabled">
                    <?php
                } else {
                    ?>
                    <input class="submit" type="submit" value="Login">
                    <?php
                    //Si los datos son incorrectos
                    if ($datosIncorrectos) {
                        $_SESSION['contador']++;
                        ?>
                        <input type="hidden" id="error" value="<?= $datosIncorrectos ?>">
                        <?php
                    }
                }
            } else
                header("location:../index.php");
            ?>
        </form>
    </div>
    <?php
    generarFooter("../"); ?>
</main>
</body>
</html>
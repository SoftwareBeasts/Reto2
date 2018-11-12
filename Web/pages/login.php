<?php
    require '../php/generar-nav-footer.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aergibide S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <?php
        $encript = password_hash("unaipuelles", PASSWORD_DEFAULT);
        echo $encript;
        if(isset($_POST['pass'])){

            if(password_verify($_POST['pass'], $encript)){
                ?>
                <p>CORRECTO</p>
                <?php
            }
            else{
                ?>
                <p>INCORRECTO</p>
                <?php
            }
        }
    ?>
</head>
<body>
    <main id="contenedor-principal" onload="">
        <?php generarNav(); ?>
        <div class="center">
            <form method="post" action="login.php">
                <div>
                    <label class="top" for="usem">Usuario o Email</label>
                    <input class="top" type="text" id="usem" placeholder="Usuario o Email">
                </div>
                <div>
                    <label class="align center" for="pass">Contraseña</label>
                    <input class="align center" type="password" id="pass" name="pass" placeholder="···············">
                    <a href="#">Aún no estoy registrado</a>
                </div>
                <input class="bottom" type="submit">
            </form>
        </div>
        <?php generarFooter(); ?>
    </main>
</body>
</html>
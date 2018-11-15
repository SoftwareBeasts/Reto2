<?php
require '../php/generar-nav-footer.php';
require '../php/db/usuarioDB.php';

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aergibide S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/registro.css">
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/registro.js"></script>
</head>
<body>
    <main id="contenedor-principal" onload="">
        <?php generarNav("../"); ?>
        <div class="pos">
            <form action="registro.php" method="post">
                <label class="registro" for="nombreusu">Nombre Usuario<span class="required">*</span></label>
                <input type="text" id="nombreusu" class="transparent registro" name="nombreusu" required>
                <label class="registro" for="correo">Correo<span class="required">*</span></label>
                <input type="email" id="correo" class="transparent registro" name="correo" required>
                <label class="registro" for="correoConf">Confirmar correo<span class="required">*</span></label>
                <input type="" id="correoConf" class="transparent registro" name="correoConf" required>
                <label class="registro" for="passw">Contraseña<span class="required">*</span></label>
                <input type="password" id="passw" class="transparent registro" name="passw" required>
                <label class="registro" for="passwConf">Confirmar contraseña<span class="required">*</span></label>
                <input type="password" id="passwConf" class="transparent registro" name="passwConf" required>
                <label class="registro" for="descripcion">Descripción<span class="required">*</span></label>
                <textarea id="descripcion" class="transparent registro" name="descripcion"></textarea>
                <label class="registro" for="img">Imagen de perfil</label>
                <input type="file" id="img" class="transparent registro" name="img">
                <input type="submit">
                <span id="hidden"></span>
            </form>
        </div>
        <?php
        generarFooter(); ?>
    </main>
</body>
</html>
<?php
require '../php/generar-nav-footer.php';
require '../php/db/dbUtils.php';

session_start();
if(!isset($_SESSION['userLogged'])){
    echo "1";
    $_SESSION['userLogged'] = null;
}

$correcto = false;
if(isset($_POST['nombreusu'])){
    echo "2";
    if($_POST['descripcion'] === ""){
        echo "3";
        $_POST['descripcion'] = null;
    }
    if($_POST['img'] === ""){
        echo "4";
        $_POST['img'] = "/media/usersImg/user_default.png";
    }
    else{
        echo "5";
        $file = pathinfo($_FILES['img']['name']);
        $extension = $file['extension'];
        $newname = $_POST['nombreusu'].".".$extension;

        $target = '/media/usersImg/'.$newname;
        move_uploaded_file( $_FILES['img']['tmp_name'], $target);
    }
    echo "6";
    $datos = Array('nombreusu' => $_POST['nombreusu'], 'correo' => $_POST['correo'],
        'pass' => password_hash($_POST['passw'], PASSWORD_DEFAULT), 'desc' => $_POST['descripcion'],
        'img' => $_POST['img']);
    $correcto = registrarUsuario($datos);
}

if($correcto){
    echo "7";
    $_SESSION['userLogged'] = $datos;
}

if($_SESSION['userLogged'] !== null)
    header("location:../index.html");
else{
    echo "8";
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
        <?php //generarNav("../"); ?>
        <div class="pos">
            <form method="post" action="registro.php" >
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
                <label class="registro" for="descripcion">Descripción</label>
                <textarea id="descripcion" class="transparent registro" name="descripcion"></textarea>
                <label class="registro" for="img">Imagen de perfil</label>
                <input type="file" id="img" class="transparent registro" name="img">
                <input type="submit" value="Registrar">
            </form>
        </div>
        <?php
        generarFooter(); ?>
    </main>
</body>
</html>
<?php
}
?>
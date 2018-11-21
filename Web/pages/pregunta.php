<?php
if(session_id()==''){
    session_start();
}
require "../php/generar-nav-footer.php";
require_once  "../php/db/dbUtils.php";
require "../php/generar-respuestas.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Aergibide S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/grid-general.css" type="text/css" rel="stylesheet">
    <link href="../css/pregunta.css" type="text/css" rel="stylesheet">
    <link href="../css/form.css" type="text/css" rel="stylesheet">
    <script src="../js/jquery-3.3.1.min.js"></script>

</head>
<body>

<main id="contenedor-principal">
    <?php
        generarNav('../');
        $idPregunta = $_GET['preguntaid'];
        if (isset($_POST['responder_pregunta'])){
            $archivos = "";
            if (isset($_POST['archivo_respuesta'])&&!is_null($_POST['archivo_respuesta'])){
                $archivos = $_POST['archivo_respuesta'];
            }else{
                $archivos = null;
            }
            responderPregunta($idPregunta,$_POST['titulo_respuesta'],$_POST['texto_respuesta'],$_SESSION['userLogged']['idUsuario'],$archivos);
        }
        $datosPregunta = cargarDatosPreguntabyId($idPregunta);
    ?>
    <section id="contenedor-preguntas-respuestas">
        <hr>
        <div id="contenedor-pregunta">
            <span><a href="../pages/perfil.php?usuario=<?= $datosPregunta['usuario']['idUsuario'] ?>" class="informacion-usuario-pregunta"><?=$datosPregunta['usuario']['nombreusu']?></a> <?=$datosPregunta['pregunta']['fecha']?></span>
            <h2 id="titulo-pregunta"><?=$datosPregunta['pregunta']['titulo']?></h2>
            <p id="contenido-pregunta"><?=$datosPregunta['pregunta']['cuerpo']?></p>
            <div id="contenedor-categorias-pregunta">
                <a href="#"><label>PHP</label></a>

            </div>

            <div id="contenedor-likes-pregunta">
                <a href="#" class="link-like-pregunta"><img src="../media/like.png" alt="imagen-like" class="imagen-like"></a>
                <span id="numero-likes-pregunta">11</span>
                <a href="#" class="link-dislike-pregunta"><img src="../media/like.png" alt="imagen-like" class="imagen-dislike"></a>
                <span id="numero-dislikes-pregunta">3</span>
            </div>
        </div>
        <hr>
        <div id="contenedor-respuestas">
            <?php
                generarRespuestasPregunta($datosPregunta['respuestas']);
            ?>
       <!-- <article class="contenedor-respuesta">
            <span>por <a href="#" class="informacion-usuario-pregunta">Unai Puelles</a> a 11 de noviembre de 2018</span>
            <p class="respuesta-pregunta">Ya encontré la solucion en StackOverflow, muchas gracias btw</p>
            <div class="contenedor-likes-respuesta">
                <a href="#" class="link-like-respuesta"><img src="../media/like.png" alt="imagen-like" class="imagen-like"></a>
                <span class="numero-likes-respuesta">11</span>
                <a href="#" class="link-dislike-respuesta"><img src="../media/like.png" alt="imagen-like" class="imagen-dislike"></a>
                <span class="numero-dislikes-respuesta">3</span>
            </div>
        </article>-->

        </div>
        <hr>
        <div id="contenedor-responder-pregunta">
            <h3>Env&iacute;a tu respuesta</h3>
            <form action="pregunta.php?preguntaid=<?=$idPregunta?>" method="post">
                <input type="hidden" name="pregunta-responder-id" value="<?=$idPregunta?>">
                <input type="text" class="transparent" id="titulo-respuesta" name="titulo_respuesta" placeholder="titulo" required>
                <hr>
                <textarea id="texto-respuesta"  name="texto_respuesta" class="transparent" placeholder="Escribe tu respuesta" required></textarea>
                <hr>
                <input type="file" class="transparent" id="archivo-respuesta" name="archivo_respuesta">
                <?php
                if (isset($_SESSION['userLogged'])&&!is_null($_SESSION['userLogged'])){
                    ?>
                    <input type="submit"  class="submit" id="boton-responder" name="responder_pregunta" value="Responder">
                    <?php
                }else{
                    ?>
                    <input type="button" class="submit" id="boton-responder" name="loginRequerido" value="Responder">
                    <?php
                }
                ?>

            </form>
        </div>
        <hr>
        <div id="requeridoLogearse">
            <h3>Es necesario Logearse antes de continuar</h3>
        </div>
    </section>

    <?php
    generarAside('../');
    generarFooter();
    ?>
</main>
</body>
<script src="../js/pregunta.js"></script>
</html>

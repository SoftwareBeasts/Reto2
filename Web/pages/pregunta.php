<?php
if(session_id()==''){
    session_start();
}
if(!isset($_SESSION['userLogged']))
    $_SESSION['userLogged'] = null;

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
        $archivos = null;
        if(is_uploaded_file($_FILES['archivo_respuesta']['tmp_name'])){
            $file = pathinfo($_FILES['archivo_respuesta']['name']);
            $newname = $_SESSION['userLogged']['idUsuario'].$idPregunta.date("YmdHis")."_".$_FILES['archivo_respuesta']['name'];

            $target = '../media/usersArchives/'.$newname;
            move_uploaded_file( $_FILES['archivo_respuesta']['tmp_name'], $target);
            $archivos = '../media/usersArchives/'.$newname;
        }
        responderPregunta($idPregunta,$_POST['titulo_respuesta'],$_POST['texto_respuesta'],$_SESSION['userLogged']['idUsuario'],$archivos);
    }
    $datosPregunta = cargarDatosPreguntabyId($idPregunta);
    ?>
    <section id="contenedor-preguntas-respuestas">
        <hr>
        <div id="contenedor-pregunta" name="<?= $idPregunta ?>">
            <span><a href="../pages/perfil.php?usuario=<?= $datosPregunta['usuario']['idUsuario'] ?>" class="informacion-usuario-pregunta"><?=$datosPregunta['usuario']['nombreusu']?></a> <?=$datosPregunta['pregunta']['fecha']?></span>
            <h2 id="titulo-pregunta"><?=$datosPregunta['pregunta']['titulo']?></h2>
            <p id="contenido-pregunta"><?=$datosPregunta['pregunta']['cuerpo']?></p>
            <div id="contenedor-categorias-pregunta">
                <?php

                if (isset($datosPregunta['temas'])) {
                    foreach ($datosPregunta['temas'] as $clave => $valor) {
                        ?>
                        <a href="../index.php?busquedaPreguntas=<?= $valor['nombre'] ?>"><label><?= $valor['nombre'] ?></label></a>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
            function numlikesdislikesP($valor){
                $tempcontador = array(
                    "likes"=>0,
                    "dislikes"=>0
                );
                if($valor!=null) {
                    foreach ($valor['votos'] as $item => $value) {
                        if ($value['tipo'] == 1) {
                            $tempcontador['likes']++;
                        } else {
                            $tempcontador['dislikes']++;
                        }
                    }
                }
                return $tempcontador;
            }
            $listavotosPregunta = numlikesdislikesP($datosPregunta['pregunta']['votos']);
            ?>
            <div id="contenedor-likes-pregunta">

                <img src="../media/like.png" alt="imagen-like" class="imagen-like">
                <span id="numero-likes-pregunta"><?=$listavotosPregunta['likes']?></span>
                <img src="../media/like.png" alt="imagen-like" class="imagen-dislike">
                <span id="numero-dislikes-pregunta"><?=$listavotosPregunta['dislikes']?></span>

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
            <form action="pregunta.php?preguntaid=<?=$idPregunta?>" method="post" enctype='multipart/form-data'>
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
    $listaTemas = seleccionarTodosTemas();
    generarAside('../', $listaTemas);
    generarFooter("../");
    ?>
</main>
</body>
<script src="../js/pregunta.js"></script>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 16/11/2018
 * Time: 10:10
 */
if(session_id()==''){
    session_start();
}
function numlikesdislikes($valor){
    $tempcontador = array(
        "likes"=>0,
        "dislikes"=>0
    );
    foreach ($valor['votos'] as $item=>$value){
        if ($value['tipo']==1){
            $tempcontador['likes']++;
        }else{
            $tempcontador['dislikes']++;
        }
    }
    return $tempcontador;
}
function generarRespuestasPregunta($datosRespuesta){
    foreach ($datosRespuesta as $clave=>$valor) {

         $votos = numlikesdislikes($valor);

        ?>
        <article class="contenedor-respuesta" id="<?= $valor['idRespuesta'] ?>">
            <span>por <a href="#" class="informacion-usuario-pregunta"><?= $valor['Usuario_idUsuario'] ?></a> a <?=$valor['fecha']?></span>
            <h3 class="titulo-respuesta-pregunta"><?=$valor['titulo']?></h3>
            <p class="respuesta-pregunta"><?=$valor['cuerpo']?></p>
            <div class="contenedor-likes-respuesta">
                <a href="#" class="link-like-respuesta"><img src="../media/like.png" alt="imagen-like"
                                                             class="imagen-like"></a>
                <span class="numero-likes-respuesta"><?=$votos['likes']?></span>
                <a href="#" class="link-dislike-respuesta"><img src="../media/like.png" alt="imagen-like"
                                                                class="imagen-dislike"></a>
                <span class="numero-dislikes-respuesta"><?=$votos['dislikes']?></span>
            </div>
        </article>
        <?php
    }
}








/*

<article class="contenedor-respuesta">
            <span>por <a href="#" class="informacion-usuario-pregunta">Unai Puelles</a> a 11 de noviembre de 2018</span>
            <p class="respuesta-pregunta">Ya encontré la solucion en StackOverflow, muchas gracias btw</p>
            <div class="contenedor-likes-respuesta">
                <a href="#" class="link-like-respuesta"><img src="../media/like.png" alt="imagen-like" class="imagen-like"></a>
                <span class="numero-likes-respuesta">11</span>
                <a href="#" class="link-dislike-respuesta"><img src="../media/like.png" alt="imagen-like" class="imagen-dislike"></a>
                <span class="numero-dislikes-respuesta">3</span>
            </div>
        </article>


*/
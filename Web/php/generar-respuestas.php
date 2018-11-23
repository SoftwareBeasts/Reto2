<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 16/11/2018
 * Time: 10:10
 */
if (session_id() == '') {
    session_start();
}
/**
 * @param $valor un array con todos los votos de esa respuesta
 * @return array un array de dos posiciones una con los likes y otra con los dislikes
 *
 * guarda los datos en un array que contiene likes y dislikes
 */
function numlikesdislikes($valor)
{
    $tempcontador = array(
        "likes" => 0,
        "dislikes" => 0
    );
    if ($valor != null) {
        foreach ($valor as $item => $value) {
            if ($value == 1) {
                $tempcontador['likes']++;
            } else {
                $tempcontador['dislikes']++;
            }
        }
    }
    return $tempcontador;
}

/**
 * @param $datosRespuesta Los datos de la respuesta
 *
 * Genera una respuesta con los datos suministrados
 */
function generarRespuestasPregunta($datosRespuesta)
{
    foreach ($datosRespuesta as $clave => $valor) {

        $votos = numlikesdislikes($valor);
        $archivo = explode("_", $valor['archivos']);
        ?>
        <article class="contenedor-respuesta" id="<?= $valor['idRespuesta'] ?>">
            <span>por <a href="../pages/perfil.php?usuario=<?= $valor['Usuario_idUsuario'] ?>"
                         class="informacion-usuario-pregunta"><?= $valor['nombre'] ?></a> a <?= $valor['fecha'] ?></span>
            <h3 class="titulo-respuesta-pregunta"><?= $valor['titulo'] ?></h3>
            <p class="respuesta-pregunta"><?= $valor['cuerpo'] ?></p>
            <?php
            if ($archivo[0] !== "") {
                ?>
                <span><a class="informacion-usuario-pregunta"
                         href="<?= $valor['archivos'] ?>"><?= $archivo[1] ?></a></span>
                <?php
            }
            ?>
            <div class="contenedor-likes-respuesta">
                <img src="../media/like.png" alt="imagen-like" class="imagen-like">
                <span class="numero-likes-respuesta"><?= $votos['likes'] ?></span>
                <img src="../media/like.png" alt="imagen-like" class="imagen-dislike">
                <span class="numero-dislikes-respuesta"><?= $votos['dislikes'] ?></span>
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
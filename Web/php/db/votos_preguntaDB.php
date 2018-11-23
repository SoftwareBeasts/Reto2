<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 21/11/2018
 * Time: 9:39
 */

/**
 * @param $conexion La conexion
 * @param $likeDislikeData un array con datos (idPregunta y idUsuario)
 * @return array un array con los datos de los likes y los dislikes
 *
 * Busca si existe el like o el dislike que se esta intentado ejecutar
 */
function likeDislikeFinderP($conexion, $likeDislikeData)
{
    $encontrado = [false, false];
    try {

        $consulta = $conexion->prepare("SELECT `tipo` FROM voto_pregunta
                                        WHERE Pregunta_idPregunta = :Pregunta_idPregunta
                                        AND Usuario_idUsuario = :Usuario_idUsuario");
        $consulta->setFetchMode(PDO::FETCH_OBJ);
        $consulta->execute($likeDislikeData);
        $resul = $consulta->fetch();

        if (!$resul == null) {
            $encontrado = [true, ((int)$resul->tipo ? true : false)];
        }

    } catch (Exeption $e) {
        return $encontrado;
    }
    return $encontrado;
}

/**
 * @param $conexion La conexion
 * @param $likeDislikeData array con datos para la select(idPregunta y idUsuario)
 * @param $alter "boolean" que comprueba si es necesario alterar el voto o insertarlo de nuevo
 * @return bool true si esta bien false si esta mal
 */
function insertLikeDislikeP($conexion, $likeDislikeData, $alter)
{
    $correcto = false;
    try {
        if ($alter !== "TRUE") {
            $consulta = $conexion->prepare('INSERT INTO voto_pregunta (`tipo`,`Pregunta_idPregunta`,`Usuario_idUsuario`)
                                        VALUES (:type, :Pregunta_idPregunta, :Usuario_idUsuario)');
        } else {
            $consulta = $conexion->prepare('UPDATE voto_pregunta SET tipo = :type
                                        WHERE Pregunta_idPregunta = :Pregunta_idPregunta
                                        AND Usuario_idUsuario = :Usuario_idUsuario');
        }
        $consulta->execute($likeDislikeData);
        //$correcto = $consulta ->errorCode();
        $correcto = true;

    } catch (Exception $e) {
    }
    return $correcto;
}

/**
 * @param $conexion La conexion
 * @param $id la id de la pregunta
 * @return array un array con los votos de la pregunta
 */
function selectVotosByPreguntaID($conexion, $id)
{
    try {
        $consulta = $conexion->prepare("SELECT * FROM voto_pregunta WHERE Pregunta_idPregunta = :id");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(":id", "$id");
        $consulta->execute();
        $listaVotos = array();

        while ($voto = $consulta->fetch()) {
            $listaVotos[] = $voto;
        }
        $conexion = null;
        return $listaVotos;
    } catch (Exception $e) {
        echo $e;
    }
}
<?php

/**
 * Devuelve todos los votos que contiene el id de respuesta aportado
 * @param $conexion conexion de la base de datos
 * @param $id id de la respuesta
 * @return array todos los votos
 */
function selectAllVotosByRespuestaID($conexion, $id)
{
    try {
        $consulta = $conexion->prepare("SELECT * FROM voto_respuesta WHERE Respuesta_idRespuesta = :id");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id', "$id");
        $consulta->execute();

        $listaVotos = array();
        $contador = 0;
        while ($voto = $consulta->fetch()) {
            $listaVotos[$contador] = $voto;
            $contador++;
        }

        $conexion = null;

        return $listaVotos;

    } catch (Exception $e) {
        echo $e;
    }
}

/**
 * Busca si se ha encotnrado el voto
 * @param $conexion conexion de la base de datos
 * @param $likeDislikeData array asociativo con el id respuesta y el id usuario
 * @return array un array con true si lo ha encontrado y true o false dependiiendo del tipo de voto
 */
function likeDislikeFinder($conexion, $likeDislikeData)
{
    $encontrado = [false, false];
    try {
        $consulta = $conexion->prepare("SELECT `tipo` FROM voto_respuesta 
                                          WHERE Respuesta_idRespuesta = :Respuesta_idRespuesta
                                          AND Usuario_idUsuario = :Usuario_idUsuario");
        $consulta->setFetchMode(PDO::FETCH_OBJ);
        $consulta->execute($likeDislikeData);
        $resul = $consulta->fetch();

        if (!$resul == null) {
            $encontrado = [true, ((int)$resul->tipo ? true : false)];
        }
    } catch (Exception $e) {
        return $encontrado;
    }
    return $encontrado;
}

/**
 * Inserta o altera el voto en la base de datos
 * @param $conexion conexion de la base de datos
 * @param $likeDislikeData array asociativo con el tipo de voto, id respuesta y el id usuario
 * @param $alter true si hay que hacer alter table o false si hay que hacer insert
 * @return bool true si se ha realizado correctamente
 */
function insertLikeDislike($conexion, $likeDislikeData, $alter)
{
    $correcto = false;
    try {
        if ($alter !== "TRUE") {
            $consulta = $conexion->prepare('INSERT INTO voto_respuesta (`tipo`, `Respuesta_idRespuesta`, `Usuario_idUsuario`) 
                                          VALUES (:type, :Respuesta_idRespuesta, :Usuario_idUsuario)');
        } else {
            $consulta = $conexion->prepare('UPDATE voto_respuesta SET tipo = :type
                                          WHERE Respuesta_idRespuesta = :Respuesta_idRespuesta
                                           AND Usuario_idUsuario = :Usuario_idUsuario');
        }
        $consulta->execute($likeDislikeData);
        //$correcto = $consulta -> errorCode();
        $correcto = true;

    } catch (Exception $e) {
    }
    return $correcto;
}
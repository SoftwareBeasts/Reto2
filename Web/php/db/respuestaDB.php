<?php

/**
 * @param $conexion La conexion
 * @param $usuario id del usuario que ha hecho la respuesta
 * @return array|null  un array con las respuestas formuladas por el usuario cuya id se proporciona
 */
function findRespuestasByUsuario($conexion, $usuario)
{
    try {
        $datos = array('usuario' => $usuario);

        $consulta = $conexion->prepare('SELECT DISTINCT Pregunta_idPregunta FROM Respuesta WHERE Usuario_idUsuario = :usuario');
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute($datos);
        $respuestas = array();

        while ($respuesta = $consulta->fetch()) {
            $respuestas[] = $respuesta;
        }
        return $respuestas;
    } catch (Exception $e) {
        return null;
    }
}

/**
 * @param $conexion La conexion
 * @param $id el id de la pregunta cuyas respuestas queremos
 * @return mixed devuelve un array asociativo con una posicion que contiene una respuesta
 */
function selectRespuestabyPreguntaID($conexion, $id)
{
    try {

        $consulta = $conexion->prepare("SELECT  * FROM respuesta WHERE Pregunta_idPregunta = :id LIMIT 1");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id', "$id");
        $consulta->execute();

        $respuesta = $consulta->fetch();
        $conexion = null;

        return $respuesta;
    } catch (Exception $e) {
        echo $e;
    }
}

/**
 * @param $conexion La conexion
 * @param $id el id de la pregunta
 * @return array un array con todas las respuestas de la pregunta
 */
function selectAllRespuestabyPreguntaID($conexion, $id)
{
    try {

        $consulta = $conexion->prepare("SELECT * FROM respuesta WHERE Pregunta_idPregunta = :id");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id', "$id");
        $consulta->execute();

        $listarespuestas = array();
        $contador = 0;
        while ($respuesta = $consulta->fetch()) {
            $listarespuestas[$contador] = $respuesta;
            $contador++;
        }

        $conexion = null;

        return $listarespuestas;
    } catch (Exception $e) {
        echo $e;
    }
}

/**
 * @param $conexion la conexion
 * @param $idPregunta el id de la respuesta
 * @param $titulo el titulo de la respuesta
 * @param $cuerpo el cuerpo de la respuesta
 * @param $userID el id del usuario que ha formulado la respuesta
 * @param null $archivos los archivos de la respuesta
 */
function insertRespuesta($conexion, $idPregunta, $titulo, $cuerpo, $userID, $archivos = null)
{
    try {
        $today = date("Y-m-d");

        if ($archivos == null) {
            $insert = $conexion->prepare("INSERT INTO respuesta(`titulo`,`cuerpo`,`fecha`,`aprobado`,`Usuario_idUsuario`,`Pregunta_idPregunta`)
                      VALUES(:titulo,:cuerpo,:fecha,:aprobado,:iduser,:idpregunta) ");
            $datos = array(
                "titulo" => $titulo,
                "cuerpo" => $cuerpo,
                "fecha" => $today,
                "aprobado" => 0,
                "iduser" => $userID,
                "idpregunta" => $idPregunta
            );
        } else {
            $insert = $conexion->prepare("INSERT INTO respuesta(`titulo`,`cuerpo`,`fecha`,`archivos`,`aprobado`,`Usuario_idUsuario`,`Pregunta_idPregunta`)
                      VALUES(:titulo,:cuerpo,:fecha,:archivos,:aprobado,:iduser,:idpregunta) ");
            $datos = array(
                "titulo" => $titulo,
                "cuerpo" => $cuerpo,
                "fecha" => $today,
                "archivos" => $archivos,
                "aprobado" => 0,
                "iduser" => $userID,
                "idpregunta" => $idPregunta
            );
        }

        $insert->execute($datos);

        $conexion = null;

    } catch (Exception $e) {
        echo $e;
    }
}

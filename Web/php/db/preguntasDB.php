<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 13/11/2018
 * Time: 12:11
 */

/**
 * @param $connection La conexion
 * @return array un array con las preguntas mas recientes
 *
 * Retorna las 20 preguntas mas recientes en forma de array asociativo
 */
function selectRecientes($connection)
{

    try {
        $consulta = $connection->prepare("SELECT * FROM pregunta ORDER BY fecha DESC LIMIT  20");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        $listaPreguntas = array();
        $id = 0;

        while ($pregunta = $consulta->fetch()) {
            $listaPreguntas[$id] = $pregunta;
            $id++;
        }

        $connection = null;
        return $listaPreguntas;
    } catch (Exception $e) {
        echo $e;
    }
}

/**
 * @param $conexion La conexion
 * @return array un array con las preguntas mas votadas
 *
 * Selecciona las preguntas mas votadas y las devuelve en forma de array asociativo
 */
function selectMasVotadas($conexion)
{
    try {
        $consulta = $conexion->prepare("SELECT pregunta.* FROM pregunta WHERE pregunta.idPregunta IN (SELECT `idPre` FROM 
                                      (SELECT `contados`,`idPre` FROM
                                        (SELECT COUNT(*) AS `contados`,Pregunta_idPregunta AS `idPre` FROM `votos_pregunta` WHERE tipo=1 GROUP BY Pregunta_idPregunta) AS contar1 ORDER BY `contados` DESC LIMIT 20
                                      ) AS contar2)");
        /*Esta select igual es mejor explicarla, lo que hace basicamente es buscar todos los datos de las preguntas cuyo
         id este dentro de otra busqueda, la cual recoge las ids de otra busqueda, la cual recoge la cantidad de votos contados
         por id de pregunta y los ordena en orden descendente y con un limite de 20
        esos datos los saca de otra consulta que cuenta los votos por id de pregunta y se agrupan por id de pregunta*/
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        $listaPreguntas = array();
        $id = 0;

        while ($pregunta = $consulta->fetch()) {
            $listaPreguntas[$id] = $pregunta;
            $id++;
        }

        $conexion = null;
        return $listaPreguntas;
    } catch (Exception $e) {
        echo $e;
    }
}

/**
 * @param $conexion La conexion
 * @param $id el id de la pregunta
 * @return mixed devuelve un array asociativo;
 *
 * Busca una unica pregunta con la id proporcionada
 */
function selectPreguntabyID($conexion, $id)
{
    try {

        $consulta = $conexion->prepare("SELECT * FROM pregunta WHERE idPregunta = :id");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id', "$id");
        $consulta->execute();
        $pregunta = $consulta->fetch();

        $conexion = null;
        return $pregunta;
    } catch (Exception $e) {
        echo $e;
    }
}

/**
 * @param $conexion La conexion
 * @param $temas un array con los temas de la pregunta
 * @param $id el id de la pregunta
 * @return mixed un array asociativo
 *
 * Selecciona todas las preguntas que tengan al menos un tema de los que hay en el array temas
 */
function selectPreguntabyTemas($conexion, $temas, $id)
{
    try {
        if ($id == null) {
            $id = 0;
        }
        $contador = 0;
        $temasConsulta = "";
        foreach ($temas as $item => $value) {

            if ($contador == sizeof($temas) - 1) {
                $temasConsulta = $temasConsulta . " tema.idTema = " . $value['idTema'];
            } else {
                $temasConsulta = $temasConsulta . " tema.idTema = " . $value['idTema'] . " OR";
            }
            $contador++;
        }

        $consulta = $conexion->prepare("SELECT pregunta.* FROM pregunta,tema,pregunta_has_tema 
          WHERE tema.idTema=pregunta_has_tema.Tema_idTema AND pregunta.idPregunta = pregunta_has_tema.Pregunta_idPregunta
          AND (" . $temasConsulta . ") AND pregunta.idPregunta>:id LIMIT 1");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id', "$id");
        $consulta->execute();


        $pregunta = $consulta->fetch();


        $conexion = null;
        return $pregunta;
    } catch (Exception $e) {
        echo $e;
    }
}


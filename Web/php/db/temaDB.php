<?php
/**
 * @param $conexion La conexion
 * @param $nombre el nombre del tema a buscar
 * @return null retorna nulo si hay algun error y el tema si se encuentra
 */
function findTema($conexion, $nombre)
{
    try {
        $datos = array('nombre' => $nombre);

        $consulta = $conexion->prepare('SELECT * FROM Tema WHERE nombre = :nombre');
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute($datos);

        $tema = $consulta->fetch();
        return $tema;
    } catch (Exception $e) {
        return null;
    }
}

/**
 * @param $conexion La conexion
 * @param $nombre el nombre del tema a insertar
 * @return null si ahy algun error retorna nulo
 */
function insertTema($conexion, $nombre)
{
    try {
        $datos = array('nombre' => $nombre);
        $consulta = $conexion->prepare('INSERT INTO Tema (nombre) VALUES (:nombre)');
        $consulta->execute($datos);
    } catch (Exception $e) {
        return null;
    }
}

/**
 * @param $conexion La conexion
 * @return array retorna un array con todos los temas
 */
function selectAllTema($conexion)
{
    try {
        $consulta = $conexion->prepare("SELECT * FROM tema");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();

        $temas = array();
        while ($tema = $consulta->fetch()) {
            array_push($temas, $tema);
        }
        $conexion = null;
        return $temas;
    } catch (Exception $e) {
        echo $e;
    }
}

/**
 * @param $conexion La conexion
 * @param $id el id de la pregunta de la cual coger los temas
 * @return array un array con los temas de la pregunta cuyo id se suministra
 */
function selectTemaByPreguntaID($conexion, $id)
{
    try {
        $consulta = $conexion->prepare("SELECT tema.* FROM tema,pregunta_has_tema WHERE pregunta_has_tema.Pregunta_idPregunta=:id AND pregunta_has_tema.Tema_idTema = tema.idTema");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id', "$id");
        $consulta->execute();


        $contador = 0;
        $listaTemas = array();
        while ($tema = $consulta->fetch()) {
            $listaTemas[$contador] = $tema;
            $contador++;
        }
        $conexion = null;
        return $listaTemas;
    } catch (Excepcion $e) {
        echo $e;
    }
}

?>
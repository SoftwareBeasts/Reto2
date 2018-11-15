<?php

require 'dbUtils.php';

function findPregunta($idPregunta){
    $conexion = getConnection();

    try{
        $datos = array('idPregunta' => $idPregunta);

        $consulta = $conexion -> prepare('SELECT * FROM Pregunta WHERE idPregunta = :idPregunta');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        $pregunta = $consulta -> fetch();

        $conexion = null;
        return $pregunta;
    }
    catch (Exception $e){
        return null;
    }
}

function insertPregunta($titulo, $cuerpo, $usuario){
    $conexion = getConnection();

    try{
        $datos = array('titulo' => $titulo, 'cuerpo' => $cuerpo, 'usuario' => $usuario);
        $consulta = $conexion -> prepare('INSERT INTO Pregunta (titulo, cuerpo, fecha, idUsuario) VALUES (:titulo, :cuerpo, SYSDATE, :usuario)');
        $consulta -> execute($datos);

        $conexion = null;
    }
    catch (Exception $e){
        return null;
    }
}
?>
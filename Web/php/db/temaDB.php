<?php

require 'dbUtils.php';

function findTema($nombre){
    $conexion = getConnection();

    try{
        $datos = array('nombre' => $nombre);

        $consulta = $conexion -> prepare('SELECT * FROM Tema WHERE nombre = :nombre');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        $tema = $consulta -> fetch();

        $conexion = null;
        return $tema;
    }
    catch (Exception $e){
        return null;
    }
}

function insertTema($nombre){
    $conexion = getConnection();

    try{
        $datos = array('nombre' => $nombre);
        $consulta = $conexion -> prepare('INSERT INTO Tema (nombre) VALUES (:nombre)');
        $consulta -> execute($datos);

        $conexion = null;
    }
    catch (Exception $e){
        return null;
    }
}
?>
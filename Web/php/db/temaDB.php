<?php

function findTema($conexion, $nombre){
    try{
        $datos = array('nombre' => $nombre);

        $consulta = $conexion -> prepare('SELECT * FROM Tema WHERE nombre = :nombre');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        $tema = $consulta -> fetch();
        return $tema;
    }
    catch (Exception $e){
        return null;
    }
}

function insertTema($conexion, $nombre){
    try{
        $datos = array('nombre' => $nombre);
        $consulta = $conexion -> prepare('INSERT INTO Tema (nombre) VALUES (:nombre)');
        $consulta -> execute($datos);
    }
    catch (Exception $e){
        return null;
    }
}
?>
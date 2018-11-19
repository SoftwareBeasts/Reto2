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

function selectAllTema($conexion){
    try{
        $consulta = $conexion->prepare("SELECT * FROM tema");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();

        $temas = array();
        while($tema = $consulta->fetch()){
            array_push($temas,strtolower($tema['nombre']));
        }
        $conexion = null;
        return $temas;
    }catch(Exception $e){
        echo $e;
    }
}
?>
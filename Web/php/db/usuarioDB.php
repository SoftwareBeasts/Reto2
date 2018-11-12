<?php

require 'dbUtils.php';

function findUsuario($correo){
    $conexion = getConnection();

    try{
        $datos = array('correo' => $correo);
        $consulta = $conexion -> prepare('SELECT * FROM usuario WHERE correo = :correo');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        $usuario = $consulta -> fetch();

        if($usuario == null){
            echo "NULL";
        }
        else{
            echo "No es null";
        }

        $conexion = null;
        return $usuario;
    }
    catch (Exception $e){
        return null;
    }
}
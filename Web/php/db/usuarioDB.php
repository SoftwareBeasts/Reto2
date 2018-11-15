<?php

require 'dbUtils.php';

function findUsuario($correo,$id){
    $conexion = getConnection();

    try{
        if($correo == "no"){
            $datos = array('id'=>$id);
            $consulta = $conexion -> prepare('SELECT * FROM usuario WHERE id = :id');
        }else {
            $datos = array('correo' => $correo);
            $consulta = $conexion->prepare('SELECT * FROM usuario WHERE correo = :correo');
        }
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
<?php

require_once 'dbUtils.php';

function findUsuario($conexion,$correo,$id=null){

    try{
        $datos=array();
        if($correo == "no"){
            $datos['id']=$id;
            $consulta = $conexion -> prepare('SELECT * FROM usuario WHERE idUsuario = :id');
        }else {
            $datos['correo']=$correo;
            $consulta = $conexion->prepare('SELECT * FROM usuario WHERE correo = :correo');
        }
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);
        $usuario = $consulta -> fetch();
        $conexion = null;
        return $usuario;
    }
    catch (Exception $e){
        return null;
    }
}

function findUsuarioByNombreUsu($conexion, $nombreusu){
    $encontrado = false;
    try {
        $consulta = $conexion->prepare('SELECT nombreusu FROM usuario WHERE nombreusu = :nombreusu');
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':nombreusu', "$nombreusu");
        $consulta->execute();
        $usuario = $consulta -> fetch();
        if(!$usuario == null)
            $encontrado = true;
        else
            $encontrado = false;
    }
    catch (Exception $e){
    }
    return $encontrado;
}
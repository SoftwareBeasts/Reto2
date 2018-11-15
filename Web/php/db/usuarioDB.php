<?php


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
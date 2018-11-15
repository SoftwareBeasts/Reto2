<?php

require_once 'dbUtils.php';

function findRespuestasByUsuario($usuario){
    $conexion = getConnection();

    try{
        $datos = array('usuario' => $usuario);

        $consulta = $conexion -> prepare('SELECT * FROM Respuesta WHERE Usuario_idUsuario = :usuario');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);

        while($respuesta = $consulta -> fetch())
        {
            $respuestas[]=$respuesta;
        }

        $conexion = null;
        return $respuestas;
    }
    catch (Exception $e){
        return null;
    }
}
?>
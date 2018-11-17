<?php

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
        return $respuestas;
    }
    catch (Exception $e){
        return null;
    }
}

function selectRespuestabyPreguntaID($conexion,$id){
    try{

        $consulta = $conexion->prepare("SELECT  * FROM respuesta WHERE Pregunta_idPregunta = :id LIMIT 1");
        $consulta ->setFetchMode(PDO::FETCH_ASSOC);
        $consulta ->bindValue(':id',"$id");
        $consulta ->execute();

        $respuesta = $consulta->fetch();
        $conexion=null;

        return $respuesta;
    }catch(Exception $e){
        echo $e;
    }
}

function selectAllRespuestabyPreguntaID($conexion,$id){
    try{

        $consulta = $conexion->prepare("SELECT * FROM respuesta WHERE Pregunta_idPregunta = :id");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id',"$id");
        $consulta->execute();

        $listarespuestas = array();
        $contador = 0;
        while($respuesta = $consulta->fetch()){
            $listarespuestas[$contador] = $respuesta;
            $contador++;
        }

        $conexion=null;

        return $listarespuestas;
    }catch(Exception $e){
        echo $e;
    }
}
?>

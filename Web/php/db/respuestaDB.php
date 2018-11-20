<?php

function findRespuestasByUsuario($conexion, $usuario){
    try{
        $datos = array('usuario' => $usuario);

        $consulta = $conexion -> prepare('SELECT * FROM Respuesta WHERE Usuario_idUsuario = :usuario');
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta -> execute($datos);
        $respuestas=array();

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

function insertRespuesta($conexion,$idPregunta,$titulo,$cuerpo,$userID,$archivos=null){
    try{
        $today = date("Y-m-d");

        if ($archivos==null){
            $insert = $conexion->prepare("INSERT INTO respuesta(`titulo`,`cuerpo`,`fecha`,`aprobado`,`Usuario_idUsuario`,`Pregunta_idPregunta`)
                      VALUES(:titulo,:cuerpo,:fecha,:aprobado,:iduser,:idpregunta) ");
            $datos = array(
                "titulo"=>$titulo,
                "cuerpo"=>$cuerpo,
                "fecha"=>$today,
                "aprobado"=>0,
                "iduser"=>$userID,
                "idpregunta"=>$idPregunta
            );
        }else{
            $insert = $conexion->prepare("INSERT INTO respuesta(`titulo`,`cuerpo`,`fecha`,`archivos`,`aprobado`,`Usuario_idUsuario`,`Pregunta_idPregunta`)
                      VALUES(:titulo,:cuerpo,:fecha,:archivos,:aprobado,:iduser,:idpregunta) ");
            $datos = array(
                "titulo"=>$titulo,
                "cuerpo"=>$cuerpo,
                "fecha"=>$today,
                "archivos"=>$archivos,
                "aprobado"=>0,
                "iduser"=>$userID,
                "idpregunta"=>$idPregunta
            );
        }

        $insert->execute($datos);

        $conexion = null;

    }catch(Exception $e){
        echo $e;
    }
}
?>

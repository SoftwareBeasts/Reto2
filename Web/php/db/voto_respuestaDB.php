<?php

function selectAllVotosByRespuestaID ($conexion,$id){
    try{
        $consulta = $conexion->prepare("SELECT * FROM voto_respuesta WHERE Respuesta_idRespuesta = :id");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id',"$id");
        $consulta->execute();

        $listaVotos= array();
        $contador = 0;
        while($voto = $consulta->fetch()){
            $listaVotos[$contador] = $voto;
            $contador++;
        }

        $conexion=null;

        return $listaVotos;

    }catch(Exception $e){
        echo $e;
    }
}

function likeDislikeFinder($conexion, $likeDislikeData){
    $encontrado = [false, false];
    try{
        $consulta = $conexion -> prepare("SELECT `tipo` FROM voto_respuesta 
                                          WHERE Respuesta_idRespuesta = :Respuesta_idRespuesta
                                          AND Usuario_idUsuario = :Usuario_idUsuario");
        $consulta->setFetchMode(PDO::FETCH_OBJ);
        $consulta -> execute($likeDislikeData);
        $resul = $consulta->fetch();

        if(!$resul == null) {
            $encontrado = [true, ((int)$resul->tipo ? true : false)];
        }
    }
    catch (Exception $e){
        return $encontrado;
    }
    return $encontrado;
}

//Cuando hay un voto y lo cambias hace otra insert en vez de alter (Mirar el if de $alter)
function insertLikeDislike($conexion, $likeDislikeData, $alter){
    $correcto = false;
    try{
        if($alter !== "TRUE"){
            $consulta = $conexion -> prepare('INSERT INTO voto_respuesta (`tipo`, `Respuesta_idRespuesta`, `Usuario_idUsuario`) 
                                          VALUES (:type, :Respuesta_idRespuesta, :Usuario_idUsuario)');
        }
        else{
            $consulta = $conexion -> prepare('UPDATE voto_respuesta SET tipo = :type
                                          WHERE Respuesta_idRespuesta = :Respuesta_idRespuesta
                                           AND Usuario_idUsuario = :Usuario_idUsuario');
        }
        $consulta -> execute($likeDislikeData);
        //$correcto = $consulta -> errorCode();
        $correcto = true;

    }
    catch (Exception $e){
    }
    return $correcto;
}
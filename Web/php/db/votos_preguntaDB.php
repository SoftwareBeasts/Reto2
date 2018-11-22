<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 21/11/2018
 * Time: 9:39
 */
/*SELECT `idPRe` FROM ( SELECT `contados`,`idPre` FROM ( SELECT COUNT(*) AS `contados`,Pregunta_idPregunta AS `idPre` FROM `respuesta` GROUP BY Pregunta_idPregunta) AS contar1 ORDER BY `contados` DESC LIMIT 20 ) AS contar2*/

function likeDislikeFinderP($conexion,$likeDislikeData){
    $encontrado = [false,false];
    try{
        $consulta = $conexion->prepare("SELECT `tipo` FROM voto_pregunta
                                        WHERE Pregunta_idPregunta = :Pregunta_idPregunta
                                        AND Usuario_idUsuario = :Usuario_idUsuario");
        $consulta->setFetchMode(PDO::FETCH_OBJ);
        $consulta->execute($likeDislikeData);
        $resul = $consulta->fetch();

        if(!$resul == null){
            $encontrado = [true, ((int)$resul->tipo ? true:false)];
        }

    }catch(Eception $e){
        return $encontrado;
    }
    return $encontrado;
}

function insertLikeDislikeP($conexion,$likeDislikeData,$alter){
    $correcto = false;
    try{
        if($alter !== "TRUE"){
            $consulta = $conexion->prepare('INSERT INTO voto_pregunta (`tipo`,`Pregunta_idPregunta`,`Usuario_idUsuario`)
                                        VALUES (:type, :Pregunta_idPregunta, :Usuario_idUsuario)');
        }
        else{
            $consulta = $conexion -> prepare('UPDATE voto_pregunta SET tipo = :type
                                        WHERE Pregunta_idPregunta = :Pregunta_idPregunta
                                        AND Usuario_idUsuario = :Usuario_idUsuario');
        }
        $consulta->execute($likeDislikeData);
        //$correcto = $consulta ->errorCode();
        $correcto = true;

    }catch(Exception $e){
    }
    return $correcto;
}
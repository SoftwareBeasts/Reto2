<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 15/11/2018
 * Time: 9:47
 */

function selectRespuestabyPreguntaID($conexion,$id){
    try{

        $consulta = $conexion->prepare("SELECT  * FROM pregunta WHERE Pregunta_idPregunta = :id LIMIT 1");
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
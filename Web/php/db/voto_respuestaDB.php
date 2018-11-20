<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 16/11/2018
 * Time: 10:22
 */

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
<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 13/11/2018
 * Time: 12:11
 */


function selectRecientes($connection){

    try {
        $consulta = $connection->prepare("SELECT * FROM pregunta ORDER BY fecha DESC LIMIT  20");
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta ->execute();
        $listaPreguntas=array();
        $id = 0;

        while($pregunta = $consulta->fetch()){
            $listaPreguntas[$id] = $pregunta;
            $id++;
        }

        $connection=null;
        return $listaPreguntas;
    }
    catch(Exception $e){
        echo $e;
    }
}

function selectMasVotadas($conexion){
    try{
        echo "Funcionalidad aun no añadida";

    }catch(Exception $e){
        echo $e;
    }
}

function selectPreguntabyID($conexion,$id){
    try{

        $consulta = $conexion->prepare("SELECT * FROM pregunta WHERE idPregunta = :id");
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->bindValue(':id',"$id");
        $consulta->execute();
        $pregunta = $consulta -> fetch();

        $conexion=null;
        return $pregunta;
    }catch (Exception $e){
        echo $e;
    }
}
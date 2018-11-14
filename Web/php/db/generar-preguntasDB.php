<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 13/11/2018
 * Time: 12:11
 */
require "dbUtils.php";
if(session_id()==''){
    session_start();
}

function seleccionarRecientes(){


    $connection = getConnection();
    try {
        $consulta = $connection->prepare("SELECT * FROM pregunta ORDER BY fecha DESC LIMIT  20");
        $consulta -> setFetchMode(PDO::FETCH_ASSOC);
        $consulta ->execute();
        $listaPreguntas=array();
        $id = 0;

        while($pregunta = $consulta->fetch()){
            $listaPreguntas[$id] = $pregunta;
            $id++;
            echo "hola";
        }

        $connection=null;
        return $listaPreguntas;
    }
    catch(Exception $e){
        echo $e;
    }
}

function obtenerUltimaFecha(){

}
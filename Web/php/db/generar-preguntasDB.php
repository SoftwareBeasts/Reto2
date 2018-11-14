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
if(!isset($_SESSION['listaPreguntas'])){
    $_SESSION['listaPreguntas'] = new DOMNodeList();
}
function seleccionarRecientes(){

}

function obtenerUltimaFecha(){

}
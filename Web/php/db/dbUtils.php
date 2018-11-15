<?php
require "preguntasDB.php";
require "usuarioDB.php";
require "respuestaDB.php";
function getConnection(){
    $bbdd = "mysql:host=localhost;dbname=reto2_bbdd;charset=utf8";
    $usuario = "root";
    $pass = "";

    try{
        $conexion = new PDO($bbdd, $usuario, $pass);
        return $conexion;
    }
    catch (PDOException $e) {
        echo "Fallo en la conexión: ".$e -> getMessage();
        $conexion = null;
        return $conexion;
    }
}
function encontrarUsuario($correo,$id=null){
    $conexion = getConnection();
    $usuario = findUsuario($conexion,$correo,$id);
    return $usuario;
}
function seleccionarRecientes(){
    $conexion = getConnection();
    $listaPreguntas = selectRecientes($conexion);
    foreach ($listaPreguntas as $clave => $valor){
        $conexion = getConnection();
        $temp = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['Usuario_idUsuario'] = $temp['nombreusu'];
    }
    return $listaPreguntas;
}
function seleccionarMasVotadas(){
    $conexion = getConnection();
    $listaPreguntas = selectMasVotadas($conexion);
}

function seleccionarSinResponder($id=null){
    $contador = 1;
    if ($id!=null){
        $contador = $id;
    }

    $listaPreguntas=array();
    while(sizeof($listaPreguntas)<10){
        $conexion = getConnection();
        $respuesta = selectRespuestabyPreguntaID($conexion,$contador);
        if($respuesta['Pregunta_idPregunta']==null){
            $conexion = getConnection();
            $pregunta = selectPreguntabyID($conexion,$contador);
            $listaPreguntas[$contador] = $pregunta;
        }
        $contador++;
    }
    return $listaPreguntas;


}
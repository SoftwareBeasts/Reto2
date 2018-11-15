<?php
require "preguntasDB.php";
require "usuarioDB.php";
require "respuestaDB.php";

if(isset($_POST['nombreusu'])){
    $resultado = verificarNombreUsuario($_POST['nombreusu']);
    echo($resultado);
}

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
    if ($id==null){
        $id = 1;
    }
    $pregunta = " ";
    $listaPreguntas=array();
    while(sizeof($listaPreguntas)<10&&$pregunta!=null){
        $conexion = getConnection();
        $pregunta = selectPreguntabyID($conexion,$id);
        $conexion = getConnection();
        $respuesta = selectRespuestabyPreguntaID($conexion,$id);
        if($respuesta['Pregunta_idPregunta']==null){
            if($pregunta!=null) {
                $listaPreguntas[$id] = $pregunta;
            }
        }

        $id++;
    }

    return $listaPreguntas;
}

function seleccionarRespondidas($id=null){
    if($id==null){
        $id=1;
    }
    $pregunta=" ";
    $listaPreguntas=array();
    while(sizeof($listaPreguntas)<10&&$pregunta!=null){
        $conexion = getConnection();
        $pregunta = selectPreguntabyID($conexion,$id);
        $conexion = getConnection();
        $respuesta = selectRespuestabyPreguntaID($conexion,$id);
        if($respuesta['Pregunta_idPregunta']!=null){
            if($pregunta!=null) {
                $listaPreguntas[$id] = $pregunta;
            }
        }

        $id++;
    }

    return $listaPreguntas;
}

function verificarNombreUsuario($nombreusu){
    $conexion = getConnection();
    $encontrado = findUsuarioByNombreUsu($conexion, $nombreusu);
    return $encontrado;
}
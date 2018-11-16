<?php
require_once "preguntaDB.php";
require_once "temaDB.php";
require_once "preguntasDB.php";
require_once "usuarioDB.php";
require_once "respuestaDB.php";

if(isset($_POST['nombreusu'])){
    $resultado = verificarNombreUsuario($_POST['nombreusu']);
    die($resultado);
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

function registrarUsuario($datos){
    $conexion = getConnection();
    $correcto = altaUsuario($conexion, $datos);
    return $correcto;
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

function insertarPregunta($titulo, $descripcion, $categorias, $usuario){
    $conexion = getConnection();
    insertPregunta($conexion, $titulo, $descripcion, $usuario);
    $pregunta=findPregunta($conexion, $titulo, $descripcion, $usuario);

    foreach($categorias as $elements)
    {
        $categoria=findTema($conexion, $elements);

        if($categoria == null)
        {
            insertTema($conexion, $elements);
            $categoria=findTema($conexion, $elements);
        }
        insertPreguntaTema($conexion, $pregunta["idPregunta"],$categoria["idTema"]);
    }
    $conexion=null;
}

function buscarPreguntasRespuestasUsuario($tipo, $usuario){
    $conexion = getConnection();
    switch ($tipo){
        case "Preguntas":
            $preguntas=findPreguntasByUsuario($conexion, $usuario);
            break;
        case "Respuestas":
            $respuestas=findRespuestasByUsuario($conexion, $usuario);
            foreach ($respuestas as $clave=>$valor)
            {
                $preguntas[]=findPreguntaById($conexion, $valor["idRespuesta"]);
            }
            break;
    }
    $conexion=null;
    return $preguntas;
}
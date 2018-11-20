<?php
require_once "preguntaDB.php";
require_once "temaDB.php";
require_once "preguntasDB.php";
require_once "usuarioDB.php";
require_once "respuestaDB.php";
require_once "voto_respuestaDB.php";

if(isset($_POST['value']) && isset($_POST['verificarUsuarioRegistrado'])){
    if($_POST['verificarUsuarioRegistrado'])
        $resultado = verificarNombreUsuario($_POST['value']);
    else
        $resultado = verificarEmailUsuario($_POST['value']);
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

function registrarUsuario($datos) {
    $conexion = getConnection();
    if(!findUsuarioByEmail($conexion, $datos['correo'])){
        $correcto = altaUsuario($conexion, $datos);
    }
    else
        throw new Exception("Email ya registrado");

    return $correcto;
}

function seleccionarRecientes(){
    $conexion = getConnection();
    $listaPreguntas = selectRecientes($conexion);
    foreach ($listaPreguntas as $clave => $valor){
        $conexion = getConnection();
        $tempUser = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['Usuario_idUsuario'] = $tempUser['nombreusu'];
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
    foreach ($listaPreguntas as $clave => $valor){
        $conexion = getConnection();
        $tempUser = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['Usuario_idUsuario'] = $tempUser['nombreusu'];
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
    foreach ($listaPreguntas as $clave => $valor){
        $conexion = getConnection();
        $tempUser = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['Usuario_idUsuario'] = $tempUser['nombreusu'];
    }

    return $listaPreguntas;
}

function verificarNombreUsuario($nombreusu){
    $conexion = getConnection();
    $encontrado = findUsuarioByNombreUsu($conexion, $nombreusu);
    return $encontrado;
}

function verificarEmailUsuario($correo){
    $conexion = getConnection();
    $encontrado = findUsuarioByemail($conexion, $correo);
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

function buscarPreguntasRespuestasUsuario($tipo, $usuario)
{
    $conexion = getConnection();
    switch ($tipo) {
        case "Preguntas":
            $preguntas = findPreguntasByUsuario($conexion, $usuario);
            break;
        case "Respuestas":
            $respuestas = findRespuestasByUsuario($conexion, $usuario);
            foreach ($respuestas as $clave => $valor) {
                $preguntas[] = findPreguntaById($conexion, $valor["idRespuesta"]);
            }
            break;
    }
    $conexion = null;
    return $preguntas;
}

function cargarDatosPreguntabyId($id){
    $datosPregunta = array();
    $conexion = getConnection();
    $datosPregunta['pregunta'] = selectPreguntabyID($conexion,$id);
    $conexion = getConnection();
    $datosPregunta['usuario'] = findUsuario($conexion,"no",$datosPregunta['pregunta']['Usuario_idUsuario']);
    $conexion = getConnection();
    $datosPregunta['respuestas'] = selectAllRespuestabyPreguntaID($conexion,$id);
    foreach ($datosPregunta['respuestas'] as $clave => $valor){
        $conexion = getConnection();
        $tempUser = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
        $datosPregunta['respuestas'][$clave]['Usuario_idUsuario'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempVotos = selectAllVotosByRespuestaID($conexion,$valor['idRespuesta']);
        $datosPregunta['respuestas'][$clave]['votos'] = $tempVotos;
    }

    return $datosPregunta;
}
/*Responder a una Pregunta*/
function responderPregunta($idPregunta,$titulo,$cuerpo,$userID,$archivos=null){
    $conexion = getConnection();
    insertRespuesta($conexion,$idPregunta,$titulo,$cuerpo,$userID,$archivos);
}

/*Busqueda Personalizada*/
    function filtrarTemas($compuesto){
        $conexion = getConnection();
        $allTemas = selectAllTema($conexion);
        $temasEncontrados = array();
        foreach ($compuesto as $item){
            foreach ($allTemas as $tema){
                if($item==$tema['nombre']){
                    array_push($temasEncontrados,$tema);
                }
            }
        }
        return $temasEncontrados;
    }


    function seleccionarPreguntasByTemaID($temas,$regex,$id=null){
        $conexion = getConnection();
        $preguntas = selectPreguntabyTemas($conexion,$temas,$regex,$id);

        foreach ($preguntas as $clave => $valor){
            $conexion = getConnection();
            $tempUser = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
            $preguntas[$clave]['Usuario_idUsuario'] = $tempUser['nombreusu'];
        }


        return $preguntas;
    }

/*Busqueda Personalizada*/
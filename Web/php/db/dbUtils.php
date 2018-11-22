<?php
require_once "preguntaDB.php";
require_once "temaDB.php";
require_once "preguntasDB.php";
require_once "usuarioDB.php";
require_once "respuestaDB.php";
require_once "voto_respuestaDB.php";
require_once "votos_preguntaDB.php";

if(isset($_POST['value']) && isset($_POST['verificarUsuarioRegistrado'])){
    if($_POST['verificarUsuarioRegistrado'])
        $resultado = verificarNombreUsuario($_POST['value']);
    else
        $resultado = verificarEmailUsuario($_POST['value']);
    die($resultado);
}
/*Respuesta*/
if(isset($_GET['idRespuesta']) && isset($_GET['userId'])){
    if(isset($_GET['type'])){

        if($_GET['type'] === "true")
            $tipo = 1;
        else
            $tipo = 0;

        $likeDislikeData = array('type' => (int)$tipo, 'Respuesta_idRespuesta' => (int)$_GET['idRespuesta'],
            'Usuario_idUsuario' => (int)$_GET['userId']);
        $encontrado = setLikeDislike($likeDislikeData, $_GET['alter']);
    }
    else{
        $likeDislikeData = array('Respuesta_idRespuesta' => $_GET['idRespuesta'],
            'Usuario_idUsuario' => $_GET['userId']);
        $encontrado = findLikeDislike($likeDislikeData);
    }
    die(json_encode($encontrado));
}
/*Pregunta*/
if(isset($_GET['idPregunta'],$_GET['userId'])){
    if(isset($_GET['type'])){
        if ($_GET['type']==="true")
            $tipo = 1;
        else
            $tipo = 0;

        $likeDislikeData = array('type'=>(int)$tipo, 'Pregunta_idPregunta' => (int)$_GET['idPregunta'],
            'Usuario_idUsuario' => (int)$_GET['userId']);
        $encontrado = setLikeDislikeP($likeDislikeDataP,$_GET['alter']);
    }else{
        $likeDislikeData = array('Pregunta_idPregunta'=>$_GET['idPregunta'],
            'Usuario_idUsuario'=> $_GET['userId']);
        $encontrado = findLikeDislikeP($likeDislikeData);
    }
    die(json_encode($encontrado));
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
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion,$valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion,$valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
    }

    return $listaPreguntas;
}
function seleccionarMasVotadas(){
    $conexion = getConnection();
    $listaPreguntas = selectMasVotadas($conexion);
    foreach ($listaPreguntas as $clave=> $valor){
        $conexion = getConnection();
        $tempUser = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion,$valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion,$valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
    }

    return $listaPreguntas;
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
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion,$valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion,$valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
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
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion,$valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion,$valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
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
    $preguntas=array();
    switch ($tipo) {
        case "Preguntas":
            $preguntas = findPreguntasByUsuario($conexion, $usuario);
            foreach ($preguntas as $clave=>$valor){
                $conexion=getConnection();
                $listaTemas = selectTemaByPreguntaID($conexion,$valor['idPregunta']);
                $preguntas[$clave]['temas'] = $listaTemas;
                $conexion = getConnection();
                $tempVotos = selectVotosByPreguntaID($conexion,$valor['idPregunta']);
                $listaPreguntas[$clave]['votos'] = $tempVotos;
            }
            break;
        case "Respuestas":
            $respuestas = findRespuestasByUsuario($conexion, $usuario);
            foreach ($respuestas as $clave => $valor) {
                $preguntas[] = findPreguntaById($conexion, $valor["Pregunta_idPregunta"]);
            }
            $conexion=null;
            foreach ($preguntas as $clave=>$valor){
                $conexion=getConnection();
                $listaTemas = selectTemaByPreguntaID($conexion,$valor['idPregunta']);
                $preguntas[$clave]['temas'] = $listaTemas;
                $conexion = getConnection();
                $tempVotos = selectVotosByPreguntaID($conexion,$valor['idPregunta']);
                $listaPreguntas[$clave]['votos'] = $tempVotos;
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
    $datosPregunta['pregunta']['votos'] = selectVotosByPreguntaID($conexion,$id);
    $conexion = getConnection();
    $datosPregunta['usuario'] = findUsuario($conexion,"no",$datosPregunta['pregunta']['Usuario_idUsuario']);
    $conexion = getConnection();
    $datosPregunta['respuestas'] = selectAllRespuestabyPreguntaID($conexion,$id);
    foreach ($datosPregunta['respuestas'] as $clave => $valor){
        $conexion = getConnection();
        $tempUser = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
        $datosPregunta['respuestas'][$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempVotos = selectAllVotosByRespuestaID($conexion,$valor['idRespuesta']);
        $datosPregunta['respuestas'][$clave]['votos'] = $tempVotos;

    }

    return $datosPregunta;
}

function findLikeDislike($likeDislikeData){
    $conexion = getConnection();
    $encontrado = likeDislikeFinder($conexion, $likeDislikeData);
    return $encontrado;
}
function findLikeDislikeP($likeDislikeData){
    $conexion = getConnection();
    $encontrado = likeDislikeFinderP($conexion,$likeDislikeData);
    return $encontrado;
}

function setLikeDislike($likeDislikeData, $alter){
    $conexion = getConnection();
    $correcto = insertLikeDislike($conexion, $likeDislikeData, $alter);
    return $correcto;
}
function setLikeDislikeP($likeDislikeData,$alter){
    $conexion = getConnection();
    $correcto = insertLikeDislikeP($conexion,$likeDislikeData,$alter);
    return $correcto;
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


    function seleccionarPreguntasByTemaID($temas,$regex,$id=null)
    {
        if ($id == null) {
            $id = 0;
        }
        $pregunta = " ";
        $contador = 0;
        $listaPreguntas = array();
        while (sizeof($listaPreguntas) < 10 && !$pregunta == null) {
            $conexion = getConnection();
            $pregunta = selectPreguntabyTemas($conexion, $temas,$id);
            if(!$pregunta==null) {
                if (preg_match($regex, $pregunta['titulo'])) {
                    $listaPreguntas[$contador] = $pregunta;
                    $contador++;
                }
            }
            $id = $pregunta['idPregunta'];
        }
        foreach ($listaPreguntas as $clave => $valor){
            $conexion = getConnection();
            $tempUser = findUsuario($conexion,"no",$valor['Usuario_idUsuario']);
            $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
            $conexion = getConnection();
            $tempListaTemas = selectTemaByPreguntaID($conexion,$valor['idPregunta']);
            $listaPreguntas[$clave]['temas'] = $tempListaTemas;
            $conexion = getConnection();
            $tempVotos = selectVotosByPreguntaID($conexion,$valor['idPregunta']);
            $listaPreguntas[$clave]['votos'] = $tempVotos;
        }


        return $listaPreguntas;
    }

/*Busqueda Personalizada*/
/*Cargar los Temas*/
    function seleccionarTodosTemas(){
        $conexion = getConnection();
        $listaTemas = selectAllTema($conexion);
        return $listaTemas;
    }
/*Cargar los Temas*/
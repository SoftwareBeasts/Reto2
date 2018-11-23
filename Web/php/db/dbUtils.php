<?php
require_once "preguntaDB.php";
require_once "temaDB.php";
require_once "preguntasDB.php";
require_once "usuarioDB.php";
require_once "respuestaDB.php";
require_once "voto_respuestaDB.php";
require_once "votos_preguntaDB.php";

if (isset($_POST['value']) && isset($_POST['verificarUsuarioRegistrado'])) {
    if ($_POST['verificarUsuarioRegistrado'])
        $resultado = verificarNombreUsuario($_POST['value']);
    else
        $resultado = verificarEmailUsuario($_POST['value']);
    die($resultado);
}
/*Controlar los likes de las respuestas*/
/*Respuesta*/
if (isset($_GET['idRespuesta']) && isset($_GET['userId'])) {
    if (isset($_GET['type'])) {

        if ($_GET['type'] === "true")
            $tipo = 1;
        else
            $tipo = 0;

        $likeDislikeData = array('type' => (int)$tipo, 'Respuesta_idRespuesta' => (int)$_GET['idRespuesta'],
            'Usuario_idUsuario' => (int)$_GET['userId']);
        $encontrado = setLikeDislike($likeDislikeData, $_GET['alter']);
    } else {
        $likeDislikeData = array('Respuesta_idRespuesta' => $_GET['idRespuesta'],
            'Usuario_idUsuario' => $_GET['userId']);
        $encontrado = findLikeDislike($likeDislikeData);
    }
    die(json_encode($encontrado));
}
/*Controlar los likes de las preguntas*/
/*Pregunta*/
if (isset($_GET['idPregunta'], $_GET['userId'])) {
    if (isset($_GET['type'])) {
        if ($_GET['type'] === "true")
            $tipo = 1;
        else
            $tipo = 0;

        $likeDislikeData = array('type' => (int)$tipo, 'Pregunta_idPregunta' => (int)$_GET['idPregunta'],
            'Usuario_idUsuario' => (int)$_GET['userId']);
        $encontrado = setLikeDislikeP($likeDislikeData, $_GET['alter']);
    } else {
        $likeDislikeData = array('Pregunta_idPregunta' => $_GET['idPregunta'],
            'Usuario_idUsuario' => $_GET['userId']);
        $encontrado = findLikeDislikeP($likeDislikeData);
    }
    die(json_encode($encontrado));
}

/**
 * @return null|PDO Devuelve la conexion solo si se hace correctamente
 */
function getConnection()
{
    $bbdd = "mysql:host=localhost;dbname=reto2_bbdd;charset=utf8";
    $usuario = "root";
    $pass = "";

    try {
        $conexion = new PDO($bbdd, $usuario, $pass);
        return $conexion;
    } catch (PDOException $e) {
        echo "Fallo en la conexión: " . $e->getMessage();
        $conexion = null;
        return $conexion;
    }
}

/**
 * @param $correo el correo del usuario
 * @param null $id el id del usuario a buscar
 * @return null retorna el usuario
 *
 * Busca al usuario y si lo encuenra lo devuelve
 */
function encontrarUsuario($correo, $id = null)
{
    $conexion = getConnection();
    $usuario = findUsuario($conexion, $correo, $id);
    return $usuario;
}

/**
 * @param $datos Los datos del usuario
 * @return bool retorna true si se ejecuta correctamente
 * @throws Exception lanza una excepcion si encuentra el email
 *
 * Registra al usuario en la base de datos
 */
function registrarUsuario($datos)
{
    $conexion = getConnection();
    if (!findUsuarioByEmail($conexion, $datos['correo'])) {
        $correcto = altaUsuario($conexion, $datos);
    } else
        throw new Exception("Email ya registrado");

    return $correcto;
}

/**
 * @return array contiene las preguntas recientes
 *
 * Devuelve un array con las 20 preguntas más recientes y todos los datos necesarios para despues visualizarlas
 */
function seleccionarRecientes()
{
    $conexion = getConnection();
    $listaPreguntas = selectRecientes($conexion);
    foreach ($listaPreguntas as $clave => $valor) {
        $conexion = getConnection();
        $tempUser = findUsuario($conexion, "no", $valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
    }

    return $listaPreguntas;
}

/**
 * @return array contiene las preguntas más votadas
 *
 * Devuelve un array con las 20 preguntas mas votadas
 */
function seleccionarMasVotadas()
{
    $conexion = getConnection();
    $listaPreguntas = selectMasVotadas($conexion);
    foreach ($listaPreguntas as $clave => $valor) {
        $conexion = getConnection();
        $tempUser = findUsuario($conexion, "no", $valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
    }

    return $listaPreguntas;
}

/**
 * @param null $id id opcional que indica desde que id hay que ejecutar la busqueda
 * @return array contiene las preguntas sin responder(10)
 *
 * Coge las 10 preguntas sin responder a partir del id marcado
 */
function seleccionarSinResponder($id = null)
{
    if ($id == null) {
        $id = 1;
    }
    $pregunta = " ";
    $listaPreguntas = array();
    while (sizeof($listaPreguntas) < 10 && $pregunta != null) {
        $conexion = getConnection();
        $pregunta = selectPreguntabyID($conexion, $id);
        $conexion = getConnection();
        $respuesta = selectRespuestabyPreguntaID($conexion, $id);
        if ($respuesta['Pregunta_idPregunta'] == null) {
            if ($pregunta != null) {
                $listaPreguntas[$id] = $pregunta;
            }
        }

        $id++;
    }
    foreach ($listaPreguntas as $clave => $valor) {
        $conexion = getConnection();
        $tempUser = findUsuario($conexion, "no", $valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
    }

    return $listaPreguntas;
}

/**
 * @param null $id id opcional para indicar desde que pregunta hay que ejecutar la busqueda
 * @return array contiene 10 preguntas respondidas
 *
 * Coge los datos de 10 preguntas respondidas a partir del id enviado
 */
function seleccionarRespondidas($id = null)
{
    if ($id == null) {
        $id = 1;
    }
    $pregunta = " ";
    $listaPreguntas = array();
    while (sizeof($listaPreguntas) < 10 && $pregunta != null) {
        $conexion = getConnection();
        $pregunta = selectPreguntabyID($conexion, $id);
        $conexion = getConnection();
        $respuesta = selectRespuestabyPreguntaID($conexion, $id);
        if ($respuesta['Pregunta_idPregunta'] != null) {
            if ($pregunta != null) {
                $listaPreguntas[$id] = $pregunta;
            }
        }

        $id++;
    }
    foreach ($listaPreguntas as $clave => $valor) {
        $conexion = getConnection();
        $tempUser = findUsuario($conexion, "no", $valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
    }

    return $listaPreguntas;
}

/**
 * @param $nombreusu nombre del usuario
 * @return bool true si se encuentra false si no
 *
 * Comprueba que el nombre de usuario existe
 */
function verificarNombreUsuario($nombreusu)
{
    $conexion = getConnection();
    $encontrado = findUsuarioByNombreUsu($conexion, $nombreusu);
    return $encontrado;
}

/**
 * @param $correo correo del usuario
 * @return bool true si se encuentra false si no
 *
 * Comprueba que el correo exista
 */
function verificarEmailUsuario($correo)
{
    $conexion = getConnection();
    $encontrado = findUsuarioByemail($conexion, $correo);
    return $encontrado;
}

/**
 * @param $titulo el titulo de la pregunta
 * @param $descripcion el cuerpo de la pregunta
 * @param $categorias los temas de la pregunta
 * @param $usuario el usuario que ha formulado la pregunta
 *
 * Inserta una pregunta en la base de datos
 */
function insertarPregunta($titulo, $descripcion, $categorias, $usuario)
{
    $conexion = getConnection();
    insertPregunta($conexion, $titulo, $descripcion, $usuario);
    $pregunta = findPregunta($conexion, $titulo, $descripcion, $usuario);

    foreach ($categorias as $elements) {
        $categoria = findTema($conexion, $elements);

        if ($categoria == null) {
            insertTema($conexion, $elements);
            $categoria = findTema($conexion, $elements);
        }
        insertPreguntaTema($conexion, $pregunta["idPregunta"], $categoria["idTema"]);
    }
    $conexion = null;
}

/**
 * @param $tipo string el tipo de busqueda que hay que ejecutar
 * @param $usuario el usuario del cual se están recogiendo los datos
 * @return array|null    un array conteniendo las preguntas que ha formulado el ususario, o las preguntas a las cuales ha respondido
 *
 * Busca las preguntas/respuestas de un usuario para mostrarlas en su perfil
 */
function buscarPreguntasRespuestasUsuario($tipo, $usuario)
{
    $conexion = getConnection();
    $preguntas = array();
    switch ($tipo) {
        case "Preguntas":
            $preguntas = findPreguntasByUsuario($conexion, $usuario);
            foreach ($preguntas as $clave => $valor) {
                $conexion = getConnection();
                $listaTemas = selectTemaByPreguntaID($conexion, $valor['idPregunta']);
                $preguntas[$clave]['temas'] = $listaTemas;
                $conexion = getConnection();
                $tempVotos = selectVotosByPreguntaID($conexion, $valor['idPregunta']);
                $listaPreguntas[$clave]['votos'] = $tempVotos;
            }
            break;
        case "Respuestas":
            $respuestas = findRespuestasByUsuario($conexion, $usuario);
            foreach ($respuestas as $clave => $valor) {
                $preguntas[] = findPreguntaById($conexion, $valor["Pregunta_idPregunta"]);
            }
            $conexion = null;
            foreach ($preguntas as $clave => $valor) {
                $conexion = getConnection();
                $listaTemas = selectTemaByPreguntaID($conexion, $valor['idPregunta']);
                $preguntas[$clave]['temas'] = $listaTemas;
                $conexion = getConnection();
                $tempVotos = selectVotosByPreguntaID($conexion, $valor['idPregunta']);
                $listaPreguntas[$clave]['votos'] = $tempVotos;
            }
            break;
    }
    $conexion = null;
    return $preguntas;
}

/**
 * @param $id el id de la pregunta cuyos datos hay que cargar
 * @return array un array bastante complejo con los datos de la pregunta a cargar
 *
 * Carga los datos de la pregunta, sus votos, categorias, respuestas, votos de las respuestas, para mostrarlos
 */
function cargarDatosPreguntabyId($id)
{
    $datosPregunta = array();
    $conexion = getConnection();
    $datosPregunta['pregunta'] = selectPreguntabyID($conexion, $id);
    $conexion = getConnection();
    $datosPregunta['pregunta']['votos'] = selectVotosByPreguntaID($conexion, $id);
    $conexion = getConnection();
    $datosPregunta['usuario'] = findUsuario($conexion, "no", $datosPregunta['pregunta']['Usuario_idUsuario']);
    $conexion = getConnection();
    $datosPregunta['respuestas'] = selectAllRespuestabyPreguntaID($conexion, $id);
    $conexion = getConnection();
    $listaTemas = selectTemaByPreguntaID($conexion, $id);
    if (sizeof($listaTemas) > 0) {
        $datosPregunta['temas'] = $listaTemas;
    }
    foreach ($datosPregunta['respuestas'] as $clave => $valor) {
        $conexion = getConnection();
        $tempUser = findUsuario($conexion, "no", $valor['Usuario_idUsuario']);
        $datosPregunta['respuestas'][$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempVotos = selectAllVotosByRespuestaID($conexion, $valor['idRespuesta']);
        $datosPregunta['respuestas'][$clave]['votos'] = $tempVotos;

    }

    return $datosPregunta;
}

/**
 * @param $likeDislikeData datos de los likes y los dislikes
 * @return array un array con los likes y los dislikes de la respuesta
 *
 * Busca los likes y los dislikes de la respuesta a la cual se quiere introducir un nuevo like para comprobar que ya existe.
 */
function findLikeDislike($likeDislikeData)
{
    $conexion = getConnection();
    $encontrado = likeDislikeFinder($conexion, $likeDislikeData);
    return $encontrado;
}

/**
 * @param $likeDislikeData datos de los likes y los dislikes
 * @return array un array con los likes y los dislikes de la pregunta
 *
 * Busca los likes y los dislikes de la repuesta a la cual se quiere introducir un nuevo like para comprobar que ya existe
 */
function findLikeDislikeP($likeDislikeData)
{
    $conexion = getConnection();
    $encontrado = likeDislikeFinderP($conexion, $likeDislikeData);
    return $encontrado;
}

/**
 * @param $likeDislikeData datos de los likes y los dislikes
 * @param $alter true|false si hay o no que ejecutar un alter en lugar de un insert
 * @return bool true|false si se ha hecho correctamente o no
 *
 * Introduce un like o un dislike a la respuesta correcta o lo altera si ya se habia votado a esa respuesta
 */
function setLikeDislike($likeDislikeData, $alter)
{
    $conexion = getConnection();
    $correcto = insertLikeDislike($conexion, $likeDislikeData, $alter);
    return $correcto;
}

/**
 * @param $likeDislikeData datos de los likes y los dislikes
 * @param $alter true|false si hay o no que ejecutar un alter en lugar de un inset
 * @return bool true|false si se ha hecho correctamente o no
 *
 * Introduce un like o un dislike a la pregunta o lo altera si ya se habia votado a esa pregunta
 */
function setLikeDislikeP($likeDislikeData, $alter)
{
    $conexion = getConnection();
    $correcto = insertLikeDislikeP($conexion, $likeDislikeData, $alter);
    return $correcto;
}

/*Responder a una Pregunta*/
/**
 * @param $idPregunta id de la pregunta a la que se va a responder
 * @param $titulo el titulo de la respuesta
 * @param $cuerpo el cuerpo de la respuesta
 * @param $userID el id del usuario que ha formulado la repsuesta
 * @param null $archivos os archivos adicionales que se han añadido para responder
 *
 * Introduce una respuesta a la pregunta correcta con los datos que se le suministra.
 */
function responderPregunta($idPregunta, $titulo, $cuerpo, $userID, $archivos = null)
{
    $conexion = getConnection();
    insertRespuesta($conexion, $idPregunta, $titulo, $cuerpo, $userID, $archivos);
}

/*Busqueda Personalizada*/
/**
 * @param $compuesto array con la busqueda que hace el usuario
 * @return array retorna un array con los temas que coinciden con la busqueda
 *
 * Filtra los temas, cogiendo solo los que se encuentren dentro del array que se suministra
 */
function filtrarTemas($compuesto)
{
    $conexion = getConnection();
    $allTemas = selectAllTema($conexion);
    $temasEncontrados = array();
    foreach ($compuesto as $item) {
        foreach ($allTemas as $tema) {
            if ($item == $tema['nombre']) {
                array_push($temasEncontrados, $tema);
            }
        }
    }
    return $temasEncontrados;
}

/**
 * @param $temas array con los id de los temas por los que hay que buscar preguntas
 * @param $regex una exxpresion regular para controlar que las preguntas que se recuperan tengan al menos una palabra de la busqueda que ha hecho el usuario
 * @param null $id id por el cual hay que empezar a buscar preguntas
 * @return array un array con las preguntas que cumplen todos los criterios de busqueda
 *
 * Selecciona las preguntas que coincidan con los id de los temas.
 */
function seleccionarPreguntasByTemaID($temas, $regex, $id = null)
{
    if ($id == null) {
        $id = 0;
    }
    $pregunta = " ";
    $contador = 0;
    $listaPreguntas = array();
    while (sizeof($listaPreguntas) < 10 && !$pregunta == null) {
        $conexion = getConnection();
        $pregunta = selectPreguntabyTemas($conexion, $temas, $id);
        if (!$pregunta == null) {
            if (preg_match($regex, $pregunta['titulo'])) {
                $listaPreguntas[$contador] = $pregunta;
                $contador++;
            }
        }
        $id = $pregunta['idPregunta'];
    }
    foreach ($listaPreguntas as $clave => $valor) {
        $conexion = getConnection();
        $tempUser = findUsuario($conexion, "no", $valor['Usuario_idUsuario']);
        $listaPreguntas[$clave]['nombre'] = $tempUser['nombreusu'];
        $conexion = getConnection();
        $tempListaTemas = selectTemaByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['temas'] = $tempListaTemas;
        $conexion = getConnection();
        $tempVotos = selectVotosByPreguntaID($conexion, $valor['idPregunta']);
        $listaPreguntas[$clave]['votos'] = $tempVotos;
    }


    return $listaPreguntas;
}

/*Busqueda Personalizada*/
/*Cargar los Temas*/
/**
 * @return array con todos los temas de la base de datos
 *
 * Busca todos los temas de la base de datos
 */
function seleccionarTodosTemas()
{
    $conexion = getConnection();
    $listaTemas = selectAllTema($conexion);
    return $listaTemas;
}
/*Cargar los Temas*/
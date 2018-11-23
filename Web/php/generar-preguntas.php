<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 12/11/2018
 * Time: 12:51
 */
require_once "db/dbUtils.php";
if (session_id() == '') {
    session_start();
}
/*Comprobar que exista la necesidad del boton Cargar Mas*/
if (!isset($_SESSION['botonMasModo'])) {
    $_SESSION['botonMasModo'] = "ninguno";
}
/*Crear El almacen de preguntas*/
if (!isset($_SESSION['almacenPreguntas'])) {
    $_SESSION['almacenPreguntas'] = array();
}
/*Si cambia el modo de busqueda, borrar el almacen de preguntas*/
$modoBusqueda = $_GET['modoBusqueda'];
if ($modoBusqueda != $_SESSION['botonMasModo']) {
    $_SESSION['botonMasModo'] = $modoBusqueda;
    $_SESSION['almacenPreguntas'] = array();
}
/**
 * @param $listaVotos la lista de los votos
 * @return int la puntuacion total
 *
 * Recorre un array con los votos y va sumando o restando un total dependiendo si son likes o dislikes
 */
function puntuacionPreguntas($listaVotos)
{
    $tempcontador = 0;
    if ($listaVotos != null) {
        foreach ($listaVotos as $item => $value) {
            if ($value['tipo'] == 1) {
                $tempcontador++;
            } else {
                $tempcontador--;
            }
        }
        return $tempcontador;
    }
}


/*Este switch controla como debe organizarse la carga de preguntas dependiendo de que modo está seleccionado*/
switch ($modoBusqueda) {
    case "recientes":
        $listaPreguntas = seleccionarRecientes();
        /*Recorre la lista de preguntas y las introduce*/
        foreach ($listaPreguntas as $clave => $valor) {
            $votos = puntuacionPreguntas($valor['votos']);
            htmlPreguntaPre($valor['idPregunta'], $valor['nombre'], $valor['Usuario_idUsuario'], $valor['fecha'], $valor['titulo'], $valor['temas'], $votos);
        }
        break;
    case "masvotadas":
        $listaPreguntas = seleccionarMasVotadas();
        /*Recorre la lista de preguntas y las introduce*/
        foreach ($listaPreguntas as $clave => $valor) {
            $votos = puntuacionPreguntas($valor['votos']);
            htmlPreguntaPre($valor['idPregunta'], $valor['nombre'], $valor['Usuario_idUsuario'], $valor['fecha'], $valor['titulo'], $valor['temas'], $votos);
        }
        break;
    case "sinresponder":
        /*Si existe la necesidad del boton Cargar mas, se coge el Get con una id*/
        if (isset($_GET['cargarMas'])) {
            $id = $_GET['cargarMas'];
        } else {
            $id = null;
        }/*La id anteriormente recogida sirve para saber desde que pregunta hay que seguir buscando*/
        $listaPreguntas = seleccionarSinResponder($id);
        /*Guarda las preguntas en el almacen de preguntas*/
        $preguntasTemp = $_SESSION['almacenPreguntas'];
        $_SESSION['almacenPreguntas'] = array_merge($preguntasTemp, $listaPreguntas);
        /*Recorre la lista de preguntas y las introduce*/
        foreach ($_SESSION['almacenPreguntas'] as $clave => $valor) {
            $votos = puntuacionPreguntas($valor['votos']);
            htmlPreguntaPre($valor['idPregunta'], $valor['nombre'], $valor['Usuario_idUsuario'], $valor['fecha'], $valor['titulo'], $valor['temas'], $votos);
        }
        /*Comprueba la necesidad del boton Cargar mas*/
        if (sizeof($listaPreguntas) == 10) {
            htmlBotonMas(end($listaPreguntas)['idPregunta'] + 1, $modoBusqueda);
        }

        break;
    case "respondidas":
        /*Si existe la necesidad del boton Cargar mas, se coge el Get con una id*/
        if (isset($_GET['cargarMas'])) {
            $id = $_GET['cargarMas'];
        } else {
            $id = null;
        }/*La id anteriormente recogida sirve para saber desde que pregunta hay que seguir buscando*/
        $listaPreguntas = seleccionarRespondidas($id);
        /*Guarda las preguntas en el almacen de preguntas*/
        $preguntasTemp = $_SESSION['almacenPreguntas'];
        $_SESSION['almacenPreguntas'] = array_merge($preguntasTemp, $listaPreguntas);
        /*Recorre la lista de preguntas y las introduce*/
        foreach ($_SESSION['almacenPreguntas'] as $clave => $valor) {
            $votos = puntuacionPreguntas($valor['votos']);
            htmlPreguntaPre($valor['idPregunta'], $valor['nombre'], $valor['Usuario_idUsuario'], $valor['fecha'], $valor['titulo'], $valor['temas'], $votos);
        }
        /*Comprueba la necesidad del boton Cargar mas*/
        if (sizeof($listaPreguntas) == 10) {
            htmlBotonMas(end($listaPreguntas)['idPregunta'] + 1, $modoBusqueda);
        }
        break;
    case "perso":
        /*Si existe la necesidad del boton Cargar mas, se coge el Get con una id*/
        if (isset($_GET['cargarMas'])) {
            $id = $_GET['cargarMas'];
        } else {
            $id = null;
        }
        /*Coge el texto de la busqueda y quita las palabras irrelevantes*/
        $textoBusqueda = $_SESSION['busquedaRelevantes'];

        $temasBusquedaconID = filtrarTemas($textoBusqueda);
        $temasBusquedasinID = array();
        /*Detecta los temas que haya en la busqueda y los separa*/
        foreach ($temasBusquedaconID as $clave => $valor) {

            array_push($temasBusquedasinID, $valor['nombre']);
        }
        /*Devuelve el resto de palabras sin los temas*/
        $textoFiltrado = array_diff($textoBusqueda, $temasBusquedasinID);
        /*Expresion regular para las palabras restantes*/
        $regex = "/(\?)";
        if (sizeof($textoFiltrado) == 0) {
            $regex = $regex . "?";
        } else {
            foreach ($textoFiltrado as $item) {
                $regex = $regex . "|(" . $item . ")\b";
            }
        }
        $regex = $regex . "/";
        //echo $regex;
        if (sizeof($temasBusquedaconID) == 0 && sizeof($textoFiltrado) == 0) {
            /*No hacer nada*/
        } else {
            /*Selecciona las preguntas que tengan al menos un tema, si no tienen temas no se buscan*/
            $listaPreguntas = seleccionarPreguntasByTemaID($temasBusquedaconID, $regex, $id);
            /*Guarda las preguntas en sesion*/
            $preguntasTemp = $_SESSION['almacenPreguntas'];
            $_SESSION['almacenPreguntas'] = array_merge($preguntasTemp, $listaPreguntas);
            /*Genera las preguntas*/
            foreach ($_SESSION['almacenPreguntas'] as $clave => $valor) {
                $votos = puntuacionPreguntas($valor['votos']);
                htmlPreguntaPre($valor['idPregunta'], $valor['nombre'], $valor['Usuario_idUsuario'], $valor['fecha'], $valor['titulo'], $valor['temas'], $votos);
            }
            /*Comprueba la necesidad del boton cargar mas*/
            if (sizeof($listaPreguntas) == 10) {
                htmlBotonMas(end($listaPreguntas)['idPregunta'] + 1, $modoBusqueda);
            }
        }
        break;

    default:
        echo "Error Desconocido";
}

/**
 * @param $id id de la pregunta
 * @param $usuario el usuario que ha formulado la pregunta
 * @param $iduser el id del usuario que ha formulado la pregunta
 * @param $fecha la fecha en la que se ha hecho la pregunta
 * @param $titulo el titulo de la pregunta
 * @param $temas los temas de la pregunta
 * @param $votos los votos de la pregunta
 *
 * Esta funcion genera una pregunta con los datos que se le suministran
 */
function htmlPreguntaPre($id, $usuario, $iduser, $fecha, $titulo, $temas, $votos)
{
    ?>
    <article class="pregunta-index" id="<?= $id ?>">
        <span class="informacion-usuario-fecha-pregunta">por <a href="./pages/perfil.php?usuario=<?= $iduser ?>"
                                                                class="link-perfil-usuario"><?= $usuario ?></a> a <?= $fecha ?></span>
        <h2 class="titulo-pregunta"><a href="./pages/pregunta.php?preguntaid=<?= $id ?>"><?= $titulo ?></a></h2>
        <div class="contenedor-categorias-pregunta">
            <?php
            foreach ($temas as $clave => $valor) {
                ?>
                <a href="index.php?busquedaPreguntas=<?= $valor['nombre'] ?>"><label><?= $valor['nombre'] ?></label></a>
                <?php
            }
            ?>
        </div>
        <div class="contenedor-likes-preguntas">
            <span class="puntuacion-pregunta-index"><?= $votos ?></span>
        </div>
    </article>
    <?php
}

/**
 * @param $id el ultimo id que habra que buscar
 * @param $modoBusqueda el modo en el que se esta buscando
 *
 * Esta funcion genera el boton Cargar Mas con los datos que se le suministran
 */
function htmlBotonMas($id, $modoBusqueda)
{
    $_SESSION['botonMasModo'] = $modoBusqueda;


    ?>

    <button id="botonCargarMasPreguntas" value="<?= $modoBusqueda ?>" name="<?= $id ?>" onclick="cargarMasPreguntas()">
        Cargar M&aacute;s
    </button>

    <?php

}


?>



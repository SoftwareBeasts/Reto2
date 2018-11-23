<?php
/**
 * Para insertar una pregunta en la base de datos en la tabla Preguntas, Tema y Pregunta_has_Tema.
 */

require "db/dbUtils.php";

session_start();

if(isset($_POST["tituloPregunta"])&&isset($_POST["descripcionPregunta"])&&isset($_POST["categoriasPregunta"]))
{
    /* Recogida de datos y separar las categorías/temas */
    $titulo=$_POST["tituloPregunta"];
    $descripcion=$_POST["descripcionPregunta"];
    $categorias=explode(",", $_POST["categoriasPregunta"]);
    foreach ($categorias as $item=>$value){
        $temp = str_replace(" ","",$categorias[$item]);
        $categorias[$item] = $temp;
    }
    $usuario=$_SESSION["userLogged"]["idUsuario"];

    /* Insertar la pregunta en la base de datos */
    insertarPregunta($titulo, $descripcion, $categorias, $usuario);

    /* Volver a la página de inicio */
    header("Location: ../index.php");
}
?>
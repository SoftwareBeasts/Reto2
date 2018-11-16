<?php

require "db/dbUtils.php";

session_start();

if(isset($_POST["tituloPregunta"])&&isset($_POST["descripcionPregunta"])&&isset($_POST["categoriasPregunta"]))
{
    $titulo=$_POST["tituloPregunta"];
    $descripcion=$_POST["descripcionPregunta"];
    $categorias=explode(",", $_POST["categoriasPregunta"]);
    $usuario=$_SESSION["userLogged"]["idUsuario"];

    insertarPregunta($titulo, $descripcion, $categorias, $usuario);

    header("Location: ../index.php");
}
?>
<?php

require "db/preguntaDB.php";
require "db/temaDB.php";

session_start();

if(isset($_POST["tituloPregunta"])&&isset($_POST["descripcionPregunta"])&&isset($_POST["categoriasPregunta"]))
{
    $titulo=$_POST["tituloPregunta"];
    $descripcion=$_POST["descripcionPregunta"];
    $categorias=explode(",", $_POST["categoriasPregunta"]);
    $usuario=$_SESSION["userLogged"]["idUsuario"];

    insertPregunta($titulo, $descripcion, $usuario);
    $pregunta=findPregunta($titulo, $descripcion, $usuario);

    foreach($categorias as $elements)
    {
        $categoria=findTema($elements);

        if($categoria == null)
        {
            insertTema($elements);
            $categoria=findTema($elements);
        }
        insertPreguntaTema($pregunta["idPregunta"],$categoria["idTema"]);
    }
}

?>
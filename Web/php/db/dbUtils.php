<?php

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
<?php
//Documento para reocger el id del usuario que está registrado
session_start();
$userId = null;
if(isset($_SESSION['userLogged']))
    $userId = $_SESSION['userLogged']['idUsuario'];

die($userId);
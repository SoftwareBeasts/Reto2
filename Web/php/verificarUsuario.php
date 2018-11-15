<?php

require './db/dbUtils.php';

if(isset($_GET['nombreusu'])){
    $encontrado = verificarNombreUsuario($_GET['nombreusu']);
    if($encontrado){
        ?>
        <input id="varUsuarioRegistrado" type="hidden" value="1">
        <?php
    }
    else{
        ?>
        <input id="varUsuarioRegistrado" type="hidden" value="0">
        <?php
    }

}
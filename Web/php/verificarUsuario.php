<?php

require './db/dbUtils.php';

//Busca el usuario que se ha pasado por post y genera un input hidden con true si lo ha encontrado o false si no
if (isset($_GET['nombreusu'])) {
    $encontrado = verificarNombreUsuario($_GET['nombreusu']);
    if ($encontrado) {
        ?>
        <input id="varUsuarioRegistrado" type="hidden" value="1">
        <?php
    } else {
        ?>
        <input id="varUsuarioRegistrado" type="hidden" value="0">
        <?php
    }

}
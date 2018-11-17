<?php

function generarNav($ruta){
    ?>
    <nav id="menu-cabecera">
        <div id="contenido-izquierda-nav">
            <a href="<?=$ruta?>index.php"><img alt="Logo-Foro" id="logo-foro"></a>
        <a href="<?=$ruta?>pages/hacerPregunta.php" id="link-pregunta">Haz una Pregunta</a>
        <form id="formulario-busqueda" method="get" action="#">
            <label for="caja-busqueda" id="label-caja-busqueda">Buscar</label>
            <input type="text" name="busqueda" id="caja-busqueda" placeholder="Buscar">
        </form>
        </div>
        <div id="contenido-derecha-nav">
            <?php
                if (isset($_SESSION['userLogged'])){
                    ?>
                    <div class="dropdown">
                        <a class="dropbtn"><?= $_SESSION['userLogged']['nombreusu'] ?></a>
                        <div class="dropdown-content">
                            <a href="<?= $ruta ?>pages/perfil.php">Perfil</a>
                            <a href="<?= $ruta ?>pages/perfil.php">Configuración</a>
                            <a href="<?= $ruta ?>index.php?logout=true">Log out</a>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <a href="<?=$ruta?>pages/login.php" id="link-inicio-sesion">Iniciar Sesi&oacuten</a>
                    <?php
                }
            ?>
        </div>
    </nav>
    <?php
}


function generarFooter(){
    ?>
    <footer id="pie-pagina">
        <img alt="Logo-Software-Beasts">
        <a href="#"><img alt="Logo-Github"></a>
        <label>MIT License</label>
    </footer>
    <?php
}
function generarAside(){
    ?>
    <aside id="barra-lateral-aside">
        <div id="placeholder-aside-aside"></div>
        <div id="contenedor-principal-categorias-aside">
            <h3 id="titulo-categoria">Categor&iacute;as</h3>
            <div id="contenedor-secundario-categorias-aside">
                <a href="#"><label>PHP</label></a>
                <a href="#"><label>PHP</label></a>
                <a href="#"><label>PHP</label></a>
                <a href="#"><label>PHP</label></a>
                <a href="#"><label>PHP</label></a>
            </div>
        </div>
    </aside>
    <?php
}
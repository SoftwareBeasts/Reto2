<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 08/11/2018
 * Time: 13:53
 */
session_start();
function generarNav($ruta){
    ?>
    <nav id="menu-cabecera">
        <div id="contenido-izquierda-nav">
        <img alt="Logo-Foro" id="logo-foro">
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
                    <form id="formulario-usuario" method="get" action="#" hidden>
                        <select name="usuario-opciones" id="opciones-usuario-select">
                            <option value="#">Perfil</option>
                            <option value="#">Configuracion</option>
                        </select>
                    </form>
                    <?php
                }else{
                    ?>
                    <a href="<?=$ruta?>pages/login.php"  id="link-inicio-sesion">Iniciar Sesi&oacuten</a>
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
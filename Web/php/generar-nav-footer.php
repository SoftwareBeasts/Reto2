<?php
/**
 * Created by PhpStorm.
 * User: 2gdaw08
 * Date: 08/11/2018
 * Time: 13:53
 */
function generarNav(){
    ?>
    <nav id="menu-cabecera">
        <img alt="Logo-Foro" id="logo-foro">
        <a href="#" id="link-pregunta"><button>Pregunta</button></a>
        <form id="formulario-busqueda" method="get" action="#">
            <label for="caja-busqueda" id="label-caja-busqueda">Buscar</label>
            <input type="text" name="busqueda" id="caja-busqueda" placeholder="Buscar">
        </form>
        <a href="#" id="link-inicio-sesion"><button>Iniciar Sesi&oacuten</button></a>
        <form id="formulario-usuario" method="get" action="#" hidden>
            <select name="usuario-opciones" id="opciones-usuario-select">
                <option value="#">Perfil</option>
                <option value="#">Configuracion</option>
            </select>
        </form>
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
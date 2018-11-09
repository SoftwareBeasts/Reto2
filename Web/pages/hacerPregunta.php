<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hacer una pregunta &#124; Aergibide S.L.</title>
    <link rel="stylesheet" type="text/css" href="../css/hacerPregunta.css" />
</head>
<body>
<!--
    <header id="menu-cabecera">
        <img alt="Logo-Empresa">
        <a href="#">Pregunta</a>
        <form id="formulario-busqueda" method="get" action="#">
            <label for="caja-busqueda" id="label-caja-busqueda">Buscar</label>
            <input type="text" name="busqueda" id="caja-busqueda" placeholder="Buscar">
        </form>
        <a><button>Iniciar Sesi&oacuten</button></a>
    </header>
-->
<div id="contenedor">
    <h1>Hacer una pregunta</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="tituloPregunta">T&iacute;tulo:</label>
                <input type="text" id="tituloPregunta" name="tituloPregunta" value="" />
            </li>
            <li>
                <label for="descripcionPregunta">Descripci&oacute;n:</label>
                <textarea id="descripcionPregunta" name="descripcionPregunta" rows="15" cols="90"></textarea>
            </li>
            <li>
                <label for="etiquetasPregunta">Etiquetas:</label>
                <input type="text" id="etiquetasPregunta" name="etiquetasPregunta" value="" />
            </li>
            <li>
                <input type="submit" id="enviarPregunta" value="Enviar" />
            </li>
        </ul>
    </form>
</div>
</body>
</html>
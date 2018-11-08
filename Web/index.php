<!DOCTYPE html>
<html>
    <head>
        <title>Aergibide S.L</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/grid-general.css" type="text/css" rel="stylesheet">
        <link href="css/index.css" type="text/css" rel="stylesheet">
    </head>
    <body>

        <main id="contenedor-principal">
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
            <section id="contenedor-preguntas-index">

            </section>
            <aside id="barra-lateral-index">

            </aside>
        </main>
    </body>
</html>
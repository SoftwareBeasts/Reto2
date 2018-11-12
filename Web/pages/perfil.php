<?php
require "../php/generar-nav-footer.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Perfil de @usuario &#124; Aergibide S.L.</title>
    <link rel="stylesheet" type="text/css" href="../css/grid-general.css" />
    <link rel="stylesheet" type="text/css" href="../css/perfil.css" />
</head>
<body>

<main id="contenedor-principal">
    <?php
    generarNav();
    ?>
    <section id="contenedor-perfil">
        <div id="perfilUsuario">
            <h3>Nombre y apellidos</h3>
            <p>Preguntas realizadas: 1 &#124; Respuestas proporcionadas: 1 &#124; Votos recibidos: 1</p>
            <p>Su descripción del perfil va aquí. Puede editarse desde el enlace del perfil de edición en su panel de control.</p>
        </div>
        <ul>
            <li>Preguntas</li>
            <li>Respuestas</li>
        </ul>
        <table>
            <tr>
                <td>
                    <p><span>@usuario</span>&nbsp;&nbsp;<span>@fecha</span></p>
                    <h3>Pregunta</h3>
                    <p><span>Categor&iacute;a</span><span>-5</span></p>
                </td>
            </tr>
        </table>
    </section>
    <aside id="barra-lateral-index">

    </aside>
    <?php
    generarFooter();
    ?>
</main>
</body>
</html>
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
        <div>
            <h3>Nombre y apellidos</h3>
            <p>Preguntas realizadas: 1 &#124; Respuestas proporcionadas: 1</p>
            <p>Su descripción del perfil va aquí. Puede editarse desde el enlace del perfil de edición en su panel de control.</p>
        </div>
        <ul>
            <li>Preguntas</li>
            <li>Respuestas</li>
        </ul>
        <article>
            <p>Por <span>@usuario</span>&nbsp;el <span>@fecha</span></p>
            <h3>Pregunta</h3>
            <div>
                <div>
                    <p>Categor&iacute;a</p>
                    <p>Categor&iacute;a</p>
                </div>
                <div>
                    <p>&nbsp;-5&nbsp;</p>
                </div>
            </div>
        </article>
        <article>
            <p>Por <span>@usuario</span>&nbsp;el <span>@fecha</span></p>
            <h3>Pregunta</h3>
            <div>
                <div>
                    <p>Categor&iacute;a</p>
                    <p>Categor&iacute;a</p>
                </div>
                <div>
                    <p>&nbsp;-5&nbsp;</p>
                </div>
            </div>
        </article>
    </section>
    <aside id="barra-lateral-index">
    </aside>
    <?php
    generarFooter();
    ?>
</main>
</body>
</html>
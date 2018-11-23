/**
 * Para validar los datos (valores nulos) antes de insertar preguntas para no saturar al servidor
 * @returns {boolean}
 */
function validarDatos() {
    try
    {
        /* Validando el título */
        var titulo=$("input[name='tituloPregunta']").val();
        if(titulo==="")
        {
            throw "Hacer pregunta: No se ha introducido el título.";
        }

        /* Validando la descripción */
        var descripcion=$("textarea").val();
        if(descripcion==="")
        {
            throw "Hacer pregunta: No se ha introducido la descripción.";
        }
        var categorias=$("input[name='categoriasPregunta']").val();

        /* Validando las categorías */
        if(categorias==="")
        {
            throw "Hacer pregunta: No se ha introducido ninguna categoría.";
        }
        return true;
    }
    catch(err)
    {
        console.log(err);
        return false;
    }
}
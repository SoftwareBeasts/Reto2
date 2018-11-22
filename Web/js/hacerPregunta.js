function validarDatos() {
    try
    {
        var titulo=$("input[name='tituloPregunta']").val();
        if(titulo==="")
        {
            throw "Hacer pregunta: No se ha introducido el título.";
        }
        var descripcion=$("textarea").val();
        if(descripcion==="")
        {
            throw "Hacer pregunta: No se ha introducido la descripción.";
        }
        var categorias=$("input[name='categoriasPregunta']").val();
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
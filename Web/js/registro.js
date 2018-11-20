$(document).ready(function () {
    $('#nombreusu').on("blur", ()=>verificarRegistrado('nombreusu', true));
    $('#correo').on("blur", ()=>verificarRegistrado('correo', 0 ));
    $('input[name=correoConf]').keyup(()=>verificar('correo', 'correoConf'));
    $('input[name=passw]').keyup(verificarPassw);
    $('input[name=passwConf]').keyup(()=>verificar('passw', 'passwConf'));
});

function verificar(input, inputConf) {
    let inputConfTmp = document.getElementById(inputConf);
    if ($('input[name='+input+']').val() === inputConfTmp.value) {
        inputConfTmp.setCustomValidity('');
    } else {
        inputConfTmp.setCustomValidity('No coinciden');
    }
}

function verificarPassw() {
    let mediumRegExp = new RegExp("^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).*$");
    let input = document.getElementById("passw");
    try{
        if(!mediumRegExp.test(input.value)){
            throw "Debe tener al menos una mayúscula, una minúscula y un número";
        }
        else
            input.setCustomValidity("");
    }
    catch (e) {
        input.setCustomValidity(e);
    }
}

function verificarRegistrado(inputVr, accion) {
    let input = document.getElementById(inputVr);
    let cadena;
    if(accion)
        cadena = 'Usuario ya registrado';
    else
        cadena = 'Correo ya registrado';
    $.ajax({
        type: "POST",
        url: "../php/db/dbUtils.php",
        data: {value: input.value, verificarUsuarioRegistrado: accion}
    }).done(function (data) {
        console.log(data);
        if (!data) {
            input.setCustomValidity('');
        }
        else{
            input.setCustomValidity(cadena);
        }
    });
}
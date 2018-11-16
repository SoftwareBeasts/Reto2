$(document).ready(function () {
    document.getElementById('nombreusu').focus();
    $('input[name=correoConf]').keyup(()=>verificar('correo', 'correoConf'));
    $('input[name=passw]').keyup(verificarPassw);
    $('input[name=passwConf]').keyup(()=>verificar('passw', 'passwConf'));
    $('#nombreusu').on("focusout", verificarUsuarioRegistrado);
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
            console.log("1");
            throw "Debe tener al menos una mayúscula, una minúscula y un número";
        }
        else
            input.setCustomValidity("");
    }
    catch (e) {
        input.setCustomValidity(e);
    }
}

function verificarUsuarioRegistrado() {
    $.ajax({
        type: "POST",
        url: "../php/db/dbUtils.php",
        data: {nombreusu: $('#nombreusu').val()}
    }).done(function (data) {
        if (!data) {
            document.getElementById('nombreusu').setCustomValidity('');
        }
        else{
            document.getElementById('nombreusu').setCustomValidity('Usuario ya registrado');
        }
    }).fail(function () {
        alert("FAIL");
    });
}
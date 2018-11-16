$(document).ready(function () {
    document.getElementById('nombreusu').focus();
    $('input[name=correoConf]').keyup(()=>verificar('correo', 'correoConf'));
    $('input[name=passwConf]').keyup(()=>verificar('passw', 'passwConf'));
    $('#nombreusu').on("focusout", verificarUsuarioRegistrado);
});

function verificar(input, inputConf) {
    debugger;
    let inputConfTmp = document.getElementById(inputConf);
    if ($('input[name='+input+']').val() === inputConfTmp.value) {
        inputConfTmp.setCustomValidity('');
    } else {
        inputConfTmp.setCustomValidity('No coinciden');
    }
}

function verificarUsuarioRegistrado() {
    alert("Entra");
    $.post(
        "../php/dbUtils.php",
        { nombreusu: $('#nombreusu').val()})
        .done(function(data) {
            alert("hola");
            if(!data)
                input.setCustomValidity('');
            else
                input.setCustomValidity('Usuario ya registrado');
        }
    );

}
$("[name=loginRequerido]").one("click",avisarLoginRequerido);

function cargarLogin(){
    window.location = "../pages/login.php";
}
function avisarLoginRequerido(){
    $("#requeridoLogearse").show();
    setTimeout(function () {
        $("#requeridoLogearse").fadeOut("slow");
    },2000);
    $("#boton-responder").click(cargarLogin);
}
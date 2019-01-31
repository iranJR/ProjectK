/* ### Página de Recuperar Senha da Index ### */

<!--Início Animação da Div de Recuperar Senha-->

//Transição da tela de login, para tela de recuperação de senha

$(document).ready(function(){
    $("#esqueceuSenha").click(
        function () {
            $("#divLogin").css("display", "none");
            $("#divRecuperarSenha").fadeIn(1500);
        }
    );
});

//Transição da tela de recuperação de senha, para tela de login

$(document).ready(function(){
    $("#botaoVoltarLogin").click(
        function () {
            $("#divRecuperarSenha").css("display", "none");
            $("#divLogin").fadeIn(1500);
        }
    );
});

<!--Fim Animação da Div de Recuperar Senha-->
/* ----------------------------------------------------------------- */
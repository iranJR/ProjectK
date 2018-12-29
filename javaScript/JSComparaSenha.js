/* ### Função em JS para comparar as senhas do formulário de cadastro ### */

$(document).ready(function(){
    $("#confirmSenha").keyup(
        function () {

            $("#confirmSenhaHelp").css("display", "block");

            if($("#senha").val() === $("#confirmSenha").val()){
                $("#textSpanSenhaHelp").css("color", "#37C967");
                $("#textSpanSenhaHelp").text("As senhas são iguais ! ");
                $("#botaoLogin").prop("disabled", false);
            }
            else {
                $("#textSpanSenhaHelp").css("color", "crimson");
                $("#textSpanSenhaHelp").text("As senhas são diferentes ! ");
                $("#botaoLogin").prop("disabled", true);
            }
        }
    );
});
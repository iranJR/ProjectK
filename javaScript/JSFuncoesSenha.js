/* ### Página de Cadastro de Usuário ### */

/* ### Função em JS para medir a força da senha ### */

$(document).ready(function(){
    $("#senha").keyup(
        function () {
           senha = $("#senha").val();
           forca = 0;

            if((senha.length >= 4) && (senha.length <= 7)){
                forca += 10;
            }else if(senha.length>7){
                forca += 25;
            }
            if(senha.match(/[a-z]+/g)){
                forca += 10;
            }
            if(senha.match(/[A-Z]+/g)){
                forca += 20;
            }
            if(senha.match(/[0-9]+/g)){
                forca += 20;
            }

            $("#senhaHelp").css("display", "block");
            $("#barraForca").css("display", "block");

            if(forca < 30){
                $("#spanSenhaHelp").css("color", "red");
                $("#spanSenhaHelp").text("Fraca");
                $("#barra").css("width", forca+"%");
                $("#barra").css("background-color", "red");
            }else if((forca >= 30) && (forca < 60)){
                $("#spanSenhaHelp").css("color", "yellow");
                $("#spanSenhaHelp").text("Média");
                $("#barra").css("width", forca+"%");
                $("#barra").css("background-color", "yellow");
            }else {
                $("#spanSenhaHelp").css("color", "#37C967");
                $("#spanSenhaHelp").text("Forte");
                $("#barra").css("width", forca+"%");
                $("#barra").css("background-color", "green");
            }

        }
    );
});

/*--------------------------------------------------------------------------------*/

/* ### Página de Cadastro de Usuário ### */

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

/*--------------------------------------------------------------------------------*/
/* ### Página de Cadastro de Usuário ### */

/* ### Função em JS para medir a força da senha ### */

$(document).ready(function(){
    $("#senha").keyup(function () {
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
        });
});

/*---------------------------------------------------------------------------------*/

/* ### Página de Cadastro de Usuário ### */

/* ### Função em JS para comparar as senhas do formulário de cadastro ### */

$(document).ready(function() {

    // Ao digitar no campo de senha
    $("#senha").keyup(function () {
        // verifica se o campo confirmSenha está preenchido
        if ($("#confirmSenha").val() !== "") {
            // verifica se os campos tem o mesmo valor
            if ($("#senha").val() === $("#confirmSenha").val()) {
                $("#confirmSenhaHelp").css("display", "block");
                $("#textSpanSenhaHelp").css("color", "#37C967");
                $("#textSpanSenhaHelp").text("As senhas são iguais ! ");
                var txt = $("#spanSenhaHelp").text();

                // O cadastro só é habilitado caso a senha seja forte.
                if (txt === "Forte") {
                    $("#botaoProximo2").prop("disabled", false);
                } else {
                    $("#botaoProximo2").prop("disabled", true);
                }
            } else {
                $("#confirmSenhaHelp").css("display", "block");
                $("#textSpanSenhaHelp").css("color", "crimson");
                $("#textSpanSenhaHelp").text("As senhas são diferentes ! ");
                $("#botaoProximo2").prop("disabled", true);
            }
        } else {
            $("#confirmSenhaHelp").css("display", "none");
            $("#textSpanSenhaHelp").text("");
        }
    });

    // Ao digitar no campo confirmSenha
    $("#confirmSenha").keyup(function () {
        // verifica se o campo senha está preenchido
        if ($("#senha").val() !== "") {
            // verifica se a senha e confirmSenha são iguais ou diferentes
            if ($("#senha").val() === $("#confirmSenha").val()) {
                $("#confirmSenhaHelp").css("display", "block");
                $("#textSpanSenhaHelp").css("color", "#37C967");
                $("#textSpanSenhaHelp").text("As senhas são iguais ! ");
                var txt = $("#spanSenhaHelp").text();

                // O cadastro só é habilitado caso a senha seja forte.
                if (txt === "Forte") {
                    $("#botaoProximo2").prop("disabled", false);
                } else {
                    $("#botaoProximo2").prop("disabled", true);
                }
            } else {
                $("#confirmSenhaHelp").css("display", "block");
                $("#textSpanSenhaHelp").css("color", "crimson");
                $("#textSpanSenhaHelp").text("As senhas são diferentes ! ");
                $("#botaoProximo2").prop("disabled", true);
            }
        } else {
            $("#confirmSenhaHelp").css("display", "none");
            $("#textSpanSenhaHelp").text("");
        }
    });

    // Ao sair do campo senha
    $("#senha").blur(function () {
        // se o campo estiver vazio, sumirá a mensagem
        if ($("#senha").val() === "") {
            $("#confirmSenhaHelp").css("display", "none");
        }
    });

    // Ao sair do campo confirmSenha
    $("#confirmSenha").blur(function () {
        // se o campo estiver vazio, sumirá a mensagem
        if ($("#confirmSenha").val() === "") {
            $("#confirmSenhaHelp").css("display", "none");
        }
    });

});

/*---------------------------------------------------------------------------------*/



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

/* ### Página de Alterar Senha  ### */

/* ### Função em JS para medir a força da senha ### */

/*$(document).ready(function () {

    $("#senhaNova").keyup( function () {
            senha = $("#senhaNova").val();
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
});*/

/*---------------------------------------------------------------------------------*/

/* ### Página de Alterar Senha  ### */

/* ### Função em JS para comparar as senhas do formulário de cadastro ### */

$(document).ready(function () {

    // Ao digitar no campo senhaNova
    $("#senhaNova").keyup(function () {
        // verifica se o campo confirmSenha está preenchido
        if ($("#confirmSenhaNova").val() !== "") {
            // verifica se os campos tem o mesmo valor
            if ($("#senhaNova").val() === $("#confirmSenhaNova").val()) {
                $("#textSpanSenhaHelp").css("color", "#37C967");
                $("#textSpanSenhaHelp").text("As senhas são iguais ! ");
                var txt = $("#spanSenhaHelp").text();

                // O cadastro só é habilitado caso a senha seja forte.
                if (txt === "Forte") {
                    $("#botaoAlterarSenha").prop("disabled", false);
                } else {
                    $("#botaoAlterarSenha").prop("disabled", true);
                }
            } else {
                $("#textSpanSenhaHelp").css("color", "crimson");
                $("#textSpanSenhaHelp").text("As senhas são diferentes ! ");
                $("#botaoAlterarSenha").prop("disabled", true);
            }
        } else {
            $("#textSpanSenhaHelp").text("");
        }
    });

    // Ao digitar no campo confirmSenha
    $("#confirmSenhaNova").keyup(function () {
        // verifica se o campo senha está preenchido
        if ($("#senhaNova").val() !== "") {
            // verifica se a senha e confirmSenha são iguais ou diferentes.
            if ($("#senhaNova").val() === $("#confirmSenhaNova").val()) {
                $("#textSpanSenhaHelp").css("color", "#37C967");
                $("#textSpanSenhaHelp").text("As senhas são iguais ! ");
                var txt = $("#spanSenhaHelp").text();

                // O cadastro só é habilitado caso a senha seja forte.
                if (txt === "Forte") {
                    $("#botaoAlterarSenha").prop("disabled", false);
                } else {
                    $("#botaoAlterarSenha").prop("disabled", true);
                }
            } else {
                $("#textSpanSenhaHelp").css("color", "crimson");
                $("#textSpanSenhaHelp").text("As senhas são diferentes ! ");
                $("#botaoAlterarSenha").prop("disabled", true);
            }
        } else {
            $("#textSpanSenhaHelp").text("");
        }
    });

    // Ao sair do campo senha
    $("#senhaNova").blur(function () {
        // se o campo estiver vazio, sumirá a mensagem
        if ($("#senhaNova").val() === "") {
            $("#textSpanSenhaHelp").text("");
        }
    });

    // Ao sair do campo confirmSenha
    $("#confirmSenhaNova").blur(function () {
        // se o campo estiver vazio, sumirá a mensagem
        if ($("#confirmSenhaNova").val() === "") {
            $("#textSpanSenhaHelp").text("");
        }
    });

});

/*----------------------------------------------------------------------------------*/

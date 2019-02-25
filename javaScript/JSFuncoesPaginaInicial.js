/* ### Página de Inicial da Rede Social ### */

/* ### Função em JS para habilitar e desabilitar a DIV de solicitações de amizade
do usuário ### */

$(document).ready(function(){
    $("#botaoNotificacoes").click(
        function () {

            if($("#ulDropDownNotificacoes").css("display") === "none") {
                $("#ulDropDownNotificacoes").css("display", "block");
            }
            else {
                $("#ulDropDownNotificacoes").css("display", "none");
            }

        }
    );
});

/*----------------------------------------------------------------------------*/

/* ## Página de Perfil do Usuário ## */

<!--Início da Função para Contagem de Caracteres Restantes do Input do Formulário de Postagem.-->

$(document).ready(function(){
    $("#inputPostagemPerfilUsuario").keyup(
        function () {
            $("#contMensagemPostagem").text(500 - $("#inputPostagemPerfilUsuario").val().length +" caracteres restantes.")
        }
    );
});

<!--Fim da Função para Contagem de Caracteres Restantes do Input do Formulário de Postagem.-->

/*----------------------------------------------------------------------------*/
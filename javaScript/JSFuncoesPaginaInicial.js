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
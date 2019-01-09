/* ### Página de Contato ### */

<!--Início da Função para Contagem de Caracteres Restantes do Text Area do Formulário de Contato.-->

$(document).ready(function(){
    $("#txtAreaMensagem").keyup(
        function () {
            $("#contMensagem").text(350 - $("#txtAreaMensagem").val().length +" caracteres restantes.")
        }
    );
});

<!--Fim da Função para Contagem de Caracteres Restantes do Text Area do Formulário de Contato.-->
/* ----------------------------------------------------------------- */
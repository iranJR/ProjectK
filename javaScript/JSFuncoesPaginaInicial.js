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

<!--Fim da Função para Contagem de Caracteres Restantes do Input do Formulário de Postagem de Vídeo.-->

<!--Início da Função para Contagem de Caracteres Restantes do Input do Formulário de Vídeo.-->

$(document).ready(function(){
    $("#textoPostagemVideo").keyup(
        function () {
            $("#contMensagemPostagemVideo").text(500 - $("#textoPostagemVideo").val().length +" caracteres restantes.")
        }
    );
});

<!--Fim da Função para Contagem de Caracteres Restantes do Input do Formulário de Postagem de Vídeo.-->

<!--Início da Função para Contagem de Caracteres Restantes do Input do Formulário de Imagem.-->

$(document).ready(function(){
    $("#textoPostagemImagem").keyup(
        function () {
            $("#contMensagemPostagemImagem").text(500 - $("#textoPostagemImagem").val().length +" caracteres restantes.")
        }
    );
});

<!--Fim da Função para Contagem de Caracteres Restantes do Input do Formulário de Postagem de Imagem.-->

<!--Início da Função para Carregar uma Pré-Visualização da Imagem do Input do Formulário de Postagem de Imagem.-->

$(document).ready(function(){
    $("#imagemPost").on('change', function () {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#fotoPreview').attr('src', e.target.result);
                $('#fotoPreview').attr('alt', "Foto pré-carregada");
                $('#fotoPreview').attr('class', "fotoPreview");
            };

            reader.readAsDataURL(this.files[0]);
        }
        else {
            $('#fotoPreview').attr('src', '');
            $('#fotoPreview').attr('alt', '');
            $('#fotoPreview').attr('class', '');
        }

    });
});

<!--Fim da Função para Carregar uma Pré-Visualização da Imagem do Input do Formulário de Postagem de Imagem.-->

<!--Início da Função de Exibição e Ocultação da Div dos Comentários na Página de Perfil do Usuário-->

$(document).ready(function(){
    $("#aBotaoExibirComentarios").click(
        function () {

            if($("#divComentariosInputPostagemMural").css("display") === "none") {
                $("#iExpandirOcultarComentario").attr("class", "");
                $("#iExpandirOcultarComentario").attr("class", "glyphicon glyphicon-menu-up");
                $("#divComentariosInputPostagemMural").css("display", "block");
            }
            else {
                $("#iExpandirOcultarComentario").attr("class", "");
                $("#iExpandirOcultarComentario").attr("class", "glyphicon glyphicon-menu-down");
                $("#divComentariosInputPostagemMural").css("display", "none");
            }

        }
    );
});

<!--Fim da Função de Exibição e Ocultação da Div dos Comentários na Página de Perfil do Usuário-->

/*----------------------------------------------------------------------------*/
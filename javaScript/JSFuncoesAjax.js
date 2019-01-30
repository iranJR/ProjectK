/* ### Página de Cadastro de Usuário ### */

/* ### Função em Ajax para preenchimento do select de cidade no cadastro
do usuário ### */

$(document).ready(function(){
    $('#uf').change(function(){
        $('#cidade').load('../util/PreencheCidadeAjax.php?uf='+$('#uf').val() );
    });
});

/*----------------------------------------------------------------------------*/

/* ### Página Inicial ### */

/* ### Função em Ajax para preenchimento do Menu DropDown de Pesquisa de Usuário ### */

$(document).ready(function(){
    $("#inputPesquisar").keyup(
        function () {

            if($("#inputPesquisar").val().length > 0) {
                $("#ulDropDownPesquisa").css("display", "block");
                var busca = $('#inputPesquisar').val().toString().replace(" ", "1");
                $("#ulDropDownPesquisa").load("../util/PreenchePesquisaUsuarioAjax.php?busca="+busca+"");
            }
            else {
                $("#ulDropDownPesquisa").css("display", "none");
            }

        }
    );
});

/*----------------------------------------------------------------------------*/
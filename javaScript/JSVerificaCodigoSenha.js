/* ### Página Recuperar Senha Index ### */

/* Função para verificar se o código está dentro do padrão e habilitar o botão de verificar */

$(document).ready(function(){
    $("#codigoRecuperacao").keyup(function () {
        codigo = $("#codigoRecuperacao").val();

        if((codigo.length === 9) && (codigo.match(/^([0-9]{9})$/))){
            $("#botaoCodRec").prop("disabled", false);
        }else {
            $("#botaoCodRec").prop("disabled", true);
        }
    });
});

/*---------------------------------------------------------------------------------*/

/* ### Função em Ajax para verificar o código de recuperação e efetuar o
 preenchimento da Div de Nova Senha ### */

$(document).ready(function(){
    $("#botaoCodRec").click(
        function () {
            var codigo = $("#codigoRecuperacao").val();
            if(codigo.length === 0){
                $(location).attr("href", "recuperarSenhaIndex.view.php?msg=Preencha o código de recuperação !");
            }
            else if(codigo.length < 9){
                $(location).attr("href", "recuperarSenhaIndex.view.php?msg=Preencha corretamente o código de " +
                    "recuperação informado !");
            }
            else {
                $("#divCodigoRecuperacao").css("display", "none");
                $("#newDiv").load("../util/NovaSenhaIndexAjax.php?codigo="+codigo);
            }
        }
    );
});

/*----------------------------------------------------------------------------*/
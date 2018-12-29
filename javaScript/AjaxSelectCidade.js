/* ### Função em Ajax para preenchimento do select de cidade no cadastro
do usuário ### */

$(document).ready(function(){
    $('#uf').change(function(){
        $('#cidade').load('../util/PreencheCidadeAjax.php?uf='+$('#uf').val() );
    });
});
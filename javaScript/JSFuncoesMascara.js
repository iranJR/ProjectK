/* ### Página de Cadastro de Usuário ### */

/* ### Função em JS para criar máscaras para os campos de input ### */

$(document).ready(function(){
    $('.cpf').mask('000.000.000-00', {reverse: false});
    $('.telefone').mask('(00) 0000-0000');
    $('.celular').mask('(00) 00000-0000');
    $('.cep').mask('00000-000');
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
});

/*---------------------------------------------------------------------------*/
$(document).ready(function () {

    // funcao que define o padrão da senha
    jQuery.validator.addMethod("passwordCheck",
        function(value, element, param) {
            if (this.optional(element)) {
                return true;
            } else if (!/[A-Z]/.test(value)) {
                return false;
            } else if (!/[a-z]/.test(value)) {
                return false;
            } else if (!/[0-9]/.test(value)) {
                return false;
            }
            return true;
        },
        "erro");

    $("#formLogin").validate({

        rules:{
            senhaAtual:{
                required:true,
                minlength:8,
                passwordCheck:true,
            },
            senhaNova:{
                required:true,
                minlength:8,
                passwordCheck:true,
            },
            confirmSenhaNova:{},
        },
        messages:{
            senhaAtual:{
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
                minlength: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   A senha deve conter pelo menos 8 caracteres.</p>",
                passwordCheck: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   A senha deve conter pelo menos: uma letra maiúscula, uma letra minúscula e um dígito.</p>",
            },
            senhaNova:{
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
                minlength: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   A senha deve conter pelo menos 8 caracteres.</p>",
                passwordCheck: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   A senha deve conter pelo menos: uma letra maiúscula, uma letra minúscula e um dígito.</p>",
            },
            confirmSenhaNova:{},
        }
    });

});
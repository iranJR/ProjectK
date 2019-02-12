/* ### Página de Cadastro ### */

<!--Início do JS para troca dos Steps do Formulário de Cadastro e do JQuery Validation-->

/*Downloaded from https://www.codeseek.co/brettmichaelorr/bootstrap-form-wizard-with-tooltipster-and-jquery-validate-RaRZLe */
$(document).ready(function () {

    $('input, select').tooltipster({
        trigger: 'custom',
        onlyOne: false,
        position: 'right',
        theme: 'tooltipster-light'
    });

    // funcao que define o padrão do campo nome(nome simples ou composto)
    /*jQuery.validator.addMethod("letras", function(value, element) {
        return this.optional(element) || /^[A-zÀ-ú]+$/i.test(value);
    }, "erro");*/

    jQuery.validator.addMethod("letras", function(value, element) {
        return this.optional(element) || /^[A-zÀ-ú]+\s[A-zÀ-ú]+\s?$/i.test(value) || /^[A-zÀ-ú]+$/i.test(value);
    }, "erro");


    // funcao que define o padrão do campo sobrenome(simples ou composto por 2 ou 3 nomes)
    jQuery.validator.addMethod("espacamento", function(value, element) {
        return this.optional(element) || /^[A-zÀ-ú]+\s[A-zÀ-ú]+\s[A-zÀ-ú]+\s?$/i.test(value)
                                      || /^[A-zÀ-ú]+\s[A-zÀ-ú]+\s?$/i.test(value)
                                      || /^[A-zÀ-ú]+$/i.test(value);
    }, "erro");

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

    // validacoes do formulario
    $("#form").validate({
        rules : {
            nome:{
                required:true,
                letras:true,
                minlength:3,
                maxlength: 20,
            },
            sobrenome:{
                required:true,
                espacamento:true,
                minlength:2,
                maxlength: 45,
            },
            email:{
                required:true,
                email:true,
            },
            cpf:{
                required:true,
                minlength: 14,
                maxlength: 14,
            },
            dataNasc:{
                required:true,
                min: $("#dataNasc").attr("min"),
                max: $("#dataNasc").attr("max"),
            },
            uf:{
                required:true,
            },
            cidade:{
                required:true,
            },
            senha:{
                required:true,
                minlength:8,
                passwordCheck:true,
            },
            confirmSenha:{
                required:true,
            },
        },
        messages:{
            nome:{
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
                letras: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Digite apenas o primeiro nome.</p>",
                minlength:"<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   O nome deve conter no mínimo 3 letras.</p>",
                maxlength: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   O nome deve conter no máximo 20 letras.</p>",
            },
            sobrenome:{
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
                espacamento: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Digite no máximo 2 nomes para o sobrenome.</p>",
                minlength:"<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   O nome deve conter no mínimo 2 letras.</p>",
                maxlength: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   O nome deve conter no máximo 45 letras.</p>",

            },
            email:{
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
                email: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Formato de e-mail inválido. Exemplo: seuemail@exemplo.com</p>",
            },
            cpf:{
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
                minlength: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   É necessário no mínimo 14 dígitos.</p>",
                maxlength: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   É necessário no máximo 14 dígitos.</p>",
            },
            dataNasc:{
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
                min: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   A data deve ser posterior ou igual a "+$("#dataBR").attr("min")+".</p>",
                max: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   A data deve ser anterior ou igual a "+$("#dataBR").attr("max")+".</p>",
            },
            uf:{
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Selecione um item da lista.</p>",
            },
            cidade: {
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Selecione um item da lista.</p>",
            },
            senha: {
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
                minlength: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   A senha deve conter pelo menos 8 caracteres.</p>",
                passwordCheck: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   A senha deve conter pelo menos: uma letra maiúscula, uma letra minúscula e um dígito.</p>",
            },
            confirmSenha: {
                required: "<p style='font-size: 12px; margin-bottom: 0;'><i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'/>   Preencha este campo.</p>",
            },
        }
    });


    /* This code handles all of the navigation stuff.
    ** Probably leave it. Credit to https://bootsnipp.com/snippets/featured/form-wizard-and-validation
    */
    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            $('input, select').tooltipster("hide");
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    /* Handles validating using jQuery validate.
    */
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input"),
            isValid = true;

        //Loop through all inputs in this form group and validate them.
        for(var i=0; i<curInputs.length; i++){
            if (!$(curInputs[i]).valid()){
                isValid = false;
            }
        }

        if (isValid){
            //Progress to the next page.
            nextStepWizard.removeClass('disabled').trigger('click');
            // # # # AJAX REQUEST HERE # # #

            /*
            Theoretically, in order to preserve the state of the form should the worst happen, we could use an ajax call that would look something like this:

            //Prepare the key-val pairs like a normal post request.
            var fields = {};
            for(var i= 0; i < curInputs.length; i++){
              fields[$(curInputs[i]).attr("name")] = $(curInputs[i]).attr("name").val();
            }

            $.post(
                "location.php",
                fields,
                function(data){
                  //Silent success handler.
                }
            );

            //The FINAL button on last page should have its own logic to finalize the enrolment.
            */
        }
    });

    $('div.setup-panel div a.btn-primary').trigger('click');

});

<!--Início do JS para troca dos Steps do Formulário de Cadastro e do JQuery Validation-->

/* ---------------------------------------------------------------------------------------------------- */




/* ### Página de Cadastro ### */

<!--Início do JS para troca dos Steps do Formulário de Cadastro e do JQuery Validation-->

/*Downloaded from https://www.codeseek.co/brettmichaelorr/bootstrap-form-wizard-with-tooltipster-and-jquery-validate-RaRZLe */
$(document).ready(function () {

    //validation
    $('input, select').tooltipster({
        trigger: 'custom',
        onlyOne: false,
        position: 'right',
        theme: 'tooltipster-light'
    });

    /*jQuery.validator.addMethod("seletor", function(element) {
        return ( $('#uf').val() === "");
    });*/

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




    /*$("#form").validate({
        rules : {
            uf:{
                required: true,
               }
           },
        messages: {
            uf :{
                required: "Preencha o campo",
            }
        }
    });*/

    $("#form").validate({
        rules : {
            nome:{
                required:true,
            },
            sobrenome:{
                required:true,
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
                required:"Preencha este campo",
            },
            sobrenome:{
                required: "Preencha este campo",
            },
            email:{
                required:"Preencha este campo",
                email: "Formato de email Inválido",
            },
            cpf:{
                required: "Preencha este campo",
                minlength: "É necessário no mínimo 14 dígitos",
                maxlength: "É necessário no maximo 14 dígitos",
            },
            dataNasc:{
                required: "Preencha este campo",
                min: "<i class='glyphicon glyphicon-exclamation-sign' style='color: yellow'></i>A data deve ser posterior ou igual a "+ $("#dataBR").attr("min"),
                max: "A data deve ser anterior ou igual a "+$("#dataBR").attr("max"),
            },
            uf:{
                required: "Preencha este campo agora",
            },
            cidade: {
                required: "Preencha este campo",
            },
            senha: {
                required: "Preencha este campo",
                minlength: "A sua senha deve ter pelo menos 8 caracteres",
                passwordCheck: "Necessário conter pelo menos: uma letra maiuscula, uma letra minúscula e um dígito",
            },
            confirmSenha: {
                required: "Preencha este campo",
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




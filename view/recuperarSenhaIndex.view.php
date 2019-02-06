<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 30/01/2019
 * Time: 19:08
 */

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet" href="../css/estiloIndex.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    <script src="../javaScript/JSValidationAlterarSenha.js"></script>
    <script src="../javaScript/JSFadeInDiv.js"></script>
    <script src="../javaScript/JSVerificaCodigoSenha.js"></script>
    <title>ProjectK - Recuperar Senha</title>

</head>
<body>

<video autoplay muted loop id="videoLogin">
    <source src="../videos/Video%20Login.mp4" type="video/mp4">
</video>

<div id="divCodigoRecuperacao" class="col-sm-4">
    <form id="formCodigoVerificacao" method="post" action="">
        <h1><i class="glyphicon glyphicon-lock"></i> Formulário para Recuperação de Senha</h1>
        <h4>Informe aqui o seu código de recuperação.</h4>
        <hr>
        <p>
            <?php if (isset($_GET['msg'])) {
                echo "<p id='mensagemCadastro'><span id='spanSenhaHelp2'>* </span>" . $_GET['msg'] . "<span id='spanSenhaHelp2'> *</span></p>";
            } ?>
        </p>

        <div class="row">
            <div class="form-group col-md-10">
                <label class="labelForm" for="cpf">Código de Recuperação:</label>
                <input type="text" pattern="[0-9]+" class="form-control" id="codigoRecuperacao" name="codigoRecuperacao" placeholder="Digite aqui o código de recuperação..."
                       required minlength="9" maxlength="9">
            </div>
        </div>

        <br/>
        <button id="botaoCodRec" type="button" class="btn btn-info nextBtn" disabled title="Preencha o código de verificação.">Verificar   <i
                    class="glyphicon glyphicon-share-alt"></i></button>
    </form>
</div>

<div id="newDiv">

</div>

</body>
</html>



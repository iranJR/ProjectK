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
    <script src="../javaScript/JSFadeInDiv.js"></script>
    <script src="../plugins/jQuery%20Mask%20Plugin/dist/jquery.mask.min.js"></script>
    <script src="../javaScript/JSFuncoesMascara.js"></script>
    <title>ProjectK - Recuperar Senha</title>

</head>
<body>

<video autoplay muted loop id="videoLogin">
    <source src="../videos/Video%20Login.mp4" type="video/mp4">
</video>

<div id="divRecuperarSenha" class="col-sm-6">
    <form id="formLogin" method="post" action="../controller/recuperarSenha.action.php">
        <h1><i class="glyphicon glyphicon-lock"></i> Formulário para Recuperação de Senha</h1>
        <h4>Preencha os campos abaixo para recuperar sua senha.</h4>
        <hr>
        <p>
            <?php if (isset($_GET['msg'])) {
                echo "<p id='mensagemCadastro'><span id='spanSenhaHelp2'>* </span>" . $_GET['msg'] . "<span id='spanSenhaHelp2'> *</span></p>";
            } ?>
        </p>

        <div class="row">
            <input type="hidden" name="act" value="etapa1"/>
            <div class="form-group col-md-6">
                <label class="labelForm" for="cpf">CPF:</label>
                <input type="text" class="form-control cpf" name="cpf" placeholder="Digite aqui o seu cpf..."
                       required minlength="14">
            </div>
            <div class="form-group col-md-6">
                <label class="labelForm" for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" required
                       placeholder="Digite aqui o seu e-mail...">
            </div>
        </div>

        <br/>
        <button id="botaoRecuperar" type="submit" class="btn btn-info">Próximo   <i
                    class="glyphicon glyphicon-share-alt"></i></button>
    </form>
</div>

</body>
</html>



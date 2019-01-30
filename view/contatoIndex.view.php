<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 04/01/2019
 * Time: 17:11
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
    <script src="../javaScript/JSFuncaoContato.js"></script>
    <title>ProjectK - Contato</title>

</head>
<body>

<video autoplay muted loop id="videoLogin">
    <source src="../videos/Video%20Login.mp4" type="video/mp4">
</video>

<div id="divContato" class="col-sm-6">
    <form id="formLogin" method="post" action="../controller/email.action.php">
        <h1><i class="glyphicon glyphicon-envelope"></i> Formulário de Contato</h1>
        <h4>Preencha o formulário abaixo para entrar em contato conosco.</h4>
        <hr>
        <p>
            <?php if (isset($_GET['msg'])) {
                echo "<p id='mensagemCadastro'><span id='spanSenhaHelp2'>* </span>" . $_GET['msg'] . "<span id='spanSenhaHelp2'> *</span></p>";
            } ?>
        </p>

        <div class="row">
            <input type="hidden" name="pagina" value="contatoIndex"/>
            <div class="form-group col-md-6">
                <label class="labelForm" for="nome">Nome:</label>
                <input type="text" name="nome" class="form-control" required placeholder="Digite aqui o seu nome...">
            </div>
            <div class="form-group col-md-6">
                <label class="labelForm" for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" required
                       placeholder="Digite aqui o seu e-mail...">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-7">
                <label class="labelForm" for="motivo">Motivo:</label>
                <select class="form-control" name="motivo" required>
                    <option disabled selected value="">Selecione o motivo para seu contato...</option>
                    <option value="Elogio">Elogio</option>
                    <option value="Sugestão">Sugestão</option>
                    <option value="Reclamação">Reclamação</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-9">
                <textarea id="txtAreaMensagem" class="form-control" rows="5" name="mensagem" required
                          maxlength="350" placeholder="Digite aqui sua mensagem..." ></textarea>
                <small id="contMensagem" class="form-text text-muted">350 caracteres restantes.</small>
            </div>
        </div>

        <button id="botaoLogin" type="submit" class="btn btn-info">Enviar</button>
    </form>
</div>

</body>
</html>

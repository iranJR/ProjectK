<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 22/12/2018
 * Time: 14:37
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
    <script src="../javaScript/JSValidationLogin.js"></script>
    <script src="../javaScript/JSLoginRecuperarSenha.js"></script>
    <script src="../plugins/jQuery%20Mask%20Plugin/dist/jquery.mask.min.js"></script>
    <script src="../javaScript/JSFuncoesMascara.js"></script>
    <title>ProjectK - Login</title>

</head>
<body>

<video autoplay muted loop id="videoLogin">
    <source src="../videos/Video%20Login.mp4" type="video/mp4">
</video>

<div id="divLogin" class="col-sm-3">
    <form id="formLogin" method="post" action="../controller/login.action.php">
        <h1>ProjectK</h1>
        <hr>
        <p>
            <?php if (isset($_GET['msg'])) {
                echo "<p id='mensagemCadastro'><span id='spanSenhaHelp2'>* </span>".$_GET['msg']."<span id='spanSenhaHelp2'> *</span></p>";
            } ?>
        </p>
        <div class="form-group">
            <label class="labelForm" for="login">Login:</label>
            <input type="email" name="login" class="form-control" required
                   aria-describedby="emailHelp" placeholder="Digite aqui o seu e-mail...">
        </div>
        <div class="form-group">
            <label class="labelForm" for="senha">Senha:</label>
            <input type="password" name="senha" class="form-control" required
                   placeholder="Digite aqui sua senha...">
        </div>
        <div id="divCheck" class="form-group">
            <div id="checkboxLogin" class="form-check">
                <input class="form-check-input" type="checkbox" name="gridCheck" value="true" id="gridCheck">
                <label id="labelCheck" class="form-check-label" for="gridCheck">
                    Permanecer conectado
                </label>
            </div>
        </div>
        <div class="form-group">
            <a id="esqueceuSenha">Esqueceu sua senha ?</a>
        </div>
        <button id="botaoLogin" type="submit" class="btn btn-info">Entrar</button>
        <hr id="hr">
        <p>Ainda não possui cadastro ? <a href="../view/cadastroUsuario.view.php">Clique aqui</a> e cadastre-se agora.</p>
    </form>
</div>

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
        <div class="row">
            <div class="form-group col-md-6">
                <button id="botaoVoltarLogin" class="btn btn-info"><i class="glyphicon glyphicon-circle-arrow-left"></i>
                    Voltar</button>
            </div>
            <div class="form-group col-md-6">
                <button id="botaoRecuperar" type="submit" class="btn btn-info">Próximo   <i
                            class="glyphicon glyphicon-share-alt"></i></button>
            </div>
        </div>

    </form>
</div>

</body>
</html>
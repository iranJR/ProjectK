<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 22/12/2018
 * Time: 20:14
 */

$dataMax = date("Y-m-d", strtotime("-18 years"));
$dataMaxBR = date("d-m-Y", strtotime("-18 years"));

$dataMin = date("Y-m-d", strtotime("- 90 years"));
$dataMinBR = date("d-m-Y", strtotime("- 90 years"));

require_once("../dao/UfDAO.php");

$ufDAO = new UfDAO();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estiloIndex.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    <script src="../javaScript/JSCadastroJQueryValidation.js"></script>
    <script src="../javaScript/JSFadeInDiv.js"></script>
    <script src="../javaScript/JSFuncoesAjax.js"></script>
    <script src="../javaScript/JSFuncoesSenha.js"></script>
    <script src="../plugins/jQuery%20Mask%20Plugin/dist/jquery.mask.min.js"></script>
    <script src="../javaScript/JSFuncoesMascara.js"></script>
    <title>ProjectK - Cadastro</title>

</head>

<body>

<video autoplay muted loop id="videoLogin">
    <source src="../videos/Video%20Login.mp4" type="video/mp4">
</video>

<div class="container col-sm-6" id="divCadastro">

    <h1><i class="glyphicon glyphicon-user"></i> Cadastro de Usuário</h1>

    <?php if (isset($_GET['msg'])) {
        echo "<hr id='hrCadastro'>";
        echo "<p id='mensagemCadastro'><span id='spanSenhaHelp2'>* </span>".$_GET['msg']."<span id='spanSenhaHelp2'> *</span></p>";
    } ?>

    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle"><i
                            class="glyphicon glyphicon-calendar"></i></a>
                <p>Dados Pessoais</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle disabled"><i
                            class="glyphicon glyphicon-map-marker"></i></a>
                <p>Endereço</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle disabled"><i
                            class="glyphicon glyphicon-lock"></i></a>
                <p>Dados de Acesso</p>
            </div>
        </div>
    </div>

    <form role="form" id="form" name="form" method="post" action="../controller/cadastroUsuario.action.php?act=save">

        <div class="row setup-content" id="step-1">
            <fieldset id="fieldsetCadastro">
                <legend>Dados Pessoais:</legend>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome" placeholder="Digite aqui o seu nome..."
                               required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sobrenome">Sobrenome:</label>
                        <input type="text" class="form-control" name="sobrenome"
                               placeholder="Digite aqui o seu sobrenome..." required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control cpf" name="cpf" placeholder="Digite aqui o seu cpf..."
                               required minlength="14">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dataNasc">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="dataNasc" name="dataNasc" min="<?= $dataMin ?>" max="<?= $dataMax ?>" required>
                    </div>
                    <input type="hidden" class="form-control" id="dataBR" name="dataBR" min="<?= $dataMinBR ?>" max="<?= $dataMaxBR ?>" required>
                </div>
                <div class="row">
                    <div class="form-group col-md-1">
                        <label for="sexo">Sexo: </label>
                    </div>
                    <div id="inputSexo" class="form-group col-md-6">
                        <label class="radio-inline"><input type="radio" name="sexo" value="masculino"
                                                           checked>Masculino</label>
                        <label class="radio-inline"><input type="radio" name="sexo" value="feminino">Feminino</label>
                    </div>
                </div>
                <button id="botaoProximo" class="btn btn-primary nextBtn pull-right" type="button">Próximo   <i class="glyphicon glyphicon-share-alt"></i></button>
            </fieldset>
        </div>

        <div class="row setup-content" id="step-2">
            <fieldset id="fieldsetCadastro">
                <legend>Endereço:</legend>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="uf">Estado:</label>
                        <select id="uf" class="form-control" name="uf" required>
                            <option disabled selected value="">Selecione o seu estado...</option>
                            <?php
                            foreach ($ufDAO->buscarTodos() as $uf) {
                                echo "<option value='$uf->idUf'>$uf->nomeUf</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cidade">Cidade:</label>
                        <select id="cidade" class="form-control" name="cidade" required>
                            <option disabled selected value="">Selecione a sua cidade...</option>
                        </select>
                    </div>
                </div>

                <button id="botaoProximo" class="btn btn-primary nextBtn pull-right" type="button">Próximo   <i class="glyphicon glyphicon-share-alt"></i></button>
            </fieldset>
        </div>

        <div class="row setup-content" id="step-3">
            <fieldset id="fieldsetCadastro">
                <legend>Dados de Acesso:</legend>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" placeholder="Digite aqui seu e-mail..."
                               required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha"
                               placeholder="Digite aqui sua senha..."
                               required passwordCheck="passwordCheck" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                               title="A sua senha deve ter pelo menos 8 caracteres e conter pelo menos: uma letra maiúscula, uma letra minúscula e um dígito. ">
                        <small id="senhaHelp" class="form-text text-muted"><span id="spanSenhaHelp2">*</span> Força da
                            Senha : <span id="spanSenhaHelp"></span>
                            <div id="barraForca" class="progress">
                                <div id="barra" class="progress-bar" role="progressbar"></div>
                            </div>
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirmSenha">Confirme sua senha:</label>
                        <input type="password" class="form-control" id="confirmSenha" name="confirmSenha"
                               placeholder="Digite sua senha novamente..." title="As senhas devem ser iguais"
                               required>
                        <small id="confirmSenhaHelp" class="form-text text-muted"><span id="spanSenhaHelp2">*</span>
                            <span id="spanConfirmSenha">Atenção : </span> <span id="textSpanSenhaHelp">As senhas devem ser iguais ! </span><span
                                    id="spanSenhaHelp2">*</span></small>
                    </div>
                </div>
            </fieldset>
            <button id="botaoLogin" type="submit" disabled class="btn btn-info"
                    title="Preencha todos os campos do formulário">Cadastrar   <i class="glyphicon glyphicon-check"></i>
            </button>
        </div>

    </form>
</div>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 16/01/2019
 * Time: 08:52
 */

/*Nomeclaturando sessão*/
session_name(hash('sha256',$_SERVER['SERVER_ADDR'].$_SERVER['REMOTE_ADDR']));

/* Iniciando a sessão.*/
session_start();

//Verificação de segurança. Se não houver usuário logado, redireciona para a página de login.
if((empty($_SESSION['idUsuario']) || empty($_SESSION['nomeUsuario']) || empty($_SESSION['fotoPerfil'])) &&
    (empty($_COOKIE[hash('sha256','idUsuario')]) || empty($_COOKIE[hash('sha256','nomeUsuario')]) ||
        empty($_COOKIE[hash('sha256','fotoPerfil')]) || empty($_COOKIE[hash('sha256','senha')]) ||
        empty($_COOKIE[hash('sha256','email')]))){

    $msg = "É necessário estar logado para acessar esta página !";
    //echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

// Verificação se usuário está logado via sessão.
if(!empty($_SESSION['idUsuario']) || !empty($_SESSION['nomeUsuario']) || !empty($_SESSION['fotoPerfil'])) {

    $idUsuario = $_SESSION['idUsuario'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $fotoPerfil = $_SESSION['fotoPerfil'];
}

// Verificação se usuário está logado via cookie.
if(!empty($_COOKIE[hash('sha256','idUsuario')]) || !empty($_COOKIE[hash('sha256','nomeUsuario')]) ||
    !empty($_COOKIE[hash('sha256','fotoPerfil')]) || !empty($_COOKIE[hash('sha256','senha')]) ||
    !empty($_COOKIE[hash('sha256','email')])){

    $idUsuario = base64_decode($_COOKIE[hash('sha256','idUsuario')]);
    $nomeUsuario = base64_decode($_COOKIE[hash('sha256','nomeUsuario')]);
    $fotoPerfil = base64_decode($_COOKIE[hash('sha256','fotoPerfil')]);
}

require_once ("../view/templatePaginaInicial.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet" href="../css/estiloPaginaInicial.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estiloPaginaInicial.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    <script src="../javaScript/JSFuncaoContato.js"></script>
    <script src="../javaScript/JSFuncoesSenha.js"></script>
    <script src="../javaScript/JSValidationAlterarSenha.js"></script>
    <script src="../javaScript/JSFuncoesAjax.js"></script>
    <script src="../javaScript/JSFuncoesPaginaInicial.js"></script>
    <title>ProjectK - Modificar Senha</title>
</head>
<body>

<!--Cabeçalho do site-->
<?php cabecalho($nomeUsuario, $fotoPerfil, $idUsuario); ?>
<!--Fim do Cabeçalho do site -->

<!--Menu Horizontal de Ações -->
<?php menuHorizontal($idUsuario); ?>
<!-- Fim do Menu Horizontal de Ações -->

<!-- Inicio da Div Geral da Página -->
<div class='container-fluid text-center'>
    <div class='row content'>
        <!-- Pausa na Div Geral da Página -->

        <!-- Início do Menu Lateral do Usuário -->
        <?php menuLateralEsquerdoUsuario($fotoPerfil, $idUsuario); ?>
        <!-- Início do Menu Lateral do Usuário -->

        <!-- Início da Div Central da Página, Alterar Senha -->
        <!-- Alterar senha (digita seu cpf, digite sua senha atual, confirme sua senha atual, digite sua nova senha,
        confirme sua nova senha);  -->

        <div id='divMural' class='col-sm-8 text-left'>
            <div id='divAlterarSenha' class="col-sm-10">
               <form id="formLogin" method="post" action="../controller/recuperarSenha.action.php?act=save">
                   <h2><i class='glyphicon glyphicon-pencil'></i>   Modificar Senha</h2>
                   <h4>Confirme sua senha atual, para alterar a senha</h4>
                   <hr>
                   <p>
                       <?php if (isset($_GET['msg'])) {
                           echo "<p id='mensagemContato'><span id='spanMensagemContato'>* </span>" . $_GET['msg'] . "<span id='spanMensagemContato'> *</span></p>";
                       } ?>
                   </p>
                   <div class="row">
                       <div class="form-group col-md-6">
                            <input type="hidden" name="usuario" value="<?= $idUsuario ?>">
                            <label class="labelForm" for="nome">Senha Atual:</label>
                            <input class="form-control" type="password" name="senhaAtual" id="senhaAtual" placeholder="Digite sua senha atual...">
                       </div>
                   </div>
                   <hr>

                   <div class="row">
                       <div class="form-group col-md-6">
                           <label for="senha">Nova Senha:</label>
                           <input type="password" class="form-control" id="senha" name="senha"
                                  placeholder="Digite aqui sua nova senha..."
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
                   <hr>
                   <div class="row">
                       <button id="botaoAlterarSenha" type="submit" class="btn btn-info">Alterar   <i class='glyphicon glyphicon-ok'></i></button>
                   </div>
               </form>
            </div>
        </div>
        <!-- Fim da Div Central da Página, Alterar Senha -->

        <!-- Início do Menu Lateral Direito, Menu de Amigos -->
        <?php menuLateralDireitoAmigos($idUsuario); ?>
        <!-- Fim do Menu Lateral Direito, Menu de Amigos -->

        <!-- Retorno da Pausa na Div Geral da Página -->
    </div>
</div>
<!-- Fim da Div Geral da Página -->

<!-- Inicio do Rodapé -->
<?php rodape(); ?>
<!-- Fim do Rodapé -->

</body>
</html>


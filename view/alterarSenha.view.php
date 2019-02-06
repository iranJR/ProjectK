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

$idUsuario = 1;
$nomeUsuario = "ciro";
$fotoPerfil = "";

//Verificação de segurança. Se não houver usuário logado, redireciona para a página de login.
if((empty($_SESSION['idUsuario']) || empty($_SESSION['nomeUsuario']) || empty($_SESSION['fotoPerfil'])) &&
    (empty($_COOKIE[hash('sha256','idUsuario')]) || empty($_COOKIE[hash('sha256','nomeUsuario')]) ||
        empty($_COOKIE[hash('sha256','fotoPerfil')]) || empty($_COOKIE[hash('sha256','senha')]) ||
        empty($_COOKIE[hash('sha256','email')]))){

    $msg = "É necessário estar logado para acessar esta página !";
    // echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
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
    <title>ProjectK - Alterar Senha</title>
</head>
<body>

<!--Cabeçalho do site-->
<?php cabecalho($nomeUsuario, $fotoPerfil, $idUsuario); ?>
<!--Fim do Cabeçalho do site -->

<!--Menu Horizontal de Ações -->
<?php menuHorizontal(); ?>
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

        <div id='divMural'>
            <div id='divAlterarSenha' class="form-group col-md-6">
               <form id="formLogin" method="post" action="../controller/recuperarSenha.action.php?act=save">
                   <div class="row">
                       <h4>Alterar Senha</h4>
                       <hr>
                       <div class="form-group col-md-8">
                            <input type="hidden" name="usuario" value="<?= $idUsuario ?>">
                            <label class="labelForm" for="nome">Senha Atual:</label>
                            <input type="password" name="senhaAtual" id="senhaAtual" placeholder="Digite sua senha atual...">
                       </div>
                   </div>
                   <hr>
                   <div class="row">
                       <div class="form-group col-md-8">
                           <label class="labelForm" for="nome">Nova Senha:</label>
                           <input type="password" name="senhaNova" id="senhaNova" placeholder="Digite sua senha nova...">
                              <p>
                                 <small id="senhaHelp" class="form-text text-muted"><span id="spanSenhaHelp2">*</span> Força da
                                      Senha : <span id="spanSenhaHelp"> </span>
                                      <div id="barraForca" class="progress">
                                          <div id="barra" class="progress-bar" role="progressbar"></div>
                                      </div>
                                 </small>
                              </p>
                       </div>
                   </div>
                   <hr>
                   <div class="row">
                       <div class="form-group col-md-10">
                           <label class="labelForm" for="nome">Confirme a Nova Senha:</label>
                           <input type="password" name="confirmSenhaNova" id="confirmSenhaNova" placeholder="Confirme sua senha nova...">
                           <p>
                              <small id="confirmSenhaHelp" class="form-text text-muted">
                                 <span id="spanSenhaHelp2">*</span>
                                 <span id="spanConfirmSenha">Atenção : </span>
                                 <span id="textSpanSenhaHelp">As senhas devem ser iguais ! </span>
                                 <span id="spanSenhaHelp2">*</span>
                              </small>
                           </p>
                       </div>
                   </div>
                   <hr>
                   <div class="row">
                       <div class="form-group col-md-13">
                            <button id="botaoAlterarSenha" type="submit" class="btn btn-info">Alterar</button>
                       </div>
                   </div>
               </form>
            </div>
        </div>
        <!-- Fim da Div Central da Página, Alterar Senha -->

        <!-- Início do Menu Lateral Direito, Menu de Amigos -->
        <?php menuLateralDireitoAmigos(); ?>
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


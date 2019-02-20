<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 15/02/2019
 * Time: 15:29
 */

require_once("../view/templatePaginaInicial.php");

/*Nomeclaturando sessão*/
session_name(hash('sha256', $_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR']));

// Iniciando a sessão.
session_start();

//Verificação de segurança. Se não houver usuário logado, redireciona para a página de login.
if ((empty($_SESSION['idUsuario']) || empty($_SESSION['nomeUsuario']) || empty($_SESSION['fotoPerfil'])) &&
    (empty($_COOKIE[hash('sha256', 'idUsuario')]) || empty($_COOKIE[hash('sha256', 'nomeUsuario')]) ||
        empty($_COOKIE[hash('sha256', 'fotoPerfil')]) || empty($_COOKIE[hash('sha256', 'senha')]) ||
        empty($_COOKIE[hash('sha256', 'email')]))) {

    $msg = "É necessário estar logado para acessar esta página !";
    echo "<script>window.location.href='../view/login.view.php?msg=" . $msg . "'</script>";
}

// Verificação se usuário está logado via sessão.
if (!empty($_SESSION['idUsuario']) || !empty($_SESSION['nomeUsuario']) ||
    !empty($_SESSION['fotoPerfil'])) {

    $idUsuario = $_SESSION['idUsuario'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $fotoPerfil = $_SESSION['fotoPerfil'];
}

// Verificação se usuário está logado via cookie.
if (!empty($_COOKIE[hash('sha256', 'idUsuario')]) || !empty($_COOKIE[hash('sha256', 'nomeUsuario')]) ||
    !empty($_COOKIE[hash('sha256', 'fotoPerfil')]) || !empty($_COOKIE[hash('sha256', 'senha')]) ||
    !empty($_COOKIE[hash('sha256', 'email')])) {

    $idUsuario = base64_decode($_COOKIE[hash('sha256', 'idUsuario')]);
    $nomeUsuario = base64_decode($_COOKIE[hash('sha256', 'nomeUsuario')]);
    $fotoPerfil = base64_decode($_COOKIE[hash('sha256', 'fotoPerfil')]);
}

require_once("../model/Usuario.php");
require_once("../dao/UsuarioDAO.php");
require_once ("../model/Cidade.php");
require_once ("../dao/CidadeDAO.php");
require_once ("../model/Uf.php");
require_once ("../dao/UfDAO.php");

$usuario = new Usuario('', '', '', '', '', '', '', '',
    '', '', '', '');
$cidade = new Cidade('','','');
$uf = new Uf('','','');
$usuarioDAO = new UsuarioDAO();
$cidadeDAO = new CidadeDAO();
$ufDAO = new UfDAO();

$usuario = $usuarioDAO->buscarPeloId($idUsuario);
$cidade = $cidadeDAO->buscarPeloId($usuario->getCidade());
$uf = $ufDAO->buscarPeloId($usuario->getEstado());

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet" href="../css/estiloPaginaInicial.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tooltipster/3.3.0/js/jquery.tooltipster.min.js'></script>
    <script src='https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js'></script>
    <script src="../javaScript/JSFuncoesAjax.js"></script>
    <script src="../javaScript/JSFuncoesPaginaInicial.js"></script>
    <title>ProjectK - Dados Cadastrais</title>

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

        <!-- Início da Div Central da Página, Mural de Notícias -->
        <div id='divMural' class='col-sm-8 text-left'>
            <div id="divConfiguracoes" class="col-sm-12">
                <h2><i class="glyphicon glyphicon-wrench"></i> Dados Cadastrais</h2>
                <hr id="hrPaginaPerfil">
                <div id="divDadosCadastrais" class="row" >
                    <div class="col-md-6">
                        <p><span>Nome:</span> <?= $usuario->getNome() ?></p>
                        <p><span>Sobrenome:</span> <?= $usuario->getSobrenome() ?></p>
                        <p><span>CPF:</span> <?= base64_decode($usuario->getCpf()) ?></p>
                        <p><span>E-mail:</span> <?= base64_decode($usuario->getEmail()) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><span>Sexo:</span> <?= mb_convert_case($usuario->getSexo(), MB_CASE_TITLE) ?></p>
                        <p><span>Data de Nascimento:</span> <?= date("d/m/Y", strtotime($usuario->getDataNascimento())) ?>,
                            <?= date("Y") - date("Y", strtotime($usuario->getDataNascimento())) ?> anos.</p>
                        <p><span>Localidade:</span> <?= $cidade->getNomeCidade() ?> - <?= $uf->getNomeUf() ?></p>
                        <p><span>Membro desde:</span> <?= strftime('%d de %B de %Y.', strtotime($usuario->getDataCadastro())) ?></p>
                    </div>
                    <small id="smallDadosCadastraisEditar"><a href=""><i class="glyphicon glyphicon-pencil"></i>   Editar Perfil</a></small>
                </div>
                <hr/>
                <div class="row">
                <ul>
                    <li><a href="../view/modificarEmail.view.php"><i class="glyphicon glyphicon-envelope"></i> Modificar
                            E-mail</a></li>
                    <li><a href="../view/recuperarSenha.view.php"><i class="glyphicon glyphicon-lock"></i> Modificar
                            Senha</a></li>
                    <li><a href="../view/contato.view.php"><i class="glyphicon glyphicon-comment"></i> Fale Conosco</a></li>
                </ul>
                </div>
            </div>
        </div>
        <!-- Fim da Div Central da Página, Mural de Notícias -->

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
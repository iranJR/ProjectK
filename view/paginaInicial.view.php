<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 28/12/2018
 * Time: 13:28
 */

require_once ("../view/templatePaginaInicial.php");

/*Nomeclaturando sessão*/
session_name(hash('sha256',$_SERVER['SERVER_ADDR'].$_SERVER['REMOTE_ADDR']));

/* Iniciando a sessão.*/
session_start();

//Verificação de segurança. Se não houver usuário logado, redireciona para a página de login.
if((empty($_SESSION['idUsuario']) || empty($_SESSION['nomeUsuario']) || empty($_SESSION['fotoPerfil'])) &&
    (empty($_COOKIE[hash('sha256','idUsuario')]) || empty($_COOKIE[hash('sha256','nomeUsuario')])||
        empty($_COOKIE[hash('sha256','fotoPerfil')]) || empty($_COOKIE[hash('sha256','senha')]) ||
        empty($_COOKIE[hash('sha256','email')]))){

    $msg = "É necessário estar logado para acessar esta página !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

// Verificação se usuário está logado via sessão.
if(!empty($_SESSION['idUsuario']) || !empty($_SESSION['nomeUsuario']) ||
    !empty($_SESSION['fotoPerfil'])) {

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
    <script src="../javaScript/JSFuncoesAjax.js"></script>
    <title>ProjectK - Página Inicial</title>

</head>
<body>

<!--Cabeçalho do site-->
    <!-- O cabeçalho do site, requer três paramêtros agora, nome de usuário, foto de perfil e id do usuário
    atribuidos via sessão ou cookies -->
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
        <!-- O cabeçalho do site, requer dois paramêtros agora, foto de perfil e id do usuário
        atribuidos via sessão ou cookies -->
        <?php menuLateralEsquerdoUsuario($fotoPerfil, $idUsuario); ?>
        <!-- Início do Menu Lateral do Usuário -->

        <!-- Início da Div Central da Página, Mural de Notícias -->
            <?php muralDeNoticias(); ?>
        <!-- Fim da Div Central da Página, Mural de Notícias -->

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
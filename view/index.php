<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 20/12/2018
 * Time: 17:24
 */

//Verifica se existe um cookie de login criado, se houver compara os dados criptografados com os
// dados do banco, se tudo ok, redireciona para a página inicial.
if(!empty($_COOKIE[hash('sha256','idUsuario')]) && !empty($_COOKIE[hash('sha256','nomeUsuario')])
    && !empty($_COOKIE[hash('sha256','fotoPerfil')]) && !empty($_COOKIE[hash('sha256','senha')])
    && !empty($_COOKIE[hash('sha256','email')])){

    require_once ("../model/Usuario.php");
    require_once ("../dao/UsuarioDAO.php");

    $usuario = new Usuario('','','','','','',
        '','','','','','');
    $usuarioDao = new UsuarioDAO();
    $usuario = $usuarioDao->buscarPeloId(base64_decode($_COOKIE[hash('sha256','idUsuario')]));

    if($usuario->getEmail() == base64_decode($_COOKIE[hash('sha256','email')]) &&
        $usuario->getSenha() == base64_decode($_COOKIE[hash('sha256','senha')])){
        echo "<script>window.location.href='paginaInicial.view.php'</script>";
    }
}

/*Nomeclaturando sessão*/
session_name(hash('sha256', $_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR']));

/* Iniciando a sessão.*/
session_start();

//Verifica se existe um sessão criada, se houver compara os dados com os
// dados do banco, se tudo ok, redireciona para a página inicial.
if (!empty($_SESSION['idUsuario']) && !empty($_SESSION['nomeUsuario']) &&
!empty($_SESSION['fotoPerfil'])) {

    require_once ("../model/Usuario.php");
    require_once ("../dao/UsuarioDAO.php");

    $usuario = new Usuario('','','','','','',
        '','','','','','');
    $usuarioDao = new UsuarioDAO();
    $usuario = $usuarioDao->buscarPeloId($_SESSION['idUsuario']);

    if($usuario->getIdUsuario() == $_SESSION['idUsuario'] && $usuario->getNome() == $_SESSION['nomeUsuario']
    && $usuario->getFotoPerfil() == $_SESSION['fotoPerfil']){
        echo "<script>window.location.href='paginaInicial.view.php'</script>";
    }

}

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
    <script src="../javaScript/JSFadeInDiv.js"></script>
    <title>ProjectK</title>
</head>
<body>

<video autoplay muted loop id="videoIndex">
    <source src="../videos/Video%20Login.mp4" type="video/mp4">
</video>

<div id="divIndex" class="col-sm-5">
    <h3>Seja bem vindo ao</h3>
    <h1>ProjectK</h1>
    <h3>Sua rede social esportiva</h3>
    <div class="row">
        <div class="form-group col-md-5">
            <a id="botaoIndex" type="submit" class="btn btn-info" href="login.view.php" >Entrar</a>
        </div>
        <div class="form-group col-md-5">
            <a id="botaoIndex" type="submit" class="btn btn-info" href="cadastroUsuario.view.php" >Cadastrar</a>
        </div>
    </div>
</div>

<div class="content">
    <div id="rodapeIndex" class="col-md-12 text-center container-fluid">
        <p>ProjectK ® - 2018</p>
        <p><a href='contatoIndex.view.php'>Entre em contato conosco.</a></p>
        <p id='pDevs'>Desenvolvido por: Ciro Gustavo e Iran Junior</p>
    </div>
</div>

</body>
</html>

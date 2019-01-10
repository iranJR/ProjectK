<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 08/01/2019
 * Time: 21:22
 */
//Inicia a sessão.
session_start();

//Se usuário logado via sessão, limpa sessão e a destrói.
if(!empty($_SESSION['idUsuario']) || !empty($_SESSION['nomeUsuario']) ||
    !empty($_SESSION['fotoPerfil'])){

    $_SESSION['idUsuario'] = null;
    $_SESSION['nomeUsuario'] = null;
    $_SESSION['fotoPerfil'] = null;

    unset($_SESSION['idUsuario']);
    unset($_SESSION['nomeUsuario']);
    unset($_SESSION['fotoPerfil']);

    session_destroy();
    echo "<script>window.location.href='../view/index.php'</script>";
}

//Se usuário logado via cookies, limpa os cookies e os destrói.
if(!empty($_COOKIE['idUsuario']) || !empty($_COOKIE['nomeUsuario']) || !empty($_COOKIE['fotoPerfil']) ||
    !empty($_COOKIE['senha']) || !empty($_COOKIE['email'])){

    setcookie("idUsuario", '', time()-3600, '/');
    setcookie("nomeUsuario", '', time()-3600, '/');
    setcookie("fotoPerfil", '', time()-3600, '/');
    setcookie("senha", '', time()-3600, '/');
    setcookie("email", '', time()-3600, '/');

    unset($_COOKIE['idUsuario']);
    unset($_COOKIE['nomeUsuario']);
    unset($_COOKIE['fotoPerfil']);
    unset($_COOKIE['senha']);
    unset($_COOKIE['email']);

    session_destroy();
    echo "<script>window.location.href='../view/index.php'</script>";
}



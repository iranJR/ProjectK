<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 08/01/2019
 * Time: 21:22
 */
/*Nomeclaturando sessão*/
session_name(hash('sha256',$_SERVER['SERVER_ADDR'].$_SERVER['REMOTE_ADDR']));

/*Inicia a sessão.*/
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
if(!empty($_COOKIE[hash('sha256','idUsuario')]) || !empty($_COOKIE[hash('sha256','nomeUsuario')]) ||
    !empty($_COOKIE[hash('sha256','fotoPerfil')]) || !empty($_COOKIE[hash('sha256','senha')]) ||
    !empty($_COOKIE[hash('sha256','email')])){

    setcookie(hash('sha256',"idUsuario"), '', time()-3600, '/');
    setcookie(hash('sha256',"nomeUsuario"), '', time()-3600, '/');
    setcookie(hash('sha256',"fotoPerfil"), '', time()-3600, '/');
    setcookie(hash('sha256',"senha"), '', time()-3600, '/');
    setcookie(hash('sha256',"email"), '', time()-3600, '/');

    unset($_COOKIE[hash('sha256','idUsuario')]);
    unset($_COOKIE[hash('sha256','nomeUsuario')]);
    unset($_COOKIE[hash('sha256','fotoPerfil')]);
    unset($_COOKIE[hash('sha256','senha')]);
    unset($_COOKIE[hash('sha256','email')]);

    session_destroy();
    echo "<script>window.location.href='../view/index.php'</script>";
}



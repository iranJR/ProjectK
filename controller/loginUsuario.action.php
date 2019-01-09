<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 05/01/2019
 * Time: 16:55
 */

require_once ('../dao/usuarioDao.php');
require_once ('../model/Usuario.php');

/*Inicia a sessão*/
session_start();

/*Verifica se foi setado no input um email e uma senha*/
if(!empty($_POST['login']) && !empty($_POST['senha'])){
    $email = base64_decode($_POST['login']);
    $senha = hash('sha256', $_POST['senha']);
    $usuario = new Usuario('','','','','','','','',
        '','','','');
    $dao = new usuarioDao();
    $usuario = $dao->buscarPeloLogin($email, $senha);
    if($usuario->getEmail() == $email && $usuario->getSenha() == $senha){
        $_SESSION['idUsuario'] = $usuario->getIdUsuario();
        $_SESSION['nomeUsuario'] = $usuario->getNome();
        $_SESSION['fotoPerfil'] = $usuario->getFotoPerfil();
        echo "<script>window.location.href='../view/paginaInicial.view.php'</script>";
        echo "entrou";
    }
    else{
        $msg = "Login ou senha incorretos !";
        echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
    }
}
else{
    $msg = "Por favor digite um login e uma senha !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

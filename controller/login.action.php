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
    $email = base64_encode($_POST['login']);
    $senha = hash('sha256', $_POST['senha']);
    $usuario = new Usuario('','','','','','','','',
        '','','','');
    $dao = new usuarioDao();
    $usuario = $dao->buscarPeloLogin($email, $senha);
    if($usuario->getEmail() == $email && $usuario->getSenha() == $senha){

        //Verifica se o checkbox Permanecer Conectado está marcado. Se sim, cria os cookies da sessão.
        // Senão, cria os paramêtros da sessão.
        if(!empty($_POST['gridCheck'])){
            // Valor para expiração do cookie de 7 dias.
            // Fórmula: Data atual + 60 minutos + 60 segundos + 24 horas + 7 dias.
            $expira = time() + (60 * 60 * 24 * 7);
            setcookie("idUsuario", base64_encode($usuario->getIdUsuario()), $expira, '/');
            setcookie("nomeUsuario", base64_encode($usuario->getNome()), $expira, '/');
            setcookie("fotoPerfil", base64_encode($usuario->getFotoPerfil()), $expira, '/');
            setcookie("senha", base64_encode($usuario->getSenha()), $expira, '/');
            setcookie("email", base64_encode($usuario->getEmail()), $expira, '/');
            echo "<script>window.location.href='../view/paginaInicial.view.php'</script>";
        }
        else{
            $_SESSION['idUsuario'] = $usuario->getIdUsuario();
            $_SESSION['nomeUsuario'] = $usuario->getNome();
            $_SESSION['fotoPerfil'] = $usuario->getFotoPerfil();
            echo "<script>window.location.href='../view/paginaInicial.view.php'</script>";
        }
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

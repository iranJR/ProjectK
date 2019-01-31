<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 05/01/2019
 * Time: 16:55
 */

require_once ('../dao/usuarioDao.php');
require_once ('../model/Usuario.php');

/*Nomeclaturando sessão*/
session_name(hash('sha256',$_SERVER['SERVER_ADDR'].$_SERVER['REMOTE_ADDR']));

/*Inicia a sessão*/
session_start();

$email = $senha = null;

/*Verifica se foi setado no input um email e uma senha*/
if(!empty($_POST['login']) && !empty($_POST['senha'])) {

    // verifica se o email está no formato correto
    if (filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['login'];
    }
    // verifica se a senha está no formato correto
    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $_POST['senha'])) {
        $senha = $_POST['senha'];
    }

    if ($email != null && $senha != null) {
        $email = base64_encode($_POST['login']);
        $senha = hash('sha256', $_POST['senha']);
        $usuario = new Usuario('', '', '', '', '', '', '', '',
            '', '', '', '');
        $dao = new UsuarioDAO();
        $usuario = $dao->buscarPeloLogin($email, $senha);
        if ($usuario->getEmail() == $email && $usuario->getSenha() == $senha) {

            //Verifica se o checkbox Permanecer Conectado está marcado. Se sim, cria os cookies da sessão.
            // Senão, cria os paramêtros da sessão.
            if (!empty($_POST['gridCheck'])) {
                // Valor para expiração do cookie de 7 dias.
                // Fórmula: Data atual + 60 minutos + 60 segundos + 24 horas + 7 dias.
                $expira = time() + (60 * 60 * 24 * 7);
                setcookie(hash('sha256',"idUsuario"), base64_encode($usuario->getIdUsuario()), $expira, '/');
                setcookie(hash('sha256',"nomeUsuario"), base64_encode($usuario->getNome()), $expira, '/');
                setcookie(hash('sha256',"senha"), base64_encode($usuario->getSenha()), $expira, '/');
                setcookie(hash('sha256',"email"), base64_encode($usuario->getEmail()), $expira, '/');
                setcookie(hash('sha256',"fotoPerfil"), base64_encode($usuario->getFotoPerfil()), $expira, '/');
                echo "<script>window.location.href='../view/paginaInicial.view.php'</script>";

            } else {

                $_SESSION['idUsuario'] = $usuario->getIdUsuario();
                $_SESSION['nomeUsuario'] = $usuario->getNome();
                $_SESSION['fotoPerfil'] = $usuario->getFotoPerfil();
                echo "<script>window.location.href='../view/paginaInicial.view.php'</script>";
            }
        } else {
            $msg = "Login ou senha incorretos !";
            echo "<script>window.location.href='../view/login.view.php?msg=" . $msg . "'</script>";
        }
    } else {
        $msg = "Aviso: Navegação suspeita, para um navegação segura verifique se todos os plugins estão ativados !";
        echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
    }
}else{
    $msg = "Por favor digite um login e uma senha !";
    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

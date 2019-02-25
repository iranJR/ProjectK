<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 15/02/2019
 * Time: 14:53
 */

require_once ("../model/Usuario.php");
require_once ("../dao/UsuarioDAO.php");

if($_GET['act'] == 'save') {
    if(!empty($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['usuario'])
        && !empty($_POST['confirmSenha']))
    {
        $email = $senha = null;

        // verifica se o email está no formato correto
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        }

        // verifica se a senha possui ao menos um digito, uma letra maiscula, uma minuscula e possi no mínimo 8 caracteres
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $_POST['senha'])) {
            // verifica se a senha e a senha confirmada são iguais
            if ($_POST['senha'] == $_POST['confirmSenha']) {
                $senha = $_POST['senha'];
            }
        }

        if($email != null && $senha != null){
            $email = base64_encode($_POST['email']);
            $senha = hash('sha256', $_POST['senha']);

            $usuario = new Usuario('', '', '', '', '', '', '', '',
                '', '', '', '');

            $dao = new UsuarioDAO();

            $usuario = $dao->buscarPeloId($_POST['usuario']);

            if($usuario->getIdUsuario() != null && $usuario->getSenha() == $senha){

                $usuario->setEmail($email);

                $dao->alterar($usuario);

                $msg = "E-mail alterado com sucesso !";
                echo "<script>window.location.href='../view/modificarEmail.view.php?msg=" . $msg . "'</script>";
            }
            else {
                $msg = "Usuário e senha não conferem !";
                echo "<script>window.location.href='../view/modificarEmail.view.php?msg=" . $msg . "'</script>";
            }

        }
        else{
            $msg = "Aviso: Navegação suspeita, para uma navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/modificarEmail.view.php?msg=".$msg."'</script>";
        }
    }
    else{
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/modificarEmail.view.php?msg=".$msg."'</script>";
    }
}
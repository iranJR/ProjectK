<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 17/01/2019
 * Time: 16:32
 */

require_once ('../dao/usuarioDao.php');
require_once ('../model/Usuario.php');

$senhaAtual = $senhaNova = null;

if($_GET['act'] == 'save') {
    if (!empty($_POST['senhaAtual']) && !empty($_POST['senhaNova'])) {
        // verifica se a senha atual está no formato correto
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $_POST['senhaAtual'])) {
            try{
                $dao = new UsuarioDAO();
                $usuario = new Usuario('','','','','','','','',
                    '','','','');
                $usuario = $dao->buscarPeloId($_POST['usuario']); // $_POST['usuario']
                $senha = $usuario->getSenha();
                if(hash('sha256',$_POST['senhaAtual']) == $senha){
                    $senhaAtual = $_POST['senhaAtual'];
                }
            }catch(PDOException $erro){
                $msg = "Senha atual está errada: " . $erro->getMessage();
                echo "<script>window.location.href='../view/alterarSenha.view.php?msg=".$msg."'</script>";
            }
        }
        // verifica se a senha nova está no formato correto
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $_POST['senhaNova'])) {
            // confirmação de senha nova
            if ($_POST['senhaNova'] == $_POST['confirmSenhaNova']) {
                $senhaNova = $_POST['senhaNova'];
            }
        }
        // verifica se todos os dados estão de acordo com o formato correto e inicia a alteração da senha
        if ($senhaAtual != null && $senhaNova != null) {
            try {
                $dao = new UsuarioDAO();
                $usuario = new Usuario('','','','','','','','',
                    '','','','');
                $usuario = $dao->buscarPeloId($_POST['usuario']); // $_POST['usuario']
                $usuario->setSenha(hash('sha256',$senhaNova));
                $dao->alterar($usuario);

                $msg = "Sua senha foi alterada com sucesso !";
                echo "<script>window.location.href='../view/alterarSenha.view.php?msg=".$msg."'</script>";

            } catch (PDOException $erro) {
                $msg = "Erro ao alterar senha: " . $erro->getMessage();
                echo "<script>window.location.href='../view/alterarSenha.view.php?msg=".$msg."'</script>";
            }
        } else {
            $msg = "Aviso: Navegação suspeita, para um navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/alterarSenha.view.php?msg=".$msg."'</script>";
        }
    } else {
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/alterarSenha.view.php?msg=".$msg."'</script>";
    }
}

// Se a requisição vier da Página recuperarSenhaIndex e tiver o parâmetro etapa1.
if($_POST['act'] == 'etapa1') {
    if (!empty($_POST['cpf']) && !empty($_POST['email'])) {

        $email = $cpf = null;

        // verifica se o email está no formato correto
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        }
        // verifica se o cpf só recebe digitos e se possui 11 caracteres
        if (preg_match("/^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}))$/", $_POST['cpf'])) {
            $cpf = $_POST['cpf'];
        }

        if( $email != null && $cpf != null){
            $email = base64_encode($_POST['email']);
            $cpf = base64_encode($_POST['cpf']);
            $usuario = new Usuario('', '', '', '', '', '', '', '',
                '', '', '', '');
            $dao = new UsuarioDAO();
            $usuario = $dao->buscarPeloLoginCPF($email, $cpf);
            if ($usuario->getEmail() == $email && $usuario->getCpf() == $cpf) {
                $msg = "OK Achou !";
                echo "<script>window.location.href='../view/recuperarSenhaIndex.php?msg=" . $msg . "'</script>";
            }
            else {
                $msg = "Login ou CPF incorretos !";
                echo "<script>window.location.href='../view/recuperarSenhaIndex.php?msg=" . $msg . "'</script>";
            }
        }
        else {
            $msg = "Aviso: Navegação suspeita, para um navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/recuperarSenhaIndex.php?msg=".$msg."'</script>";
        }
    }
    else {
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/recuperarSenhaIndex.php?msg=".$msg."'</script>";
    }
}

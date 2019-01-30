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
                echo "<script>window.location.href='../view/alterarSenha.view.php?msg=$msg'</script>";
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
                echo "<script>window.location.href='../view/alterarSenha.view.php?msg=$msg'</script>";

            } catch (PDOException $erro) {
                $msg = "Erro ao alterar senha: " . $erro->getMessage();
                echo "<script>window.location.href='../view/alterarSenha.view.php?msg=$msg'</script>";
            }
        } else {
            echo "Aviso: Navegação suspeita, para um navegação segura verifique se todos os puglins estão ativados!!!";
        }
    } else {
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/alterarSenha.view.php?msg=$msg'</script>";
    }
}

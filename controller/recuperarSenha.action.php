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
            //Busca o usuário no banco, com e-mail e cpf informados.
            $usuario = $dao->buscarPeloLoginCPF($email, $cpf);
            if ($usuario->getEmail() == $email && $usuario->getCpf() == $cpf) {

                //Encontrando o usuário, cria-se o código de recuperação.
                //O código é um número aleatório entre 100000000 e 999999999. E a data de expiração do código é válida
                //por 30 minutos à partir da hora atual.
                require_once ("../model/RecuperarSenha.php");
                require_once ("../dao/RecuperarSenhaDAO.php");

                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');

                $recuperarSenha = new RecuperarSenha('','','','','');
                $recuperarSenha->setCodigoRecuperacao(mt_rand(100000000, 999999999));
                $recuperarSenha->setDataExpiracao(date("Y-m-d H:i:s", strtotime("+ 30 minutes")));
                $recuperarSenha->setEmailRecuperacao($usuario->getEmail());
                $recuperarSenha->setCpfRecuperacao($usuario->getCpf());

                $recuperarSenhaDAO = new RecuperarSenhaDAO();
                $recuperarSenhaDAO->salvar($recuperarSenha);

                //Se o código foi salvo com sucesso, é enviado o e-mail para o usuário.
                if($recuperarSenha->getIdRecuperarSenha() != ''){

                    require_once("../email/email.functions.php");
                    $retorno = enviarEmailCodigoRecuperacaoSenha(base64_decode($recuperarSenha->getEmailRecuperacao()), $usuario->getNome(), $recuperarSenha->getCodigoRecuperacao());

                    if ($retorno == "E-mail enviado com sucesso!") {

                        $msg = "Enviamos um código de recuperação para o e-mail cadastrado no site. Insira o código abaixo.";
                        echo "<script>window.location.href='../view/recuperarSenhaIndex.php?msg=" . $msg . "'</script>";
                    } else {

                        $msg = "Desculpe, ocorreu um erro com o envio do código, por favor tente novamente mais tarde.";
                        echo "<script>window.location.href='../view/login.view.php?msg=" . $msg . "'</script>";
                    }
                }
                else {
                    $msg = "Desculpe, ocorreu um erro, por favor tente novamente mais tarde.";
                    echo "<script>window.location.href='../view/login.view.php?msg=" . $msg . "'</script>";
                }
            }
            else {
                $msg = "Login ou CPF incorretos !";
                echo "<script>window.location.href='../view/login.view.php?msg=" . $msg . "'</script>";
            }
        }
        else {
            $msg = "Aviso: Navegação suspeita, para um navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
        }
    }
    else {
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
    }
}
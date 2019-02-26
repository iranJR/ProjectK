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
    if (!empty($_POST['senhaAtual']) && !empty($_POST['senha']) && !empty($_POST['confirmSenha'])
        && !empty($_POST['usuario'])) {
        // verifica se a senha atual está no formato correto
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $_POST['senhaAtual'])) {

            $dao = new UsuarioDAO();
            $usuario = new Usuario('','','','','','','','',
                    '','','','');
            $usuario = $dao->buscarPeloId($_POST['usuario']); // $_POST['usuario']
            if($usuario->getIdUsuario() != "" || $usuario->getIdUsuario() != null) {
                $senha = $usuario->getSenha();
                if (hash('sha256', $_POST['senhaAtual']) == $senha) {
                    $senhaAtual = $_POST['senhaAtual'];
                }
                else {
                    $msg = "A senha atual está errada !";
                    echo "<script>window.location.href='../view/recuperarSenha.view.php?msg=" . $msg . "'</script>";
                }
            }else {
                $msg = "Erro ao encontrar o usuário !";
                echo "<script>window.location.href='../view/recuperarSenha.view.php?msg=" . $msg . "'</script>";
            }
        }
        // verifica se a senha nova está no formato correto
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $_POST['senha'])) {
            // confirmação de senha nova
            if ($_POST['senha'] == $_POST['confirmSenha']) {
                $senhaNova = $_POST['senha'];
            }
        }
        // verifica se todos os dados estão de acordo com o formato correto e inicia a alteração da senha
        if ($senhaAtual != null && $senhaNova != null) {

            $dao = new UsuarioDAO();
            $usuario = new Usuario('','','','','','','','',
                    '','','','');
            $usuario = $dao->buscarPeloId($_POST['usuario']); // $_POST['usuario']
            if($usuario->getIdUsuario() != "" || $usuario->getIdUsuario() != null) {

                $usuario->setSenha(hash('sha256', $senhaNova));
                $dao->alterar($usuario);

                $msg = "Sua senha foi alterada com sucesso !";
                echo "<script>window.location.href='../view/recuperarSenha.view.php?msg=" . $msg . "'</script>";
            }else {
                $msg = "Erro ao alterar senha ! ";
                echo "<script>window.location.href='../view/recuperarSenha.view.php?msg=" . $msg . "'</script>";
            }
        } else {
            $msg = "Aviso: Navegação suspeita, para uma navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/recuperarSenha.view.php?msg=".$msg."'</script>";
        }
    } else {
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/recuperarSenha.view.php?msg=".$msg."'</script>";
    }
}

// Se a requisição vier da Página de Login e tiver o parâmetro etapa1.
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
                        echo "<script>window.location.href='../view/recuperarSenhaIndex.view.php?msg=" . $msg . "'</script>";
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
            $msg = "Aviso: Navegação suspeita, para uma navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
        }
    }
    else {
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
    }
}

// Se a requisição vier da Página Recuperar Senha Index e tiver o parâmetro etapa2.
if($_POST['act'] == 'etapa2') {

    if (!empty($_POST['senha']) && !empty($_POST['confirmSenha']) && !empty($_POST['codigoRec'])) {

        $senha = $codigo = null;

        // verifica se a senha possui ao menos um digito, uma letra maiscula, uma minuscula e possi no mínimo 8 caracteres
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $_POST['senha'])) {
            // verifica se a senha e a senha confirmada são iguais
            if ($_POST['senha'] == $_POST['confirmSenha']) {
                $senha = $_POST['senha'];
            }
        }

        // verifica se o código de recuperação só recebe digitos e se possui 9 caracteres
        if (preg_match("/^(([0-9]{9}))$/", $_POST['codigoRec'])) {
            $codigo = $_POST['codigoRec'];
        }

        if($senha != null && $codigo != null){

            require_once ("../model/RecuperarSenha.php");
            require_once ("../dao/RecuperarSenhaDAO.php");

            $recuperarSenha = new RecuperarSenha('','','','','');
            $recuperarDAO = new RecuperarSenhaDAO();

            $recuperarSenha = $recuperarDAO->buscarPeloCodigoRecuperacao($codigo);

            //Se o ID não for nulo, o código está correto.
            if($recuperarSenha->getIdRecuperarSenha() != null){

                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                date_default_timezone_set('America/Sao_Paulo');

                //Verifica se o código não está expirado.
                if($recuperarSenha->getDataExpiracao() > date("Y-m-d H:i:s", strtotime("- 30 minutes"))){

                    //Verifica se foi excedido o limite de tentativas para alterar a senha, caso tenha sido excedido
                    //a senha não é alterada e é enviado um e-mail de alerta para o usuário.
                    if(count($recuperarDAO->buscarTodosPeloLoginCPF($recuperarSenha->getEmailRecuperacao(),
                            $recuperarSenha->getCpfRecuperacao())) <= 3){

                        $usuario = new Usuario('','','','','','',
                            '','','','','','');

                        $usuarioDAO = new UsuarioDAO();
                        $usuario = $usuarioDAO->buscarPeloLoginCPF($recuperarSenha->getEmailRecuperacao(),
                            $recuperarSenha->getCpfRecuperacao());

                        $usuario->setSenha(hash('sha256',$senha));

                        $usuarioDAO->alterar($usuario);

                        $msg = "Sua senha foi alterada com sucesso !";
                        echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
                    }
                    else {
                        $usuario = new Usuario('','','','','','',
                            '','','','','','');

                        $usuarioDAO = new UsuarioDAO();
                        $usuario = $usuarioDAO->buscarPeloLoginCPF($recuperarSenha->getEmailRecuperacao(),
                            $recuperarSenha->getCpfRecuperacao());

                        require_once("../email/email.functions.php");
                        enviarEmailAlertaTrocaSenha(base64_decode($recuperarSenha->getEmailRecuperacao()), $usuario->getNome());

                        $msg = "Atenção: Você excedeu o número de tentativas permitidas para alterar a senha !";
                        echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
                    }

                }
                else {
                    $msg = "Atenção: O código de recuperação expirou, solicite novamente o seu código !";
                    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
                }
            }
            else{
                $msg = "Atenção: O código de recuperação informado não é válido !";
                echo "<script>window.location.href='../view/recuperarSenhaIndex.view.php?msg=".$msg."'</script>";
            }

        }
        else {
            $msg = "Aviso: Navegação suspeita, para uma navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/recuperarSenhaIndex.view.php?msg=".$msg."'</script>";
        }
    }
    else {
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/recuperarSenhaIndex.view.php?msg=".$msg."'</script>";
    }
}

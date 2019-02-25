<?php

require_once ("../model/Usuario.php");
require_once ("../dao/UsuarioDAO.php");
require_once ("../model/Album.php");
require_once ("../dao/AlbumDAO.php");

$dataNasc = $email = $cpf = $senha = null;

$dataMax = date("Y-m-d", strtotime("- 18 years"));
$dataMin = date("Y-m-d", strtotime("- 90 years"));

if($_GET['act'] == 'save') {
    if(!empty($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['cpf'])
        && !empty($_POST['dataNasc']) && !empty($_POST['cidade']) && !empty($_POST['uf']) && !empty($_POST['senha'])
        && !empty($_POST['confirmSenha']))
    {
        // verifica se a data de nascimento está entre as idades de 18 anos e 90 anos.
        if ($_POST['dataNasc'] < $dataMax && $_POST['dataNasc'] > $dataMin) {
            $dataNasc = $_POST['dataNasc'];
        }
        // verifica se o email está no formato correto
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        }
        // verifica se o cpf só recebe digitos e se possui 11 caracteres
        if (preg_match("/^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}))$/", $_POST['cpf'])) {
            $cpf = $_POST['cpf'];
        }
        // verifica se a senha possui ao menos um digito, uma letra maiscula, uma minuscula e possi no mínimo 8 caracteres
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $_POST['senha'])) {
            // verifica se a senha e a senha confirmada são iguais
            if ($_POST['senha'] == $_POST['confirmSenha']) {
                $senha = $_POST['senha'];
            }
        }

        if($dataNasc != null &&  $email != null && $cpf != null && $senha != null){

            try {
                $usuario = new Usuario('', '', '', '', '', '', '', '',
                    '', '', '', '');

                $usuario->setNome(mb_convert_case($_POST['nome'], MB_CASE_TITLE));
                $usuario->setSobrenome(mb_convert_case($_POST['sobrenome'], MB_CASE_TITLE));
                $usuario->setSenha(hash('sha256', $_POST['senha']));
                $usuario->setEmail(base64_encode($_POST['email']));
                $usuario->setCpf(base64_encode($_POST['cpf']));
                $usuario->setDataNascimento(date('Y-m-d', strtotime($_POST['dataNasc'])));
                $usuario->setSexo($_POST['sexo']);
                $usuario->setCidade($_POST['cidade']);
                $usuario->setEstado($_POST['uf']);
                $usuario->setFotoPerfil('perfil.png');
                $usuario->setDataCadastro(date('Y-m-d'));

                $usuarioDao = new UsuarioDAO();
                $usuarioDao->salvar($usuario);

                //Verifica se realmente os dados foram salvo e atribuido um ID ao usuário.
                // Se sim, cria os diretórios de imagens padrões do usuário, cria o álbum de fotos de perfil
                // e envia um e-mail de boas vindas ao site.
                if ($usuario->getIdUsuario() != '') {
                    mkdir("../imagens/Usuario/" . $usuario->getIdUsuario() . "/Albuns/Perfil", 0777, true);

                    $album = new Album('', '', '', '');
                    $album->setNomeAlbum("Perfil");
                    $album->setIdUsuario($usuario->getIdUsuario());
                    $album->setDataAlbum(date("Y-m-d"));

                    $albumDao = new AlbumDAO();
                    $albumDao->salvar($album);

                    require_once("../email/email.functions.php");
                    enviarEmailBoasVindas(base64_decode($usuario->getEmail()), $usuario->getNome(), $usuario->getSobrenome());

                    $msg = "Seus dados foram cadastrados com sucesso !";
                    echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
                } else {
                    $msg = "Não foi possível realizar o seu cadastro !";
                    echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=".$msg."'</script>";
                }
            } catch (PDOException $erro) {
                $msg = "Erro ao cadastrar os dados: " . $erro->getMessage();
                echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=".$msg."'</script>";
            }
        }else{
            $msg = "Aviso: Navegação suspeita, para uma navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=".$msg."'</script>";
        }
    }else{
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=".$msg."'</script>";
    }
}



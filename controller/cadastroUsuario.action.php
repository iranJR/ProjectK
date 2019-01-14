<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 02/01/2019
 * Time: 18:28
 */
require_once ("../model/Usuario.php");
require_once ("../dao/UsuarioDAO.php");
require_once ("../model/Album.php");
require_once ("../dao/AlbumDAO.php");

if($_GET['act'] == 'save') {
    if(!empty($_POST['nome']) && !empty($_POST['sobrenome']) && !empty($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['cpf'])
    && !empty($_POST['dataNasc']) && !empty($_POST['sexo']) && !empty($_POST['cidade']) && !empty($_POST['uf']))
    {
        try {
            $usuario = new Usuario('', '', '', '', '', '', '', '',
                '', '', '', '');

            $usuario->setNome($_POST['nome']);
            $usuario->setSobrenome($_POST['sobrenome']);
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
            if($usuario->getIdUsuario() != ''){
                mkdir("../imagens/Usuario/".$usuario->getIdUsuario()."/Albuns/Perfil", 0777, true);

                $album = new Album('','','','');
                $album->setNomeAlbum("Perfil");
                $album->setIdUsuario($usuario->getIdUsuario());
                $album->setDataAlbum(date("Y-m-d"));

                $albumDao = new AlbumDAO();
                $albumDao->salvar($album);

                require_once ("../email/email.functions.php");
                enviarEmailBoasVindas(base64_decode($usuario->getEmail()),$usuario->getNome(), $usuario->getSobrenome());

                $msg = "Seus dados foram cadastrados com sucesso !";
                echo "<script>window.location.href='../view/login.view.php?msg=$msg'</script>";
            }
            else{
                $msg = "Não foi possível realizar o seu cadastro !";
                echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=$msg'</script>";
            }

        }catch(PDOException $erro){
            $msg = "Erro ao cadastrar os dados: " . $erro->getMessage();
            echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=$msg'</script>";
        }
    }else{
        $msg = "Preencha todos os campos obrigatórios !";
        echo "<script>window.location.href='../view/cadastroUsuario.view.php?msg=$msg'</script>";
    }
}

/*if($_GET['act'] == 'del'){
    try {
        $usuarioDao = new UsuarioDAO();
        $usuario = $usuarioDao->buscarPeloId($_SESSION['idUsuario']);
        $usuarioDao->apagar($usuario);

    }catch(PDOException $erro){
            $msg = "Erro ao deletar: " . $erro->getMessage();
            //echo "<script>window.location.href='../view/.view.php?msg=$msg'</script>";
    }
 }

if($_GET['act'] == 'alt'){

}*/
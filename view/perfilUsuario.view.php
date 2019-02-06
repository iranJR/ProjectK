<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 04/02/2019
 * Time: 18:44
 */

require_once("../view/templatePaginaInicial.php");

/*Nomeclaturando sessão*/
session_name(hash('sha256', $_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR']));

/* Iniciando a sessão.*/
session_start();

//Verificação de segurança. Se não houver usuário logado, redireciona para a página de login.
if ((empty($_SESSION['idUsuario']) || empty($_SESSION['nomeUsuario']) || empty($_SESSION['fotoPerfil'])) &&
    (empty($_COOKIE[hash('sha256', 'idUsuario')]) || empty($_COOKIE[hash('sha256', 'nomeUsuario')]) ||
        empty($_COOKIE[hash('sha256', 'fotoPerfil')]) || empty($_COOKIE[hash('sha256', 'senha')]) ||
        empty($_COOKIE[hash('sha256', 'email')]))) {

    $msg = "É necessário estar logado para acessar esta página !";
    echo "<script>window.location.href='../view/login.view.php?msg=" . $msg . "'</script>";
}

// Verificação se usuário está logado via sessão.
if (!empty($_SESSION['idUsuario']) || !empty($_SESSION['nomeUsuario']) ||
    !empty($_SESSION['fotoPerfil'])) {

    $idUsuario = $_SESSION['idUsuario'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $fotoPerfil = $_SESSION['fotoPerfil'];
}

// Verificação se usuário está logado via cookie.
if (!empty($_COOKIE[hash('sha256', 'idUsuario')]) || !empty($_COOKIE[hash('sha256', 'nomeUsuario')]) ||
    !empty($_COOKIE[hash('sha256', 'fotoPerfil')]) || !empty($_COOKIE[hash('sha256', 'senha')]) ||
    !empty($_COOKIE[hash('sha256', 'email')])) {

    $idUsuario = base64_decode($_COOKIE[hash('sha256', 'idUsuario')]);
    $nomeUsuario = base64_decode($_COOKIE[hash('sha256', 'nomeUsuario')]);
    $fotoPerfil = base64_decode($_COOKIE[hash('sha256', 'fotoPerfil')]);
}

$userID = $_GET['userID'];

require_once ("../model/Usuario.php");
require_once ("../dao/UsuarioDAO.php");
require_once ("../model/Cidade.php");
require_once ("../dao/CidadeDAO.php");
require_once ("../model/Uf.php");
require_once ("../dao/UfDAO.php");

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->buscarPeloId($userID);

$cidadeDAO = new CidadeDAO();
$cidade = $cidadeDAO->buscarPeloId($usuario->getCidade());

$ufDAO = new UfDAO();
$uf = $ufDAO->buscarPeloId($usuario->getEstado());
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet" href="../css/estiloPaginaInicial.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../javaScript/JSFuncoesAjax.js"></script>
    <title>ProjectK - Perfil</title>

</head>
<body>

<!--Cabeçalho do site-->
<!-- O cabeçalho do site, requer três paramêtros agora, nome de usuário, foto de perfil e id do usuário
atribuidos via sessão ou cookies -->
<?php cabecalho($nomeUsuario, $fotoPerfil, $idUsuario); ?>
<!--Fim do Cabeçalho do site -->

<!--Menu Horizontal de Ações -->
<?php menuHorizontal(); ?>
<!-- Fim do Menu Horizontal de Ações -->

<!-- Inicio da Div Geral da Página -->
<div class='container-fluid text-center'>
    <div class='row content'>
        <!-- Pausa na Div Geral da Página -->

        <!-- Início do Menu Lateral do Usuário -->
        <!-- O cabeçalho do site, requer dois paramêtros agora, foto de perfil e id do usuário
        atribuidos via sessão ou cookies -->
        <?php menuLateralEsquerdoUsuario($fotoPerfil, $idUsuario); ?>
        <!-- Início do Menu Lateral do Usuário -->

        <!-- Início da Div Central da Página, Mural de Notícias -->
        <div id='divMural' class='col-sm-8 text-left'>
            <div id="divPaginaPerfil" class="col-sm-12">
                <div id="cabecalhoPerfilUsuário" class="col-sm-12">
                    <div class="row">
                        <div id="divDadosUsuario" class="col-md-4">
                            <h4><?= $usuario->getNome() ?> <?= $usuario->getSobrenome() ?></h4>
                            <h5 >Aniversário: <?= date("d/m/Y", strtotime($usuario->getDataNascimento())) ?></h5>
                            <h5 ><?= $cidade->getNomeCidade() ?> - <?= $uf->getSiglaUf() ?></h5>
                            <h5 >Membro desde <?= date("Y", strtotime($usuario->getDataCadastro())) ?></h5>
                        </div>
                        <div class="col-md-4">
                            <?php
                                if($usuario->getFotoPerfil() == 'perfil.png') {
                                    echo "<img id='imgFotoPerfilPerfilUsuario' src='../imagens/perfil.png' class='img-circle' alt='Foto Perfil'/>";
                                }
                                else {
                                    echo "<img id='imgFotoPerfilPerfilUsuario' src='../imagens/Usuario/".$usuario->getIdUsuario()."/Albuns/Perfil/".$usuario->getFotoPerfil()."'' class='img-circle' alt='Foto Perfil'/>";
                                }

                                if($userID == $idUsuario){
                                    echo"<a id='aAlterarFotoPerfil'><i class='glyphicon glyphicon-pencil'></i>
                                    Alterar Foto</a>";
                                }

                            ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                                if($userID != $idUsuario){
                                    echo"<div class='row'>
                                        <div class='col-md-12'>
                                            <button id='botaoMensagem' title='Enviar Mensagem' class='btn btn-primary'>
                                                <i class='glyphicon glyphicon-envelope'></i> Mensagem
                                            </button>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <button id='botaoAdicionarPerfil' title='Adicionar aos Amigos' class='btn btn-primary'>
                                                <i class='glyphicon glyphicon-user'></i> Adicionar
                                            </button>
                                        </div>
                                    </div>";
                                }
                                else {
                                    echo"<div class='row'>
                                        <div class='col-md-12'>
                                            <button id='botaoMensagem' title='Minhas Mensagens' class='btn btn-primary'>
                                                <i class='glyphicon glyphicon-envelope'></i> Mensagens
                                            </button>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <button id='botaoAdicionarPerfil' title='Meus Amigos' class='btn btn-primary'>
                                                <i class='glyphicon glyphicon-user'></i> Amigos
                                            </button>
                                        </div>
                                    </div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        if($userID == $idUsuario){
                            echo"<a id='aEditarPerfilPerfil'><i
                                class='glyphicon glyphicon-pencil'></i> Editar Perfil</a>";
                        }
                    ?>
                </div>

                <hr id="hrPaginaPerfil"/>

                <div class="row">
                    <div id="divAmigosPerfil" class="col-sm-4">
                        <table id='tableAmigosPerfil' class='table'>
                            <thead>
                            <tr>
                                <th scope='col' colspan='4'>Amigos</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                            </tr>
                            <tr>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                            </tr>
                            <tr>
                                <th scope='col' colspan='4'><a id='aVerTodos'> Ver Todos </a></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="divAmigosPerfil" class="col-sm-4">
                        <table id='tableAmigosPerfil' class='table'>
                            <thead>
                            <tr>
                                <th scope='col' colspan='4'> Álbuns</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                            </tr>
                            <tr>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                                <td><img src='../imagens/thor.jpg' class='img-rounded'></td>
                            </tr>
                            <tr>
                                <th scope='col' colspan='4'><a id='aVerTodos'> Ver Todos </a></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- Fim da Div Central da Página, Mural de Notícias -->

        <!-- Início do Menu Lateral Direito, Menu de Amigos -->
        <?php menuLateralDireitoAmigos(); ?>
        <!-- Fim do Menu Lateral Direito, Menu de Amigos -->

        <!-- Retorno da Pausa na Div Geral da Página -->
    </div>
</div>
<!-- Fim da Div Geral da Página -->

<!-- Inicio do Rodapé -->
<?php rodape(); ?>
<!-- Fim do Rodapé -->

</body>
</html>
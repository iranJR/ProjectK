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

$userID = base64_decode($_GET['userID']);

require_once("../model/Usuario.php");
require_once("../dao/UsuarioDAO.php");
require_once("../model/Cidade.php");
require_once("../dao/CidadeDAO.php");
require_once("../model/Uf.php");
require_once("../dao/UfDAO.php");
require_once ("../model/Post.php");
require_once ("../dao/PostDAO.php");
//Retira as mensagens de notificação de erro do PHP neste contexto da página.
//Neste ponto estão vindo notificações da DAO.
//error_reporting(E_WARNING);
require_once("../model/Amigo.php");
require_once("../dao/AmigoDAO.php");

$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->buscarPeloId($userID);

$cidadeDAO = new CidadeDAO();
$cidade = $cidadeDAO->buscarPeloId($usuario->getCidade());

$ufDAO = new UfDAO();
$uf = $ufDAO->buscarPeloId($usuario->getEstado());

$postagensDAO = new PostDAO();
$postagens = new Post('','','','','','','');

if($userID == $idUsuario){
    // meu perfil
    $postagens = $postagensDAO->buscarMinhasPostagens($userID);
}else{
    // perfil visitante
    $postagens = $postagensDAO->buscarTodasPostagensPerfil($userID);
}

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
    <script src="../javaScript/JSFuncoesPaginaInicial.js"></script>
    <title>ProjectK - Perfil</title>

</head>
<body>

<!--Cabeçalho do site-->
<!-- O cabeçalho do site, requer três paramêtros agora, nome de usuário, foto de perfil e id do usuário
atribuidos via sessão ou cookies -->
<?php cabecalho($nomeUsuario, $fotoPerfil, $idUsuario); ?>
<!--Fim do Cabeçalho do site -->

<!--Menu Horizontal de Ações -->
<?php menuHorizontal($idUsuario); ?>
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
                            <h5>Aniversário: <?= date("d/m/Y", strtotime($usuario->getDataNascimento())) ?></h5>
                            <h5><?= $cidade->getNomeCidade() ?> - <?= $uf->getSiglaUf() ?></h5>
                            <h5>Membro desde <?= date("Y", strtotime($usuario->getDataCadastro())) ?></h5>
                        </div>
                        <div class="col-md-4">
                            <?php
                            if ($usuario->getFotoPerfil() == 'perfil.png') {
                                echo "<img id='imgFotoPerfilPerfilUsuario' src='../imagens/perfil.png' class='img-circle' alt='Foto Perfil'
                                            data-toggle='modal' data-target='#modalFotoPerfilUsuario'/>";
                            } else {
                                echo "<img id='imgFotoPerfilPerfilUsuario' src='../imagens/Usuario/" . $usuario->getIdUsuario() . "/Albuns/Perfil/" . $usuario->getFotoPerfil() . "'' class='img-circle' alt='Foto Perfil'
                                            data-toggle='modal' data-target='#modalFotoPerfilUsuario'/>";
                            }

                            if ($userID == $idUsuario) {
                                echo "<a id='aAlterarFotoPerfil'><i class='glyphicon glyphicon-pencil'></i>
                                    Alterar Foto</a>";
                            }

                            ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                            if ($userID == $idUsuario) {
                                echo "<div class='row'>
                                        <div class='col-md-12'>
                                            <button id='botaoMensagem' title='Minhas Mensagens' class='btn btn-primary'>
                                                <i class='glyphicon glyphicon-envelope'></i> Mensagens
                                            </button>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <a href='../view/verAmigos.view.php?userID=".base64_encode($idUsuario)."' id='botaoAdicionarPerfil' title='Meus Amigos' class='btn btn-primary'>
                                                <i class='glyphicon glyphicon-user'></i>   Amigos
                                            </a>
                                        </div>
                                    </div>";
                            } else {

                                $amigo = new Amigo('', '', '', '', '');

                                $amigoDAO = new AmigoDAO();
                                $amigo = $amigoDAO->buscarPorAmizade($idUsuario, $userID);
                                if ($amigo->getIdSolicitacao() != "") {
                                    if ($amigo->getDataConfirmacao() != null) {
                                        echo "<div class='row'>
                                            <div class='col-md-12'>
                                                <button id='botaoMensagem' title='Enviar Mensagem' class='btn btn-primary'>
                                                    <i class='glyphicon glyphicon-envelope'></i> Mensagem
                                                </button>
                                            </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <form method='post' action='../controller/amizade.action.php'>
                                                        <input type='hidden' name='act' value='desfazer'>
                                                        <input type='hidden' name='idUsuario' value='" . $idUsuario . "'>
                                                        <input type='hidden' name='userID' value='" . $userID . "'> 
                                                        <button id='botaoDesfazerAmizade' type='submit' title='Desfazer a Amizade' class='btn btn-primary'>
                                                            <i class='glyphicon glyphicon-ban-circle'></i> Desfazer Amizade
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>";
                                    } else if ($amigo->getIdSolicitado() == $idUsuario) {
                                        echo "<div class='row'>
                                                <div class='col-md-12'>
                                                    <button id='botaoMensagem' title='Enviar Mensagem' class='btn btn-primary'>
                                                        <i class='glyphicon glyphicon-envelope'></i> Mensagem
                                                    </button>
                                                </div>
                                                </div>
                                                <div class='row'>
                                                    <div class='col-md-12'>
                                                        <form method='post' action='../controller/amizade.action.php'>
                                                            <input type='hidden' name='act' value='aceitar'>
                                                            <input type='hidden' name='idUsuario' value='" . $idUsuario . "'>
                                                            <input type='hidden' name='userID' value='" . $userID . "'>                                                
                                                            <button id='botaoAceitarSolicitacao' type='submit' title='Adicionar aos Meus Amigos' class='btn btn-primary'>
                                                                <i class='glyphicon glyphicon-ok'></i> Aceitar
                                                            </button>
                                                        </form>
                                                        <form method='post' action='../controller/amizade.action.php'>
                                                            <input type='hidden' name='act' value='recusar'>
                                                            <input type='hidden' name='idUsuario' value='" . $idUsuario . "'>
                                                            <input type='hidden' name='userID' value='" . $userID . "'>                                                
                                                            <button id='botaoRecusarSolicitacao' type='submit' title='Recusar Solicitação de Amizade' class='btn btn-primary'>
                                                                <i class='glyphicon glyphicon-remove'></i> Recusar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>";
                                    } else {
                                        echo "<div class='row'>
                                            <div class='col-md-12'>
                                                <button id='botaoMensagem' title='Enviar Mensagem' class='btn btn-primary'>
                                                    <i class='glyphicon glyphicon-envelope'></i> Mensagem
                                                </button>
                                            </div>
                                            </div>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <form method='post' action='../controller/amizade.action.php'>
                                                        <input type='hidden' name='act' value='cancelar'>
                                                        <input type='hidden' name='idUsuario' value='" . $idUsuario . "'>
                                                        <input type='hidden' name='userID' value='" . $userID . "'> 
                                                        <button id='botaoCancelarSolicitacao' type='submit' title='Cancelar a Solicitação de Amizade' class='btn btn-primary'>
                                                            <i class='glyphicon glyphicon-remove'></i> Cancelar Solicitação
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>";
                                    }
                                } else {
                                    echo "<div class='row'>
                                        <div class='col-md-12'>
                                            <button id='botaoMensagem' title='Enviar Mensagem' class='btn btn-primary'>
                                                <i class='glyphicon glyphicon-envelope'></i> Mensagem
                                            </button>
                                        </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-md-12'>
                                                <form method='post' action='../controller/amizade.action.php'>
                                                    <input type='hidden' name='act' value='add'>
                                                    <input type='hidden' name='idUsuario' value='" . $idUsuario . "'>
                                                    <input type='hidden' name='userID' value='" . $userID . "'>
                                                    <button id='botaoAdicionarPerfil' type='submit' title='Adicionar aos Amigos' class='btn btn-primary'>
                                                        <i class='glyphicon glyphicon-user'></i> Adicionar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if ($userID == $idUsuario) {
                        echo "<a id='aEditarPerfilPerfil'><i
                                class='glyphicon glyphicon-pencil'></i> Editar Perfil</a>";
                    }
                    ?>
                </div>

                <hr id="hrPaginaPerfil"/>

                <!-- Início do Modal da Foto de Perfil do Usuário -->
                <div id='modalFotoPerfilUsuario' class='modal fade' role='dialog'>
                    <div class='modal-dialog'>

                        <div id='modalBodyFotoPerfilUsuario' class='modal-body'>
                            <button id='botaoFecharModalFotoPerfil' type='button' class='close' data-dismiss='modal'>
                                &times;
                            </button>

                            <?php
                            if ($usuario->getFotoPerfil() == 'perfil.png') {
                                echo "<img src='../imagens/perfil.png' alt='Foto Perfil' />";
                            } else {
                                echo "<img src='../imagens/Usuario/" . $usuario->getIdUsuario() . "/Albuns/Perfil/" . $usuario->getFotoPerfil() . "' alt='Foto Perfil' >";
                            }
                            ?>

                        </div>
                        <div id='captionModalFotoPerfil'>
                            <p>Foto de Perfil</p>
                        </div>

                    </div>
                </div>
                <!-- Fim do Modal da Foto de Perfil do Usuário -->

                <div class="row">
                    <div id="divAmigosPerfil" class="col-sm-4">
                        <table id='tableAmigosPerfil' class='table'>
                            <thead>
                            <tr>
                                <?php
                                $amigoDAO = new AmigoDAO();
                                $amigos = $amigoDAO->buscarTodosAmigos($usuario->getIdUsuario());
                                shuffle($amigos);

                                if(count($amigos) > 0) {
                                    echo "<th scope = 'col' colspan = '4' > Amigos (".count($amigos).")</th >";
                                }
                                else {
                                    echo "<th scope = 'col' colspan = '4' > Amigos</th >";
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(count($amigos) > 0) {
                                $i = $j = 0;

                                if(count($amigos) < 8){
                                    $amigoVazio = ["idSolicitacao" => "", "dataSolicitacao" => "", "idSolicitante" => "", "idSolicitado" => "", "dataConfirmacao" => ""];
                                    $amigoVazio = (object)$amigoVazio;
                                    while (count($amigos) < 8){
                                        array_push($amigos, $amigoVazio);
                                    }
                                }

                                foreach ($amigos as $amigo) {

                                    $usuarioAmigo = new Usuario('', '', '', '', '',
                                        '', '', '', '', '', '', '');

                                    $usuarioDAO = new UsuarioDAO();
                                    if ($amigo->idSolicitante == $userID) {
                                        $usuarioAmigo = $usuarioDAO->buscarPeloId($amigo->idSolicitado);
                                    } else {
                                        $usuarioAmigo = $usuarioDAO->buscarPeloId($amigo->idSolicitante);
                                    }

                                    if ($i < 4) {
                                        if ($i == 0) {
                                            echo "<tr>";
                                        }
                                        if ($usuarioAmigo->getFotoPerfil() == "perfil.png") {
                                            echo "<td ><a href='../view/perfilUsuario.view.php?userID=" . base64_encode($usuarioAmigo->getIdUsuario()) . "'><img src = '../imagens/perfil.png' class='img-rounded' alt='Foto Perfil' ></a></td >";
                                        }
                                        else if($usuarioAmigo->getFotoPerfil() == ""){
                                            echo "<td ><img src = '../imagens/perfil.png' class='img-rounded' alt='Foto Perfil' ></td >";
                                        }
                                        else {
                                            echo "<td ><a href='../view/perfilUsuario.view.php?userID=" . base64_encode($usuarioAmigo->getIdUsuario()) . "'><img src = '../imagens/Usuario/" . $usuarioAmigo->getIdUsuario() . "/Albuns/Perfil/" . $usuarioAmigo->getFotoPerfil() . "' class='img-rounded' alt='Foto Perfil' ></a></td >";
                                        }
                                        $i++;
                                    } else if ($i < 8) {
                                        if ($j == 0) {
                                            echo "</tr>";
                                            echo "<tr>";
                                            $j++;
                                        }
                                        if ($usuarioAmigo->getFotoPerfil() == "perfil.png") {
                                            echo "<td ><a href='../view/perfilUsuario.view.php?userID=" . base64_encode($usuarioAmigo->getIdUsuario()) . "'><img src = '../imagens/perfil.png' class='img-rounded' alt='Foto Perfil' ></a></td >";
                                        }
                                        else if($usuarioAmigo->getFotoPerfil() == ""){
                                            echo "<td ><img src = '../imagens/perfil.png' class='img-rounded' alt='Foto Perfil' ></td >";
                                        }
                                        else {
                                            echo "<td ><a href='../view/perfilUsuario.view.php?userID=" . base64_encode($usuarioAmigo->getIdUsuario()) . "'><img src = '../imagens/Usuario/" . $usuarioAmigo->getIdUsuario() . "/Albuns/Perfil/" . $usuarioAmigo->getFotoPerfil() . "' class='img-rounded' alt='Foto Perfil' ></a></td >";
                                        }
                                        $i++;
                                    } else {
                                        echo "</tr>";
                                        break;
                                    }

                                }
                                echo "<tr >
                                        <th scope = 'col' colspan = '4' ><a id = 'aVerTodos' href='../view/verAmigos.view.php?userID=" . base64_encode($userID) . "'> Ver Todos </a ></th >
                                    </tr >";
                            }
                            else {
                                echo"<tr><td id='tableAmigosPerfilSemAmigos' colspan='4'><i class='	glyphicon glyphicon-warning-sign'></i>   Usuário ainda não possui amigos.</td></tr>";
                            }
                            ?>
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

                <hr id="hrPaginaPerfil2"/>

                <!-- Inicío da Área de Postagem -->
                <div class="row">
                    <form id='formPostagemPerfilUsuario' class='navbar-form navbar-left' method='post' action='../controller/postar.action.php?act=save'>
                        <div class="col-md-12">

                            <div class="col-md-2">
                                <?php
                                if ($fotoPerfil == 'perfil.png') {
                                    echo "<img id='imgFotoPerfilPostagem' src='../imagens/perfil.png' alt='Foto Perfil' class='img-circle' />";
                                } else {
                                    echo "<img id='imgFotoPerfilPostagem' src='../imagens/Usuario/" . $idUsuario . "/Albuns/Perfil/" . $fotoPerfil . "' alt='Foto Perfil' 
                                    class='img-circle' >";
                                }
                                ?>
                            </div>

                            <div class="col-md-10">
                                <div id='divInputPostagemPerfilUsuario' class='input-group'>
                                    <input hidden value="<?= $idUsuario ?>" name="idRemetente">
                                    <input hidden value="<?= $usuario->getIdUsuario() ?>" name="idDestinatario">
                                    <input hidden value="texto" name="tipoPost">
                                    <input id='inputPostagemPerfilUsuario' name='textoPostagem' type='text'
                                           class='form-control' autocomplete='off' placeholder='<?php
                                    if ($userID == $idUsuario) {
                                        echo $nomeUsuario . " escreva algo para que seus amigos vejam...";
                                    } else {
                                        echo $nomeUsuario . " escreva algo para " . $usuario->getNome() . "...";
                                    } ?>' maxlength='500' required>
                                    <div class='input-group-btn'>
                                        <button id='botaoPostarPerfilUsuario' title="Postar" class='btn btn-warning'
                                                type='submit'>
                                            <i class='glyphicon glyphicon-send'></i>
                                        </button>
                                        <button id='botaoPostarImgPerfilUsuario' type="button" title="Postar Imagem"
                                                class='btn btn-warning' data-toggle="modal" data-target="#divModalPostagemImagem">
                                            <i class='glyphicon glyphicon-camera'></i>
                                        </button>
                                        <button id='botaoPostarVideoPerfilUsuario' type="button" title="Postar Vídeo"
                                                class='btn btn-warning' data-toggle="modal" data-target="#divModalPostagemVideo">
                                            <i class='glyphicon glyphicon-facetime-video'></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>
                    <div class="col-md-12">
                        <small id="contMensagemPostagem" class="form-text text-muted">500 caracteres restantes.</small>
                    </div>
                </div>

                <!-- Início da Modal de Postagem de Imagem -->
                <div id="divModalPostagemImagem" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button id="botaoFecharModalVideo" type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="glyphicon glyphicon-camera"></i>   Postagem - Imagem</h4>
                            </div>
                            <form method="post" action="../controller/postar.action.php?act=save">
                                <input hidden value="<?= $idUsuario ?>" name="idRemetente">
                                <input hidden value="<?= $usuario->getIdUsuario() ?>" name="idDestinatario">
                                <input hidden value="imagem" name="tipoPost">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <img id="fotoPreview" src="" alt="" />
                                        </div>
                                        <div class="col-md-7">
                                            <input id="imagemPost" name="imagemPost" type="file">
                                            <label id="labelInputImagemPost" for="imagemPost" title="Clique para adicionar uma imagem." ><i class="glyphicon glyphicon-plus" ></i></label>
                                        </div>
                                    </div>
                                    <br/>
                                    <div id="textAreaPostagem" class="form-group">
                                        <textarea class="form-control" rows="3" id="textoPostagemImagem" name="textoPostagemImagem" maxlength='500' placeholder="Escreva aqui algo sobre a imagem..."></textarea>
                                        <small id="contMensagemPostagemImagem" class="form-text text-muted">500 caracteres restantes.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-md-12">
                                        <button id="botaoEnviarModalVideo" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-send"></i>   Enviar</button>
                                        <button id="botaoCancelarModalVideo" type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>   Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- Início da Modal de Postagem de Imagem -->

                <!-- Início da Modal de Postagem de Vídeo -->
                <div id="divModalPostagemVideo" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button id="botaoFecharModalVideo" type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><i class="glyphicon glyphicon-facetime-video"></i>   Postagem - Vídeo</h4>
                            </div>
                            <form method="post" action="../controller/postar.action.php?act=save">
                                <input hidden value="<?= $idUsuario ?>" name="idRemetente">
                                <input hidden value="<?= $usuario->getIdUsuario() ?>" name="idDestinatario">
                                <input hidden value="video" name="tipoPost">
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" name="textoPostagemVideo" id="textoPostagemVideo" maxlength='500' placeholder="Escreva aqui algo sobre o vídeo..."></textarea>
                                    <small id="contMensagemPostagemVideo" class="form-text text-muted">500 caracteres restantes.</small>
                                </div>
                                <div class="form-group">
                                    <label>Link do vídeo do YouTube:</label>
                                    <input class="form-control" type="text" name="linkVideo" placeholder="Cole aqui o link do vídeo do YouTube..." />
                                    <small id="smallMensagemPostagemVideo"><i class="glyphicon glyphicon-alert"></i>   Atenção: o link a ser colado deve ser a URL do vídeo do YouTube.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12">
                                    <button id="botaoEnviarModalVideo" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-send"></i>   Enviar</button>
                                    <button id="botaoCancelarModalVideo" type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>   Cancelar</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Início da Modal de Postagem de Vídeo -->

                <!-- Fim da Área de Postagem  -->

                <!-- Início do Mural de Notícias -->
                <h3 id="h3MuralPerilUsuario"><i class="glyphicon glyphicon-bullhorn"></i> Mural de Notícias</h3>
                <br/>
                <div class="row">

                    <!-- Inicio das Postagens - Laço de Repetição -->
                    <?php

                        foreach ($postagens as $post) {

                            require_once ("../dao/UsuarioDAO.php");
                            require_once ("../model/Usuario.php");

                            $userDao = new UsuarioDAO();
                            $user = new Usuario('','','','','','','','',
                                '','','','');

                            $user = $userDao->buscarPeloId($post->idRemetente);

                            echo "<div id='divPostagemMuralPerfilUsuario' class='col-md-10'>
        
                            <div class='col-md-1'>";

                            if ($user->getFotoPerfil() == 'perfil.png') {
                                echo "<img id='imgFotoPerfilPostagem' src='../imagens/perfil.png' alt='Foto Perfil' class='img-circle' />";
                            } else {
                                echo "<img id='imgFotoPerfilPostagem' src='../imagens/Usuario/" . $user->getIdUsuario() .
                                    "/Albuns/Perfil/" . $user->getFotoPerfil() . "' alt='Foto Perfil' class='img-circle'/>";
                            }
                            echo "</div>
                                     <div id='nomeUsuarioPostagemMural' class='col-md-7' >
                                        <a href='../view/perfilUsuario.view.php?userID=" . base64_encode($user->getIdUsuario()) . "'> ".$user->getNome()." ". $user->getSobrenome()." </a>
                                    </div>
                                    <div class='col-md-4'>
                                        <small id='smallDataPostagemMural'>".date('d/m/Y à\\s H:i:s', strtotime($post->dataPost))." </small>
                                    </div>
        
                                <div id='divConteudoPostagemMural' class='col-md-12'>";
                                    if($post->tipoPost == "texto") {
                                        echo "<h3 > $post->textoPost </h3 >";
                                    }
                                    if($post->tipoPost == "imagem"){
                                        echo "<h4> $post->textoPost </h4>
                                              <img width='220px' height='240px' src='".$post->linkPost."'>";
                                    }
                                    if($post->tipoPost == "video"){
                                        echo "<video width='220px' height='240px' controls>
                                                <source src='".$post->linkPost."' type='video/mp4'>
                                            </video>";
                                    }
                            echo  "</div>
        
                                <div id='divRodapePostagemMural' class='col-md-12'>
                                    <div id='divRecaoPostagemMural' class='col-md-6'>
                                        <a title='Gostei'><i class='glyphicon glyphicon-thumbs-up'></i></a>
                                        <a>|</a>
                                        <a title='Não Gostei'><i class='glyphicon glyphicon-thumbs-down'></i></a>
                                    </div>
                                    <div id='divComentariosPostagemMural' class='col-md-6'>
                                        <a id='aBotaoExibirComentarios'><i class='glyphicon glyphicon-comment'></i>   Comentários...   <i id='iExpandirOcultarComentario' class='glyphicon glyphicon-menu-down'></i></a>
                                    </div>
                                    
                                    <!-- Início da Div de Exibição dos Comentários -->
                                    <div id='divComentariosInputPostagemMural' class='col-md-12'>
                                        
                                        <!-- Início da Div do Input de Comentar -->
                                        <hr id='hrInputComentariosPostagemMural'/>
                                        <div class='col-md-1'>";
                                            if ($fotoPerfil == 'perfil.png') {
                                                echo "<img id='imgFotoPerfilPostagem' src='../imagens/perfil.png' alt='Foto Perfil' class='img-circle' />";
                                            } else {
                                                echo "<img id='imgFotoPerfilPostagem' src='../imagens/Usuario/" . $idUsuario . "/Albuns/Perfil/" . $fotoPerfil . "' alt='Foto Perfil' 
                                                class='img-circle' >";
                                            }
                                        echo"</div>
                                        <div class='col-md-11'>
                                            <form method='post' action=''>
                                            <input type='hidden' name='idUsuario' value='".$idUsuario."'>
                                            <input type='hidden' name='idPost' value='".$post->idPost."'>
                                            <div class='input-group'>
                                                <input id='inputPostagemPerfilUsuario' name='textoComentario' type='text'
                                                       class='form-control' autocomplete='off' placeholder='".$nomeUsuario." escreva aqui um comentário...' maxlength='500' required>
                                                <div class='input-group-btn'>
                                                    <button id='botaoPostarPerfilUsuario' title='Comentar' class='btn btn-warning'
                                                            type='submit'>
                                                        <i class='glyphicon glyphicon-send'></i>
                                                    </button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        <!-- Início da Div do Input de Comentar -->
                                        
                                        <!-- Início da Div do Comentário - Laço de Repetição -->
                                        <div id='divDadosComentario' class='col-md-12' >
                                        
                                            <div class='col-md-1'>";
                                            if ($user->getFotoPerfil() == 'perfil.png') {
                                                echo "<img id='imgFotoPerfilComentario' src='../imagens/perfil.png' alt='Foto Perfil' class='img-circle' >";
                                            } else {
                                                echo "<img id='imgFotoPerfilComentario' src='../imagens/Usuario/" . $user->getIdUsuario() .
                                                    "/Albuns/Perfil/" . $user->getFotoPerfil() . "' alt='Foto Perfil' class='img-circle'/>";
                                            }
                                            echo "</div>
                                                     <div id='nomeUsuarioPostagemMuralComentario' class='col-md-6' >
                                                        <a href='../view/perfilUsuario.view.php?userID=" . base64_encode($user->getIdUsuario()) . "'> ".$user->getNome()." ". $user->getSobrenome()." </a>
                                                    </div>
                                                    <div class='col-md-5'>
                                                        <small id='smallDataPostagemMural'>".date('d/m/Y à\\s H:i:s', strtotime($post->dataPost))." </small>
                                                    </div>   
                                                                                     
                                            <div class='col-md-12'>
                                                <h4 id='h4ComentarioPostagemMural'>Comentário...</h4>
                                            </div>
                                        </div>
                                        <!-- Fim da Div do Comentário - Laço de Repetição -->
                                        
                                    </div>
                                    <!-- Fim da Div de Exibição dos Comentários -->
                                    
                                </div>
        
                            </div>
                            <!-- Fim das Postagens - Laço de Repetição -->
                            ";
                        }
                     ?>
                </div>
                <!-- Fim do Mural de Notícias -->
            </div>
        </div>
        <!-- Fim da Div Central da Página, Mural de Notícias -->

        <!-- Início do Menu Lateral Direito, Menu de Amigos -->
        <?php menuLateralDireitoAmigos($idUsuario); ?>
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
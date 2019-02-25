<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 02/01/2019
 * Time: 14:33
 */

require_once ("../model/Amigo.php");
require_once ("../dao/AmigoDAO.php");
require_once ("../model/Usuario.php");
require_once ("../dao/UsuarioDAO.php");
require_once ("../model/Cidade.php");
require_once ("../dao/CidadeDAO.php");
require_once ("../model/Uf.php");
require_once ("../dao/UfDAO.php");

function cabecalho($nomeUsuario, $fotoPerfil, $idUsuario){
//Cabeçalho do site

echo"<nav id='cabecalho' class='navbar navbar-inverse'>
    <div class='container-fluid'>

        <div class='navbar-header'>
            <a id='logoProjectK' class='navbar-brand' href='../view/paginaInicial.view.php'>ProjectK</a>
        </div>

        <div class='dropdown show'>
          <form id='formPesquisar' class='navbar-form navbar-left' method='get' action='../view/buscaUsuario.view.php'>
            <div id='divInputPesquisar' class='input-group'>
                <input id='inputPesquisar' name='busca' type='text' class='form-control' autocomplete='off' placeholder='Pesquisar...'>
                <div class='input-group-btn'>
                    <button id='BotaoPesquisar' class='btn btn-warning' type='submit'>
                        <i class='glyphicon glyphicon-search'></i>
                    </button>
                </div>                
            </div>            
        </form>
        
          <ul id='ulDropDownPesquisa' class='dropdown-menu'>
          
          </ul>
        </div>

        <div id='divUsuarioCabecalho' class='nav nav-bar navbar-right'>
            <div id='divBemVindoUsuario' class='col-sm-9'>
                <span class='glyphicon glyphicon-user'></span>
                <label>Bem vindo, ".$nomeUsuario."</label>
            </div>
            <div id='divFotoMenuUsuario' class='dropdown nav nav-bar navbar-right'>";
                if($fotoPerfil == 'perfil.png') {
                    echo "<img class='dropdown-toggle img-circle' data-toggle='dropdown' src='../imagens/perfil.png'
                     alt='Foto Perfil'/>";
                }
                else {
                    echo "<img class='dropdown-toggle img-circle' data-toggle='dropdown' src='../imagens/Usuario/".$idUsuario."/Albuns/Perfil/".$fotoPerfil."'
                     alt='Foto Perfil'/>";
                }
                echo"<ul id='dropDownUser' class='dropdown-menu'>
                    <li><a href='../view/perfilUsuario.view.php?userID=".$idUsuario."'>Meu Perfil</a></li>
                    <li><a href='../view/configuracoes.view.php'>Configurações</a></li>
                    <li><a href='../controller/logout.action.php'>Sair</a></li>
                </ul>
            </div>
        </div>

    </div>
</nav>";

//Fim do Cabeçalho do site
}

function menuHorizontal($idUsuario) {
//Menu Horizontal de Ações

    $solicitacoesRecibidas = new Amigo('','','','','');
    $solicitacoesEnviadas = $solicitacoesRecibidas;

    $amigoDAO = new AmigoDAO();

    $solicitacoesRecibidas = $amigoDAO->buscarSolicitacoesRecebidas($idUsuario);
    $solicitacoesEnviadas = $amigoDAO->buscarSolicitacoesEnviadas($idUsuario);

    $numSolicitacoesRecebidas = '';
    if(count($solicitacoesRecibidas) > 0){
        $numSolicitacoesRecebidas = count($solicitacoesRecibidas);
    }

echo"<nav id='MenuHorizontal' class='navbar navbar-inverse'>
    <div class='container-fluid'>
        <ul id='ulMenuHorizontal' class='nav navbar-nav'>
            <li><a href='../view/verAmigos.view.php?userID=".$idUsuario."'>Amigos</a></li>
            <li><a href='#' id='botaoNotificacoes' class='dropdown-toggle' data-toggle='dropdown'>Notificações   <span id='badgeNotificacao' class='badge'>".$numSolicitacoesRecebidas."</span></a></li>
            
            <ul id='ulDropDownNotificacoes' class='dropdown-menu'>
                <li><h3 id='h3Solicitacoes'>Solicitações Recebidas</h3></li>
                <li><hr id='hrSolicitacoes'/></li>";

                if($numSolicitacoesRecebidas > 0){
                    foreach ($solicitacoesRecibidas as $soli) {

                        $userDAO = new UsuarioDAO();
                        $user = $userDAO->buscarPeloId($soli->idSolicitante);

                        $cidadeDAO = new CidadeDAO();
                        $cidade = $cidadeDAO->buscarPeloId($user->getCidade());

                        $ufDAO = new UfDAO();
                        $uf = $ufDAO->buscarPeloId($user->getEstado());

                        echo "<li><div id='DivMediaDropdownSolicitacao' class='col-md-12'>
                    <div id='divMediaSolicitacao' class='media'>
                        <div class='media-left media-middle'>";
                            if($user->getFotoPerfil() == 'perfil.png') {
                                echo "<a href='../view/perfilUsuario.view.php?userID=".$user->getIdUsuario()."' ><img class='media-object' src='../imagens/perfil.png'
                             alt='Foto Perfil'/></a>";
                            }
                            else {
                                echo "<a href='../view/perfilUsuario.view.php?userID=".$user->getIdUsuario()."' ><img class='media-object' src='../imagens/Usuario/".$user->getIdUsuario()."/Albuns/Perfil/".$user->getFotoPerfil()."'
                             alt='Foto Perfil'/></a>";
                            }
                        echo"</div>
                        <div class='media-body'>
                            <div id='divMediaSolicitacaoDados' class='col-md-8'>
                            <h5 class='media-heading'>".$user->getNome()." ".$user->getSobrenome()."</h5>
                                <p>".$cidade->getNomeCidade()." - ".$uf->getSiglaUf()."</p>
                            </div>
                            <div id='divMediaSolicitacaoButton' class='col-md-4'>
                                <div class='row'>
                                    <form method='post' action='../controller/amizade.action.php'>
                                        <input type='hidden' name='act' value='aceitar'>
                                        <input type='hidden' name='idUsuario' value='" . $idUsuario . "'>
                                        <input type='hidden' name='userID' value='" . $user->getIdUsuario() . "'> 
                                        <button class='btn btn-primary' title='Aceitar Solicitação de Amizade' type='submit'>
                                        <i class='glyphicon glyphicon-ok'></i>   Aceitar</button>
                                    </form>
                                </div>
                                <div class='row'>
                                    <form method='post' action='../controller/amizade.action.php'>
                                        <input type='hidden' name='act' value='recusar'>
                                        <input type='hidden' name='idUsuario' value='" . $idUsuario . "'>
                                        <input type='hidden' name='userID' value='" . $user->getIdUsuario() . "'> 
                                        <button class='btn btn-primary' title='Recusar Solicitação de Amizade' type='submit'>
                                        <i class='glyphicon glyphicon-remove'></i>   Recusar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small id='smallDataSolicitacao'>Recebida em ".date("d/m/Y" , strtotime($soli->dataSolicitacao))."</small>
                </div></li>";
                    }
                }
                else {
                    echo"<li><h4 id=''><i class='glyphicon glyphicon-bell'></i>   Você não possui solitações no momento.</h4></li>";
                }

            echo"<li><h3 id='h3Solicitacoes'>Solicitações Enviadas</h3></li>
                <li><hr id='hrSolicitacoes'/></li>";

            if(count($solicitacoesEnviadas) > 0){
                foreach ($solicitacoesEnviadas as $soli) {

                    $userDAO = new UsuarioDAO();
                    $user = $userDAO->buscarPeloId($soli->idSolicitado);

                    $cidadeDAO = new CidadeDAO();
                    $cidade = $cidadeDAO->buscarPeloId($user->getCidade());

                    $ufDAO = new UfDAO();
                    $uf = $ufDAO->buscarPeloId($user->getEstado());

                    echo "<li><div id='DivMediaDropdownSolicitacao' class='col-md-12'>
                            <div id='divMediaSolicitacao' class='media'>
                                <div class='media-left media-middle'>";
                    if($user->getFotoPerfil() == 'perfil.png') {
                        echo "<a href='../view/perfilUsuario.view.php?userID=".$user->getIdUsuario()."' ><img class='media-object' src='../imagens/perfil.png'
                                     alt='Foto Perfil'/></a>";
                    }
                    else {
                        echo "<a href='../view/perfilUsuario.view.php?userID=".$user->getIdUsuario()."' ><img class='media-object' src='../imagens/Usuario/".$user->getIdUsuario()."/Albuns/Perfil/".$user->getFotoPerfil()."'
                                     alt='Foto Perfil'/></a>";
                    }
                    echo"</div>
                                <div class='media-body'>
                                    <div id='divMediaSolicitacaoDados' class='col-md-8'>
                                    <h5 class='media-heading'>".$user->getNome()." ".$user->getSobrenome()."</h5>
                                        <p>".$cidade->getNomeCidade()." - ".$uf->getSiglaUf()."</p>
                                    </div>
                                    <div id='divMediaSolicitacaoButtonCancelar' class='col-md-4'>
                                        <div class='row'>
                                            <form method='post' action='../controller/amizade.action.php'>
                                                <input type='hidden' name='act' value='cancelar'>
                                                <input type='hidden' name='idUsuario' value='" . $idUsuario . "'>
                                                <input type='hidden' name='userID' value='" . $user->getIdUsuario() . "'> 
                                                <button class='btn btn-primary' title='Cancelar Solicitação de Amizade' type='submit'>
                                                <i class='glyphicon glyphicon-remove'></i>   Cancelar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <small id='smallDataSolicitacao'>Solicitado em ".date("d/m/Y" , strtotime($soli->dataSolicitacao))."</small>
                        </div></li>";
                }
            }
            else {
                echo"<li><h4 id=''><i class='glyphicon glyphicon-bell'></i>   Você não possui solitações no momento.</h4></li>";
            }

            echo"</ul>
            
            <li><a href='#'>Mensagens</a></li>
            <li><a href='../view/perfilUsuario.view.php?userID=".$idUsuario."'>Meu Perfil</a></li>
        </ul>
    </div>
</nav>";

//Fim do Menu Horizontal de Ações
}

function menuLateralEsquerdoUsuario($fotoPerfil, $idUsuario) {
//Início do Menu Lateral do Usuário

echo"<div id='divMenuLateralEsquerdo' class='col-sm-2 sidenav'>
    <div id='divMenuLateralUsuario' class='container-fluid bg-1 text-center'>";
        if($fotoPerfil == 'perfil.png') {
            echo "<img id='imgFotoPerfilUsuario' src='../imagens/perfil.png' class='img-circle' alt='Foto Perfil'/>";
        }
        else {
            echo "<img id='imgFotoPerfilUsuario' src='../imagens/Usuario/".$idUsuario."/Albuns/Perfil/".$fotoPerfil."'' class='img-circle' alt='Foto Perfil'/>";
        }
        echo"<a>Editar Perfil</a>
    </div>
        <p><a id='BotaoMenuLateral' class='btn btn-info' href='#'>Editar Perfil</a></p>
        <p><a id='BotaoMenuLateral' class='btn btn-info' href='#'>Álbuns</a></p>
        <p><a id='BotaoMenuLateral' class='btn btn-info' href='#'>Demais Opções</a></p>
</div>";

//Início do Menu Lateral do Usuário
}

function muralDeNoticias()
{
//Início da Div Central da Página, Mural de Notícias

echo"<div id = 'divMural' class='col-sm-8 text-left' >
    <h1 > Mural de Notícias </h1 >
    <p > Aqui será o feed, onde aparecem todas as atualizações .</p >
    <hr >
    <h3 > Teste</h3 >
    <p > Fim do Feed...</p >
    <h1 > Mural de Notícias </h1 >
    <p > Aqui será o feed, onde aparecem todas as atualizações .</p >
    <hr >
    <button>Click</button>
    <h3 > Teste</h3 >
    <p > Fim do Feed...</p >
    <h1 > Mural de Notícias </h1 >
    <p > Aqui será o feed, onde aparecem todas as atualizações .</p >
    <hr >
    <h3 > Teste</h3 >
    <p > Fim do Feed...</p >
    <h1 > Mural de Notícias </h1 >
    <p > Aqui será o feed, onde aparecem todas as atualizações .</p >
    <hr >
    <h3 > Teste</h3 >
    <p > Fim do Feed...</p >
    <h1 > Mural de Notícias </h1 >
    <p > Aqui será o feed, onde aparecem todas as atualizações .</p >
    <hr >
    <h3 > Teste</h3 >
    <p > Fim do Feed...</p >
    <h1 > Mural de Notícias </h1 >
    <p > Aqui será o feed, onde aparecem todas as atualizações .</p >
    <hr >
    <h3 > Teste</h3 >
    <p > Fim do Feed...</p >
</div >";

//Fim da Div Central da Página, Mural de Notícias
}

function menuLateralDireitoAmigos($idUsuario)
{
//Início do Menu Lateral Direito, Menu de Amigos

echo "<div id = 'divMenuLateralDireito' class='col-sm-2 sidenav' >
    <table id = 'tableAmigos' class='table' >
        <thead >
        <tr >
            <th scope = 'col' colspan = '3' > Meus Amigos </th >
        </tr >
        </thead >
        <tbody >
        <tr >
            <td ><img src = '../imagens/thor.jpg' class='img-rounded' ></td >
            <td ><img src = '../imagens/thor.jpg' class='img-rounded' ></td >
            <td ><img src = '../imagens/thor.jpg' class='img-rounded' ></td >
        </tr >
        <tr >
            <td ><img src = '../imagens/thor.jpg' class='img-rounded' ></td >
            <td ><img src = '../imagens/thor.jpg' class='img-rounded' ></td >
            <td ><img src = '../imagens/thor.jpg' class='img-rounded' ></td >
        </tr >
        <tr >
        <th scope = 'col' colspan = '3' ><a id = 'aVerTodos' href='../view/verAmigos.view.php?userID=".$idUsuario."'> Ver Todos </a ></th >
        </tr >
        </tbody >
    </table >

    <table id = 'tableAmigos' class='table' >
        <thead >
        <tr >
            <th scope = 'col' colspan = '3' > Meus Times </th >
        </tr >
        </thead >
        <tbody >
        <tr >
            <td ><img src = '../imagens/thor.jpg' ></td >
            <td ><img src = '../imagens/thor.jpg' ></td >
            <td ><img src = '../imagens/thor.jpg' ></td >
        </tr >
        <tr >
            <td ><img src = '../imagens/thor.jpg' ></td >
            <td ><img src = '../imagens/thor.jpg' ></td >
            <td ><img src = '../imagens/thor.jpg' ></td >
        </tr >
        <tr >
            <th scope = 'col' colspan = '3' ><a id = 'aVerTodos' > Ver Todos </a ></th >
        </tr >
        </tbody >
    </table >
</div >";

//Fim do Menu Lateral Direito, Menu de Amigos
}

function rodape()
{
//Inicio do Rodapé

    echo "<footer id='divRodape' class='container-fluid text-center'>
    <p>ProjectK ® - 2018</p>
    <p><a href='../view/contato.view.php'>Entre em contato conosco.</a></p>
    <p id='pDevs'>Desenvolvido por: Ciro Gustavo e Iran Junior</p>
</footer>";

//Fim do Rodapé
}
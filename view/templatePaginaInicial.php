<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 02/01/2019
 * Time: 14:33
 */

function cabecalho(){
//Cabeçalho do site

echo"<nav id='cabecalho' class='navbar navbar-inverse'>
    <div class='container-fluid'>

        <div class='navbar-header'>
            <a id='logoProjectK' class='navbar-brand' href='../view/paginaInicial.view.php'>ProjectK</a>
        </div>

        <form id='formPesquisar' class='navbar-form navbar-left' method='post' action='#'>
            <div id='divInputPesquisar' class='input-group'>
                <input id='inputPesquisar' name='busca' type='text' class='form-control' placeholder='Pesquisar...'>
                <div class='input-group-btn'>
                    <button id='BotaoPesquisar' class='btn btn-warning' type='submit'>
                        <i class='glyphicon glyphicon-search'></i>
                    </button>
                </div>
            </div>
        </form>

        <div id='divUsuarioCabecalho' class='nav nav-bar navbar-right'>
            <span class='glyphicon glyphicon-user'></span>
            <label>Bem vindo, Usuário</label>
            <div id='divFotoMenuUsuario' class='dropdown nav nav-bar navbar-right'>
                <img class='dropdown-toggle img-circle' data-toggle='dropdown' src='../imagens/perfil.png'
                     alt='Foto Perfil'/>
                <ul class='dropdown-menu'>
                    <li><a href='#'>Meu Perfil</a></li>
                    <li><a href='#'>Configurações</a></li>
                    <li><a href='#'>Sair</a></li>
                </ul>
            </div>
        </div>

    </div>
</nav>";

//Fim do Cabeçalho do site
}

function menuHorizontal() {
//Menu Horizontal de Ações

echo"<nav id='MenuHorizontal' class='navbar navbar-inverse'>
    <div class='container-fluid'>
        <ul id='ulMenuHorizontal' class='nav navbar-nav'>
            <li><a href='#'>Amigos</a></li>
            <li><a href='#'>Notificações</a></li>
            <li><a href='#'>Mensagens</a></li>
            <li><a href='#'>Meu Perfil</a></li>
        </ul>
    </div>
</nav>";

//Fim do Menu Horizontal de Ações
}

function menuLateralEsquerdoUsuario() {
//Início do Menu Lateral do Usuário

echo"<div id='divMenuLateralEsquerdo' class='col-sm-2 sidenav'>
    <div id='divMenuLateralUsuario' class='container-fluid bg-1 text-center'>
        <img id='imgFotoPerfilUsuario' src='../imagens/perfil.png' class='img-circle' alt='Foto Perfil'/>
        <a>Editar Perfil</a>
    </div>
        <p>Menu Lateral do Usuário</p>
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

function menuLateralDireitoAmigos()
{
//Início do Menu Lateral Direito, Menu de Amigos

echo"<div id = 'divMenuLateralDireito' class='col-sm-2 sidenav' >
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
        <th scope = 'col' colspan = '3' ><a id = 'aVerTodos' > Ver Todos </a ></th >
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
    <p><a>Entre em contato conosco.</a></p>
    <p id='pDevs'>Desenvolvido por: Ciro Gustavo e Iran Junior</p>
</footer>";

//Fim do Rodapé
}
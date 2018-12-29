<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 28/12/2018
 * Time: 13:28
 */
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>ProjectK - Página Inicial</title>

</head>
<body>

<!--Cabeçalho do site-->
<nav id='cabecalho' class='navbar navbar-inverse'>
    <div class='container-fluid'>
        <div class='navbar-header'>
            <a class='navbar-brand' href='../view/paginaInicial.view.php'>ProjectK</a>
        </div>
        <form class='navbar-form navbar-left' method='post' action='#'>
            <div class='input-group'>
                <input id='Pesquisar' name='busca' type='text' class='form-control' placeholder='Pesquisar...'>
                <div class='input-group-btn'>
                    <button id='BotaoPesquisar' class='btn btn-warning' type='submit'>
                        <i class='glyphicon glyphicon-search'></i>
                    </button>
                </div>
            </div>
        </form>
        <div id='Usuario' class='dropdown nav nav-bar navbar-right'>
            <span class='glyphicon glyphicon-user'></span>
            <label>Bem vindo, Usuário !</label>
            <button class='btn btn-warning dropdown-toggle' type='button' data-toggle='dropdown'><span
                        class='glyphicon glyphicon-menu-hamburger'></span></button>
            <ul class='dropdown-menu'>
                <li><a href='#'>Meu Perfil</a></li>
                <li><a href='#'>Configurações</a></li>
                <li><a href='#'>Sair</a></li>
            </ul>
        </div>
</nav>
<!--Fim do Cabeçalho do site -->

<!--Menu de Ações -->
<nav id='Menu' class='navbar navbar-inverse'>
    <div class='container-fluid'>
        <ul class='nav navbar-nav '>
            <li><a href='#'>Amigos</a></li>
            <li><a href='#'>Notificações</a></li>
            <li><a href='#'>Mensagens</a></li>
            <li><a href='#'>Meu Perfil</a></li>
        </ul>
    </div>
</nav>
<!-- Fim do Menu de Ações -->

<!-- Inicio da Div Geral da Página -->
<div class="container-fluid text-center">
    <div class="row content">
        <!-- Pausa na Div Geral da Página -->

        <!-- Início do Menu Lateral do Usuário -->
        <div class="col-sm-2 sidenav">
            <p>Menu Lateral do Usuário</p>
            <p><a href="#">Editar Perfil</a></p>
            <p><a href="#">Álbuns</a></p>
            <p><a href="#">Demais Opções</a></p>
        </div>
        <!-- Início do Menu Lateral do Usuário -->

        <!-- Início da Div Central da Página, Mural de Notícias -->
        <div class="col-sm-8 text-left">
            <h1>Mural de Notícias</h1>
            <p>Aqui será o feed, onde aparecem todas as atualizações.</p>
            <hr>
            <h3>Teste</h3>
            <p>Fim do Feed...</p>
        </div>
        <!-- Fim da Div Central da Página, Mural de Notícias -->

        <!-- Início do Menu Lateral Direito, Menu de Amigos -->
        <div class="col-sm-2 sidenav">
            <p>Menu Lateral Direito</p>
            <p>Amigos e outras coisas</p>
            <div class="well">
                <p>Amigos</p>
            </div>
            <div class="well">
                <p>Times</p>
            </div>
        </div>
        <!-- Fim do Menu Lateral Direito, Menu de Amigos -->

        <!-- Retorno da Pausa na Div Geral da Página -->
    </div>
</div>
<!-- Fim da Div Geral da Página -->

<!-- Inicio do Rodapé -->
<footer class="container-fluid text-center">
    <p>Rodapé</p>
    <p>Entre em contato conosco.</p>
</footer>
<!-- Fim do Rodapé -->

</body>
</html>
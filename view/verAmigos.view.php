<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 05/02/2019
 * Time: 15:20
 */
/*Nomeclaturando sessão*/
session_name(hash('sha256',$_SERVER['SERVER_ADDR'].$_SERVER['REMOTE_ADDR']));

/* Iniciando a sessão.*/
session_start();

$idUsuario=1;
$nomeUsuario="";
$fotoPerfil="";

//Verificação de segurança. Se não houver usuário logado, redireciona para a página de login.
if((empty($_SESSION['idUsuario']) || empty($_SESSION['nomeUsuario']) || empty($_SESSION['fotoPerfil'])) &&
    (empty($_COOKIE[hash('sha256','idUsuario')]) || empty($_COOKIE[hash('sha256','nomeUsuario')]) ||
        empty($_COOKIE[hash('sha256','fotoPerfil')]) || empty($_COOKIE[hash('sha256','senha')]) ||
        empty($_COOKIE[hash('sha256','email')]))){

    $msg = "É necessário estar logado para acessar esta página !";
    //echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
}

// Verificação se usuário está logado via sessão.
if(!empty($_SESSION['idUsuario']) || !empty($_SESSION['nomeUsuario']) || !empty($_SESSION['fotoPerfil'])) {

    $idUsuario = $_SESSION['idUsuario'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $fotoPerfil = $_SESSION['fotoPerfil'];
}

// Verificação se usuário está logado via cookie.
if(!empty($_COOKIE[hash('sha256','idUsuario')]) || !empty($_COOKIE[hash('sha256','nomeUsuario')]) ||
    !empty($_COOKIE[hash('sha256','fotoPerfil')]) || !empty($_COOKIE[hash('sha256','senha')]) ||
    !empty($_COOKIE[hash('sha256','email')])){

    $idUsuario = base64_decode($_COOKIE[hash('sha256','idUsuario')]);
    $nomeUsuario = base64_decode($_COOKIE[hash('sha256','nomeUsuario')]);
    $fotoPerfil = base64_decode($_COOKIE[hash('sha256','fotoPerfil')]);
}

require_once ("../view/templatePaginaInicial.php");
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
    <title>ProjectK - Meus Amigos</title>

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
        <div id = 'divMural' class='col-sm-8 text-left'>

            <!--<div id="verAmigos" class="container">-->
            <div class="col-md-12" id="verAmigos">
                <div class='row'>
                    <h1> Meus Amigos</h1>
                    <input type="text" placeholder="busque amigo pelo nome...">
                    <hr>
                </div>
                <?php
                for($i=1; $i < 9;$i++) {
                    echo "<div class='row'>
                        <div class='col-md-12'>
                            <div id='divAmigo' class='col-md-5'>
                                <div class='col-md-2'>
                                     <a href='#'>
                                         <img class='media-object' src='' alt='foto'>
                                     </a>
                                </div>
                                <div class='col-md-2' style='margin-top: 2%'>
                                     <h5 style='font-weight: bold;' class='media-heading'>nome</h5>
                                     <p>cidade</p>
                                </div>
                                <div class='col-md-8' style='margin-top: 2%'>
                                     <button id='btnMensagem' class='btn btn-info'>
					                     <i class='glyphicon glyphicon-user'></i>  Mensagem
                                      </button>
                                      <button id='btnExcluir' class='btn btn-info'>
					                     <i class='glyphicon glyphicon-user'></i>  Excluir 
                                     </button>
                                </div>
                                
                            </div>
                            <div id='divAmigo' class='col-md-5' >
                                <div class='col-md-2'>
                                     <a href='#'>
                                         <img class='media-object' src='' alt='foto'>
                                     </a>
                                </div>
                                <div class='col-md-2' style='margin-top: 2%'>
                                     <h5 style='font-weight: bold;' class='media-heading'>nome</h5>
                                     <p>cidade</p>
                                </div>
                                <div class='col-md-8' style='margin-top: 2%'>
                                     <button id='btnMensagem' class='btn btn-info'>
					                     <i class='glyphicon glyphicon-user'></i>  Mensagem
                                     </button>
                                     <button id='btnExcluir' class='btn btn-info'>
					                     <i class='glyphicon glyphicon-user'></i>  Excluir 
                                     </button>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
                ?>
                <nav id='Paginacao' aria-label='Navegacao' class="col-md-10">
                    <ul id='UlPaginacao' class='pagination pagination-md'>
                        <li class='page-item'>

                            <?php/*
                            echo "<a class='page-link $exibir_botao_inicio' href='$endereco?page=$primeira_pagina&busca=$busca[0]' title='Primeira Página'>&laquo; Primeira  </a>";
                            */?>
                        </li>
                        <li class='page-item'>
                            <?php/*
                            echo"<a class='page-link $exibir_botao_inicio' href='$endereco?page=$pagina_anterior&busca=$busca[0]' title='Página Anterior'>‹ Anterior  </a>";
                            */?>
                        </li>
                        <?php
                        /* Loop para montar a páginação central com os números*/
                        /*for ($i = $range_inicial; $i <= $range_final; $i++):
                            $destaque = ($i == $pagina_atual) ? 'destaque' : '';
                            echo "<li class='page-item'>";
                            echo "<a class='page-link $destaque' href='$endereco?page=$i&busca=$busca[0]'>  $i  </a>";
                            echo"</li>";
                        endfor;*/
                        ?>

                        <li class='page-item'>
                            <?php/*
                            echo"<a class='page-link $exibir_botao_final' href='$endereco?page=$proxima_pagina&busca=$busca[0]' title='Próxima Página'> Próxima ›</a>";
                            */?>
                        </li>
                        <li class='page-item'>
                            <?php/*
                            echo"<a class='page-link $exibir_botao_final' href='$endereco?page=$ultima_pagina&busca=$busca[0]'  title='Última Página'> Última &raquo;</a>";
                            */?>
                        </li>
                    </ul>
                </nav>
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
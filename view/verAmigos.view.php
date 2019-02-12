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
        <div id = 'divMural' class='col-sm-8 text-left' style="height: 600px;" >

            <h1>Meus Amigos: </h1>
            <br>
            <input type="text" id="pesquisarAmigos" name="busca">

            <?php
            foreach ($dados as $usuario) {
                require_once ("../dao/CidadeDAO.php");
                require_once ("../dao/UfDAO.php");

                $cidadeDao = new CidadeDAO();
                $cidade = $cidadeDao->buscarPeloId($usuario->cidade);

                $ufDao = new UfDAO();
                $uf = $ufDao->buscarPeloId($usuario->estado);

                echo "<div class='col-md-8' style='margin-bottom: 2%;'>
                <div class='media' style='border: solid; border-radius: 10px; border-color: #E5E5E5; border-width: 1px;'>
                    <div class='media-left media-middle'>";
                if($usuario->fotoPerfil == 'perfil.png') {
                    echo "<a href='#'>
                                <img class='media-object' src='../imagens/Usuario/15/Albuns/Perfil/thor.jpg' 
                                alt='foto' style='width: 80px; height: 80px;'>
                            </a>";
                }else{
                    echo "<a href='#'><img class='media-object' src='../imagens/Usuario/".$usuario->idUsuario."/Albuns/Perfil/".$usuario->fotoPerfil."' 
                            alt='Foto Perfil' style='width: 80px; height: 80px;'/></a>";
                }
                echo "</div>
                    <div class='media-body'>
                        <div class='col-md-7' style='margin-top: 6%'>
                        <h5 style='font-weight: bold;' class='media-heading'>" . $usuario->nome . " ".$usuario->sobrenome."</h5>
                            <p>" . $cidade->getNomeCidade() . " - " . $uf->getSiglaUf() . "</p>
                        </div>
                        <div class='col-md-5' style='margin-top: 6%'>
                            <button style='width: 100%; background-color: #37C967; color: white; font-size: 16px; font-weight: bold; border-color: #37C967' class='btn btn-info'>Adicionar</button>
                        </div>
                    </div>
                </div>
                </div>";
            }
            ?>

            <div class='row'>
                <!-- Inicio da Lista de paginação -->
                <ul class="pagination">
                    <?php
                        if($pagina_atual != 1 ) {
                            echo "<li><a href='../view/resultadoBuscaUsuario.view.php?page=$primeira_pagina&palavra=$palavra'>Primeira Página</a></li>
                              <li><a href='../view/resultadoBuscaUsuario.view.php?page=$pagina_anterior&palavra=$palavra'>&lt;&lt;</a></li>";
                        }
                    ?>
                    <?php
                        if($valor->total_registros > QTDE_REGISTROS) {
                            for ($i = $pagina_atual/*$range_inicial*/; $i <= $range_final; $i++) {
                                echo "<li><a href='../view/resultadoBuscaUsuario.view.php?page=$i&palavra=$palavra'> $i</a></li>";
                            }
                        }
                    ?>
                    <?php
                        if($pagina_atual != $range_final) {
                            echo "<li><a href='../view/resultadoBuscaUsuario.view.php?page=$proxima_pagina&palavra=$palavra'>&gt;&gt;</a></li>
                                <li><a href='../view/resultadoBuscaUsuario.view.php?page=$ultima_pagina&palavra=$palavra'>Última Página</a></li>";
                        }
                    ?>
                </ul>
                <!-- Fim da Lista de paginação -->
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
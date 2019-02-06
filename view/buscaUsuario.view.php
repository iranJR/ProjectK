<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 12/01/2019
 * Time: 11:29
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

$busca = $_GET['palavra'];
$busca = explode(' ', $busca, 2);
$palavra = $_GET['palavra'];

require_once ('../banco/conexao_bd.php');

global $pdo;
/*endereço atual da página*/
$endereco = $_SERVER ['PHP_SELF'];
/* Constantes de configuração*/
define('QTDE_REGISTROS', 1);
define('RANGE_PAGINAS', 3);
/* Recebe o número da página via parâmetro na URL*/
$pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
/* Calcula a linha inicial da consulta*/
$linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;
/* Instrução de consulta para paginação com MySQL*/
if(count($busca) == 2) {
    $sql = "SELECT * FROM usuario where nome like :busca && sobrenome like :busca2 LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':busca',  $busca[0] . '%');
    $statement->bindValue(':busca2',  $busca[1] . '%');
}else{
    $sql = "SELECT * FROM usuario where nome like :busca LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':busca',  $busca[0] . '%');
}
$statement->execute();
$dados = $statement->fetchAll(PDO::FETCH_OBJ);
/* Conta quantos registos existem na tabela*/
if(count($busca) == 2) {
    $sqlContador = "SELECT COUNT(*) AS total_registros FROM usuario where nome like :busca && sobrenome like :busca2";
    $statement = $pdo->prepare($sqlContador);
    $statement->bindValue(':busca',  $busca[0] . '%');
    $statement->bindValue(':busca2', $busca[1] . '%');
}else{
    $sqlContador = "SELECT COUNT(*) AS total_registros FROM usuario where nome like :busca";
    $statement = $pdo->prepare($sqlContador);
    $statement->bindValue(':busca',  $busca[0] . '%');
}
$statement->execute();
$valor = $statement->fetch(PDO::FETCH_OBJ);

/* Idêntifica a primeira página*/
$primeira_pagina = 1;
/* Cálcula qual será a última página*/
$ultima_pagina = ceil($valor->total_registros / QTDE_REGISTROS);
/* Cálcula qual será a página anterior em relação a página atual em exibição*/
$pagina_anterior = ($pagina_atual > 1) ? $pagina_atual - 1 : $pagina_atual;
/* Cálcula qual será a pŕoxima página em relação a página atual em exibição*/
$proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual + 1 : $pagina_atual;
/* Cálcula qual será a página inicial do nosso range*/
$range_inicial = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1;
/* Cálcula qual será a página final do nosso range*/
$range_final = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina;
/* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo"*/
$exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';
/* Verifica se vai exibir o botão "Anterior" e "Último"*/
$exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';


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
    <title>ProjectK - Página Inicial</title>

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
        <div id = 'divMural' class='col-sm-8 text-left' style="height: 600px;" >

            <h1>Resultados da Busca: </h1>
            <br>

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
                            <button style='width: 100%; background-color: #37C967; color: white; font-size: 16px; font-weight: bold; border-color: #37C967' class='btn btn-info'>
                                <i class='glyphicon glyphicon-user'></i>   Adicionar
                            </button>
                        </div>
                    </div>
                </div>
                </div>";
            }
            ?>

            <div class='row'>
<!--                <div class="col-md-12">-->
<!--                <ul class="pagination">-->
<!--                    --><?php
//                        if($pagina_atual != 1 ) {
//                            echo "<li><a href='../view/buscaUsuario.view.php?page=$primeira_pagina&palavra=$palavra'>Primeira Página</a></li>
//                              <li><a href='../view/buscaUsuario.view.php?page=$pagina_anterior&palavra=$palavra'>&lt;&lt;</a></li>";
//                        }
//                    ?>
<!--                    --><?php
//                        if($valor->total_registros > QTDE_REGISTROS) {
//                            for ($i = $pagina_atual; $i <= $range_final; $i++) {
//                                if($i != $pagina_atual) {
//                                    echo "<li><a href='../view/buscaUsuario.view.php?page=$i&palavra=$palavra'> $i</a></li>";
//                                }
//                            }
//                        }
//                    ?>
<!--                    --><?php
//                        if($pagina_atual != $range_final) {
//                            echo "<li><a href='../view/buscaUsuario.view.php?page=$proxima_pagina&palavra=$palavra'>&gt;&gt;</a></li>
//                                <li><a href='../view/buscaUsuario.view.php?page=$ultima_pagina&palavra=$palavra'>Última Página</a></li>";
//                        }
//                    ?>
<!--                </ul>-->
<!--                </div>-->

                <nav id='Paginacao' aria-label='Navegacao' class="col-md-10">
                    <ul id='UlPaginacao' class='pagination pagination-md'>
                        <li class='page-item'>

                            <?php
                                echo "<a class='page-link $exibir_botao_inicio' href='$endereco?page=$primeira_pagina&palavra=$palavra' title='Primeira Página'>&laquo; Primeira  </a>";
                            ?>
                        </li>
                        <li class='page-item'>
                            <?php
                                echo"<a class='page-link $exibir_botao_inicio' href='$endereco?page=$pagina_anterior&palavra=$palavra' title='Página Anterior'>‹ Anterior  </a>";
                            ?>
                        </li>
                        <?php
                        /* Loop para montar a páginação central com os números*/
                        for ($i = $range_inicial; $i <= $range_final; $i++):
                            $destaque = ($i == $pagina_atual) ? 'destaque' : '';
                            echo "<li class='page-item'>";
                                echo "<a class='page-link $destaque' href='$endereco?page=$i&palavra=$palavra'>  $i  </a>";
                            echo"</li>";
                        endfor;
                        ?>

                        <li class='page-item'>
                            <?php
                                echo"<a class='page-link $exibir_botao_final' href='$endereco?page=$proxima_pagina&palavra=$palavra' title='Próxima Página'> Próxima ›</a>";
                            ?>
                        </li>
                        <li class='page-item'>
                            <?php
                                echo"<a class='page-link $exibir_botao_final' href='$endereco?page=$ultima_pagina&palavra=$palavra'  title='Última Página'> Última &raquo;</a>";
                            ?>
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
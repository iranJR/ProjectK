<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 12/01/2019
 * Time: 11:29
 */

require_once ("../view/templatePaginaInicial.php");

$nomeUsuario = "Iran";
$fotoPerfil = '';
$idUsuario = 5;

$busca = "Iran Junior";


//echo $busca[0];

//if(count($busca) == 2){
//    echo "Dividiu";
//}else{
//    echo "Não dividiu";
//}

    $busca = $_GET['busca'];
    $busca = explode(' ', $busca, 2);

require_once ('../banco/conexao_bd.php');

global $pdo;
/*endereço atual da página*/
$endereco = $_SERVER ['PHP_SELF'];
/* Constantes de configuração*/
define('QTDE_REGISTROS', 10);
define('RANGE_PAGINAS', 1);
/* Recebe o número da página via parâmetro na URL*/
$pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
/* Calcula a linha inicial da consulta*/
$linha_inicial = ($pagina_atual - 1) * QTDE_REGISTROS;
/* Instrução de consulta para paginação com MySQL*/
if(count($busca) == 2) {
    $sql = "SELECT * FROM usuario where nome like :busca && sobrenome like :busca2 LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':busca', '%' . $busca[0] . '%');
    $statement->bindValue(':busca2', '%' . $busca[1] . '%');
}else{
    $sql = "SELECT * FROM usuario where nome like :busca LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':busca', '%' . $busca[0] . '%');
}
$statement->execute();
$dados = $statement->fetchAll(PDO::FETCH_OBJ);
/* Conta quantos registos existem na tabela*/
if(count($busca) == 2) {
    $sqlContador = "SELECT COUNT(*) AS total_registros FROM usuario where nome like :busca && sobrenome like :busca2";
    $statement = $pdo->prepare($sqlContador);
    $statement->bindValue(':busca', '%' . $busca[0] . '%');
    $statement->bindValue(':busca2', '%' . $busca[1] . '%');
}else{
    $sqlContador = "SELECT COUNT(*) AS total_registros FROM usuario where nome like :busca";
    $statement = $pdo->prepare($sqlContador);
    $statement->bindValue(':busca', '%' . $busca[0] . '%');
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
                <div class='media-left media-middle'>
                    <a href='#'>
                        <img class='media-object' src='../imagens/Usuario/15/Albuns/Perfil/thor.jpg' alt='foto' style='width: 80px; height: 80px;'>
                    </a>
                </div>
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
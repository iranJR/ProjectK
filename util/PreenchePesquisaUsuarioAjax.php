<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 25/01/2019
 * Time: 16:49
 */
$busca = $_GET['busca'];
$busca = str_replace("1", " ", $busca);
$busca = explode(' ', $busca, 2);

require_once ('../banco/conexao_bd.php');

global $pdo;

if(count($busca) == 2) {
    $sql = "SELECT * FROM usuario where nome like :busca && sobrenome like :busca2 order by nome, sobrenome LIMIT 5";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':busca', $busca[0] . '%');
    $statement->bindValue(':busca2', '%'. $busca[1] . '%');
}else{
    $sql = "SELECT * FROM usuario where nome like :busca order by nome, sobrenome LIMIT 5";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':busca', $busca[0] . '%');
}
$statement->execute();
$dados = $statement->fetchAll(PDO::FETCH_OBJ);

if(count($dados) > 0){
    foreach ($dados as $usuario) {
        require_once ("../dao/CidadeDAO.php");
        require_once ("../dao/UfDAO.php");

        $cidadeDao = new CidadeDAO();
        $cidade = $cidadeDao->buscarPeloId($usuario->cidade);

        $ufDao = new UfDAO();
        $uf = $ufDao->buscarPeloId($usuario->estado);

        echo"<li><div id='DivMediaDropdownUser' class='col-md-12'>
            <a href='../view/perfilUsuario.view.php?userID=".base64_encode($usuario->idUsuario)."' >
            <div id='divMediaUser' class='media'>
                <div class='media-left media-middle'>";
                    if($usuario->fotoPerfil == 'perfil.png') {
                    echo "<img class='media-object' src='../imagens/perfil.png' alt='Foto Perfil'/>";
                }
                else {
                    echo "<img class='media-object' src='../imagens/Usuario/".$usuario->idUsuario."/Albuns/Perfil/".$usuario->fotoPerfil."' alt='Foto Perfil' />";
                }
                echo"</div>
                <div class='media-body'>
                    <div id='divMediaUserDados' class='col-md-12'>
                    <h5 class='media-heading'>".$usuario->nome." ".$usuario->sobrenome."</h5>
                        <p>".$cidade->getNomeCidade()." - ".$uf->getSiglaUf()."</p>
                    </div>
                </div>
            </div>
            </a>
            </div></li>";
    }
        if(count($busca) == 2) {
            echo "<li>
                <a id='divMediaUserVerTodos' class='dropdown-item' href='../view/buscaUsuario.view.php?busca=$busca[0] $busca[1]'>Ver Todos</a>
            </li>";
        }
        else{
            echo "<li>
                <a id='divMediaUserVerTodos' class='dropdown-item' href='../view/buscaUsuario.view.php?busca=$busca[0]'>Ver Todos</a>
            </li>";
        }
}
else {
    echo "<li><p id='DivMediaUserP'><i class='glyphicon glyphicon-alert'></i>   Nenhum resultado encontrado.</p></li>";
}
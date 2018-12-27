<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 22/12/2018
 * Time: 14:14
 */

require_once ("../banco/config_conexao.inc.php");

try{
    $pdo= new PDO(BANCO,USUARIO,SENHA);
    $pdo->exec( "set names utf8");
}
catch (PDOException $erro){
    echo"Erro ao tentar conectar com o banco de dados. ".$erro->getMessage();
    echo exit(1);
}
<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 27/12/2018
 * Time: 20:53
 */

require_once ("../dao/CidadeDAO.php");

$idUf = $_GET['uf'];

$cidadeDAO = new CidadeDAO();

    echo "<option disabled selected value=''>Selecione a sua cidade...</option>";
foreach ($cidadeDAO->buscarTodosPorEstado($idUf) as $cidade){
    echo "<option value='$cidade->idCidade' >$cidade->nomeCidade</option>";
}
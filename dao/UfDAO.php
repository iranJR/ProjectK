<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 27/12/2018
 * Time: 20:30
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Uf.php");

class UfDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("INSERT INTO uf (nomeUf, siglaUf) VALUES (:nomeUf, :siglaUf)");

            $statement->bindValue(":nomeUf", $obj->getNomeUf());
            $statement->bindValue(":siglaUf", $obj->getSiglaUf());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('UF cadastrada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível cadastrar a UF !');</script>";
                }
            }
            else{
                throw new PDOException("<script>alert('Não foi possível executar o código SQL');</script>");
            }
        }
        catch (PDOException $erro){
            return "Erro ao conectar com o banco de dados: ".$erro->getMessage();
        }
    }

    public function alterar($obj)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("UPDATE uf SET nomeUf = :nomeUf, siglaUf = :siglaUf WHERE idUf = :id");

            $statement->bindValue(":nomeUf", $obj->getNomeUf());
            $statement->bindValue(":siglaUf", $obj->getSiglaUf());
            $statement->bindValue(":id", $obj->getIdUf());

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "<script> alert('UF alterada com sucesso !'); </script>";
                } else {
                    return "<script> alert('Não foi possível alterar a UF !'); </script>";
                }
            } else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar com o banco de dados: " . $erro->getMessage();
        }
    }

    public function apagar($obj)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM uf WHERE idUf = :id");
            $statement->bindValue(":id", $obj->getIdUf());

            if ($statement->execute()) {
                return "<script> alert('UF apagada com sucesso !'); </script>";
            } else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar com o banco de dados: " . $erro->getMessage();
        }
    }

    public function buscarPeloId($id)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT idUf, nomeUf, siglaUf FROM uf WHERE idUf = :id");
            $statement->bindValue(":id", $id);

            if($statement->execute()){

                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Uf('','','');

                if($rs != null) {
                    $obj->setIdUf($rs->idUf);
                    $obj->setNomeUf($rs->nomeUf);
                    $obj->setSiglaUf($rs->siglaUf);
                }

                return $obj;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar com o banco de dados: " . $erro->getMessage();
        }
    }

    public function buscarTodos()
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM uf");

            if($statement->execute()){

                $result = $statement->fetchAll(PDO::FETCH_OBJ);

                return $result;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar com o banco de dados: " . $erro->getMessage();
        }
    }
}
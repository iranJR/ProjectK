<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 27/12/2018
 * Time: 20:22
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Cidade.php");

class CidadeDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("INSERT INTO cidade (nomeCidade, idUf) VALUES (:nomeCidade, :idUf)");

            $statement->bindValue(":nomeCidade", $obj->getNomeCidade());
            $statement->bindValue(":idUf", $obj->getIdUf());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Cidade cadastrada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível cadastrar a cidade !');</script>";
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
            $statement = $pdo->prepare("UPDATE cidade SET nomeCidade = :nomeCidade, idUf = :idUf WHERE idCidade = :id");

            $statement->bindValue(":nomeCidade", $obj->getNomeCidade());
            $statement->bindValue(":idUf", $obj->getIdUf());
            $statement->bindValue(":id", $obj->getIdCidade());

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "<script> alert('Cidade alterada com sucesso !'); </script>";
                } else {
                    return "<script> alert('Não foi possível alterar a cidade !'); </script>";
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
            $statement = $pdo->prepare("DELETE FROM cidade WHERE idCidade = :id");
            $statement->bindValue(":id", $obj->getIdCidade());

            if ($statement->execute()) {
                return "<script> alert('Cidade apagada com sucesso !'); </script>";
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
            $statement = $pdo->prepare("SELECT idCidade, nomeCidade, idUf FROM cidade WHERE idCidade = :id");
            $statement->bindValue(":id", $id);

            if($statement->execute()){

                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Cidade('','','');

                if($rs != null) {
                    $obj->setIdCidade($rs->idCidade);
                    $obj->setNomeCidade($rs->nomeCidade);
                    $obj->setIdUf($rs->idUf);
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
            $statement = $pdo->prepare("SELECT * FROM cidade");

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

    public function buscarTodosPorEstado($id)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM cidade WHERE idUf = :id");
            $statement->bindValue(":id", $id);

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
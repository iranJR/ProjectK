<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 20/02/2019
 * Time: 16:12
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Reacao.php");

class ReacaoDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO reacao (idPost, idUsuario, tipoReacao) VALUES
           (:idPost, :idUsuario, :tipoReacao)");

            $statement->bindValue(":idPost",$obj->getIdPost());
            $statement->bindValue(":idUsuario",$obj->getIdUsuario());
            $statement->bindValue(":tipoReacao",$obj->getTipoReacao());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Reação realizada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível realizar a reação !');</script>";
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
        try{
            $statement = $pdo->prepare("UPDATE reacao SET idPost = :idPost, idUsuario = :idUsuario , tipoReacao = :tipoReacao WHERE idReacao = :id");

            $statement->bindValue(":idPost",$obj->getIdPost());
            $statement->bindValue(":idUsuario",$obj->getIdUsuario());
            $statement->bindValue(":tipoReacao",$obj->getTipoReacao());
            $statement->bindValue(":id",$obj->getIdReacao());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Reação alterada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível alterar a reação !');</script>";
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

    public function apagar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("DELETE FROM reacao WHERE idReacao = :id");
            $statement->bindValue(":id",$obj->getIdReacao());
            if($statement->execute()) {
                return "<script>alert('Reação apagada com sucesso !');</script>";
            }
            else{
                throw new PDOException("<script>alert('Não foi possível executar o código SQL');</script>");
            }
        }
        catch (PDOException $erro){
            return "Erro ao conectar com o banco de dados: ".$erro->getMessage();
        }
    }

    public function buscarPeloId($id)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM reacao WHERE idReacao = :id ");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Reacao('','','','');

                if($rs != null) {
                    $obj->setIdReacao($rs->idReacao);
                    $obj->setIdPost($rs->idPost);
                    $obj->setIdUsuario($rs->idUsuario);
                    $obj->setTipoReacao($rs->tipoReacao);
                }

                return $obj;
            }
            else {
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
            $statement= $pdo->prepare("SELECT * FROM reacao ");
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
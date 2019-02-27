<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 15:28
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Amigo.php");

class AmigoDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO amigo(dataSolicitacao , idSolicitante, idSolicitado) 
            VALUES(:dataSolicitacao , :idSolicitante, :idSolicitado)");

            $statement->bindValue(":dataSolicitacao",$obj->getDataSolicitacao());
            $statement->bindValue(":idSolicitante",$obj->getIdSolicitante());
            $statement->bindValue(":idSolicitado",$obj->getIdSolicitado());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    $obj->setIdSolicitacao($pdo->lastInsertId());
                    return"<script>alert('Amizade solicitada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível solicitar a amizade !');</script>";
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
            $statement = $pdo->prepare("UPDATE amigo SET dataSolicitacao = :dataSolicitacao , idSolicitante = :idSolicitante, 
            idSolicitado = :idSolicitado, dataConfirmacao = :dataConfirmacao WHERE idSolicitacao = :id");

            $statement->bindValue(":dataSolicitacao",$obj->getDataSolicitacao());
            $statement->bindValue(":idSolicitante",$obj->getIdSolicitante());
            $statement->bindValue(":idSolicitado",$obj->getIdSolicitado());
            $statement->bindValue(":dataConfirmacao",$obj->getDataConfirmacao());
            $statement->bindValue(":id",$obj->getIdSolicitacao());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Amizade alterada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível alterar a amizade !');</script>";
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
            $statement = $pdo->prepare("DELETE FROM amigo WHERE idSolicitacao = :id");
            $statement->bindValue(":id",$obj->getIdSolicitacao());
            if($statement->execute()) {
                return "<script>alert('Amizade apagada com sucesso !');</script>";
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
            $statement = $pdo->prepare("SELECT * FROM amigo WHERE idSolicitacao= :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Amigo('','','','','');

                if($rs != null) {
                    $obj->setIdSolicitacao($rs->idSolicitacao);
                    $obj->setDataSolicitacao($rs->dataSolicitacao);
                    $obj->setIdSolicitante($rs->idSolicitante);
                    $obj->setIdSolicitado($rs->idSolicitado);
                    $obj->setDataConfirmacao($rs->dataConfirmacao);
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
            $statement= $pdo->prepare("SELECT * FROM amigo ");
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

    public function buscarPorAmizade($idUsuario, $idAmigo)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM amigo WHERE idSolicitante = :idUsuario AND idSolicitado = :idAmigo OR idSolicitado = :idUsuario AND idSolicitante = :idAmigo");
            $statement->bindValue(":idUsuario",$idUsuario);
            $statement->bindValue(":idAmigo",$idAmigo);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Amigo('','','','','');

                if($rs != null) {
                    $obj->setIdSolicitacao($rs->idSolicitacao);
                    $obj->setDataSolicitacao($rs->dataSolicitacao);
                    $obj->setIdSolicitante($rs->idSolicitante);
                    $obj->setIdSolicitado($rs->idSolicitado);
                    $obj->setDataConfirmacao($rs->dataConfirmacao);
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

    public function buscarTodosAmigos($idUsuario)
    {
        global $pdo;
        try{
            $statement= $pdo->prepare("SELECT * FROM amigo WHERE idSolicitante = :id AND dataConfirmacao is not null OR idSolicitado = :id AND dataConfirmacao is not null ");
            $statement->bindValue(":id",$idUsuario);
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

    public function buscarSolicitacoesRecebidas($idUsuario)
    {
        global $pdo;
        try{
            $statement= $pdo->prepare("SELECT * FROM amigo WHERE idSolicitado = :id AND dataConfirmacao is null ORDER BY dataSolicitacao DESC");
            $statement->bindValue(":id",$idUsuario);
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

    public function buscarSolicitacoesEnviadas($idUsuario)
    {
        global $pdo;
        try{
            $statement= $pdo->prepare("SELECT * FROM amigo WHERE idSolicitante = :id AND dataConfirmacao is null ORDER BY dataSolicitacao DESC");
            $statement->bindValue(":id",$idUsuario);
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
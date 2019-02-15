<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 15:38
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Conversa.php");

class ConversaDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO conversa( dataConversa, idRemetenteCon, idDestinatarioCon) VALUES 
            (:dataConversa, :idRemetenteCon, :idDestinatarioCon)");

            $statement->bindValue(":dataConversa",$obj->getDataConversa());
            $statement->bindValue(":idRemetenteCon",$obj->getIdRemetenteCon());
            $statement->bindValue(":idDestinatarioCon",$obj->getIdDestinatarioCon());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Conversa iniciada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível iniciar a conversa !');</script>";
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
            $statement = $pdo->prepare("UPDATE conversa SET dataConversa = :dataConversa, idRemetenteCon = :idRemetenteCon, 
            idDestinatarioCon = :idDestinatarioCon WHERE idConversa = :id");

            $statement->bindValue(":dataConversa",$obj->getDataConversa());
            $statement->bindValue(":idRemetenteCon",$obj->getIdRemetenteCon());
            $statement->bindValue(":idDestinatarioCon",$obj->getIdDestinatarioCon());
            $statement->bindValue(":id",$obj->getIdConversa());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Conversa alterada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível alterar a conversa !');</script>";
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
            $statement = $pdo->prepare("DELETE FROM conversa WHERE idConversa = :id");
            $statement->bindValue(":id",$obj->getIdConversa());
            if($statement->execute()) {
                return "<script>alert('Conversa apagada com sucesso !');</script>";
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
            $statement = $pdo->prepare("SELECT * FROM conversa WHERE idConversa= :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Conversa('','','','');

                if($rs != null) {
                    $obj->setIdConversa($rs->idConversa);
                    $obj->setDataConversa($rs->dataConversa);
                    $obj->setIdRemetenteCon($rs->idRemetenteCon);
                    $obj->setIdDestinatarioCon($rs->idDestinatario);
                }

                return $obj;
            }
            else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar com o banco de dados: ". $erro->getMessage();
        }
    }

    public function buscarTodos()
    {
        global $pdo;
        try{
            $statement= $pdo->prepare("SELECT * FROM conversa ");
            if($statement->execute()){
                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                return $result;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar com o banco de dados: ". $erro->getMessage();
        }
    }
}
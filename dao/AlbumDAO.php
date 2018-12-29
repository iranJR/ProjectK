<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 15:42
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Album.php");

class AlbumDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO album (nomeAlbum, dataAlbum, idUsuario) VALUES(:nomeAlbum , :dataAlbum , :idUsuario)");

            $statement->bindValue(":nomeAlbum",$obj->getNomeAlbum());
            $statement->bindValue(":dataAlbum",$obj->getDataAlbum());
            $statement->bindValue(":idUsuario",$obj->getIdUsuario());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Álbum cadastrado com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível cadastrar o álbum !');</script>";
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
            $statement = $pdo->prepare("UPDATE album SET nomeAlbum = :nomeAlbum, dataAlbum = :dataAlbum, idUsuario = :idUsuario
            WHERE idAlbum = :id");

            $statement->bindValue(":nomeAlbum",$obj->getNomeAlbum());
            $statement->bindValue(":dataAlbum",$obj->getDataAlbum());
            $statement->bindValue(":idUsuario",$obj->getIdUsuario());
            $statement->bindValue(":id",$obj->getIdAlbum());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Álbum alterado com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível alterar o álbum');</script>";
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
            $statement = $pdo->prepare("DELETE FROM album WHERE idAlbum = :id");
            $statement->bindValue(":id",$obj->getIdAlbum());
            if($statement->execute()) {
                return "<script>alert('Álbum apagado com sucesso !');</script>";
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
            $statement = $pdo->prepare("SELECT * FROM album WHERE idAlbum = :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Album('','','','');

                $obj->setIdAlbum($rs->idAlbum);
                $obj->setNomeAlbum($rs->nomeAlbum);
                $obj->setDataAlbum($rs->dataAlbum);
                $obj->setIdUsuario($rs->idUsuario);

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
            $statement= $pdo->prepare("SELECT * FROM album ");
            if($statement->execute()){
                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                return $result;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar com o banco de dados: ". $erro->getMessage();
        }
    }
}
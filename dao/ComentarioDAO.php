<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 20/02/2019
 * Time: 15:59
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Comentario.php");


class ComentarioDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO comentario (idPost, idUsuario, textoComentario, dataComentario) VALUES
           (:idPost, :idUsuario, :textoComentario, :dataComentario)");

            $statement->bindValue(":idPost",$obj->getIdPost());
            $statement->bindValue(":idUsuario",$obj->getIdUsuario());
            $statement->bindValue(":textoComentario",$obj->getTextoComentario());
            $statement->bindValue(":dataComentario",$obj->getDataComentario());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Comentário realizado com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível realizar o comentário !');</script>";
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
            $statement = $pdo->prepare("UPDATE comentario SET idPost = :idPost, idUsuario = :idUsuario , textoComentario = :textoComentario, 
           dataComentario = :dataComentario WHERE idComentario = :id");

            $statement->bindValue(":idPost",$obj->getIdPost());
            $statement->bindValue(":idUsuario",$obj->getIdUsuario());
            $statement->bindValue(":textoComentario",$obj->getTextoComentario());
            $statement->bindValue(":dataComentario",$obj->getDataComentario());
            $statement->bindValue(":id",$obj->getIdComentario());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Comentário alterado com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível alterar o comentário !');</script>";
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
            $statement = $pdo->prepare("DELETE FROM comentario WHERE idComentario = :id");
            $statement->bindValue(":id",$obj->getIdComentario());
            if($statement->execute()) {
                return "<script>alert('Comentário apagado com sucesso !');</script>";
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
            $statement = $pdo->prepare("SELECT * FROM comentario WHERE idComentario = :id ");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Comentario('','','','','');

                if($rs != null) {
                    $obj->setIdComentario($rs->idComentario);
                    $obj->setIdPost($rs->idPost);
                    $obj->setIdUsuario($rs->idUsuario);
                    $obj->setTextoComentario($rs->textoComentario);
                    $obj->setDataComentario($rs->dataComentario);
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
            $statement= $pdo->prepare("SELECT * FROM comentario ");
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
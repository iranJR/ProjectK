<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 15:58
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Post.php");

class PostDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO post (idUsuario, textoPost, dataPost, horaPost, tipoPost) VALUES
           (:idUsuario, :textoPost, :dataPost, :horaPost, :tipoPost)");

            $statement->bindValue(":idUsuario",$obj->getIdUsuario());
            $statement->bindValue(":textoPost",$obj->getSenha());
            $statement->bindValue(":dataPost",$obj->getEmail());
            $statement->bindValue(":horaPost",$obj->getCpf());
            $statement->bindValue(":tipoPost",$obj->getDataNascimento());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Post realizado com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível realizar o post !');</script>";
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
            $statement = $pdo->prepare("UPDATE post SET idUsuario= :idUsuario, textoPost= :textoPost, 
           dataPost= :dataPost,horaPost= :horaPost, tipoPost= :tipoPost WHERE idPost= :id");

            $statement->bindValue(":idUsuario",$obj->getIdUsuario());
            $statement->bindValue(":textoPost",$obj->getSenha());
            $statement->bindValue(":dataPost",$obj->getEmail());
            $statement->bindValue(":horaPost",$obj->getCpf());
            $statement->bindValue(":tipoPost",$obj->getDataNascimento());
            $statement->bindValue(":id",$obj->getIdPost());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Post alterado com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível alterar o post !');</script>";
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
            $statement = $pdo->prepare("DELETE FROM post WHERE idPost = :id");
            $statement->bindValue(":id",$obj->getIdPost());
            if($statement->execute()) {
                return "<script>alert('Post apagado com sucesso !');</script>";
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
            $statement = $pdo->prepare("SELECT * FROM post WHERE idPost= :id ");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Post('','','','','','');

                if($rs != null) {
                    $obj->setIdPost($rs->idPost);
                    $obj->setIdUsuario($rs->idUsuario);
                    $obj->setTextoPost($rs->textoPost);
                    $obj->setDataPost($rs->dataPost);
                    $obj->setHoraPost($rs->horaPost);
                    $obj->setTipoPost($rs->cpf);
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
            $statement= $pdo->prepare("SELECT * FROM post ");
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
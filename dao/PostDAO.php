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
            $statement = $pdo->prepare("INSERT INTO post (idRemetente, idDestinatario, textoPost, dataPost, tipoPost, linkPost) VALUES
           (:idRemetente, :idDestinatario, :textoPost, :dataPost, :tipoPost, :linkPost)");

            $statement->bindValue(":idRemetente",$obj->getIdRemetente());
            $statement->bindValue(":idDestinatario",$obj->getIdDestinatario());
            $statement->bindValue(":textoPost",$obj->getTextoPost());
            $statement->bindValue(":dataPost",$obj->getDataPost());
            $statement->bindValue(":tipoPost",$obj->getTipoPost());
            $statement->bindValue(":linkPost",$obj->getLinkPost());


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
            $statement = $pdo->prepare("UPDATE post SET idRemetente = :idRemetente, idDestinatario = :idDestinatario , textoPost = :textoPost, 
           dataPost = :dataPost, tipoPost = :tipoPost, linkPost = :linkPost WHERE idPost = :id");

            $statement->bindValue(":idRemetente",$obj->getIdRemetente());
            $statement->bindValue(":idDestinatario",$obj->getIdDestinatario());
            $statement->bindValue(":textoPost",$obj->getTextoPost());
            $statement->bindValue(":dataPost",$obj->getDataPost());
            $statement->bindValue(":tipoPost",$obj->getTipoPost());
            $statement->bindValue(":linkPost",$obj->getLinkPost());
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
            $statement = $pdo->prepare("SELECT * FROM post WHERE idPost = :id ");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Post('','','','','','','');

                if($rs != null) {
                    $obj->setIdPost($rs->idPost);
                    $obj->setIdRemetente($rs->idRemetente);
                    $obj->setIdDestinatario($rs->idDestinatario);
                    $obj->setTextoPost($rs->textoPost);
                    $obj->setDataPost($rs->dataPost);
                    $obj->setTipoPost($rs->tipoPost);
                    $obj->setLinkPost($rs->linkPost);
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

    public function buscarTodasPostagensPerfil($idUsuario)
    {
        global $pdo;
        try{
            $statement= $pdo->prepare("SELECT * FROM post WHERE idDestinatario = :id AND idRemetente != idDestinatario ORDER BY dataPost desc");
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

    public function buscarMinhasPostagens($idUsuario)
    {
        global $pdo;
        try{
            $statement= $pdo->prepare("SELECT * FROM post WHERE idRemetente = :id AND idRemetente = idDestinatario OR idDestinatario = :id ORDER BY dataPost desc");
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

    public function buscarPostagensPaginaInicial($idUsuario){

        global $pdo;
        try{
            $statement= $pdo->prepare("select * from post as p join amigo a on (a.idSolicitante = p.idRemetente or a.idSolicitado = p.idRemetente) and (a.dataConfirmacao is not null) and (a.idSolicitante = :id or a.idSolicitado = :id) and (p.idRemetente = p.idDestinatario) group by p.idPost ORDER BY p.dataPost desc ");
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
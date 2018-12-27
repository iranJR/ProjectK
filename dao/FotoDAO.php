<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 15:59
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Foto.php");

class FotoDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO foto (idAlbum, legendaFoto, nomeFoto, dataFoto) VALUES 
            (:idAlbum, :legendaFoto, :nomeFoto, :dataFoto)");

            $statement->bindValue(":idAlbum",$obj->getIdAlbum());
            $statement->bindValue(":legendaFoto",$obj->getLegendadoFoto());
            $statement->bindValue(":nomeFoto",$obj->getNomeFoto());
            $statement->bindValue(":dataFoto",$obj->getDataFoto());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Foto postada com sucesso');</script>";
                }
                else{
                    return"<script>alert('Erro ao tentar salvar a foto');</script>";
                }
            }
            else{
                throw new PDOException("<script>alert('Erro ao tentar executar o codigo sql');</script>");
            }
        }
        catch (PDOException $erro){
            return "Erro ao conectar ao banco ".$erro->getMessage();
        }
    }

    public function alterar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("UPDATE foto SET idAlbum = :idAlbum, legendaFoto = :legendaFoto, 
            nomeFoto = :nomeFoto, dataFoto = :dataFoto WHERE idFoto = :id");

            $statement->bindValue(":idAlbum",$obj->getIdAlbum());
            $statement->bindValue(":legendaFoto",$obj->getLegendadoFoto());
            $statement->bindValue(":nomeFoto",$obj->getNomeFoto());
            $statement->bindValue(":dataFoto",$obj->getDataFoto());
            $statement->bindValue(":id",$obj->getIdFoto());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Foto alterada com sucesso');</script>";
                }
                else{
                    return"<script>alert('Erro ao tentar alterar a foto');</script>";
                }
            }
            else{
                throw new PDOException("<script>alert('Erro ao tentar executar o codigo sql');</script>");
            }
        }
        catch (PDOException $erro){
            return "Erro ao conectar ao banco ".$erro->getMessage();
        }
    }

    public function apagar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("DELETE FROM foto WHERE idFoto = :id");
            $statement->bindValue(":id",$obj->getIdFoto());
            if($statement->execute()) {
                return "<script>alert('Foto excluida com sucesso');</script>";
            }
            else{
                throw new PDOException("<script>alert('Erro ao tentar executar o codigo sql');</script>");
            }
        }
        catch (PDOException $erro){
            return "Erro ao conectar ao banco ".$erro->getMessage();
        }
    }

    public function buscarPeloId($id)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM foto WHERE idFoto= :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Foto('','','','', '');

                $obj->setIdFoto($rs->idFoto);
                $obj->setIdAlbum($rs->idAlbum);
                $obj->setLegendaFoto($rs->legendaFoto);
                $obj->setNomeFoto($rs->nomeFoto);
                $obj->setDataFoto($rs->dataFoto);

                return $obj;
            }
            else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar ao banco ". $erro->getMessage();
        }
    }

    public function buscarTodos()
    {
        global $pdo;
        try{
            $statement= $pdo->prepare("SELECT * FROM foto ");
            if($statement->execute()){
                $result = $statement->fetchAll(PDO::FETCH_OBJ);
                return $result;
            } else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar ao banco ". $erro->getMessage();
        }
    }
}
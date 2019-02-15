<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 15:35
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Mensagem.php");

class MensagemDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO mensagem(idConversa, textoMsg, idDestinatarioMsg,
            idRemetenteMsg, dataMsg, horaMsg ) VALUES(:idConversa, :textoMsg, :idDestinatarioMsg,
            :idRemetenteMsg, :dataMsg, :horaMsg)");

            $statement->bindValue(":idConversa",$obj->getIdConversa());
            $statement->bindValue(":textoMsg",$obj->getTextoMsg());
            $statement->bindValue(":idDestinatarioMsg",$obj->getIdDestinatarioMsg());
            $statement->bindValue(":idRemetenteMsg",$obj->getIdRemetenteMsg());
            $statement->bindValue(":dataMsg",$obj->getDataMsg());
            $statement->bindValue("::horaMsg",$obj->getHoraMsg());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Mensagem enviada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível enviar a mensagem !');</script>";
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
            $statement = $pdo->prepare("UPDATE mensagem SET idConversa = :idConversa, textoMsg = :textoMsg, 
            idDestinatarioMsg = :idDestinatarioMsg, idRemetenteMsg = :idRemetenteMsg,  dataMsg = :dataMsg, horaMsg = :horaMsg 
            WHERE idMensagem = :id");

            $statement->bindValue(":idConversa",$obj->getIdConversa());
            $statement->bindValue(":textoMsg",$obj->getTextoMsg());
            $statement->bindValue(":idDestinatarioMsg",$obj->getIdDestinatarioMsg());
            $statement->bindValue(":idRemetenteMsg",$obj->getIdRemetenteMsg());
            $statement->bindValue(":dataMsg",$obj->getDataMsg());
            $statement->bindValue("::horaMsg",$obj->getHoraMsg());
            $statement->bindValue(":id",$obj->getIdMensagem());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Mensagem alterada com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível alterar a mensagem !');</script>";
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
            $statement = $pdo->prepare("DELETE FROM mensagem WHERE idMensagem = :id");
            $statement->bindValue(":id",$obj->getIdMensagem());
            if($statement->execute()) {
                return "<script>alert('Mensagem apagada com sucesso !');</script>";
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
            $statement = $pdo->prepare("SELECT * FROM mensagem WHERE idMensagem= :id ");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Mensagem('','','','','','','');

                if($rs != null) {
                    $obj->setIdMensagem($rs->idMensagem);
                    $obj->setIdConversa($rs->idConversa);
                    $obj->setTextoMsg($rs->textoMsg);
                    $obj->setIdDestinatarioMsg($rs->idDestinatarioMsg);
                    $obj->setIdRemetenteMsg($rs->idRemetenteMsg);
                    $obj->setDataMsg($rs->dataMsg);
                    $obj->setHoraMsg($rs->horaMsg);
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
            $statement= $pdo->prepare("SELECT * FROM mensagem ");
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
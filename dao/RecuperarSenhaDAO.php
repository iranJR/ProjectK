<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 31/01/2019
 * Time: 14:21
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/RecuperarSenha.php");

class RecuperarSenhaDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO recuperarsenha (codigoRecuperacao, dataExpiracao, emailRecuperacao, cpfRecuperacao) VALUES(:codigoRecuperacao , :dataExpiracao , :emailRecuperacao, :cpfRecuperacao)");

            $statement->bindValue(":codigoRecuperacao",$obj->getCodigoRecuperacao());
            $statement->bindValue(":dataExpiracao",$obj->getDataExpiracao());
            $statement->bindValue(":emailRecuperacao",$obj->getEmailRecuperacao());
            $statement->bindValue(":cpfRecuperacao",$obj->getCpfRecuperacao());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    $obj->setIdRecuperarSenha($pdo->lastInsertId());
                    return"<script>alert('Código de recuperação cadastrado com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível cadastrar o código de recuperação !');</script>";
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
            $statement = $pdo->prepare("UPDATE recuperarsenha SET codigoRecuperacao = :codigoRecuperacao, dataExpiracao = :dataExpiracao, 
emailRecuperacao = :emailRecuperacao, cpfRecuperacao = :cpfRecuperacao WHERE idRecuperarSenha = :id");

            $statement->bindValue(":codigoRecuperacao",$obj->getCodigoRecuperacao());
            $statement->bindValue(":dataExpiracao",$obj->getDataExpiracao());
            $statement->bindValue(":emailRecuperacao",$obj->getEmailRecuperacao());
            $statement->bindValue(":cpfRecuperacao",$obj->getCpfRecuperacao());
            $statement->bindValue(":id",$obj->getIdRecuperarSenha());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Código de recuperação alterado com sucesso !');</script>";
                }
                else{
                    return"<script>alert('Não foi possível alterar o código de recuperação');</script>";
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
            $statement = $pdo->prepare("DELETE FROM recuperarsenha WHERE idRecuperarSenha = :id");
            $statement->bindValue(":id",$obj->getIdRecuperarSenha());
            if($statement->execute()) {
                return "<script>alert('Código de recuperação apagado com sucesso !');</script>";
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
            $statement = $pdo->prepare("SELECT * FROM recuperarsenha WHERE idRecuperarSenha = :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new RecuperarSenha('','','','','');

                $obj->setIdRecuperarSenha($rs->idRecuperarSenha);
                $obj->setCodigoRecuperacao($rs->codigoRecuperacao);
                $obj->setDataExpiracao($rs->dataExpiracao);
                $obj->setEmailRecuperacao($rs->emailRecuperacao);
                $obj->setCpfRecuperacao($rs->cpfRecuperacao);

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
            $statement= $pdo->prepare("SELECT * FROM recuperarsenha ");
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

    public function buscarPeloCodigoRecuperacao($codigo)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM recuperarsenha WHERE codigoRecuperacao = :codigo");
            $statement->bindValue(":codigo",$codigo);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new RecuperarSenha('','','','','');

                $obj->setIdRecuperarSenha($rs->idRecuperarSenha);
                $obj->setCodigoRecuperacao($rs->codigoRecuperacao);
                $obj->setDataExpiracao($rs->dataExpiracao);
                $obj->setEmailRecuperacao($rs->emailRecuperacao);
                $obj->setCpfRecuperacao($rs->cpfRecuperacao);

                return $obj;
            }
            else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar com o banco de dados: ". $erro->getMessage();
        }
    }

    public function buscarTodosPeloLoginCPF($emailRecuperacao, $cpfRecuperacao)
    {
        global $pdo;
        try{
            $statement= $pdo->prepare("SELECT * FROM recuperarsenha WHERE emailRecuperacao = :emailRecuperacao AND cpfRecuperacao = :cpfRecuperacao AND dataExpiracao > :dataControle");

            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');

            $dataControle = date("Y-m-d H:i:s", strtotime("- 1 day"));

            $statement->bindValue(":emailRecuperacao",$emailRecuperacao);
            $statement->bindValue(":cpfRecuperacao",$cpfRecuperacao);
            $statement->bindValue(":dataControle",$dataControle);

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
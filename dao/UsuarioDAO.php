<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 15:26
 */

require_once ("../banco/conexao_bd.php");
require_once ("../dao/GenericsDAO.php");
require_once ("../model/Usuario.php");

class UsuarioDAO implements GenericsDAO
{

    public function salvar($obj)
    {
        global $pdo;
        try{
            $statement = $pdo->prepare("INSERT INTO usuario(nome, sobrenome, senha, email, cpf, dataNascimento,
 sexo, cidade, estado, fotoPerfil, dataCadastro) VALUES(:nome, :sobrenome, :senha, :email, :cpf, :dataNascimento, :sexo, :cidade, :estado, :fotoPerfil, :dataCadastro)");

            //$statement->bindValue(":idUsuario",$obj->getIdUsuario());
            $statement->bindValue(":nome",$obj->getNome());
            $statement->bindValue(":sobrenome",$obj->getSobreNome());
            $statement->bindValue(":senha",$obj->getSenha());
            $statement->bindValue(":email",$obj->getEmail());
            $statement->bindValue(":cpf",$obj->getCpf());
            $statement->bindValue(":dataNascimento",$obj->getDataNascimento());
            $statement->bindValue(":sexo",$obj->getSexo());
            $statement->bindValue(":cidade",$obj->getCidade());
            $statement->bindValue(":estado",$obj->getEstado());
            $statement->bindValue(":fotoPerfil",$obj->getFotoPerfil());
            $statement->bindValue(":dataCadastro",$obj->getDataCadastro());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Usuario cadastro com sucesso');</script>";
                }
                else{
                    return"<script>alert('Erro ao tentar cadastrar o usuario');</script>";
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
            $statement = $pdo->prepare("UPDATE usuario SET nome = :nome, sobrenome = :sobrenome, senha = :senha, 
            email = :email, cpf = :cpf, dataNascimento = :dataNascimento, sexo = :sexo, cidade = :cidade, estado = :estado, 
            fotoPerfil = :fotoPerfil, dataCadastro = :dataCadastro WHERE idUsuario = :id");

            $statement->bindValue(":nome",$obj->getNome());
            $statement->bindValue(":sobrenome",$obj->getSobreNome());
            $statement->bindValue(":senha",$obj->getSenha());
            $statement->bindValue(":email",$obj->getEmail());
            $statement->bindValue(":cpf",$obj->getCpf());
            $statement->bindValue(":dataNascimento",$obj->getDataNascimento());
            $statement->bindValue(":sexo",$obj->getSexo());
            $statement->bindValue(":cidade",$obj->getCidade());
            $statement->bindValue(":estado",$obj->getEstado());
            $statement->bindValue(":fotoPerfil",$obj->getFotoPerfil());
            $statement->bindValue(":dataCadastro",$obj->getDataCadastro());
            $statement->bindValue(":id", $obj->getIdUsuario());

            if($statement->execute()){
                if($statement->rowCount()>0){
                    return"<script>alert('Usuario alterado com sucesso');</script>";
                }
                else{
                    return"<script>alert('Erro ao tentar alterar o usuario');</script>";
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
            $statement = $pdo->prepare("DELETE FROM usuario WHERE idUsuario = :id");
            $statement->bindValue(":id",$obj->getIdUsuario());
            if($statement->execute()) {
                return "<script>alert('Usuario excluido com sucesso');</script>";
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
            $statement = $pdo->prepare("SELECT * FROM usuario WHERE idUsuario= :id");
            $statement->bindValue(":id",$id);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Usuario('','','','','','',
                    '', '', '', '', '','');
                $obj->setIdUsuario($rs->idUsuario);
                $obj->setNome($rs->nome);
                $obj->setSobreNome($rs->sobrenome);
                $obj->setSenha($rs->senha);
                $obj->setEmail($rs->email);
                $obj->setCpf($rs->cpf);
                $obj->setDataNascimento($rs->dataNascimento);
                $obj->setSexo($rs->sexo);
                $obj->setCidade($rs->cidade);
                $obj->setEstado($rs->estado);
                $obj->setFotoPerfil($rs->fotoPerfil);
                $obj->setDataCadastro($rs->dataCadastro);

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
            $statement= $pdo->prepare("SELECT * FROM usuario ");
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

    public function buscarPeloLogin($email,$senha){
        global $pdo;
        try{
            $statement = $pdo->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha");
            $statement->bindValue(":email",$email);
            $statement->bindValue(":senha",$senha);
            if($statement->execute()){
                $rs= $statement->fetch(PDO::FETCH_OBJ);
                $obj = new Usuario('','','','','','',
                    '', '', '', '', '','');
                $obj->setIdUsuario($rs->idUsuario);
                $obj->setNome($rs->nome);
                $obj->setSobreNome($rs->sobrenome);
                $obj->setSenha($rs->senha);
                $obj->setEmail($rs->email);
                $obj->setCpf($rs->cpf);
                $obj->setDataNascimento($rs->dataNascimento);
                $obj->setSexo($rs->sexo);
                $obj->setCidade($rs->cidade);
                $obj->setEstado($rs->estado);
                $obj->setFotoPerfil($rs->fotoPerfil);
                $obj->setDataCadastro($rs->dataCadastro);
                return $obj;
            }
            else {
                throw new PDOException("<script> alert('Não foi possível executar o código SQL !'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro ao conectar ao banco ". $erro->getMessage();
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 14:37
 */

class Usuario
{
    private $idUsuario;
    private $nome;
    private $sobrenome;
    private $senha;
    private $email;
    private $cpf;
    private $dataNascimento;
    private $sexo;
    private $cidade;
    private $estado;
    private $fotoPerfil;
    private $dataCadastro;

    /**
     * Usuario constructor.
     * @param $idUsuario
     * @param $nome
     * @param $sobrenome
     * @param $senha
     * @param $email
     * @param $cpf
     * @param $dataNascimento
     * @param $sexo
     * @param $cidade
     * @param $estado
     * @param $fotoPerfil
     * @param $dataCadastro
     */
    public function __construct($idUsuario, $nome, $sobrenome, $senha, $email, $cpf, $dataNascimento, $sexo, $cidade, $estado, $fotoPerfil, $dataCadastro)
    {
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->senha = $senha;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->dataNascimento = $dataNascimento;
        $this->sexo = $sexo;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->fotoPerfil = $fotoPerfil;
        $this->dataCadastro = $dataCadastro;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * @param mixed $sobrenome
     */
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * @param mixed $dataNascimento
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param mixed $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getFotoPerfil()
    {
        return $this->fotoPerfil;
    }

    /**
     * @param mixed $fotoPerfil
     */
    public function setFotoPerfil($fotoPerfil)
    {
        $this->fotoPerfil = $fotoPerfil;
    }

    /**
     * @return mixed
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * @param mixed $dataCadastro
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }



}
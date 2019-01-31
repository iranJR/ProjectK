<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 31/01/2019
 * Time: 14:18
 */

class RecuperarSenha
{
    private $idRecuperarSenha;
    private $codigoRecuperacao;
    private $dataExpiracao;
    private $emailRecuperacao;
    private $cpfRecuperacao;

    /**
     * RecuperarSenha constructor.
     * @param $idRecuperarSenha
     * @param $codigoRecuperacao
     * @param $dataExpiracao
     * @param $emailRecuperacao
     * @param $cpfRecuperacao
     */
    public function __construct($idRecuperarSenha, $codigoRecuperacao, $dataExpiracao, $emailRecuperacao, $cpfRecuperacao)
    {
        $this->idRecuperarSenha = $idRecuperarSenha;
        $this->codigoRecuperacao = $codigoRecuperacao;
        $this->dataExpiracao = $dataExpiracao;
        $this->emailRecuperacao = $emailRecuperacao;
        $this->cpfRecuperacao = $cpfRecuperacao;
    }

    /**
     * @return mixed
     */
    public function getIdRecuperarSenha()
    {
        return $this->idRecuperarSenha;
    }

    /**
     * @param mixed $idRecuperarSenha
     */
    public function setIdRecuperarSenha($idRecuperarSenha)
    {
        $this->idRecuperarSenha = $idRecuperarSenha;
    }

    /**
     * @return mixed
     */
    public function getCodigoRecuperacao()
    {
        return $this->codigoRecuperacao;
    }

    /**
     * @param mixed $codigoRecuperacao
     */
    public function setCodigoRecuperacao($codigoRecuperacao)
    {
        $this->codigoRecuperacao = $codigoRecuperacao;
    }

    /**
     * @return mixed
     */
    public function getDataExpiracao()
    {
        return $this->dataExpiracao;
    }

    /**
     * @param mixed $dataExpiracao
     */
    public function setDataExpiracao($dataExpiracao)
    {
        $this->dataExpiracao = $dataExpiracao;
    }

    /**
     * @return mixed
     */
    public function getEmailRecuperacao()
    {
        return $this->emailRecuperacao;
    }

    /**
     * @param mixed $emailRecuperacao
     */
    public function setEmailRecuperacao($emailRecuperacao)
    {
        $this->emailRecuperacao = $emailRecuperacao;
    }

    /**
     * @return mixed
     */
    public function getCpfRecuperacao()
    {
        return $this->cpfRecuperacao;
    }

    /**
     * @param mixed $cpfRecuperacao
     */
    public function setCpfRecuperacao($cpfRecuperacao)
    {
        $this->cpfRecuperacao = $cpfRecuperacao;
    }


}
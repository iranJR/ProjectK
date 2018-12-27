<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 14:45
 */

class Amigo
{
    private $idSolicitacao;
    private $dataSolicitacao;
    private $idSolicitante;
    private $idSolicitado;
    private $dataConfirmacao;

    /**
     * Amigo constructor.
     * @param $idSolicitacao
     * @param $dataSolicitacao
     * @param $idSolicitante
     * @param $idSolicitado
     * @param $dataConfirmacao
     */
    public function __construct($idSolicitacao, $dataSolicitacao, $idSolicitante, $idSolicitado, $dataConfirmacao)
    {
        $this->idSolicitacao = $idSolicitacao;
        $this->dataSolicitacao = $dataSolicitacao;
        $this->idSolicitante = $idSolicitante;
        $this->idSolicitado = $idSolicitado;
        $this->dataConfirmacao = $dataConfirmacao;
    }

    /**
     * @return mixed
     */
    public function getIdSolicitacao()
    {
        return $this->idSolicitacao;
    }

    /**
     * @param mixed $idSolicitacao
     */
    public function setIdSolicitacao($idSolicitacao)
    {
        $this->idSolicitacao = $idSolicitacao;
    }

    /**
     * @return mixed
     */
    public function getDataSolicitacao()
    {
        return $this->dataSolicitacao;
    }

    /**
     * @param mixed $dataSolicitacao
     */
    public function setDataSolicitacao($dataSolicitacao)
    {
        $this->dataSolicitacao = $dataSolicitacao;
    }

    /**
     * @return mixed
     */
    public function getIdSolicitante()
    {
        return $this->idSolicitante;
    }

    /**
     * @param mixed $idSolicitante
     */
    public function setIdSolicitante($idSolicitante)
    {
        $this->idSolicitante = $idSolicitante;
    }

    /**
     * @return mixed
     */
    public function getIdSolicitado()
    {
        return $this->idSolicitado;
    }

    /**
     * @param mixed $idSolicitado
     */
    public function setIdSolicitado($idSolicitado)
    {
        $this->idSolicitado = $idSolicitado;
    }

    /**
     * @return mixed
     */
    public function getDataConfirmacao()
    {
        return $this->dataConfirmacao;
    }

    /**
     * @param mixed $dataConfirmacao
     */
    public function setDataConfirmacao($dataConfirmacao)
    {
        $this->dataConfirmacao = $dataConfirmacao;
    }


}
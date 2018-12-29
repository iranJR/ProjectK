<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 27/12/2018
 * Time: 20:19
 */

class Cidade
{
    private $idCidade;
    private $nomeCidade;
    private $idUf;

    /**
     * Cidade constructor.
     * @param $idCidade
     * @param $nomeCidade
     * @param $idUf
     */
    public function __construct($idCidade, $nomeCidade, $idUf)
    {
        $this->idCidade = $idCidade;
        $this->nomeCidade = $nomeCidade;
        $this->idUf = $idUf;
    }

    /**
     * @return mixed
     */
    public function getIdCidade()
    {
        return $this->idCidade;
    }

    /**
     * @param mixed $idCidade
     */
    public function setIdCidade($idCidade): void
    {
        $this->idCidade = $idCidade;
    }

    /**
     * @return mixed
     */
    public function getNomeCidade()
    {
        return $this->nomeCidade;
    }

    /**
     * @param mixed $nomeCidade
     */
    public function setNomeCidade($nomeCidade): void
    {
        $this->nomeCidade = $nomeCidade;
    }

    /**
     * @return mixed
     */
    public function getIdUf()
    {
        return $this->idUf;
    }

    /**
     * @param mixed $idUf
     */
    public function setIdUf($idUf): void
    {
        $this->idUf = $idUf;
    }
}
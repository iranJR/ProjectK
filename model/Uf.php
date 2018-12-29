<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 27/12/2018
 * Time: 20:18
 */

class Uf
{
    private $idUf;
    private $nomeUf;
    private $siglaUf;

    /**
     * Uf constructor.
     * @param $idUf
     * @param $nomeUf
     * @param $siglaUf
     */
    public function __construct($idUf, $nomeUf, $siglaUf)
    {
        $this->idUf = $idUf;
        $this->nomeUf = $nomeUf;
        $this->siglaUf = $siglaUf;
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

    /**
     * @return mixed
     */
    public function getNomeUf()
    {
        return $this->nomeUf;
    }

    /**
     * @param mixed $nomeUf
     */
    public function setNomeUf($nomeUf): void
    {
        $this->nomeUf = $nomeUf;
    }

    /**
     * @return mixed
     */
    public function getSiglaUf()
    {
        return $this->siglaUf;
    }

    /**
     * @param mixed $siglaUf
     */
    public function setSiglaUf($siglaUf): void
    {
        $this->siglaUf = $siglaUf;
    }

    /**
     * Uf constructor.
     * @param $idUf
     * @param $nome
     * @param $sigla
     */
}
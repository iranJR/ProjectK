<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 14:57
 */

class Foto
{
    private $idFoto;
    private $idAlbum;
    private $legendaFoto;
    private $nomeFoto;
    private $dataFoto;

    /**
     * Foto constructor.
     * @param $idFoto
     * @param $idAlbum
     * @param $legendaFoto
     * @param $nomeFoto
     * @param $dataFoto
     */
    public function __construct($idFoto, $idAlbum, $legendaFoto, $nomeFoto, $dataFoto)
    {
        $this->idFoto = $idFoto;
        $this->idAlbum = $idAlbum;
        $this->legendaFoto = $legendaFoto;
        $this->nomeFoto = $nomeFoto;
        $this->dataFoto = $dataFoto;
    }

    /**
     * @return mixed
     */
    public function getIdFoto()
    {
        return $this->idFoto;
    }

    /**
     * @param mixed $idFoto
     */
    public function setIdFoto($idFoto)
    {
        $this->idFoto = $idFoto;
    }

    /**
     * @return mixed
     */
    public function getIdAlbum()
    {
        return $this->idAlbum;
    }

    /**
     * @param mixed $idAlbum
     */
    public function setIdAlbum($idAlbum)
    {
        $this->idAlbum = $idAlbum;
    }

    /**
     * @return mixed
     */
    public function getLegendaFoto()
    {
        return $this->legendaFoto;
    }

    /**
     * @param mixed $legendaFoto
     */
    public function setLegendaFoto($legendaFoto)
    {
        $this->legendaFoto = $legendaFoto;
    }

    /**
     * @return mixed
     */
    public function getNomeFoto()
    {
        return $this->nomeFoto;
    }

    /**
     * @param mixed $nomeFoto
     */
    public function setNomeFoto($nomeFoto)
    {
        $this->nomeFoto = $nomeFoto;
    }

    /**
     * @return mixed
     */
    public function getDataFoto()
    {
        return $this->dataFoto;
    }

    /**
     * @param mixed $dataFoto
     */
    public function setDataFoto($dataFoto)
    {
        $this->dataFoto = $dataFoto;
    }


}
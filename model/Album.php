<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 14:55
 */

class Album
{
    private $idAlbum;
    private $nomeAlbum;
    private $dataAlbum;
    private $idUsuario;

    /**
     * Album constructor.
     * @param $idAlbum
     * @param $nomeAlbum
     * @param $dataAlbum
     * @param $idUsuario
     */
    public function __construct($idAlbum, $nomeAlbum, $dataAlbum, $idUsuario)
    {
        $this->idAlbum = $idAlbum;
        $this->nomeAlbum = $nomeAlbum;
        $this->dataAlbum = $dataAlbum;
        $this->idUsuario = $idUsuario;
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
    public function getNomeAlbum()
    {
        return $this->nomeAlbum;
    }

    /**
     * @param mixed $nomeAlbum
     */
    public function setNomeAlbum($nomeAlbum)
    {
        $this->nomeAlbum = $nomeAlbum;
    }

    /**
     * @return mixed
     */
    public function getDataAlbum()
    {
        return $this->dataAlbum;
    }

    /**
     * @param mixed $dataAlbum
     */
    public function setDataAlbum($dataAlbum)
    {
        $this->dataAlbum = $dataAlbum;
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


}
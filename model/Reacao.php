<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 20/02/2019
 * Time: 15:48
 */

class Reacao
{
    private $idReacao;
    private $idPost;
    private $idUsuario;
    private $tipoReacao;

    /**
     * Reacao constructor.
     * @param $idReacao
     * @param $idPost
     * @param $idUsuario
     * @param $tipoReacao
     */
    public function __construct($idReacao, $idPost, $idUsuario, $tipoReacao)
    {
        $this->idReacao = $idReacao;
        $this->idPost = $idPost;
        $this->idUsuario = $idUsuario;
        $this->tipoReacao = $tipoReacao;
    }

    /**
     * @return mixed
     */
    public function getIdReacao()
    {
        return $this->idReacao;
    }

    /**
     * @param mixed $idReacao
     */
    public function setIdReacao($idReacao): void
    {
        $this->idReacao = $idReacao;
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * @param mixed $idPost
     */
    public function setIdPost($idPost): void
    {
        $this->idPost = $idPost;
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
    public function setIdUsuario($idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getTipoReacao()
    {
        return $this->tipoReacao;
    }

    /**
     * @param mixed $tipoReacao
     */
    public function setTipoReacao($tipoReacao): void
    {
        $this->tipoReacao = $tipoReacao;
    }


}
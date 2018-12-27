<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 14:53
 */

class Post
{
    private $idPost;
    private $idUsuario;
    private $textoPost;
    private $dataPost;
    private $horaPost;
    private $tipoPost;

    /**
     * Post constructor.
     * @param $idPost
     * @param $idUsuario
     * @param $textoPost
     * @param $dataPost
     * @param $horaPost
     * @param $tipoPost
     */
    public function __construct($idPost, $idUsuario, $textoPost, $dataPost, $horaPost, $tipoPost)
    {
        $this->idPost = $idPost;
        $this->idUsuario = $idUsuario;
        $this->textoPost = $textoPost;
        $this->dataPost = $dataPost;
        $this->horaPost = $horaPost;
        $this->tipoPost = $tipoPost;
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
    public function setIdPost($idPost)
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
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return mixed
     */
    public function getTextoPost()
    {
        return $this->textoPost;
    }

    /**
     * @param mixed $textoPost
     */
    public function setTextoPost($textoPost)
    {
        $this->textoPost = $textoPost;
    }

    /**
     * @return mixed
     */
    public function getDataPost()
    {
        return $this->dataPost;
    }

    /**
     * @param mixed $dataPost
     */
    public function setDataPost($dataPost)
    {
        $this->dataPost = $dataPost;
    }

    /**
     * @return mixed
     */
    public function getHoraPost()
    {
        return $this->horaPost;
    }

    /**
     * @param mixed $horaPost
     */
    public function setHoraPost($horaPost)
    {
        $this->horaPost = $horaPost;
    }

    /**
     * @return mixed
     */
    public function getTipoPost()
    {
        return $this->tipoPost;
    }

    /**
     * @param mixed $tipoPost
     */
    public function setTipoPost($tipoPost)
    {
        $this->tipoPost = $tipoPost;
    }


}
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
    private $idRemetente;
    private $idDestinatario;
    private $textoPost;
    private $dataPost;
    private $tipoPost;
    private $linkPost;

    /**
     * Post constructor.
     * @param $idPost
     * @param $idRemetente
     * @param $idDestinatario
     * @param $textoPost
     * @param $dataPost
     * @param $tipoPost
     * @param $linkPost
     */
    public function __construct($idPost, $idRemetente, $idDestinatario, $textoPost, $dataPost, $tipoPost, $linkPost)
    {
        $this->idPost = $idPost;
        $this->idRemetente = $idRemetente;
        $this->idDestinatario = $idDestinatario;
        $this->textoPost = $textoPost;
        $this->dataPost = $dataPost;
        $this->tipoPost = $tipoPost;
        $this->linkPost = $linkPost;
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
    public function getIdRemetente()
    {
        return $this->idRemetente;
    }

    /**
     * @param mixed $idRemetente
     */
    public function setIdRemetente($idRemetente): void
    {
        $this->idRemetente = $idRemetente;
    }

    /**
     * @return mixed
     */
    public function getIdDestinatario()
    {
        return $this->idDestinatario;
    }

    /**
     * @param mixed $idDestinatario
     */
    public function setIdDestinatario($idDestinatario): void
    {
        $this->idDestinatario = $idDestinatario;
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
    public function setTextoPost($textoPost): void
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
    public function setDataPost($dataPost): void
    {
        $this->dataPost = $dataPost;
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
    public function setTipoPost($tipoPost): void
    {
        $this->tipoPost = $tipoPost;
    }

    /**
     * @return mixed
     */
    public function getLinkPost()
    {
        return $this->linkPost;
    }

    /**
     * @param mixed $linkPost
     */
    public function setLinkPost($linkPost): void
    {
        $this->linkPost = $linkPost;
    }



}
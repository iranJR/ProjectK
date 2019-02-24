<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 20/02/2019
 * Time: 15:45
 */

class Comentario
{
    private $idComentario;
    private $idPost;
    private $idUsuario;
    private $textoComentario;
    private $dataComentario;

    /**
     * Comentario constructor.
     * @param $idComentario
     * @param $idPost
     * @param $idUsuario
     * @param $textoComentario
     * @param $dataComentario
     */
    public function __construct($idComentario, $idPost, $idUsuario, $textoComentario, $dataComentario)
    {
        $this->idComentario = $idComentario;
        $this->idPost = $idPost;
        $this->idUsuario = $idUsuario;
        $this->textoComentario = $textoComentario;
        $this->dataComentario = $dataComentario;
    }

    /**
     * @return mixed
     */
    public function getIdComentario()
    {
        return $this->idComentario;
    }

    /**
     * @param mixed $idComentario
     */
    public function setIdComentario($idComentario): void
    {
        $this->idComentario = $idComentario;
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
    public function getTextoComentario()
    {
        return $this->textoComentario;
    }

    /**
     * @param mixed $textoComentario
     */
    public function setTextoComentario($textoComentario): void
    {
        $this->textoComentario = $textoComentario;
    }

    /**
     * @return mixed
     */
    public function getDataComentario()
    {
        return $this->dataComentario;
    }

    /**
     * @param mixed $dataComentario
     */
    public function setDataComentario($dataComentario): void
    {
        $this->dataComentario = $dataComentario;
    }


}
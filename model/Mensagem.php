<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 14:44
 */

class Mensagem
{
    private $idMensagem;
    private $idConversa;
    private $textoMsg;
    private $idDestinatarioMsg;
    private $idRemetenteMsg;
    private $dataMsg;
    private $horaMsg;

    /**
     * Mensagem constructor.
     * @param $idMensagem
     * @param $idConversa
     * @param $textoMsg
     * @param $idDestinatarioMsg
     * @param $idRemetenteMsg
     * @param $dataMsg
     * @param $horaMsg
     */
    public function __construct($idMensagem, $idConversa, $textoMsg, $idDestinatarioMsg, $idRemetenteMsg, $dataMsg, $horaMsg)
    {
        $this->idMensagem = $idMensagem;
        $this->idConversa = $idConversa;
        $this->textoMsg = $textoMsg;
        $this->idDestinatarioMsg = $idDestinatarioMsg;
        $this->idRemetenteMsg = $idRemetenteMsg;
        $this->dataMsg = $dataMsg;
        $this->horaMsg = $horaMsg;
    }

    /**
     * @return mixed
     */
    public function getIdMensagem()
    {
        return $this->idMensagem;
    }

    /**
     * @param mixed $idMensagem
     */
    public function setIdMensagem($idMensagem)
    {
        $this->idMensagem = $idMensagem;
    }

    /**
     * @return mixed
     */
    public function getIdConversa()
    {
        return $this->idConversa;
    }

    /**
     * @param mixed $idConversa
     */
    public function setIdConversa($idConversa)
    {
        $this->idConversa = $idConversa;
    }

    /**
     * @return mixed
     */
    public function getTextoMsg()
    {
        return $this->textoMsg;
    }

    /**
     * @param mixed $textoMsg
     */
    public function setTextoMsg($textoMsg)
    {
        $this->textoMsg = $textoMsg;
    }

    /**
     * @return mixed
     */
    public function getIdDestinatarioMsg()
    {
        return $this->idDestinatarioMsg;
    }

    /**
     * @param mixed $idDestinatarioMsg
     */
    public function setIdDestinatarioMsg($idDestinatarioMsg)
    {
        $this->idDestinatarioMsg = $idDestinatarioMsg;
    }

    /**
     * @return mixed
     */
    public function getIdRemetenteMsg()
    {
        return $this->idRemetenteMsg;
    }

    /**
     * @param mixed $idRemetendeMsg
     */
    public function setIdRemetenteMsg($idRemetenteMsg)
    {
        $this->idRemetenteMsg = $idRemetenteMsg;
    }

    /**
     * @return mixed
     */
    public function getDataMsg()
    {
        return $this->dataMsg;
    }

    /**
     * @param mixed $dataMsg
     */
    public function setDataMsg($dataMsg)
    {
        $this->dataMsg = $dataMsg;
    }

    /**
     * @return mixed
     */
    public function getHoraMsg()
    {
        return $this->horaMsg;
    }

    /**
     * @param mixed $horaMsg
     */
    public function setHoraMsg($horaMsg)
    {
        $this->horaMsg = $horaMsg;
    }



}
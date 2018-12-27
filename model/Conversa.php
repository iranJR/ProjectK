<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 14:46
 */

class Conversa
{
    private $idConversa;
    private $dataConversa;
    private $idRemetenteCon;
    private $idDestinatarioCon;

    /**
     * Conversa constructor.
     * @param $idConversa
     * @param $dataConversa
     * @param $idRemetenteCon
     * @param $idDestinatarioCon
     */
    public function __construct($idConversa, $dataConversa, $idRemetenteCon, $idDestinatarioCon)
    {
        $this->idConversa = $idConversa;
        $this->dataConversa = $dataConversa;
        $this->idRemetenteCon = $idRemetenteCon;
        $this->idDestinatarioCon = $idDestinatarioCon;
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
    public function getDataConversa()
    {
        return $this->dataConversa;
    }

    /**
     * @param mixed $dataConversa
     */
    public function setDataConversa($dataConversa)
    {
        $this->dataConversa = $dataConversa;
    }

    /**
     * @return mixed
     */
    public function getIdRemetenteCon()
    {
        return $this->idRemetenteCon;
    }

    /**
     * @param mixed $idRemetenteCon
     */
    public function setIdRemetenteCon($idRemetenteCon)
    {
        $this->idRemetenteCon = $idRemetenteCon;
    }

    /**
     * @return mixed
     */
    public function getIdDestinatarioCon()
    {
        return $this->idDestinatarioCon;
    }

    /**
     * @param mixed $idDestinatarioCon
     */
    public function setIdDestinatarioCon($idDestinatarioCon)
    {
        $this->idDestinatarioCon = $idDestinatarioCon;
    }


}
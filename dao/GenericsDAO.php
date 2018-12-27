<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 22/12/2018
 * Time: 15:09
 */

interface GenericsDAO
{
    public function salvar($obj);
    public function alterar($obj);
    public function apagar($obj);
    public function buscarPeloId($id);
    public function buscarTodos();
}
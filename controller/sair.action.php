<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 08/01/2019
 * Time: 21:22
 */

unset($_SESSION['idUsuario']);
unset($_SESSION['nomeUsuario']);
unset($_SESSION['fotoPerfil']);

session_destroy();

header('Location: index.php');
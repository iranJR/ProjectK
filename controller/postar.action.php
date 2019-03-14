<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 27/02/2019
 * Time: 13:38
 */
require_once ("../dao/PostDAO.php");
require_once ("../model/Post.php");

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if($_GET['act'] == 'save') {

        $post = new Post('', '', '', '', '', '', '');
        $dao = new PostDAO();

        $post->setIdRemetente($_POST['idRemetente']);
        $post->setIdDestinatario($_POST['idDestinatario']);
        if ($_POST['tipoPost'] == 'texto') {
            $post->setTextoPost($_POST['textoPostagem']);
        }
        $post->setDataPost(date('Y-m-d H:i:s' ));
        $post->setTipoPost($_POST['tipoPost']);
        if ($_POST['tipoPost'] == 'imagem') {
            $post->setLinkPost($_POST['imagemPost']);
            $post->setTextoPost($_POST['textoPostagemImagem']);
        }
        if ($_POST['tipoPost'] == 'video') {
            $post->setLinkPost($_POST['linkVideo']);
            $post->setTextoPost($_POST['textoPostagemVideo']);
        }

        $dao->salvar($post);

        $msg = "Seus dados foram cadastrados com sucesso !";

        echo "<script>window.location.href='../view/perfilUsuario.view.php?userID=". base64_encode($_POST['idDestinatario']) ."&msg=" . $msg . "'</script>";

}


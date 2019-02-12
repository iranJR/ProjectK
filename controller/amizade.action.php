<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 07/02/2019
 * Time: 20:26
 */

require_once ("../model/Amigo.php");
require_once ("../dao/AmigoDAO.php");

if($_POST['act'] == 'add') {

    if(!empty($_POST['idUsuario']) && !empty($_POST['userID'])){

        $idUsuario = $userID = null;

        if (preg_match("/^(([0-9]+))$/", $_POST['idUsuario'])) {
            $idUsuario = $_POST['idUsuario'];
        }

        if (preg_match("/^(([0-9]+))$/", $_POST['userID'])) {
            $userID = $_POST['userID'];
        }

        if($idUsuario != null && $userID != null){

            $solicitacao = new Amigo('','','','','');
            $solicitacaoDAO = new AmigoDAO();
            $solicitacao = $solicitacaoDAO->buscarPorAmizade($_POST['idUsuario'], $_POST['userID']);

            if($solicitacao->getIdSolicitacao() == null){
                $solicitacao = new Amigo('','','','','');

                $solicitacao->setIdSolicitante($_POST['idUsuario']);
                $solicitacao->setIdSolicitado($_POST['userID']);
                $solicitacao->setDataSolicitacao(date("Y-m-d"));

                $solicitacaoDAO = new AmigoDAO();
                $solicitacaoDAO->salvar($solicitacao);

                if ($solicitacao->getIdSolicitacao() != '') {
                    $msg = "Solicitação de Amizade Enviada !";
                    echo "<script>window.location.href='../view/perfilUsuario.view.php?userID=".$_POST['userID']."&msg=".$msg."'</script>";
                }
                else {
                    $msg = "Não foi possível enviar sua solicitação !";
                    echo "<script>window.location.href='../view/perfilUsuario.view.php?userID=".$_POST['userID']."&msg=".$msg."'</script>";
                }
            }
            else {
                $msg = "Esta ação já foi executada !";
                echo "<script>window.location.href='../view/perfilUsuario.view.php?userID".$_POST['userID']."&msg=".$msg."'</script>";
            }
        }
        else{
            $msg = "Aviso: Navegação suspeita, para um navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/paginaInicial.view.php?msg=".$msg."'</script>";
        }
    }
    else {
        $msg = "Desculpe, ocorreu um erro !";
        echo "<script>window.location.href='../view/paginaInicial.view.php?msg=".$msg."'</script>";
    }
}

if($_POST['act'] == 'cancelar' || $_POST['act'] == 'desfazer' || $_POST['act'] == 'recusar') {

    if(!empty($_POST['idUsuario']) && !empty($_POST['userID'])){

        $idUsuario = $userID = null;

        if (preg_match("/^(([0-9]+))$/", $_POST['idUsuario'])) {
            $idUsuario = $_POST['idUsuario'];
        }

        if (preg_match("/^(([0-9]+))$/", $_POST['userID'])) {
            $userID = $_POST['userID'];
        }

        if($idUsuario != null && $userID != null){

            $solicitacao = new Amigo('','','','','');
            $solicitacaoDAO = new AmigoDAO();
            $solicitacao = $solicitacaoDAO->buscarPorAmizade($_POST['idUsuario'], $_POST['userID']);

            if($solicitacao->getIdSolicitacao() != null){

                $solicitacaoDAO->apagar($solicitacao);
                $solicitacao = $solicitacaoDAO->buscarPorAmizade($_POST['idUsuario'], $_POST['userID']);

                if($solicitacao->getIdSolicitacao() == null){
                    if($_POST['act'] == 'cancelar'){
                        $msg = "Solicitação cancelada !";
                    }
                    else if($_POST['act'] == 'recusar'){
                        $msg = "Solicitação recusada !";
                    }
                    else {
                        $msg = "Amizade desfeita !";
                    }
                    echo "<script>window.location.href='../view/perfilUsuario.view.php?userID=".$_POST['userID']."&msg=".$msg."'</script>";
                }
                else {
                    if($_POST['act'] == 'cancelar'){
                        $msg = "Não foi possível cancelar a solicitação !";
                    }
                    else if($_POST['act'] == 'recusar'){
                        $msg = "Solicitação recusada !";
                    }
                    else {
                        $msg = "Não foi possível desfazer a amizade !";
                    }
                    echo "<script>window.location.href='../view/perfilUsuario.view.php?userID=".$_POST['userID']."&msg=".$msg."'</script>";
                }

            }
            else {
                $msg = "Solicitação Não Encontrada !";
                echo "<script>window.location.href='../view/perfilUsuario.view.php?userID".$_POST['userID']."&msg=".$msg."'</script>";
            }
        }
        else{
            $msg = "Aviso: Navegação suspeita, para um navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/paginaInicial.view.php?msg=".$msg."'</script>";
        }
    }
    else {
        $msg = "Desculpe, ocorreu um erro !";
        echo "<script>window.location.href='../view/paginaInicial.view.php?msg=".$msg."'</script>";
    }
}

if($_POST['act'] == 'aceitar') {

    if(!empty($_POST['idUsuario']) && !empty($_POST['userID'])){

        $idUsuario = $userID = null;

        if (preg_match("/^(([0-9]+))$/", $_POST['idUsuario'])) {
            $idUsuario = $_POST['idUsuario'];
        }

        if (preg_match("/^(([0-9]+))$/", $_POST['userID'])) {
            $userID = $_POST['userID'];
        }

        if($idUsuario != null && $userID != null){

            $solicitacao = new Amigo('','','','','');
            $solicitacaoDAO = new AmigoDAO();
            $solicitacao = $solicitacaoDAO->buscarPorAmizade($_POST['idUsuario'], $_POST['userID']);

            if($solicitacao->getIdSolicitacao() != null && $solicitacao->getDataConfirmacao() == null){

                $solicitacao->setDataConfirmacao(date("Y-m-d"));
                $solicitacaoDAO->alterar($solicitacao);
                $solicitacao = $solicitacaoDAO->buscarPorAmizade($_POST['idUsuario'], $_POST['userID']);

                if($solicitacao->getIdSolicitacao() != null && $solicitacao->getDataConfirmacao() != null){

                    $msg = "Solicitação aceita, agora vocês são amigos !";
                    echo "<script>window.location.href='../view/perfilUsuario.view.php?userID=".$_POST['userID']."&msg=".$msg."'</script>";
                }
                else {

                    $msg = "Não foi possível aceitar a solicitação no momento !";
                    echo "<script>window.location.href='../view/perfilUsuario.view.php?userID=".$_POST['userID']."&msg=".$msg."'</script>";
                }

            }
            else {
                $msg = "Solicitação Não Encontrada !";
                echo "<script>window.location.href='../view/perfilUsuario.view.php?userID".$_POST['userID']."&msg=".$msg."'</script>";
            }
        }
        else{
            $msg = "Aviso: Navegação suspeita, para um navegação segura verifique se todos os plugins estão ativados !";
            echo "<script>window.location.href='../view/paginaInicial.view.php?msg=".$msg."'</script>";
        }
    }
    else {
        $msg = "Desculpe, ocorreu um erro !";
        echo "<script>window.location.href='../view/paginaInicial.view.php?msg=".$msg."'</script>";
    }
}
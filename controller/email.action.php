<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 08/01/2019
 * Time: 17:18
 */

$nome = $email = null;

if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['motivo'])
    && !empty($_POST['mensagem']) && !empty($_POST['pagina'])) {

        require_once("../email/email.functions.php");
        $retorno = enviarEmailFormularioContato($_POST['email'], $_POST['nome'], $_POST['motivo'], $_POST['mensagem']);

        if ($retorno == "E-mail enviado com sucesso!") {
            $msg = "Obrigado " . $_POST['nome'] . ", recebemos seu contato e em breve estaremos retornando.";
        } else {
            $msg = "Não foi possível enviar o seu contato, por favor verifique os dados informados.";
        }

        if ($_POST['pagina'] == "contato") {
            echo "<script>window.location.href='../view/contato.view.php?msg=$msg'</script>";
        } else {
            echo "<script>window.location.href='../view/contatoIndex.view.php?msg=$msg'</script>";
        }

} else {
    $msg = "Preencha todos os campos obrigatórios !";

    if($_POST['pagina'] == "contato"){
        echo "<script>window.location.href='../view/contato.view.php?msg=$msg'</script>";
    }
    else{
        echo "<script>window.location.href='../view/contatoIndex.view.php?msg=$msg'</script>";
    }
}


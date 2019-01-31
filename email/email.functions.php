<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 08/01/2019
 * Time: 15:45
 */

require_once ("../email/conexao_email.php");
require_once("../email/view/templateEmail.php");

function enviarEmailBoasVindas($emailDestinatario, $nomeDestinatario, $sobrenomeDestinatario){
    global $email;

    // Remetente: informar o e-mail e o nome do remetente.
    $email->setFrom(REMETENTE, NOMEREMETENTE);

    // Destinatário: informar o e-mail e o nome do destinatário.
    $email->addAddress($emailDestinatario, $nomeDestinatario." ".$sobrenomeDestinatario);

    // Assunto do E-mail.
    $email->Subject = 'Seja Bem Vindo ao ProjectK';

    // Mensagem, corpo do e-mail.

    // Adiciona uma imagem ao e-mail, no scr da tag <img> se usa o cid dado neste comando para chama-lá.
    $email->AddEmbeddedImage('../email/imagens/logoEmail.jpg', 'favicon');

    $html = emailBoasVindas($nomeDestinatario);
    // Adiciona um código html ao corpo do e-mail, mensagem.
    $email->msgHTML($html);

    //Função de realiza o envio do e-mail.
    $email->send();
}

function enviarEmailFormularioContato($emailDestinatario, $nomeDestinatario, $motivo, $mensagem){
    global $email;

    // Adiciona endereço de e-mail para resposta.
    $email->addReplyTo($emailDestinatario, $nomeDestinatario);

    // Remetente: informar o e-mail e o nome do remetente.
    $email->setFrom(REMETENTE, NOMEREMETENTE);

    // Destinatário: informar o e-mail e o nome do destinatário.
    $email->addAddress(REMETENTE, NOMEREMETENTE);

    // Envia cópia oculta do e-mail.
    $email->addBCC($emailDestinatario, $nomeDestinatario);

    // Assunto do E-mail.
    $email->Subject = 'Formulário de Contato - Motivo: '.$motivo;

    // Mensagem, corpo do e-mail.

    // Adiciona uma imagem ao e-mail, no scr da tag <img> se usa o cid dado neste comando para chama-lá.
    $email->AddEmbeddedImage('../email/imagens/logoEmail.jpg', 'favicon');

    $html = emailFormularioContato($nomeDestinatario, $mensagem);
    // Adiciona um código html ao corpo do e-mail, mensagem.
    $email->msgHTML($html);

    //Função de realiza o envio do e-mail.
    if (!$email->send()) {
        return "Erro ao enviar o E-mail: " . $email->ErrorInfo;
    } else {
        return "E-mail enviado com sucesso!";
    }
}

function enviarEmailCodigoRecuperacaoSenha($emailDestinatario, $nomeDestinatario, $codigoRecuperacao){
    global $email;

    // Remetente: informar o e-mail e o nome do remetente.
    $email->setFrom(REMETENTE, NOMEREMETENTE);

    // Destinatário: informar o e-mail e o nome do destinatário.
    $email->addAddress($emailDestinatario, $nomeDestinatario);

    // Assunto do E-mail.
    $email->Subject = 'ProjectK - Código para Recuperação de Senha';

    // Mensagem, corpo do e-mail.

    // Adiciona uma imagem ao e-mail, no scr da tag <img> se usa o cid dado neste comando para chama-lá.
    $email->AddEmbeddedImage('../email/imagens/logoEmail.jpg', 'favicon');

    $html = emailCodigoRecuperacaoSenha($nomeDestinatario, $codigoRecuperacao);
    // Adiciona um código html ao corpo do e-mail, mensagem.
    $email->msgHTML($html);

    //Função de realiza o envio do e-mail.
    if (!$email->send()) {
        return "Erro ao enviar o E-mail: " . $email->ErrorInfo;
    } else {
        return "E-mail enviado com sucesso!";
    }
}

function enviarEmailAlertaTrocaSenha($emailDestinatario, $nomeDestinatario){
    global $email;

    // Remetente: informar o e-mail e o nome do remetente.
    $email->setFrom(REMETENTE, NOMEREMETENTE);

    // Destinatário: informar o e-mail e o nome do destinatário.
    $email->addAddress($emailDestinatario, $nomeDestinatario);

    // Assunto do E-mail.
    $email->Subject = 'ProjectK - Alerta de Segurança';

    // Mensagem, corpo do e-mail.

    // Adiciona uma imagem ao e-mail, no scr da tag <img> se usa o cid dado neste comando para chama-lá.
    $email->AddEmbeddedImage('../email/imagens/logoEmail.jpg', 'favicon');

    $html = emailAlertaTrocaSenha($nomeDestinatario);
    // Adiciona um código html ao corpo do e-mail, mensagem.
    $email->msgHTML($html);

    //Função de realiza o envio do e-mail.
    $email->send();
}
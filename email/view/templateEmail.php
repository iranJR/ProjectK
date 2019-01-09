<?php
/**
 * Created by PhpStorm.
 * User: Iran Junior
 * Date: 08/01/2019
 * Time: 15:36
 */

function emailBoasVindas($nomeUsuario){
    // Código HTML que será incorpado ao corpo do e-mail. O CSS deve ser inline.
    $html = "<body style='margin: 0'>
<div style='width: 100%; background-color: #3A3A3A; padding: 1%'>
    <img src='cid:favicon' alt='favicon' style='width: 20%'>
</div>
<div style='margin-left: 2%'>
<br/>
<h1>Bem vindo ao ProjectK !</h1>
<hr style='height: 10px; background-color: crimson; border: none; width: 98%; margin-left: 0%'>
<br/>
<h3 style='font-weight: normal; white-space: pre-wrap'>Olá, ".$nomeUsuario." !
Parabéns o seu cadastro foi efetuado com sucesso.
Seja bem vindo ao nosso site, é um prazer ter você aqui conosco,
esperamos que aproveite ao máximo sua experiência com a gente.</h3>
    <h3 style='font-weight: normal'>Qualquer dúvida entre contato através do e-mail <b>contato.projectk@gmail.com</b>.</h3>
<br/>
<br/>
</div>
<div style='width: 100%; background-color: #E5E5E5; padding: 0.5%'>
    <div style='margin-left: 1%'>
    <p>ProjectK ® - 2018</p>
    <p>Desenvolvido por: Ciro Gustavo e Iran Junior</p>
    </div>
</div>
</body>";

    return $html;
}

function emailFormularioContato($nomeUsuario, $mensagemUsuario) {
    $html = "<body style='margin: 0'>
<div style='width: 100%; background-color: #3A3A3A; padding: 1%'>
    <img src='cid:favicon' alt='favicon' style='width: 20%'>
</div>
<div style='margin-left: 2%'>
<br/>
<h1>".$nomeUsuario.", obrigado pelo seu contato !</h1>
<hr style='height: 10px; background-color: crimson; border: none; width: 98%; margin-left: 0%'>
<br/>
<h3 style='font-weight: normal; white-space: pre-wrap'>".$nomeUsuario.", recebemos o seu contato e estaremos retornando
o mais breve possível.</h3>
<h3 style='font-weight: normal; white-space: pre-wrap'><b>Sua mensagem:</b> ".$mensagemUsuario." </h3>
<h3 style='font-weight: normal; white-space: pre-wrap'>Agradecemos desde já, o seu contato é muito importante para nós.

Atenciosamente,
Equipe ProjectK.</h3>
<br/>
<br/>
</div>
<div style='width: 100%; background-color: #E5E5E5; padding: 0.5%'>
    <div style='margin-left: 1%'>
    <p>ProjectK ® - 2018</p>
    <p>Desenvolvido por: Ciro Gustavo e Iran Junior</p>
    </div>
</div>
</body>";

    return $html;
}
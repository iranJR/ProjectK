<?php
/**
 * Created by PhpStorm.
 * User: ciro gustavo
 * Date: 20/12/2018
 * Time: 17:24
 */
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="imagens/favicon.png">
    <link rel="stylesheet" href="css/estiloIndex.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="javaScript/JSFadeInDiv.js"></script>
    <title>ProjectK</title>

</head>
<body>

<video autoplay muted loop id="videoIndex">
    <source src="videos/Video%20Login.mp4" type="video/mp4">
</video>

<div id="divIndex" class="col-sm-5">
    <h3>Seja bem vindo ao</h3>
    <h1>ProjectK</h1>
    <h3>Sua rede social esportiva</h3>
    <div class="row">
        <div class="form-group col-md-5">
            <a id="botaoIndex" type="submit" class="btn btn-info" href="view/login.view.php" >Entrar</a>
        </div>
        <div class="form-group col-md-5">
            <a id="botaoIndex" type="submit" class="btn btn-info" href="view/cadastroUsuario.view.php" >Cadastrar</a>
        </div>
    </div>
</div>

<div class="content">
    <div id="rodapeIndex" class="col-md-12 text-center container-fluid">
        <p>ProjectK ® - 2018</p>
        <p><a href='view/contatoIndex.view.php'>Entre em contato conosco.</a></p>
        <p id='pDevs'>Desenvolvido por: Ciro Gustavo e Iran Junior</p>
    </div>
</div>

</body>
</html>

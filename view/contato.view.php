<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 04/01/2019
 * Time: 19:13
 */

require_once ("../view/templatePaginaInicial.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../imagens/favicon.png">
    <link rel="stylesheet" href="../css/estiloPaginaInicial.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../javaScript/JSFuncaoContato.js"></script>
    <title>ProjectK - Contato</title>

</head>
<body>

<!--Cabeçalho do site-->
    <?php cabecalho(); ?>
<!--Fim do Cabeçalho do site -->

<!--Menu Horizontal de Ações -->
    <?php menuHorizontal(); ?>
<!-- Fim do Menu Horizontal de Ações -->

<!-- Inicio da Div Geral da Página -->
<div class='container-fluid text-center'>
    <div class='row content'>
        <!-- Pausa na Div Geral da Página -->

        <!-- Início do Menu Lateral do Usuário -->
        <?php menuLateralEsquerdoUsuario(); ?>
        <!-- Início do Menu Lateral do Usuário -->

        <!-- Início da Div Central da Página, Mural de Notícias -->
        <div id = 'divMural' class='col-sm-8 text-left' >
            <div id="divContato" class="col-sm-10">
                <form id="formLogin" method="post" action="../controller/email.action.php">
                    <h1><i class="glyphicon glyphicon-envelope"></i> Formulário de Contato</h1>
                    <h4>Preencha o formulário abaixo para entrar em contato conosco.</h4>
                    <hr>
                    <p>
                        <?php if (isset($_GET['msg'])) {
                            echo "<p id='mensagemContato'><span id='spanMensagemContato'>* </span>" . $_GET['msg'] . "<span id='spanMensagemContato'> *</span></p>";
                        } ?>
                    </p>

                    <div class="row">
                        <input type="hidden" name="pagina" value="contato"/>
                        <div class="form-group col-md-6">
                            <label class="labelForm" for="nome">Nome:</label>
                            <input type="text" name="nome" class="form-control" required placeholder="Digite aqui o seu nome...">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="labelForm" for="email">E-mail:</label>
                            <input type="email" name="email" class="form-control" required
                                   placeholder="Digite aqui o seu e-mail...">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-7">
                            <label class="labelForm" for="motivo">Motivo:</label>
                            <select class="form-control" name="motivo" required>
                                <option disabled selected value="">Selecione o motivo para seu contato...</option>
                                <option value="Elogio">Elogio</option>
                                <option value="Sugestão">Sugestão</option>
                                <option value="Reclamação">Reclamação</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-9">
                <textarea id="txtAreaMensagem" class="form-control" rows="5" name="mensagem" required
                          maxlength="350" placeholder="Digite aqui sua mensagem..." ></textarea>
                            <small id="contMensagem" class="form-text text-muted">350 caracteres restantes.</small>
                        </div>
                    </div>

                    <button id="botaoContato" type="submit" class="btn btn-info">Enviar</button>
                </form>
            </div>
        </div>
        <!-- Fim da Div Central da Página, Mural de Notícias -->

        <!-- Início do Menu Lateral Direito, Menu de Amigos -->
            <?php menuLateralDireitoAmigos(); ?>
        <!-- Fim do Menu Lateral Direito, Menu de Amigos -->

        <!-- Retorno da Pausa na Div Geral da Página -->
    </div>
</div>
<!-- Fim da Div Geral da Página -->

<!-- Inicio do Rodapé -->
    <?php rodape(); ?>
<!-- Fim do Rodapé -->

</body>
</html>
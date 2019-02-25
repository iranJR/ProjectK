<?php
/**
 * Created by PhpStorm.
 * User: iranf
 * Date: 01/02/2019
 * Time: 17:22
 */

require_once ("../model/RecuperarSenha.php");
require_once ("../dao/RecuperarSenhaDAO.php");

$codigo = null;

if(!empty($_GET['codigo'])){

    // verifica se o código de recuperação só recebe digitos e se possui 9 caracteres
    if (preg_match("/^(([0-9]{9}))$/", $_GET['codigo'])) {
        $codigo = $_GET['codigo'];
    }

    if($codigo != null){

        $recuperarSenha = new RecuperarSenha('','','','','');
        $recuperarDAO = new RecuperarSenhaDAO();

        $recuperarSenha = $recuperarDAO->buscarPeloCodigoRecuperacao($codigo);

        //Se o ID não for nulo, o código está correto.
        if($recuperarSenha->getIdRecuperarSenha() != null){

            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');

            //Verifica se o código não está expirado.
            if($recuperarSenha->getDataExpiracao() > date("Y-m-d H:i:s", strtotime("- 30 minutes"))){

                echo "<div id='divNovaSenha' class='col-sm-6'>
                        <form id='formLogin' method='post' action='../controller/recuperarSenha.action.php'>
                            <h1><i class='glyphicon glyphicon-lock'></i>Recuperação de Senha</h1>
                            <h4>Digite sua nova senha.</h4>
                            <hr>
                    
                            <div class='row'>
                                <div class='form-group col-md-6'>
                                    <input type='hidden' name='act' value='etapa2'>
                                    <input type='hidden' name='codigoRec' value='".$codigo."'>
                                    <label for='senha'>Nova Senha:</label>
                                    <input type='password' class='form-control' id='senha' name='senha'
                                           placeholder='Digite aqui sua senha...'
                                           required passwordCheck='passwordCheck' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'
                                           title='A sua senha deve ter pelo menos 8 caracteres e conter pelo menos: uma letra maiúscula, uma letra minúscula e um dígito. '>
                                    <small id='senhaHelp' class='form-text text-muted'><span id='spanSenhaHelp2'>*</span> Força da
                                        Senha : <span id='spanSenhaHelp'></span>
                                        <div id='barraForca' class='progress'>
                                            <div id='barra' class='progress-bar' role='progressbar'></div>
                                        </div>
                                    </small>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='confirmSenha'>Confirme sua senha:</label>
                                    <input type='password' class='form-control' id='confirmSenha' name='confirmSenha'
                                           placeholder='Digite sua senha novamente...' title='As senhas devem ser iguais'
                                           required>
                                    <small id='confirmSenhaHelp' class='form-text text-muted'><span id='spanSenhaHelp2'>*</span>
                                        <span id='spanConfirmSenha'>Atenção : </span> <span id='textSpanSenhaHelp'>As senhas devem ser iguais ! </span><span
                                            id='spanSenhaHelp2'>*</span></small>
                                </div>
                            </div>
                            <br/>
                            <button id='botaoProximo2' class='btn btn-primary nextBtn' title='Preencha todos os campos do formulário' type='submit' disabled>Confirmar <i
                                    class='glyphicon glyphicon-ok'></i></button>
                        </form>
                    </div>";

    echo "<script src='../javaScript/JSVerificaCodigoSenha.js'></script>
    <script src='../javaScript/JSValidationCadastro.js'></script>
    <script src='../javaScript/JSFuncoesSenha.js'></script>";
            }
            else {
                $msg = "Atenção: O código de recuperação expirou, solicite novamente o seu código !";
                echo "<script>window.location.href='../view/login.view.php?msg=".$msg."'</script>";
            }
        }
        else{
            $msg = "Atenção: O código de recuperação informado não é válido !";
            echo "<script>window.location.href='../view/recuperarSenhaIndex.view.php?msg=".$msg."'</script>";
        }

    }else {
        $msg = "Aviso: Navegação suspeita, para uma navegação segura verifique se todos os plugins estão ativados !";
        echo "<script>window.location.href='../view/recuperarSenhaIndex.view.php?msg=".$msg."'</script>";
    }
}
else{
    $msg = "Preencha todos os campos obrigatórios !";
    echo "<script>window.location.href='../view/recuperarSenhaIndex.view.php?msg=".$msg."'</script>";
}
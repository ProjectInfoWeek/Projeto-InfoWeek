<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    if(!(isset($_SESSION['logadoadmin'])))
    {
        if(!(isset($_SESSION['logamod'])))
            {
                header('Location: ../acessonegado.php');
            }
    } 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inserção de Pontos</title>
    </head>
    <body>
        <form method="post">
            Inserção de Pontos <br>
            Equipe: <select name="equipe">
                <?php
                include_once '../classes/conexao.class.php';
                include_once '../classes/equipe.class.php';
                $bd = new conexao;
                $equipe = new equipe;
                $equipe->listarEquipes();
                ?>
            </select>
            <br>Prova: <select name="prova">
                <?php
                include_once '../classes/prova.class.php';
                $prova = new prova();
                $prova->listarProvas();
                ?>
            </select><br>
            Pontuação: <input type="number" name="pontuacao" required><br>
            <input type="submit" value="Enviar">
            <br><a href="./paineldecontrole.php">Voltar para o painel do administrador</a>
        <?php
        include_once '../classes/pontos.class.php';
        include_once '../classes/conexao.class.php';
        if($_POST){
            $idEquipe =$_POST['equipe'];
            $idProva = $_POST['prova'];
            $pontuacao = $_POST['pontuacao'];            
            $pontos = new pontos();
            $pontos->setTudo($idEquipe, $idProva, $pontuacao);
            $pontos->salvar();
            $pontos->somarPontos();
        }        
        ?>
        </form>
    </body>
</html>

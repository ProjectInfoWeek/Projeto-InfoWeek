<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//
    session_start();
    if(!(isset($_SESSION['logadoadmin'])))
    {
        header('Location: ../acessonegado.php');
    } 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscrição de Equipes</title>
    </head>
    <body>
        <form method="post">
            Inscrição de Equipes <br>
            Tema: <input type="text" name="tema" required><br>
            <input type="submit" value="Enviar">
            <br><a href="./paineldecontrole.php">Voltar para o painel do administrador</a>
        <?php
        include_once '../classes/equipe.class.php';
        include_once '../classes/conexao.class.php';
        if($_POST){
            $tema = $_POST['tema'];
            $representante = '';
            $pntsTotal = 0;
            $bd = new conexao;
            $equipe = new equipe();
            $equipe->setTudo($tema, $representante, $pntsTotal);
            $equipe->salvar();
            

        }        
        ?>
        </form>
    </body>
</html>

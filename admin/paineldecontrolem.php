<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    if(!(isset($_SESSION['logamod'])))
    {
        header('Location: ../acessonegado.php');
    } 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel de controle</title>
    </head>
    <body>
        
        <form method="post" action="paineldecontrole.php">
        <h1> Painel de controle </h1>
        <?php 
        echo 'Seja bem-vindo: '.$_SESSION['nome'];
        ?>
        <a href="../user/classificacaoEquipes.php">Classificação das Equipes</a>
        <a href="insercaoPontos.php">Inserção de Pontos</a>
        <a href="validacaouser.php">Validação de usuários</a>
        <a href="../logout.php">Deslogar</a>
    </form>
    </body>
</html>
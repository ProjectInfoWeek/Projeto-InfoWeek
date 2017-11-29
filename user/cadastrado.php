<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if (isset($_SESSION['logadoadmin'])) {
    header('Location: ../admin/paineldecontrole.php');
} else if (isset($_SESSION['logado'])) {
  header('Location: index1.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Você está cadastrado!!</h1>
        <p>Você está cadastrado falta apenas os moderadores aceitarem sua inscrição na Info Week 2017</p>
        <a href="../index.php">Voltar para a página inicial</a>
    </body>
</html>

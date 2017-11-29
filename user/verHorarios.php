<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    if(!(isset($_SESSION['logado'])))
    {
        header('Location: ../acessonegado.php');
    } 
    include '../classes/conexao.class.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Horários das Provas</title>
        <link rel="stylesheet" type="text/css" href="../codes/css.css">
    </head>
    <body>
        <?php include_once '../codes/navbar.php'; ?>
        <table border="1">
            <tr>
                <th>Data</th>
                <th>Horário</th>
                <th>Prova</th>
            </tr>
        <?php
        $bd = new conexao;
        include_once '../classes/prova.class.php';
        $prova = new prova();
        $result = $prova->selectProvas();
        while($registro = mysqli_fetch_array($result)) {
            $nome = $registro["nome"];
            $data = $registro["Data"];
            $horai = $registro["horainicio"];
            $horaf = $registro["horafim"];
            echo "<tr><td>$data</td><td>$horai-$horaf</td><td>$nome</td></tr>";
        }
        ?>
        </table>
    </body>
</html>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (!(isset($_SESSION['logado']))) {
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
        <table cellpadding="0" cellspacing="0" id="horarios" border="1">
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
            $i = 1;
            while ($registro = mysqli_fetch_array($result)) {
                $nome = $registro["nome"];
                $data = $registro["Data"];
                $horai = $registro["horainicio"];
                $horaf = $registro["horafim"];
                if ($i % 2 == 0) {
                    echo "<tr><td style='background-color: white;'>$data</td><td style='background-color: white'>$horai-$horaf</td><td style='background-color: white'>$nome</td></tr>";
                } else {
                    echo "<tr><td style='background-color: #e8e8e8;'>$data</td><td style='background-color: #e8e8e8;'>$horai-$horaf</td><td style='background-color: #e8e8e8;'>$nome</td></tr>";
                }
                $i++;
            }
            ?>
            </table>
    </body>
</html>

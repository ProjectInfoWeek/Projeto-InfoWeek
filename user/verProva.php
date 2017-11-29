<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista de Provas</title>
        <link rel="stylesheet" type="text/css" href="../codes/css.css">
    </head>
    <body>
        <?php include_once '../codes/navbar.php'; ?>
        <div class="geral">
            <?php
            include_once '../classes/conexao.class.php';
            $bd = new conexao;
            include_once '../classes/prova.class.php';
            $prova = new prova();
            $result = $prova->getTudo();
            while ($registro = mysqli_fetch_array($result)) {
                $icone = $registro["icone"];
                $nome = $registro["nome"];
                $desc = $registro["descricao"];
                $caminho = "../imagens/";
                $imagem = $caminho . $icone;
                ?>
                <div class="containerfoto">
                    <?php
                    echo "<div class='imagem'><img src='$imagem' width='210' height='180'></div></div>";
                }
                ?>
            </div>

        </div>
    </div>

</body>
</html>

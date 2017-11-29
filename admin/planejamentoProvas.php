<?php
    session_start();
    /*if(!(isset($_SESSION['logadoadmin'])))
    {
        header('Location: ../acessonegado.php');
    }*/
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Planejamento de Provas</title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data" action="planejamentoProvas.php">
            Criação de Provas <br>
            Nome: <input type="text" name="nome" required><br>
            Data: <input type="date" name="data"><br>
            Hora Inicio: <input type="time" name="horainicio" required><br>
            Hora Fim: <input type="time" name="horafim" required><br>
            Descrição: <input type="text" name="descricao" required><br>
            Máximo de Pontos: <input type="number" name="maxPontos" required><br>
            Ícone: <input type="file" name="imagem">
            <input type="submit" value="Enviar">
            <br><a href="./paineldecontrole.php">Voltar para o painel do administrador</a>
        <?php
        include_once '../classes/prova.class.php';
        include_once '../classes/conexao.class.php';
        if($_POST){
            $nome = $_POST['nome'];
            $horai = $_POST['horainicio'];
            $horaf = $_POST['horafim'];
            $data = $_POST['data'];
            $descricao = $_POST['descricao'];
            $maxPontos = $_POST['maxPontos'];
            $icone = $_FILES['imagem']['name'];
            $caminhoatual = $_FILES["imagem"]["tmp_name"];
            $caminho = "../imagens/";
            $bd = new conexao;
            $prova = new prova();
            $prova->setTudo($nome, $data, $horai, $horaf, $descricao, $maxPontos, $icone);
            $prova->salvar();
            move_uploaded_file($caminhoatual,$caminho.$icone);
            
        }        
        ?>
        </form>
    </body>
</html>
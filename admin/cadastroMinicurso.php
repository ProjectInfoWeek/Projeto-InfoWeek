<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    //Verificar se dados foram inseridos
    session_start();
    if(!(isset($_SESSION['logadoadmin'])))
    {
        header('Location: ../acessonegado.php');
    }
     include_once '../classes/minicurso.class.php';
        include_once '../classes/conexao.class.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Minicursos</title>
    </head>
    <body>
        <form method="post">
        Cadastro de Minicursos<br>
        Nome: <input type="text" name="nome" required><br>
        Descrição: <input type="text" name="descricao"><br>
        Palestrante: <input type="text" name="palestrante" required><br>
        Data: <input type="date" name="data"><br>
        Hora Inicio: <input type="time" name="horainicio" required><br>
        Hora Fim: <input type="time" name="horafim" required><br>
        <input type="submit" value="Enviar">
        <br><a href="./paineldecontrole.php">Voltar para o painel do administrador</a>
        <?php
        if($_POST){
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $palestrante = $_POST['palestrante'];
            $horai = $_POST['horainicio'];
            $horaf = $_POST['horafim'];
            $data = $_POST['data'];
            $bd = new conexao;
            $minicurso = new minicurso();
            $minicurso->setTudo($nome, $descricao, $palestrante, $horai, $horaf, $data);
            $minicurso->salvar();

        }        
        ?>
        </form>
    </body>
</html>

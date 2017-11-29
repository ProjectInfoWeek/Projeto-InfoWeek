<?php
    session_start();
    if(!(isset($_SESSION['logado'])))
    {
        header('Location: ../acessonegado.php');
    }
    include_once '../classes/conexao.class.php';
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
        <title>Etapa de confirmação</title>
        <link rel="stylesheet" type="text/css" href="../codes/css.css">
    </head>
    <body>
        <?php include_once '../codes/navbar.php'; ?>
        <h1> BEM VINDO AMIGO </h1>
        <?php
        include_once '../classes/usuario.class.php';
        include_once "../classes/aluno.class.php";
        include_once "../classes/conexao.class.php";
        
        $nome = $_SESSION['name'];
        echo 'Você é @: ' .$nome;
        $bd = new conexao;
        $aluno = new aluno();
        $aluno->setNome($nome);
        $idEquipe = $aluno->getIdEquipe();
        if($idEquipe === NULL){
            echo 'Você já está cadastrado na infoweek, só precisamos delegar uma equipe para você e aí poderá acessar os recursos do site:)';
        }else {
            include_once "../classes/equipe.class.php";
            $equipe = new equipe();
            $equipe->setIdEquipe($idEquipe);
            $nome = $equipe->getTema();
            echo '<br>Sua equipe é: '.$nome;
            
                   
        } ?>
        <a href="../logout.php">Deslogar</a>
    </body>
</html>

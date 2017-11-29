<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
//Contém erro!
session_start();
if (isset($_SESSION['logadoadmin'])) {
    header('Location: ../admin/paineldecontrole.php');
} else if (isset($_SESSION['logado'])) {
    header('Location: ./user/index1.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastre-se</title>
    </head>
    <body>
        <form method="post">
        <?php
        include '../classes/conexao.class.php';
        include '../classes/usuario.class.php';
        include '../classes/aluno.class.php';
        include '../classes/minicurso.class.php';
        ?>
            <p> Inscreva-se para participar da Info Week 2017 </p>
            Matrícula: <input type="text" placeholder="Digite sua matrícula..." name="mat">
            <br>Turma<select name="turma">
                <option value="413">413</option>
                <option value="423">423</option>
                <option value="433">433</option>
            </select>
            <br>Nome: <input type="text" placeholder="Digite seu nome..." name="name">
            <br>Email: <input type="email" placeholder="Digite seu email..." name="email">
            <br>Senha: <input type="password" placeholder="Digite sua senha..." name="senha">
            <br>Minicurso: <select name="minicurso">
                <?php
                $bd = new conexao;
                $mini = new minicurso();
                $mini->listarMinicursos();
                ?>
            </select>
            <br> <input type="submit" value="Concluído">
        <?php
        if($_POST)
        {
            $nome = $_POST['name'];
            $ver = 2;
            $turma =$_POST['turma'];
            $login = $_POST['mat'];
            $email =$_POST['email'];
            $senha = $_POST['senha'];
            //$hash = password_hash($senha, PASSWORD_DEFAULT);
            $a = new aluno();
            $a->setTudo($login, $nome, $turma, $ver, $email, $senha);
            $a->insereDados();
            $veri = $a->getVerificar();
            if($veri==true){
                header("Location:cadastrado.php");
            } else {
                header("Location:cadastrar.php?erro=insercao");
            }
        }
        ?>
        <?php
            if($_GET["erro"]){
                echo '<p>Ocorreu um erro na inserção!!';
            }
        ?>
        </form>
    </body>
</html>
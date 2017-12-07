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
        <link rel="stylesheet" type="text/css" href="../codes/css.css">
    </head>
    <body>
        <form method="post">
            <?php
            include '../classes/conexao.class.php';
            include '../classes/usuario.class.php';
            include '../classes/aluno.class.php';
            include '../classes/minicurso.class.php';
            ?>
            <div id="pagCadastro">
            <div id="form">
                <p id="título"> Inscreva-se para participar da Info Week 2017 </p>
                <div>
                    <div id="dado">
                        <div><span>Matrícula</span></div>
                        <div><span>Nome</span></div>
                        <div><span>Turma</span></div>                    
                        <div><span>Email</span></div>
                        <div><span>Senha</span></div>
                        <div><span>Minicurso</span></div>
                    </div>
                    <div id="informacao">
                        <div><input type="text" placeholder="Digite sua matrícula..." name="mat"></div>
                        <div><input type="text" placeholder="Digite seu nome..." name="name"></div>
                        <div><select name="turma">
                                <option value="413">413</option>
                                <option value="423">423</option>
                                <option value="433">433</option>
                            </select></div>
                        <div><input type="email" placeholder="Digite seu email..." name="email"></div>
                        <div><input type="password" placeholder="Digite sua senha..." name="senha"></div>
                        <div><select name="minicurso">
                                <?php
                                $bd = new conexao;
                                $mini = new minicurso();
                                $mini->listarMinicursos();
                                ?>
                            </select></div>
                    </div>
                </div>
                <div id="botaoForm"><input type="submit" value="Concluído"></div>
            </div>
            </div>
            <?php
            if ($_POST) {
                $nome = $_POST['name'];
                $ver = 2;
                $turma = $_POST['turma'];
                $login = $_POST['mat'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                //$hash = password_hash($senha, PASSWORD_DEFAULT);
                $a = new aluno();
                $a->setTudo($login, $nome, $turma, $ver, $email, $senha);
                $a->insereDados();
                $veri = $a->getVerificar();
                if ($veri == true) {
                    header("Location:cadastrado.php");
                } else {
                    header("Location:cadastrar.php?erro=insercao");
                }
            }
            ?>
            <?php
            if ($_GET["erro"]) {
                echo '<p>Ocorreu um erro na inserção!!';
            }
            ?>
        </form>
    </body>
</html>
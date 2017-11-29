<!DOCTYPE html>
<!--
 To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (!(isset($_SESSION['logadoadmin']))) {
    if(!(isset($_SESSION['logamod'])))
            {
                header('Location: ../acessonegado.php');
            }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel de controle</title>
    </head>
    <body>

        <form method="get" action="validacaouser.php">
            <h1> Painel de controle </h1>
            <?php
            if (!isset($_GET["id"])) {
                $_GET["id"] = 1;

            }

            if (isset($_GET["idp"])) {
                $_GET["id"] = $_GET["idp"];

            }
            if (isset($_GET["idn"])) {
                $_GET["id"] = $_GET["idn"];
            }
            include '../classes/conexao.class.php';
            include '../classes/usuario.class.php';
            include '../classes/admin.class.php';
            include '../classes/aluno.class.php';
            $aluno = new aluno;
            $bd = new conexao;
            $result1 = $aluno->VerificacaoUsuarios();
            while ($registro = mysqli_fetch_array($result1)) {
                $verificar = $registro[0];
            }

            if (($_GET["id"] < 0) || ($_GET["id"] > $verificar)) {
                echo "Não conseguimos encontrar usuários, tente um limite diferente!";
                echo "<br><a href='validacaouser.php'> Voltar </a>";
                exit();
            }
            echo 'Seja bem-vindo: ' . $_SESSION['nome'];
           echo  '<p>Verificação'.$_GET["id"].'de '.$verificar.  '</p>';
            ?>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Nome</th>
                    <th>Turma</th>
                    <th>Email</th>
                    <th>Minicurso</th>
                </tr>

                <?php
                $menosg = $_GET["id"] - 1;
                $gnormal = $_GET["id"];
                $maisg = $_GET["id"] + 1;
                $sql = "SELECT usuario.idUsuarios, usuario.login, usuario.nomeUsuario, usuario.turma, usuario.email, minicursos.nome FROM usuario INNER JOIN minicursos ON usuario.idMinicurso = minicursos.idMinicurso WHERE tipousuario=2 LIMIT 1 OFFSET $menosg ";
                echo $sql;
                $result = $c2->setResult($sql);

                while ($registro = mysqli_fetch_array($result)) {
                    $idUsuarios = $registro["idUsuarios"];
                    $login = $registro["login"];
                    $nome = $registro["nomeUsuario"];
                    $turma = $registro["turma"];
                    $email = $registro["email"];
                    $minicurso = $registro["nome"];
                    echo "<tr>
                            <td>$idUsuarios</td>
                            <td>$login</td>
                            <td>$nome</td>
                            <td>$turma</td>
                            <td>$email</td>
                            <td>$minicurso</td>";
                    ?>

                    <td><input type='submit' name='Aceitar' value='Aceitar'</td>
                    <td><input type='submit' name='Negar' value='Negar'</td>
                    <?php
                    "</tr>";
                }
                ?>
                <?php
                if (isset($_GET["Aceitar"])) {
                    $banco = new conexao;
                    $admin = new admin;
                    $admin->Validaruser($banco, $idUsuarios);
                }
                if (isset($_GET["Negar"])) {
                    $admin = new admin;
                    $banco = new conexao;
                    $admin->Excluiruser($banco, $idUsuarios);
                }
                ?>
            </table>
            <br><a href="./paineldecontrole.php">Voltar para o painel do administrador</a>
            <?php if (($_GET["id"] > 0) && ($_GET["id"] < $verificar)) { ?>
                <a href = 'validacaouser.php?id&idp=<?echo htmlentities(urlencode($maisg));?>'> Próximo </a>
                <?php
            }
            if (($_GET["id"] > 1) && ($_GET["id"] <= $verificar)) {
                ?>
                <br> <a href = 'validacaouser.php?id&idn=<?echo htmlentities(urlencode($menosg));?>'> Anterior </a>
            <?php }
            ?>
        </form>
    </body>
</html>


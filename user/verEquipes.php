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
        <title>Lista de Equipes</title>
        <link rel="stylesheet" type="text/css" href="../codes/css.css">
    </head>
    <body>
        <form method="POST" action="verEquipes.php">
            <?php include_once '../codes/navbar.php'; ?>
            <div id="pesquisaEquipe"><span>Visualizar equipe: </span><select name="equipe">
                    <option value='' disabled selected>Selecione a equipe</option>
            <?php
                include '../classes/equipe.class.php';
                $bd = new conexao;
                $equipe = new equipe;
                $result0 = $equipe->todosTemas();
                while ($registro0 = mysqli_fetch_array($result0)) {
                    $tema = $registro0["tema"];
                    echo "<option value='$tema'>$tema</option>";
                }
                echo "</select>"
            ?>
                    <input type="submit" name="Ver" value="Procurar">
            </select></div>
            <table cellpadding="0" cellspacing="0" id="equipes" border='1'> 
                     <tr>
                         <th>Nome</th>
                         <th>Turma</th>
                     </tr>
                     
        <?php
        if(!isset($_POST["Ver"])){
            $nome = $_SESSION["name"];
            include_once '../classes/usuario.class.php';
            include_once '../classes/aluno.class.php';
            $aluno = new aluno;
            $aluno->setNome($nome);
            $idEquipe = $aluno->getIdEquipe();
            $result = $aluno->mostrarEquipes();
            $i=1;
            while ($registro = mysqli_fetch_array($result)) {
                 $nome = $registro["nomeUsuario"];
                 $turma = $registro["turma"];
                 if($i%2==0){
                     echo "<tr>
                            <td style='background-color: white;'>$nome</td>
                            <td style='background-color: white;'>$turma</td>
                       </tr>";
                 }
                 else{
                     echo "<tr>
                            <td style='background-color: #e8e8e8;'>$nome</td>
                            <td style='background-color: #e8e8e8;'>$turma</td>
                       </tr>";
                 }
                 $i++;
             }
        } else {
            include_once '../classes/usuario.class.php';
            include_once '../classes/aluno.class.php';
            $aluno = new aluno;
            $tema = $_POST["equipe"];
            $equipe->setTema($tema);
            $idEquipe = $equipe->getIdEquipe();
            $aluno ->setIdEquipe($idEquipe);
            $result1 = $aluno->EquipeAluno();
             while ($registro = mysqli_fetch_array($result1)) {
                 $nome = $registro["nomeUsuario"];
                 $turma = $registro["turma"];
                 echo "<tr>
                            <td>$nome</td>
                            <td>$turma</td>
                       </tr>";
             }
             
        }   
        ?>
            </table>
        </form>
    </body>
</html>

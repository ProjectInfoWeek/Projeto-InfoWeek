<?php
    session_start();
    if(!(isset($_SESSION['logadoadmin'])))
    {
        header('Location: ../acessonegado.php');
    }
    include '../classes/conexao.class.php';
    include '../classes/usuario.class.php';
    include '../classes/admin.class.php';
    include '../classes/equipe.class.php'
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method='post'>
        <table border="1">
            <tr>
                <th>Aluno</th>
                <th>Equipe</th>
            </tr>
        
        <?php
        $bd = new conexao;
        $i=0;
        $j=0;
        $equipe = new equipe();
        $result = $equipe->todosTemas();
        $user = new aluno();
        $result1= $user->AlunoSemEquipe();
        echo "<tr>
                 <td><select name='aluno'>
                        <option value='' disabled selected>Selecione o usuário</option>"; 
        while($registro = mysqli_fetch_array($result1))
        {
        $nome[$i] = $registro["nomeUsuario"];
        echo "<option value='$nome[$i]'>$nome[$i]</option>" ;
        $i++;
        }
        echo"</td>";
        echo"<td><select name='equipe'>
                        <option value='' disabled selected>Selecione a equipe</option>";
        while($registro1 = mysqli_fetch_array($result))
        {
        $tema[$j] = $registro1["tema"];
        echo "<option value='$tema[$j]'>$tema[$j]</option>" ;
        $j++;
        
        }
        echo"</td>";
        ?>
        <td><input type='submit'value='Inserir'></td>
        </tr>
        <?php
        if($_POST){
            if((!empty($_POST['aluno']))&&(!empty($_POST['equipe']))) {
            $equipe = $_POST['equipe'];
            $usuario = $_POST['aluno'];
            $equipe->setTema($equipe);
            $idEquipe = $equipe->getIdEquipe();
            $user ->setIdUsuario($idEquipe);
            $user ->setNome($usuario);
            $ver = $user ->updateEquipe();
            if($ver==true) {
                header('Location: inserindoAluno_Equipe.php');
            }else {
                echo "Inserção não realizada!";
            }
            } else {
                echo 'Algum atributo não foi preenchido';
            }

        }
        ?>
        <a href="paineldecontrole.php"> Voltar </a>
        </form>
    </body>
</html>

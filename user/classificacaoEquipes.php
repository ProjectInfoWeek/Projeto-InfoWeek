<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Classificação das Equipes</title>
        <link rel="stylesheet" type="text/css" href="../codes/css.css">
    </head>
    <body>
        <?php include_once '../codes/navbar.php'; ?>
        Classificação de Equipes<br>
        <table>
            <?php
            include_once '../classes/conexao.class.php';
            include_once '../classes/equipe.class.php';
            $equipe = new equipe;
            $equipe->classificacao();
            $tema = $equipe->getTema();
            $pntsTotal = $equipe->getPntsTotal();
            echo "<tr><th> Nome da Equipe </th>";
            echo "<th> Pontos da equipe </th> </tr>";
            echo "<tr>
                    <td>$tema</td>
                    <td>$pntsTotal</td>
                  </tr>";
            
            ?>
        </table>
    </body>
</html>

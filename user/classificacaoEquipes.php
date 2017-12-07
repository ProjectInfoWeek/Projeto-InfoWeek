<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Classificação das Equipes</title>
        <link rel="stylesheet" type="text/css" href="../codes/css.css">
    </head>
    <body>
        <?php include_once '../codes/navbar.php'; ?>
        <div id="tituloClassificacao">Classificação de Equipes</div>
        <table cellpadding="0" cellspacing="0" id="classificacao" border="1">
            <?php
            include_once '../classes/conexao.class.php';
            include_once '../classes/equipe.class.php';
            $equipe = new equipe();
            $result = $equipe->classificacao();
            echo "<tr><th> Nome da Equipe </th>";
            echo "<th> Pontos da equipe </th> </tr>";
            $i=1;
            while ($registro = mysqli_fetch_array($result)) {
                $tema = $registro['tema'];
                $pntsTotal = $registro['pntsTotal'];
                
                if($i%2==0){
                    echo "<tr>
                    <td style='background-color: white;'>$tema</td>
                    <td style='background-color: white;'>$pntsTotal</td>
                  </tr>";
                }
                else{
                    echo "<tr>
                    <td style='background-color: #e8e8e8;'>$tema</td>
                    <td style='background-color: #e8e8e8;'>$pntsTotal</td>
                  </tr>";
                }
                $i++;
            }
            ?>
        </table>
    </body>
</html>

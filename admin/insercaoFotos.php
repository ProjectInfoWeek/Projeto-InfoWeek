<?php
    session_start();
    //Verificar se foi inserido
    if(!(isset($_SESSION['logadoadmin'])))
    {
        header('Location: ../acessonegado.php');
    } 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inserção de Fotos</title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data" action="insercaoFotos.php">
            Inserção de Fotos: <br>
            Foto: <input type="file" name="foto">
            <input type="submit" value="Enviar">
            <br><a href="./paineldecontrole.php">Voltar para o painel do administrador</a>
            <?php
            if (isset($_POST)) {
                include_once '../classes/fotos.class.php';
                include_once '../classes/conexao.class.php';

                $foto = $_FILES['foto']['name'];
                $caminhoatual = $_FILES["foto"]["tmp_name"];
                $caminho = "../imagens/";
                $bd = new conexao;
                $fotos = new fotos();
                $fotos->setNome($foto);
                $fotos->salvar();
                move_uploaded_file($caminhoatual,$caminho.$foto);
            }
            ?>
        </form>
    </body>
</html>

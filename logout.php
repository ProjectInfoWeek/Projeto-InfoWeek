<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Logout</title>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION["logado"]) || $_SESSION["logado"] == TRUE || isset($_SESSION['logadoadmin']) || $_SESSION['logadoadmin'] == TRUE) {
            unset($_SESSION['logado']);
            unset($_SESSION['logadoadmin']);
            session_destroy();
        }
        ?>
        Você foi deslogado!
        <a href="index.php">Voltar para o menu principal</a>
    </body>
</html>

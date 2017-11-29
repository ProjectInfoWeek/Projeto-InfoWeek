<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (isset($_SESSION['logadoadmin'])) {
    header('Location: ../paineldecontrole.php');
} else if (isset($_SESSION['logado'])) {
    header('Location: ../user/index1.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login moderador</title>
    </head>
    <body>
        <form method="post">
               
            
            Login: <input type="text" name="login" placeholder="Digite seu login">
            Senha: <input type="password" name="senha" placeholder="Digite sua senha">
            <input type="submit" value="Entrar">
        
        <?php
        if($_POST)
        {  
            include_once '../classes/conexao.class.php';
            include_once '../classes/usuario.class.php';
            include_once '../classes/admin.class.php';
            $login = addslashes($_POST['login']);
            $senha = addslashes($_POST['senha']);
            $nome = "";
            $bd = new conexao;
            $ad = new admin;
            $ad ->setLogin($login);
            $logado = $ad ->verificarEmail($login);
            $tipousuario = $ad->getTipousuario();
            /*$stmt = $bd->prepare($sql);
            $stmt ->bind_param('ss', $_POST["login"], $_POST["senha"]);
            $stmt ->execute();
            $stmt ->bind_result($tipousuario);*/
            if(empty($logado)) {
                header('Location: pagmoderador.php?email=erro');
            } else {    
            if(!isset($tipousuario)){
                header('Location: pagmoderador.php?erro=senha');
            }else{
                    if($tipousuario==1 || $tipousuario==4) {
                        $ad ->setSenha($senha);
                        $result = $ad->Logar();
                        if($result==true){
                        $name = $ad->getNome();
                        $_SESSION['nome'] = $name;
                        if($tipousuario==1){
                            $_SESSION['logadoadmin'] = $login;
                            header('Location: paineldecontrole.php');
                        }else if($tipousuario==4){
                            $_SESSION['logamod'] = $login;
                            header('Location: paineldecontrolem.php');
                        } 
                        } else {
                            header('Location: pagmoderador.php?senha=erro');
                        } 
                       
                        } else {
                            header('Location: pagmoderador.php?admin');
                        }
            }
            
            }
        }
        ?>
            
        <?php
        if($_GET)
        {
            if(isset($_GET['erro'])){
                echo 'Erro no login!';
            }
            if(isset($_GET['admin'])){
                echo 'Você não está cadastrado como administrador!';
            }
            if(isset($_GET['email'])){
                echo 'Email inválido!';
            }
            if(isset($_GET['senha'])){
                echo 'Senha inválida';
            }
        }
        ?>
        </form>
    </body>
</html>
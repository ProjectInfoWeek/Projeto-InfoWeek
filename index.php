<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
ob_start();
session_start();
if (isset($_SESSION['logadoadmin'])) {
    header('Location: ./admin/paineldecontrole.php');
} else if (isset($_SESSION['logado'])) {
    header('Location: ./user/index1.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Página inicial</title>
        <link rel="stylesheet" type="text/css" href="./codes/css.css">
    </head>
    <body>
        <form action="index.php" method="post">
            <nav id="navbar">
                <ul>
                    <li style="aprendendolabel"<a  href="index.php" class="fundo_img" ><img  src="./imagens/infoweek.png" height="50" width="150"></a></li>
                    <li><a class="inicio" href="./user/verProva.php">Provas</a></li>
                    <li><a class="inicio" href="./user/verEquipes.php">Equipes</a></li>
                    <li><a class="inicio" href="./user/verHorarios.php">Horário</a></li>
                    <li><a class="inicio" href="./user/classificacaoEquipes.php">Classificação</a></li>
                    <li><a class="inicio" href="">Galeria de fotos</a></li>
                    <li class="dropdown"><a class="inicio" class="dropbtn">Interações</a>
                        <div class="dropdown-content">
                            <a href="#">Painel de notícias</a>
                            <a href="#">#InfoWeek</a>
                        </div>
                    </li>
                </ul>   
            </nav>
            <div class="tudo">
                <section id="conexao">
                    <div class="apresentacao">
                        <h1 class="introducao">Bem-vindo a Info Week 2017</h1>
                        <p class="textoinicial"> Muito mais que uma semana da informática, é uma chance para integração dos alunos de todos os anos.
                    </div>
                    <div class="logar">
                        <div  class="logingeral">
                            <input class="inputbasico" spellcheck=false name="login"type="text" size="18" alt="login" required="">
                            <label for="username" class="aprendendolabel">Matrícula</label>
                        </div>
                        <div class="logingeral">
                            <input class="inputbasico" spellcheck=false name="senha" type="password" size="18" alt="login" required="">
                            <label for="password" class="aprendendolabel">Senha</label>
                        </div>
                    </div>
                    <div class="botoes">
                        <div id="cadastro"><a href="./user/cadastrar.php"> Faça parte da Info Week 2017 </a></div>
                        <div id="botao"> <input type="submit" value="Entrar"> </div>                        
                    </div>
                    <br> <a class="admin" href="./admin/pagmoderador.php"><img src="imagens/Spy-icon.png" width="100" height="100"></a>
                </section>
                <?php
                if (@$_POST) {
                    include './classes/conexao.class.php';
                    include './classes/usuario.class.php';
                    include './classes/aluno.class.php';
                    $login = $_POST['login'];
                    $banco = new conexao;
                    $aluno = new aluno;
                    //$tipousuario = 3;
                    $matricula = $aluno->Verificaremail($login);
                    if (empty($matricula)) {
                        header('Location: index.php?erro=email');
                    } else {
                        $tipousuario = $aluno->getTipousuario();
                        if ($tipousuario == 3 || $tipousuario == 2) {
                            $senha = $_POST["senha"];
                            $aluno->setSenha($senha);
                            $logado = $aluno->Logar();
                            if ($logado == true) {
                                $name = $aluno->getNome();
                                $equipe = $aluno->getEquipe();
                                $_SESSION['logado'] = $login;
                                $_SESSION['name'] = $name;
                                $_SESSION["equipe"] = $equipe;
                                if ($tipousuario == 3) {
                                    header('Location: ./user/index1.php');
                                } else {
                                    header('Location: ./user/semcadastro.php');
                                }
                            } else {
                                header("Location: index.php?senha=erro");
                            }
                        } else {
                            header("Location: index.php?page=error");
                        }
                    }
                    /* $aluno->setTipousuario($tipousuario);
                      $banco->login($email, $senha);

                      $result = $aluno->getZidade();

                      if ($result == true) {
                      $name = $aluno->Maedocoragem($banco);

                      $_SESSION['logado'] = $login;
                      $_SESSION['name'] = $name;
                      header('Location: ./user/index1.php');
                      } else {
                      header('Location: index.php?erro=senha');
                      } */
                }
                ?>
                <section id="noticias">
                    <div class="noticias">
                        <a class="twitter-timeline" data-lang="pt" data-width="500" data-height="500" data-theme="light" href="https://twitter.com/TwitterDev">Painel de notícias</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                    <div class="followbutton">
                        <a href="https://twitter.com/TwitterDev" class="twitter-follow-button" data-show-count="false">Follow @TwitterDev</a>
                    </div>
                </section>
                <?php
                if ($_GET) {
                    if (isset($_GET['erro'])) {
                        echo 'Email inválido!';
                    }

                    if (isset($_GET['senha'])) {
                        echo 'Senha inválida!';
                    }

                    if (isset($_GET['usuario'])) {
                        echo 'Usuário não registrado';
                    }

                    if (isset($_GET['page'])) {
                        echo 'Página incorreta para login';
                    }
                }
                ?>
                <footer>
                    <p> Desenvolvido pela Equipe Info Week 2017.
                </footer>
            </div>        
        </form>
    </body>
</html>

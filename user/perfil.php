<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if (!(isset($_SESSION['logado']))) {
    header('Location: ../acessonegado.php');
}
include '../classes/conexao.class.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../codes/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function (e) {
                $('.btn_modal').click(function () {
                    $('#modal').fadeIn(500);
                });
                $('.fechar, #modal').click(function (event) {
                    if (event.target !== this) {
                        return;
                    }
                    $('#modal').fadeOut(500);
                });
            });
        </script>
        <style rel="stylesheet" type="text/css">
            #modal{
                background:rgba(0,0,0,0.5); 
                width:100%; 
                height: 100%; 
                position:fixed; 
                left: 0; 
                top:0;
                display: none;
            }
            .modal-box{
                background: #FFF;
                width:60%;
                height: 300px;
                position: absolute;
                left:50%;
                top:50%;
                margin-left:-30%;
                margin-top:-150px;
            }
            .fechar{
                padding: 5px 10px;
                border: 1px solid #ccc;
                position: absolute;
                right: 3px;
                top: 3px;
                border-radius: 7px;
                color: #ccc;
                cursor: pointer;
            }
            .fechar:hover{
                color: #666;
                border-color: #666;
            }
        </style>
    </head>
    <body>
        <?php
        $nome = $_SESSION['name'];
        ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <?php
                $bd = new conexao;
                $sql = "SELECT usuario.idUsuarios, usuario.login, usuario.nomeUsuario, usuario.turma, usuario.email, minicursos.nome FROM usuario INNER JOIN minicursos ON usuario.idMinicurso = minicursos.idMinicurso WHERE usuario.nomeUsuario = '$nome'";
                $result = $bd->setResult($sql);
                while ($registro = mysqli_fetch_array($result)) {
                    $idUsuarios = $registro["idUsuarios"];
                    $login = $registro["login"];
                    $nome = $registro["nomeUsuario"];
                    $turma = $registro["turma"];
                    $email = $registro["email"];
                    $minicurso = $registro["nome"];
                }
                echo "<tr>
                        <th>Matrícula</th>
                        <td>$login</td>
                        <td><input type='button' tipo='varchar' class='btn_modal' campo='$login' banco='login' value='Editar'>
                         </tr>
                         <tr>
                         <th>Nome</th>
                         <td>$nome</td>
                         <td><input type='button' tipo='varchar' campo='$nome' banco='nomeUsuario' class='btn_modal'value='Editar'>
                         </tr>
                         <tr>
                         <th>Turma</th>
                         <td>$turma</td>
                         <td><input type='button' tipo='select' campo='$turma' banco='turma' class='btn_modal' value='Editar'>
                         </tr>
                         <tr>
                         <th>Email</th>
                         <td>$email</td>
                         <td><input type='button' tipo='email' campo='$email' banco='email' class='btn_modal' value='Editar'>
                         </tr>
                         <tr>
                         <th>Minicurso</th>
                         <td>$minicurso</td>
                         <td><input type='button' tipo='select' campo='$minicurso' banco='idMinicurso' class='btn_modal' value='Editar'>
                         </tr>"; 
                ?>
            <div id="modal">
                <div class="modal-box">
                    <div class="modal-box-conteudo">
                        <input type="text" atributo="" name="campoVarchar" value="">
                    </div>
                    <div class="fechar"> X </div>
                </div>
            </div>
            <p id="demo"></p>
            <style>
                input[name="campoVarchar"] {
                    display: none;
                }
            </style>

            <script>
                $(document).ready(function () {
                    $('input[tipo="varchar"]').click(function () {
                        
                        $('input[name="campoVarchar"]').css('display', 'inherit');
                        $('input[name="campoVarchar"]').val($(this).attr('campo'));
                         
                    });
                     $('input[tipo="select"]').click(function () {
                        
                         $('input[name="campoVarchar"]').css('display', 'inherit');
                         $('input[name="campoVarchar"]').val($(this).attr('campo'));
                         
                    });
                    $('input[tipo="email"]').click(function () {
                        
                         $('input[name="campoVarchar"]').css('display', 'inherit');
                         $('input[name="campoVarchar"]').val($(this).attr('campo'));
                         
                    });
                });
            </script>
    </body>
</html>

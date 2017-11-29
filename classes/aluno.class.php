<?php

class aluno extends usuario {

    protected $turma;
    protected $email;
    protected $equipe;
    protected $idEquipe;

    function getEquipe() {
        return $this->equipe;
    }

    function setEquipe($equipe) {
        $this->equipe = $equipe;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getTurma() {
        return $this->turma;
    }

    function setTurma($turma) {
        $this->turma = $turma;
    }

    function getIdEquipe() {
        $sql = "SELECT idEquipe FROM usuario WHERE nomeUsuario='$this->nome' LIMIT 1";
        $result = $this->db->setResult($sql);
        while ($registro = mysqli_fetch_array($result)) {
            $this->idEquipe = $registro[0];
        }
        return $this->idEquipe;
    }

    function setIdEquipe($idEquipe) {
        $this->idEquipe = $idEquipe;
    }

    function Logar() {
        $sql = "SELECT * FROM usuario WHERE login='$this->login' AND tipousuario='$this->tipousuario'";
        $result = $this->db->setResult($sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }
       else {
            return false;
        }
    }

    function insereDados() {
        $sql = "INSERT INTO usuario(nomeUsuario,tipousuario, turma,login, email, senha) values('$this->nome',$this->tipousuario, '$this->turma', '$this->login', '$this->email', '$this->senha')";
        $result = $this->db->setResult($sql);
        if($result){
            $this->verificar = true;
        }else{ 
            die("Erro: " . mysql_error());
            $this->verificar = false;
        }
    }

    function Verificaremail($login) {
        $sql = "SELECT login from usuario WHERE login ='$login'";
        $result0 = $this->db->setResult($sql);
        while ($registro = mysqli_fetch_array($result0)) {
            $this->login = $registro["login"];
        }
        if (!mysqli_fetch_array($result0)) {
            $this->tipousuario = null;
        }
        echo $this->login . "é user<br>";
        return $this->login;
    }

    function setTudo($login, $nome, $turma, $ver, $email, $senha) {
        $this->login = $login;
        $this->nome = $nome;
        $this->tipousuario = $ver;
        $this->turma = $turma;
        $this->email = $email;
        $this->senha = $senha;
    }
    
    function EquipeAluno(){
        $sql3 = "SELECT nomeUsuario,turma FROM usuario WHERE idEquipe = $this->idEquipe";
        $result1 = $this->db->setResult($sql3);
        return $result1;
    }
    
    function AlunoSemEquipe(){
        $sql1= "SELECT nomeUsuario FROM usuario WHERE idEquipe IS null and tipousuario=3";
        $result1 = $this->db ->setResult($sql1);
        return $result1;
    }
    
      function mostrarEquipes(){
        $sql1 = "SELECT nomeUsuario,turma FROM usuario WHERE idEquipe = $this->idEquipe";
        $result1 = $this->db->setResult($sql1);
        return $result1;
    }
    
    function updateEquipe(){
        $sql3= "UPDATE usuario SET idEquipe ='$this->idEquipe' WHERE nome='$this->nome'";
        $result = $this->db->setResult($sql3);
        if($result) {
            return true;
        } else {
            return false;
        }
        
    }
    
    function VerificacaoUsuarios(){
        $sql1 = "SELECT COUNT(tipousuario) FROM usuario WHERE tipousuario=2 ";
        $result = $this->db->setNormal($sql1);
        return $result;
    }
}

<?php
abstract class usuario {
    protected $login;
    protected $nome;
    protected $tipousuario;
    protected $senha;
    protected $hash;
    protected $db;
    protected $verificar;
    protected $idUsuario;
    
    function __construct() {
        $this->db = new conexao;
    }
    function getSenha() {
        return $this->senha;
    }
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }
    
    function getVerificar() {
        return $this->verificar;
    }

    function setVerificar($verificar) {
        $this->verificar = $verificar;
    }
    
    function setLogin($login)
    {
        $this-> login = $login;
    }
    function getLogin()
    {
        return $this->login;
    }
    function getNome()
    {
        $sql = "SELECT * FROM usuario WHERE login='$this->login' and senha='$this->senha' AND tipousuario=$this->tipousuario";
        $result = $this->db->setResult($sql);
        while ($registro = mysqli_fetch_array($result)) {
            $this->nome = $registro['nomeUsuario'];
        }
        return $this->nome;
    }
    function setNome($nome)
    {
        $this->nome = $nome;
    }
    function getTipousuario() {
        $sql = "SELECT tipousuario from usuario WHERE login = '$this->login'";
        $result = $this->db->setResult($sql);
        while($registro = mysqli_fetch_array($result)) {
            $this->tipousuario = $registro["tipousuario"];
        }

        return $this->tipousuario;
    }

    function setTipousuario($tipousuario) {
        $this->tipousuario = $tipousuario;
    }

    function getHash(){
        $sql = "SELECT senha FROM usuario WHERE login = '$this->login'";
        $result = $this->db->setResult($sql);
        while($registro = mysqli_fetch_array($result)) {
            $this->hash = $registro["senha"];
        }

        return $this->hash;
    }
    
  
    
    
    
    
}

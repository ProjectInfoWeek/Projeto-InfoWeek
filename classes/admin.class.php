<?php
class admin extends usuario{
   protected $ronaldo;
    
   function setTudo($login, $nome, $tipousuario, $senha ){
        $this->login = $login;
        $this->senha= $senha;
        $this->tipousuario = $tipousuario;
        $this->nome = $nome;
    }
   
    function getRonaldo()
    {
        return $this -> ronaldo;
    }
    function Validaruser($banco, $idUsuarios)
    {
        $sql = "UPDATE usuario SET tipousuario =3 WHERE idUsuarios = $idUsuarios";
        $banco->Update($sql);
    }
    function Excluiruser($banco, $idUsuarios)
    {
        $sql = "DELETE FROM usuario WHERE idUsuarios = $idUsuarios";
        $banco ->Update($sql);
    }
    function getFome($banco)
    {
        $sql ="SELECT nome FROM usuario WHERE login= '$this->login' AND senha= '$this->senha' AND tipousuario =$this->tipousuario";
        $result = $banco->setResult($sql);
        while($registro = mysqli_fetch_array($result))
        {
            $nome = $registro['nome'];
        }
        return $nome;
    }
    
    function verificarEmail($login){
        $sql = "SELECT login from usuario WHERE login ='$login'";
        $result0 = $this->db->setResult($sql);
        while ($registro = mysqli_fetch_array($result0)) {
                $this->login = $registro["login"];
            }         
        if(!mysqli_fetch_array($result0)) {
            $this->tipousuario = null;
        }
        return $this->login;
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
   
}

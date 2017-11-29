<?php

class conexao {

    private $host;
    private $user;
    private $password;
    private $namedb;
    private $db;
    private $row;

    function __construct($host = "localhost", $usuario = "root", $password = "", $namedb = "infoweek") {
        $this->setHost($host);
        $this->setUser($usuario);
        $this->setPassword($password);
        $this->setNamedb($namedb);
        $this->conectar();
    }

    function getHost() {
        return $this->host;
    }

    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->password;
    }

    function getNamedb() {
        return $this->namedb;
    }

    function setHost($valor) {
        $this->host = $valor;
    }

    function setUser($usuario) {
        $this->user = $usuario;
    }

    function setPassword($valor) {
        $this->password = $valor;
    }

    function setNamedb($valor) {
        $this->namedb = $valor;
    }

    function conectar() {

        $this->db = new mysqli(
                $this->getHost(), $this->getUser(), $this->getPassword(), $this->getNamedb());
        mysqli_set_charset($this->db, 'utf8');
        if ($this->db->connect_error) {
            die('Erro de conexao (' . $this->db->connect_errno . '): ' . $this->db->connect_error);
        }
    }

    function insere($query) {
        echo $query;
        $result = mysqli_query($this->db, $query);
        if ($result == 0) {
            echo 'Erro na inserção';
        } else {
            header('Location:/user/cadastrado.php');
        }
    }

    function consulta($query) {
        echo $query;
        $result = mysqli_query($this->db, $query);
        if (mysqli_num_rows($result) > 0) {
            //echo 'true';
            return true;
        } else {
            //echo 'false';
            return false;
        }
        //echo "<br>";
        /* while ($registro = mysqli_fetch_array($result)) {
          echo "Nome:" . $registro['nome'] . "<br>";
          echo "AreaAtua:" . $registro['areaAtua'] . "<br>";
          echo "<hr>";
          } */
    }

    


    function setResult($query) {
        $result = mysqli_query($this->db, $query);
        return $result;
    }

    function getDb() {
        return $this->db;
    }

    function Update($query) {
        $result = mysqli_query($this->db, $query);
        /* if($result){
          if(mysql_affected_rows()>0){
          echo 'Dado atualizado com sucesso';
          } else {
          echo 'Consulta efetuada, mas nenhuma linha modificada';
          }
          } else {
          die("Erro:  ". mysql_error());
          } */
    }

    function Desconectar() {
        $this->db->close();
    }

    function login($login, $senha) {
        $sql = "SELECT * FROM usuario WHERE login = '$login'";
        $result = $this->consulta($sql);
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $value) {
                if (password_verify($row['senha'], $senha)) {
                    echo 'Bem-vindo!';
                    if ($row['tipousuario'] == 1 || $row['tipousuario'] == 4) {
                        $_SESSION['logadoadmin'] = TRUE;
                        header('refresh:1;url=paineldecontrole.php');
                    } else {
                        $_SESSION['logado'] = true;
                        header('refresh:1;url=index1.php');
                    }
                } else {
                    echo 'Você não está cadastrado ainda!';
                }
                break;
            }
        }
    }

}

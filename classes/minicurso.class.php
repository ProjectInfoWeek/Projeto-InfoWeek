<?php
class minicurso {
    protected $nome;
    protected $descricao;
    protected $palestrante;
    protected $horai;
    protected $horaf;
    protected $data;
    protected $db;
    
    function __construct() {
        $this->db = new conexao();
    }
    
    function setTudo($nome, $descricao, $palestrante, $horai, $horaf, $data){
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->palestrante = $palestrante;
        $this->horai = $horai;
        $this->horaf = $horaf;
        $this->data = $data;
        $this->salvar();
    }
    
    function salvar() {
        $this->db->Update("INSERT INTO minicursos(nome, descricao, palestrante, horai, horaf, data) VALUES('$this->nome','$this->descricao','$this->palestrante','$this->horai', '$this->horaf', '$this->data');");
    }
    
    function listarMinicursos() {
        $query = 'SELECT nome FROM minicursos;';
        $result = $this->db->setResult($query);
        while ($value = mysqli_fetch_array($result)) {
            echo '<option value="' . $value['nome'] . '">' . $value['nome'] . '</option>';
        }
    }
}

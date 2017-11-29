<?php
class fotos {
    protected $nome;
    protected $db;
    
    function __construct() {
        $this->db = new conexao;
    }
    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

        function salvar() {
        $banco->setResult("INSERT INTO fotos(nome) VALUES('$this->nome');");
    }
}

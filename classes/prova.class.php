<?php
class prova {
    
    private $nome;
    private $Data;
    private $horai;
    private $horaf;
    private $descricao;
    private $maxpontos;
    private $icone;
    private $db;
    
    public function __construct() {
        $this->db = new conexao;
    }
    
    function selectProvas() {
        $sql = "SELECT nome, Data, horainicio, horafim from prova order by Data asc, horainicio asc";
        $result = $this->db->setResult($sql);
        return $result;
    }
    function setTudo($nome, $Data, $horai,$horaf, $descricao, $maxpontos, $icone) {
        $this->nome = $nome;
        $this->Data = $Data;
        $this->horai = $horai;
        $this->horaf= $horaf;
        $this->descricao = $descricao;
        $this->maxpontos = $maxpontos;
        $this->icone = $icone;
    }
    
    public function salvar() {
        $this->db->Update("INSERT INTO prova(nome, Data, horainicio, horafim, descricao, maxPontos, icone) VALUES('$this->nome','$this->Data','$this->horai','$this->horaf' ,'$this->descricao','$this->maxpontos','$this->icone');");
    }
    
    function getTudo(){
        $sql = "SELECT icone, nome, descricao FROM prova";
        $result = $this->db ->setResult($sql);
        return $result;
    }
    
    function listarProvas() {
        $query = 'SELECT idProva,nome FROM prova ORDER BY nome ASC;';
        $result = mysqli_query($this->db, $query);
        while ($value = mysqli_fetch_array($result)) {
            echo '<option value="' . $value['idProva'] . '">' . $value['nome'] . '</option>';
        }
    }
}

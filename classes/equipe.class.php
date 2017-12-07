<?php
class equipe {
    
    private $tema;
    private $representante;
    private $pntsTotal;
    private $db;
    private $idEquipe;

    public function __construct() {
        $this->db = new conexao;
    }
    
    function setTudo($tema, $representante, $pntsTotal){
        $this->tema = $tema;
        $this->representante = $representante;
        $this->pntsTotal = $pntsTotal;
    }
    
    function getIdEquipe() {
        $sql2 = "SELECT idEquipe FROM equipe WHERE tema = '$this->tema' LIMIT 1";
        $result2 = $this->db->setResult($sql2);
        while ($registro = mysqli_fetch_array($result2)) {
            $this-> idEquipe = $registro[0];
        }
        return $this->idEquipe;
    }

    function setIdEquipe($idEquipe) {
        $this->idEquipe = $idEquipe;
    }

        public function salvar() {
        $sql = "INSERT INTO equipe(tema, representante, pntsTotal) VALUES('$this->tema','$this->representante','$this->pntsTotal');";
        $this->db->setResult($sql);
    }
    
    function listarEquipes() {
        $query = 'SELECT idEquipe,tema FROM equipe ORDER BY tema ASC;';
        $result = $this->db->setResult($query);
        while ($value = mysqli_fetch_array($result)) {
            echo '<option value="' . $value['idEquipe'] . '">' . $value['tema'] . '</option>';
        }
    }
    function getTema() {
        $sql1 = "SELECT tema from equipe where idEquipe = $this->idEquipe";
            $result1 = $this->db->setResult($sql1);
        while($registro1 = mysqli_fetch_array($result1)){
            $this->tema = $registro1["tema"];
            }
        return $this->tema;
    }

    function getRepresentante() {
        return $this->representante;
    }

    function getPntsTotal() {
        return $this->pntsTotal;
    }

    function setTema($tema) {
        $this->tema = $tema;
    }

    function setRepresentante($representante) {
        $this->representante = $representante;
    }

    function setPntsTotal($pntsTotal) {
        $this->pntsTotal = $pntsTotal;
    }
    
    function todosTemas(){
        $sql0 = "SELECT tema FROM equipe";
        $result0 = $this->db ->setResult($sql0);
        return $result0;
    }
    
    function classificacao() {
        $query = 'SELECT tema, pntsTotal FROM equipe ORDER BY pntsTotal DESC';
        $result = $this->db->setResult($query);
        return $result;
    }
    

}

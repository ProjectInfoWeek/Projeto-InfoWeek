<?php
class pontos {
   private $idEquipe; 
   private $idProva; 
   private $pontoProva;
   private $db;
    
    public function __construct() {
        $this->db = new conexao();
    }
    
    public function setTudo($idEquipe, $idProva, $pontoProva){
        $this->idEquipe = $idEquipe;
        $this->idProva = $idProva;
        $this->pontoProva=$pontoProva;
    }
    
    public function salvar() {
        $this->db->Update("INSERT INTO pontos VALUES('$this->idEquipe','$this->idProva','$this->pontoProva');");
    }
    
    public function contarEquipes() {
        $query = "SELECT COUNT(idEquipe) FROM equipe;";
        $result = $this->db->setResult($query);
        while($registro = mysqli_fetch_array($result)){
            $contar = $registro[0];
        }
        return $contar;
    }

    public function somarPontos() {
        for ($i = 0; $i <= $this->contarEquipes(); $i++) {
            $query = "SELECT SUM(pontoProva) FROM pontos WHERE idEquipe = '$i';";
            $result = mysqli_query($this->db, $query);
            $r = mysqli_fetch_array($result);
            $this->Update("UPDATE equipe SET pntsTotal = '$r[0]' WHERE idEquipe = '$i';");
        }
    }
}

<?php
abstract class Desenho {
    protected $linhas;
    protected $colunas;

    public function __construct($linhas, $colunas) {
        $this->linhas = $linhas;
        $this->colunas = $colunas;
    }

    abstract public function gerarDesenho(): string;

    public function getLinhas(): int {
        return $this->linhas;
    }
    
    public function setLinhas($linhas) {
        $this->linhas = $linhas;
    }
    
    public function getColunas(): int {
        return $this->colunas;
    }
    
    public function setColunas($colunas) {
        $this->colunas = $colunas;
    }
}

class DesenhoXis extends Desenho {
    public function gerarDesenho(): string {
        $desenho = "";
        for ($i = 1; $i <= $this->linhas; $i++) {
            for ($j = 1; $j <= $this->colunas; $j++) {
                if (($i == $j) || ($j == ($this->colunas - $i + 1))) {
                    $desenho .= "*";
                } else {
                    $desenho .= ".";
                }
            }
            $desenho .= "\n";
        }
        return $desenho;
    }
}

class DesenhoCruz extends Desenho {
    public function gerarDesenho(): string {
        $desenho = "";
        for ($i = 1; $i <= $this->linhas; $i++) {
            for ($j = 1; $j <= $this->colunas; $j++) {
                if (($j == ceil($this->colunas / 2)) || ($i == ceil($this->linhas / 2))) {
                    $desenho .= "*";
                } else {
                    $desenho .= ".";
                }
            }
            $desenho .= "\n";
        }
        return $desenho;
    }
}

$xis = new DesenhoXis(5, 5);
$cruz = new DesenhoCruz(5, 7);

echo $xis->gerarDesenho();
echo "\n";
echo $cruz->gerarDesenho();
?>

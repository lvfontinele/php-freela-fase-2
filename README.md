# Freela PHP - Fase 2
Este repositório é referente à fase 2 do processo seletivo "Frella PHP", cujo objetivo é refatorar o código da fase 1, implementando a orientação a objetos.

## Instalação do PHP

Para executar o projeto, é necessário ter o PHP instalado na máquina. Você pode baixar o PHP no site oficial: https://www.php.net/downloads

## Configurando o projeto

Para configurar o projeto, basta baixar ou clonar o repositório em sua máquina.

```bash
git clone https://github.com/lvfontinele/php-freela-fase-2
```

Para executar, entre na pasta do projeto e execute o seguinte comando:

```bash
cd php-freela-fase-2
php index.php
```

# Mudanças realizadas

* Criação da classe abstrata `Desenho` para servir de modelo, pois contém propriedades que se repetem nas classes `DesenhoXis` e `DesenhoCruz`.
* Uso de propriedades privadas para armazenar o número de linhas e colunas de cada figura, ao invés de valores fixos.
* Alteração da condição if para o método `gerarDesenho()`.
* Criação das classes filha `DesenhoXis` e `DesenhoCruz` com o método `gerarDesenho()` modificado, para gerar o desenho de cada classe.

# Refatoração do código anterior

## Código do desafio 1

Cruz:
```php
<?php
$linhas = 5;
$colunas = 7;
for ($i = 1;$i <= $linhas; $i++){
    for ($j = 1;$j<=$colunas; $j++){
        if(($j == ceil($colunas / 2)) || ($i == ceil($linhas / 2))){
            echo "*";
        }else{
            echo ".";
        }
    }
    echo "\n";
}
?>
```

Xis:
```php
<?php
$linhas = 5;
$colunas = 5;
for ($i = 1; $i <= $linhas; $i++) {
    for ($j = 1; $j <= $colunas; $j++) {
        if (($i == $j) || ($j == ($colunas - $i + 1))) {
            echo "*";
        } else {
            echo ".";
        }
    }
    echo "\n";
}
?>
```

## Código refatorado

```php
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
```
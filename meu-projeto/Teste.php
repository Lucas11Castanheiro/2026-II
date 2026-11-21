<?php

class produto {
    public $nome;
    private $preco;

    function SetPreco($preco) {
        $this->preco = $preco;
    }

    function GetPreco() {
        return $this->preco;
    }

}

$produto1 = new produto();
$produto1->nome = readline("Digite o nome do produto: ");
$produto1->SetPreco(floatval(readline("Digite o preço do produto: ")));

echo "\nInformações do Produto:\n";
echo "\nO nome do produto é: " . $produto1->nome;
echo "\nO preço do produto é: " . $pr
oduto1->GetPreco();
?>
<?php

function Atividade1(){

echo "------------------------------\n";
echo      "\tAtividade 1\n";
echo "------------------------------\n";


    class ContaBancaria{
        private $Saldo = 0;
    

    public function Depositar($valor){
        $this->Saldo += $valor;
    }

    public function Sacar($valor){
        if($valor <=$this->Saldo){
            $this->Saldo -= $valor;
        }
        else{
            echo "Saldo insuficiente para saque!\n";
        }
    }
    public function GetSaldo(){
        return $this->Saldo;
    }
    
    }
    $Conta01 = new ContaBancaria();
    $Conta01->Depositar(1000);
    echo ("Saldo atual: " . $Conta01->GetSaldo() .  "\n");
    $Conta01->Sacar(500);
    echo ("Saldo atual: " . $Conta01->GetSaldo() . "\n");
    $Conta01->Sacar(500);
    echo ("Saldo atual: " . $Conta01->GetSaldo() . "\n");
    $Conta01->Sacar(500);
    echo ("Saldo atual: " . $Conta01->GetSaldo() . "\n");

}

function Atividade2(){

echo "------------------------------\n";
echo      "\tAtividade 2\n";
echo "------------------------------\n";

class Produto{
    private $preco = 0;

    public function Getpreco(){
        return $this->preco;
    }

    public function Setpreco($valor){
        if($valor >= 0){
            $this->preco = $valor;
            echo "o Valor de R$". $this->preco . " foi definido com sucesso!\n";
        }
        else{
            echo "Preço inválido!\n";
        }
    }
}

$produto01 = new Produto();
$produto01->Setpreco(100);

}
while (true) {
    switch (readline("\nDigite o número da atividade que deseja executar (1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ou 0 para sair): ")) {
        case 0:
            echo "Saindo do programa...\n";
            exit;
        case 1:
            Atividade1();
            break;
        case 2:
            Atividade2();
            break;
        case 3:
            Atividade3();
            break;
        case 4:
            Atividade4();
            break;
        case 5:
            Atividade5();
            break;
        case 6:
            Atividade6();
            break;
        case 7:
            Atividade7();
            break;
        case 8:
            Atividade8();
            break;
        case 9:
            Atividade9();
            break;
        case 10:
            Atividade10();
            break;
        default:
            echo "Atividade inválida!\n";
        }
    }

?>
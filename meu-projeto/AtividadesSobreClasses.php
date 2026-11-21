<?php

require_once 'AtividadesSobreClasses.php';

/* 

Aluno: Lucas Castanheiro
Matrícula: 432574

Para seguir o padrão eu deixei na seguinte sequência:

function Atividade(){
    Código da atividade
}

    Por isso alguns códigos podem quebrar já que a variável já foi declarada em outra função, exemplo disso é a atidade n° 1,
na primeira chamada do switch case, a variável $Car1 é declarada e instanciada, mas na segunda chamada do switch case, 
a variável $Car1 já foi declarada e instanciada, então o código quebra.

    Se eu fosse arrumar todo o código teria que quebrar o padrão.

*/

function Atividade1(){

echo "\n ----------------------------- \n";
echo "Atividade N° 1 \n\n";

class Carro {

    public $Modelo;
    public $Cor;
    public $Ano;

    Function exibirInfo(){
    echo "\nModelo: $this->Modelo\n";
    echo "Cor: $this->Cor\n";
    echo "Ano: $this->Ano\n";
}

}

$Car1 = new Carro();
$Car1 -> Modelo = "Civic";
$Car1 -> Cor = "Preto";
$Car1 -> Ano = 2009;

$Car2 = new Carro();
$Car2 -> Modelo = "Punto";
$Car2 -> Cor = "Vermelho";
$Car2 -> Ano = 2012;

$Car1->exibirInfo();
$Car2->exibirInfo();

}

function Atividade2(){

echo "\n ----------------------------- \n";
echo "Atividade N° 2 \n\n";

Class Aluno{

    public $Aluno;
    Public $Curso;
    Public $Nota1;
    public $Nota2;
    public $Nota3;
    public $Media;

    function calcularMedia(){
        $this->Media = ($this->Nota1 + $this->Nota2 + $this->Nota3)/ 3;

        if ($this->Media >=7){
                echo "\nO Aluno $this->Aluno foi aprovado com média $this->Media\n";
        } 
        else {
            echo "\nO Aluno $this->Aluno foi reprovado com média $this->Media\n";
        }
    }

}

$Aluno1 = new Aluno();
$Aluno1 -> Aluno = readline("\nDigite o nome do aluno: ");
$Aluno1 -> Curso = readline("Digite o curso do aluno: ");
$Aluno1 -> Nota1 = readline("Digite a primeira nota do aluno: ");   
$Aluno1 -> Nota2 = readline("Digite a segunda nota do aluno: ");
$Aluno1 -> Nota3 = readline("Digite a terceira nota do aluno: ");

$Aluno1->calcularMedia();

}

function Atividade3(){

echo "\n ----------------------------- \n";
echo "Atividade N° 3 \n\n";

Class ContaBancaria{
    public $Titular;
    public $Saldo;    

    function Depositar(){
        echo("\nO saldo atual é de: $this->Saldo\n");

        $Deposito = readline("\nDigite o valor do depósito: ");
        $this->Saldo+= $Deposito;

        return("\nO saldo atual é de: $this->Saldo\n");
    }

        function Sacar(){
        echo("\nO saldo atual é de: $this->Saldo\n");

        $Saque = readline("\nDigite o valor do Saque: ");
        if($this->Saldo >= $Saque){
            $this->Saldo -= $Saque;
            echo "\nSaque realizado com sucesso!\n";
        }
        else{
            echo "\nSaldo insuficiente para saque!\n";
        }
        return("\nO saldo atual é de: $this->Saldo\n");
    }

}

$Conta1 = new ContaBancaria();
$Conta1 -> Titular = readline("\nDigite o nome do titular da conta: ");
$Conta1 -> Saldo = 100;

$Valor = readline("\nDigite a ação a ser realizada\n1 - Depoositar\n2 - Sacar \nDigite o número da ação: ");
    if($Valor == 1){
        echo $Conta1->Depositar();
    }
    else if ($Valor == 2){
        echo $Conta1->Sacar();
    }
    else{
        echo "\nAção inválida!\n";
    }

}

function Atividade4(){

echo "\n ----------------------------- \n";
echo "Atividade N° 4 \n\n";

class Calculadora{

    public $Valor1;
    public $Valor2;
    public $Operacao;

    Function calcular(){
        $this->Valor1 = readline("\nDigite o primeiro valor: ");
        $this->Operacao = readline("\nDigite a operação desejada (+, -, *, /): ");
        $this->Valor2 = readline("\nDigite o segundo valor: ");
    
            switch($this->Operacao) {
                case '+':
                    $resultado = $this->Valor1 + $this->Valor2;
                    echo("\nO resultado da adição é: $resultado\n");
                    break;
                case '-':
                    $resultado = $this->Valor1 - $this->Valor2;
                    echo("\nO resultado da subtração é: $resultado\n");
                    break;
                case '*':
                    $resultado = $this->Valor1 * $this->Valor2;
                    echo("\nO resultado da multiplicação é: $resultado\n");
                    break;
                case '/':
                    if ($this->Valor2 != 0) {
                        $resultado = $this->Valor1 / $this->Valor2;
                        echo "\nO resultado da divisão é: $resultado\n";
                    } 
                    else {
                        echo "\nErro: Divisão por zero não é permitida.\n";
                        return;
                    }
                    break;
                default:
                    echo "\nOperação inválida!\n";
                    return;
            }
    }
}

$calc1 = new Calculadora();
$calc1->calcular();

}

function Atividade5(){

echo "\n ----------------------------- \n";
echo "Atividade N° 5 \n\n";

class contatos{
            
    public $Nome;
    public $Telefone;
    public $Email;
    public array $ListaContatos = [];

    function AdicionarContato(){
        $this->ListaContatos[] = $this->Nome;
    }
    
    function ExibirContatos(){
        foreach ($this->ListaContatos as $contato) {
            echo "\nNome: $contato";
            echo "\nTelefone: $this->Telefone";
            echo "\nEmail: $this->Email\n";
        }
    }

}
    while (true) {
        $opcao = readline("\nDigite a ação a ser realizada\n1 - Adicionar contato\n2 - Exibir contatos\n3 - Sair\n\nDigite o número da ação: ");
        if ($opcao == 3) {
            break;
        }
        elseif ($opcao == 1) {
            $Contato1 = new contatos();
            $Contato1 -> Nome = readline("\nDigite o nome do contato: ");
            $Contato1 -> Telefone = readline("\nDigite o telefone do contato: ");
            $Contato1 -> Email = readline("\nDigite o email do contato: ");
            $Contato1 -> AdicionarContato();
            echo("\nContato adicionado com sucesso!\n");
        }
        else if ($opcao == 2) {
            $Contato1 -> ExibirContatos();
        }
        else {
            echo "\nAção inválida!\n";
        }
    }
}

function Atividade6(){

    echo "\n ----------------------------- \n";
    echo "Atividade N° 6 \n\n";

    class Retangulo {
        public $largura;
        public $altura;

        function calcularArea() {
            return $this->largura * $this->altura;
        }

        function calcularPerimetro() {
            return 2 * ($this->largura + $this->altura);
        }
    }

    $retangulo1 = new Retangulo();
    $retangulo1->largura = readline("\nDigite a largura do retângulo: ");
    $retangulo1->altura = readline("Digite a altura do retângulo: ");

    $area = $retangulo1->calcularArea();
    $perimetro = $retangulo1->calcularPerimetro();

    echo "\nÁrea do retângulo: $area\n";
    echo "Perímetro do retângulo: $perimetro\n";

}

function Atividade7(){

    echo "\n ----------------------------- \n";
    echo "Atividade N° 7 \n\n";

    class Funcionario {
        public $nome;
        public $salario;

        function reajustarSalario() {
            $porcentagem = readline("Digite a porcentagem de reajuste (ex: 10 para 10%): ");
            $aumento = $this->salario * ($porcentagem / 100);
            $this->salario += $aumento;
            
            echo "\nO novo salário do funcionário $this->nome é: $this->salario\n";
        }
    }

    $funcionario1 = new Funcionario();
    $funcionario1->nome = readline("\nDigite o nome do funcionário: ");
    $funcionario1->salario = readline("Digite o salário do funcionário: ");

    $funcionario1->reajustarSalario();

}

function Atividade8(){

    echo "\n ----------------------------- \n";
    echo "Atividade N° 8 \n\n";

    class Item {
        public $nome;
        public $preco;
    }

    class Carrinho {
        public array $Itens = [];

        function adicionarItem($novoItem) {
            $this->Itens[] = $novoItem;
            echo "\nItem adicionado com sucesso!\n";
        }

        function calcularTotal() {
            $total = 0;
            foreach ($this->Itens as $item) {
                $total += $item->preco;
            }
            echo "\nO valor total da compra é: $total\n";
        }
    }

    $carrinho1 = new Carrinho();

    while (true) {
        $opcao = readline("\nDigite a ação a ser realizada\n1 - Adicionar item\n2 - Calcular total e sair\n\nDigite o número da ação: ");
        
        if ($opcao == 1) {
            $novoItem = new Item();
            $novoItem->nome = readline("\nDigite o nome do item: ");
            $novoItem->preco = readline("Digite o preço do item: ");
            $carrinho1->adicionarItem($novoItem);
        } else if ($opcao == 2) {
            $carrinho1->calcularTotal();
            break;
        } else {
            echo "\nAção inválida!\n";
        }
    }

}

function Atividade9(){

    echo "\n ----------------------------- \n";
    echo "Atividade N° 9 \n\n";

    class Livro {
        public $titulo;
        public $autor;
        public $ano;

        function exibirInfo() {
            echo "\nLivro: $this->titulo | Autor: $this->autor | Ano: $this->ano";
        }
    }

    $listaLivros = [];

    while (true) {
        $opcao = readline("\nDigite a ação a ser realizada\n1 - Adicionar livro\n2 - Exibir livros após 2015 e sair\n\nDigite o número da ação: ");
        
        if ($opcao == 1) {
            $novoLivro = new Livro();
            $novoLivro->titulo = readline("\nDigite o título do livro: ");
            $novoLivro->autor = readline("Digite o autor do livro: ");
            $novoLivro->ano = readline("Digite o ano de publicação: ");
            $listaLivros[] = $novoLivro;
            echo "\nLivro adicionado com sucesso!\n";
        } else if ($opcao == 2) {
            echo "\nLivros publicados após 2015:\n";
            $encontrou = false;
            foreach ($listaLivros as $livro) {
                if ($livro->ano > 2015) {
                    $livro->exibirInfo();
                    $encontrou = true;
                }
            }
            if (!$encontrou) {
                echo "Nenhum livro publicado após 2015 foi encontrado.\n";
            }
            echo "\n";
            break;
        } else {
            echo "\nAção inválida!\n";
        }
    }

}

function Atividade10(){

    echo "\n ----------------------------- \n";
    echo "Atividade N° 10 \n\n";

    class ConversorTemperatura {
        public $temperatura;

        function converterParaFahrenheit() {
            $fahrenheit = ($this->temperatura * 1.8) + 32;
            echo "\n$this->temperatura °C equivalem a $fahrenheit °F\n";
        }

        function converterParaCelsius() {
            $celsius = ($this->temperatura - 32) / 1.8;
            echo "\n$this->temperatura °F equivalem a $celsius °C\n";
        }
    }

    $conversor1 = new ConversorTemperatura();
    
    while (true) {
        $opcao = readline("\nDigite a ação a ser realizada\n1 - Converter Celsius para Fahrenheit\n2 - Converter Fahrenheit para Celsius\n3 - Sair\n\nDigite o número da ação: ");
        
        if ($opcao == 3) {
            break;
        } else if ($opcao == 1) {
            $conversor1->temperatura = readline("\nDigite a temperatura em Celsius: ");
            $conversor1->converterParaFahrenheit();
        } else if ($opcao == 2) {
            $conversor1->temperatura = readline("\nDigite a temperatura em Fahrenheit: ");
            $conversor1->converterParaCelsius();
        } else {
            echo "\nAção inválida!\n";
        }
    }

}

while (true) {
    switch (readline("\nDigite o número da atividade que deseja executar (1, 2, 3 ,4 ,5 ,6 ,7 ,8 ,9 10 ou 0 para sair): ")) {
        case 0:
            echo "Saindo do programa...";
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
            echo "Atividade inválida!";
    }
}
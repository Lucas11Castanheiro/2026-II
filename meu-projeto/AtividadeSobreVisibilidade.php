<?php

/* 
Aluno: Lucas Castanheiro
Matrícula: 432574
*/

function Atividade1(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 1 \n\n";

    class Produto {
        public $nome;
        public $preco;
    }

    $produto = new Produto();
    $produto->nome = readline("Digite o nome do produto: ");
    $produto->preco = readline("Digite o preço do produto: ");

    echo "\nInformações do Produto:\n";
    echo "Nome: $produto->nome\n";
    echo "Preço: $produto->preco\n";
}

function Atividade2(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 2 \n\n";

    class ProdutoV2 {
        public $nome;
        private $preco;

        function setPreco($valor) {
            $this->preco = $valor;
        }

        function getPreco() {
            return $this->preco;
        }
    }

    $produto = new ProdutoV2();
    $produto->nome = readline("Digite o nome do produto: ");
    $valor = readline("Digite o preço do produto: ");
    
    $produto->setPreco($valor);

    echo "\nInformações do Produto:\n";
    echo "Nome: $produto->nome\n";
    echo "Preço (via getPreco): " . $produto->getPreco() . "\n";
}

function Atividade3(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 3 \n\n";

    class ContaBancariaV2 {
        private $saldo = 0;

        function depositar($valor) {
            $this->saldo += $valor;
            echo "\nDepósito de $valor realizado. Saldo atual: $this->saldo\n";
        }

        function sacar($valor) {
            $this->saldo -= $valor;
            echo "\nSaque de $valor realizado. Saldo atual: $this->saldo\n";
        }
    }

    $conta = new ContaBancariaV2();
    
    $conta->depositar(readline("Digite o valor para depósito: "));
    $conta->sacar(readline("Digite o valor para saque: "));
}

function Atividade4(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 4 \n\n";

    class FuncionarioV2 {
        protected $salario = 2000;
    }

    class Gerente extends FuncionarioV2 {
        function alterarSalario($novoSalario) {
            $this->salario = $novoSalario;
            echo "\nSalário alterado com sucesso!\n";
        }

        function exibirSalario() {
            echo "Salário atual (acesso ao protected): $this->salario\n";
        }
    }

    $gerente = new Gerente();
    $gerente->exibirSalario();
    $gerente->alterarSalario(readline("\nDigite o novo salário: "));
    $gerente->exibirSalario();
}

function Atividade5(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 5 \n\n";

    class Usuario {
        private $senha;

        function __construct($senhaInicial) {
            $this->senha = $senhaInicial;
        }

        function verificarSenha($senhaTeste) {
            return $this->senha === $senhaTeste;
        }
    }

    $senhaBase = readline("Defina a senha do usuário: ");
    $usuario = new Usuario($senhaBase);

    $senhaLogin = readline("\nDigite a senha para verificação: ");
    
    if ($usuario->verificarSenha($senhaLogin)) {
        echo "\nResultado: Verdadeiro. Acesso concedido.\n";
    } else {
        echo "\nResultado: Falso. Acesso negado.\n";
    }
}

function Atividade6(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 6 \n\n";

    class Config {
        protected array $parametros = [];
    }

    class AppConfig extends Config {
        function modificarParametro($chave, $valor) {
            $this->parametros[$chave] = $valor;
            echo "Parâmetro '$chave' ajustado para '$valor'.\n";
        }

        function lerParametros() {
            echo "\nListando Parâmetros:\n";
            foreach ($this->parametros as $chave => $valor) {
                echo "$chave => $valor\n";
            }
        }
    }

    $config = new AppConfig();
    $config->modificarParametro("tema", "escuro");
    $config->modificarParametro("idioma", "pt-BR");
    $config->lerParametros();
}

function Atividade7(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 7 \n\n";

    class Pedido {
        private array $itens = [];

        function inserirItem($item) {
            $this->itens[] = $item;
            echo "Item '$item' inserido.\n";
        }

        function listarItens() {
            echo "\nItens do pedido:\n";
            foreach ($this->itens as $indice => $item) {
                echo "- $item\n";
            }
        }
    }

    $pedido = new Pedido();
    while (true) {
        $acao = readline("\n1 - Inserir item\n2 - Listar e sair\nAção: ");
        if ($acao == 1) {
            $pedido->inserirItem(readline("Nome do item: "));
        } else if ($acao == 2) {
            $pedido->listarItens();
            break;
        } else {
            echo "Ação inválida.\n";
        }
    }
}

function Atividade8(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 8 \n\n";

    class Cliente {
        public $nome;
        protected $CPF;
        private $telefone;

        function setDadosInternos($nome, $cpf, $telefone) {
            $this->nome = $nome;
            $this->CPF = $cpf;
            $this->telefone = $telefone;
            echo "\n(Interno) Dados gravados com sucesso.\n";
            echo "Acesso interno: Nome: $this->nome, CPF: $this->CPF, Tel: $this->telefone\n";
        }
    }

    $cliente = new Cliente();
    $cliente->setDadosInternos("Lucas", "123.456.789-00", "9999-9999");

    echo "\nTestando acesso externo:\n";
    $cliente->nome = "Castanheiro"; 
    echo "Acesso Público (Nome): $cliente->nome (Sucesso)\n";

    echo "\nAcesso Protegido (CPF) causaria Fatal Error. Exemplo: \$cliente->CPF = '000';\n";
    echo "Acesso Privado (Telefone) causaria Fatal Error. Exemplo: \$cliente->telefone = '000';\n";
}

function Atividade9(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 9 \n\n";

    class ContaBancariaRefatorada {
        private $saldo = 0;

        function depositar($valor) {
            $this->saldo += $valor;
            echo "Depósito de $valor concluído.\n";
        }

        function sacar($valor) {
            if ($this->saldo >= $valor) {
                $this->saldo -= $valor;
                echo "Saque de $valor realizado. Saldo restante: $this->saldo\n";
            } else {
                echo "Erro: Saldo insuficiente para o saque de $valor. Saldo atual: $this->saldo\n";
            }
        }
    }

    $conta = new ContaBancariaRefatorada();
    $conta->depositar(500);
    $conta->sacar(readline("\nDigite um valor para saque (saldo de 500): "));
}

function Atividade10(){
    echo "\n ----------------------------- \n";
    echo "Atividade N° 10 \n\n";

    class ConexaoBD {
        private $conexaoAtiva = false;

        private function conectar() {
            $this->conexaoAtiva = true;
            return "Instância de Conexão PDO/MySQLi simulada";
        }

        public function getConexao() {
            if (!$this->conexaoAtiva) {
                echo "Iniciando conexão com o banco...\n";
                return $this->conectar();
            }
            return "Conexão já estava ativa.";
        }
    }

    $db = new ConexaoBD();
    echo "\nTentando obter conexão:\n";
    $conexao = $db->getConexao();
    echo "Retorno: $conexao\n";
    
    echo "\nTentando chamar o método privado conectar() externamente resultaria em Fatal Error.\n";
    echo "Exemplo bloqueado: \$db->conectar();\n";
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
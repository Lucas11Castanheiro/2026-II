<?php

/* 
Aluno: Lucas Castanheiro
Matrícula: 432574
*/

function Atividade1(){
    echo "------------------------------\n";
    echo "\tAtividade 1 - Animais\n";
    echo "------------------------------\n";

    class Animal {
        public function falar() {
            echo "O animal faz um som genérico.\n";
        }
    }

    class Cachorro extends Animal {
        public function falar() {
            echo "O cachorro late: Au au!\n";
        }
    }

    class Gato extends Animal {
        public function falar() {
            echo "O gato mia: Miau!\n";
        }
    }

    $animal = new Animal();
    $animal->falar();

    $dog = new Cachorro();
    $dog->falar();

    $cat = new Gato();
    $cat->falar();
}

function Atividade2(){
    echo "------------------------------\n";
    echo "\tAtividade 2 - Calculadora (Opcionais)\n";
    echo "------------------------------\n";

    class Calculadora {
        // Simulando sobrecarga com parâmetro opcional
        public function somar($a, $b, $c = 0) {
            $resultado = $a + $b + $c;
            echo "Resultado da soma: $resultado\n";
        }
    }

    $calc = new Calculadora();
    echo "Somando 2 parâmetros (5 + 10):\n";
    $calc->somar(5, 10);
    
    echo "Somando 3 parâmetros (5 + 10 + 15):\n";
    $calc->somar(5, 10, 15);
}

function Atividade3(){
    echo "------------------------------\n";
    echo "\tAtividade 3 - Pagamentos\n";
    echo "------------------------------\n";

    class Pagamento {
        public function processar() {
            echo "Processando pagamento genérico...\n";
        }
    }

    class Cartao extends Pagamento {
        public function processar() {
            echo "Processando pagamento via Cartão de Crédito...\n";
        }
    }

    class Pix extends Pagamento {
        public function processar() {
            echo "Processando pagamento instantâneo via PIX...\n";
        }
    }

    class Boleto extends Pagamento {
        public function processar() {
            echo "Gerando código de barras para pagamento via Boleto...\n";
        }
    }

    $pagamentos = [new Cartao(), new Pix(), new Boleto()];
    foreach ($pagamentos as $pag) {
        $pag->processar();
    }
}

function Atividade4(){
    echo "------------------------------\n";
    echo "\tAtividade 4 - Notificações\n";
    echo "------------------------------\n";

    class Notificacao {
        public function enviar() {
            echo "Enviando notificação padrão...\n";
        }
    }

    class Email extends Notificacao {
        public function enviar() {
            echo "Enviando e-mail pelo servidor SMTP...\n";
        }
    }

    class SMS extends Notificacao {
        public function enviar() {
            echo "Enviando SMS para o número do cliente...\n";
        }
    }

    class Push extends Notificacao {
        public function enviar() {
            echo "Enviando notificação Push para o smartphone...\n";
        }
    }

    $sms = new SMS();
    $sms->enviar();
    $email = new Email();
    $email->enviar();
}

function Atividade5(){
    echo "------------------------------\n";
    echo "\tAtividade 5 - Figuras Geométricas\n";
    echo "------------------------------\n";

    class FiguraGeometrica {
        public function calcularArea() {
            return 0;
        }
    }

    class Quadrado extends FiguraGeometrica {
        private $lado = 4;
        public function calcularArea() {
            return $this->lado * $this->lado;
        }
    }

    class Retangulo extends FiguraGeometrica {
        private $base = 5;
        private $altura = 10;
        public function calcularArea() {
            return $this->base * $this->altura;
        }
    }

    class Circulo extends FiguraGeometrica {
        private $raio = 3;
        public function calcularArea() {
            return 3.14 * ($this->raio * $this->raio);
        }
    }

    $q = new Quadrado();
    echo "Área do Quadrado: " . $q->calcularArea() . "\n";
    
    $r = new Retangulo();
    echo "Área do Retângulo: " . $r->calcularArea() . "\n";
}

function Atividade6(){
    echo "------------------------------\n";
    echo "\tAtividade 6 - Relatório (__call)\n";
    echo "------------------------------\n";

    class Relatorio {
        // Uso do método mágico para simular sobrecarga real
        public function __call($nomeMetodo, $argumentos) {
            if ($nomeMetodo === 'gerar') {
                $qtdParametros = count($argumentos);
                
                if ($qtdParametros == 1) {
                    echo "Gerando relatório do ano de {$argumentos[0]}.\n";
                } elseif ($qtdParametros == 2) {
                    echo "Gerando relatório do mês {$argumentos[0]} de {$argumentos[1]}.\n";
                } else {
                    echo "Método gerar() chamado sem parâmetros válidos.\n";
                }
            } else {
                echo "Método $nomeMetodo não existe.\n";
            }
        }
    }

    $relatorio = new Relatorio();
    $relatorio->gerar("2026");
    $relatorio->gerar("Outubro", "2026");
}

function Atividade7(){
    echo "------------------------------\n";
    echo "\tAtividade 7 - Veículos\n";
    echo "------------------------------\n";

    class Veiculo {
        public function mover() {
            echo "O veículo está se movendo.\n";
        }
    }

    class CarroAutomotor extends Veiculo {
        public function mover() {
            echo "O carro está acelerando nas quatro rodas pela rodovia.\n";
        }
    }

    class Bicicleta extends Veiculo {
        public function mover() {
            echo "A bicicleta está se movendo a pedaladas.\n";
        }
    }

    class Aviao extends Veiculo {
        public function mover() {
            echo "O avião está voando pelos ares.\n";
        }
    }

    $carro = new CarroAutomotor();
    $carro->mover();
    $aviao = new Aviao();
    $aviao->mover();
}

function Atividade8(){
    echo "------------------------------\n";
    echo "\tAtividade 8 - Impressora\n";
    echo "------------------------------\n";

    class Impressora {
        public function imprimir() {
            echo "Imprimindo arquivo...\n";
        }
    }

    class PDF extends Impressora {
        public function imprimir() {
            echo "Processando e imprimindo documento PDF de alta qualidade...\n";
        }
    }

    class Texto extends Impressora {
        public function imprimir() {
            echo "Imprimindo arquivo de texto puro (TXT) rapidamente...\n";
        }
    }

    class Imagem extends Impressora {
        public function imprimir() {
            echo "Imprimindo imagem com renderização de cores em HD...\n";
        }
    }

    $doc = new PDF();
    $doc->imprimir();
}

function Atividade9(){
    echo "------------------------------\n";
    echo "\tAtividade 9 - Formatação de Mensagem\n";
    echo "------------------------------\n";

    class Mensagem {
        public function formatar($texto) {
            return $texto;
        }
    }

    class Maiusculo extends Mensagem {
        public function formatar($texto) {
            return strtoupper($texto);
        }
    }

    class Minusculo extends Mensagem {
        public function formatar($texto) {
            return strtolower($texto);
        }
    }

    class Capitalizado extends Mensagem {
        public function formatar($texto) {
            return ucfirst(strtolower($texto));
        }
    }

    $textoBase = "olá MUNdo, TEstE de PHP!";
    
    $msg1 = new Maiusculo();
    echo "Maiúsculo: " . $msg1->formatar($textoBase) . "\n";
    
    $msg2 = new Capitalizado();
    echo "Capitalizado: " . $msg2->formatar($textoBase) . "\n";
}

function Atividade10(){
    echo "------------------------------\n";
    echo "\tAtividade 10 - Sistema de Transporte\n";
    echo "------------------------------\n";

    class Transporte {
        public function calcularTarifa() {
            return 0.0;
        }
    }

    class Onibus extends Transporte {
        public function calcularTarifa() {
            return 5.50; // Tarifa fixa comum
        }
    }

    class Metro extends Transporte {
        public function calcularTarifa() {
            return 6.00; // Tarifa do metrô
        }
    }

    class Taxi extends Transporte {
        private $kmRodados = 10;
        public function calcularTarifa() {
            $bandeirada = 8.00;
            return $bandeirada + ($this->kmRodados * 3.50); 
        }
    }

    $bus = new Onibus();
    echo "Tarifa Ônibus: R$" . $bus->calcularTarifa() . "\n";
    
    $taxi = new Taxi();
    echo "Tarifa Táxi (10km): R$" . $taxi->calcularTarifa() . "\n";
}

// Controlador Principal
while (true) {
    switch (readline("\nDigite o número da atividade que deseja executar (1 a 10 ou 0 para sair): ")) {
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
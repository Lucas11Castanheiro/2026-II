📚 Biblioteca ORM em PHP

Sistema desenvolvido em PHP orientado a objetos que implementa o padrão de projeto Repository (Mapeamento Objeto-Relacional / ORM simplificado) para o gerenciamento de Autores e Livros, garantindo a separação de responsabilidades entre a regra de negócio e a camada de persistência de dados.

🏗️ Arquitetura do Projeto

O projeto está organizado seguindo boas práticas de engenharia de software (Domain-Driven Design simplificado):

Biblioteca_ORM/
├── sql/
│   └── schema.sql                       # Script DDL para criação das tabelas no banco
└── src/
    ├── Domain/                          # Camada de Domínio (Entidades e Regras de Negócio)
    │   ├── Autor.php                    # Modelo representando a entidade Autor
    │   └── Livro.php                    # Modelo representando a entidade Livro
    ├── Infrastructure/                  # Camada de Infraestrutura (Banco de Dados e Persistência)
    │   ├── Conexao.php                  # Gerenciador de conexão PDO com o banco de dados
    │   ├── RepositoryInterface.php      # Contrato padrão para os repositórios
    │   ├── AbstractRepository.php       # Classe base com operações CRUD reutilizáveis
    │   ├── AutorRepository.php          # Repositório específico para persistência de Autores
    │   └── LivroRepository.php          # Repositório específico para persistência de Livros
    └── tests/                           # Camada de Testes
        └── smoke.php                    # Teste de fumaça (Smoke Test) para validar o fluxo geral


🛠️ Tecnologias e Conceitos Aplicados

Linguagem: PHP 8+

Banco de Dados: MySQL / MariaDB (via extensão PDO)

Pilares da POO:

Encapsulamento: Atributos protegidos/privados nas entidades (Autor e Livro) com métodos de acesso e validação.

Herança: Reaproveitamento de código através da classe abstrata AbstractRepository.

Abstração & Polimorfismo: Implementação de contratos rígidos via RepositoryInterface.

Padrões de Projeto: Repository Pattern e Singleton/Factory (na conexão).

⚙️ Pré-requisitos

Para executar este projeto localmente, você precisará de:

PHP (versão 8.0 ou superior) instalado e configurado no PATH do sistema, com a extensão pdo_mysql habilitada.

Servidor de Banco de Dados (MySQL ou MariaDB) ativo (ex: XAMPP, Laragon, Docker ou serviço nativo).

🚀 Como Configurar e Executar

1. Configuração do Banco de Dados

Acesse seu gerenciador de banco de dados (phpMyAdmin, DBeaver, MySQL Workbench ou terminal).

Crie um banco de dados para o projeto (ex: biblioteca_orm).

Importe ou execute o script localizado em sql/schema.sql para criar a estrutura de tabelas necessária.

2. Configuração da Conexão

Abra o arquivo src/Infrastructure/Conexao.php e ajuste as credenciais de acesso (host, nome do banco, usuário e senha) de acordo com o seu ambiente local.

3. Executando os Testes

O projeto conta com um script de Smoke Test para verificar se a conexão com o banco, a criação de objetos e as operações de escrita/leitura estão funcionando corretamente.

Abra o terminal na raiz do projeto e execute:

php src/tests/smoke.php


👨‍💻 Autor

Lucas Castanheiro – Ciência da Computação (UNOESC)

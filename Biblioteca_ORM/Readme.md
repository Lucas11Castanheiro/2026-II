# BibliotecaORM — PHP puro + MySQL

Trabalho prático da disciplina de **Programação II** — Ciência da Computação (UNOESC).  
**Professor:** Leandro Otavio Cordova Vieira  
**Aluno:** Lucas Castanheiro  

Implementação didática de um mini-ORM (Data Mapper simplificado) utilizando PHP 8.2+ puro e MySQL 8 (InnoDB), sem uso de frameworks ou ORMs de terceiros.

## Estrutura do Projeto
- `.env.example`: Modelo para configuração de variáveis de ambiente sem expor senhas reais (R10).
- `sql/schema.sql`: Script DDL para criação do banco e tabelas (`livros`, `autores`, `livros_autores`, `exemplares`) (R1).
- `sql/seed.sql`: Dados de exemplo com livros, autores, coautorias N:N e exemplares.
- `src/Domain/`: Entidades `Livro` e `Autor` encapsuladas com propriedades privadas, validações e identificadores protegidos (R2, R8).
- `src/Infrastructure/`:
  - `RepositoryInterface.php`: Contrato para os repositórios (R3).
  - `AbstractRepository.php`: Classe abstrata com operações CRUD reutilizáveis (R4).
  - `AutorRepository.php` e `LivroRepository.php`: Repositórios concretos com hidratação e relacionamento N:N (R6, R7, R8).
  - `Conexao.php`: Gerenciador de conexão PDO com leitura de variáveis de ambiente ou `.env` (R9, R10).
- `tests/smoke.php`: Script de testes reproduzíveis demonstrando todas as 7 evidências solicitadas pelo professor.
- `docs/`: Relatório técnico em PDF solicitado na entrega (Seção 5).

## Requisitos
- PHP 8.2 ou superior com a extensão `pdo_mysql` habilitada.
- Servidor MySQL 8 em execução.

## Como Executar
1. Crie o banco de dados e as tabelas executando o script SQL:
   ```sql
   SOURCE sql/schema.sql;
   ```
2. (Opcional) Popule o banco com dados de teste:
   ```sql
   SOURCE sql/seed.sql;
   ```
3. Configure o arquivo `.env` com suas credenciais do MySQL (baseie-se no `.env.example`).
4. Execute o script de teste e demonstração:
   ```bash
   php -d zend.assertions=1 -d assert.exception=1 tests/smoke.php
   ```
=======
O projeto está organizado seguindo boas práticas de engenharia de software (Domain-Driven Design simplificado):
```
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

```

## Limitações Didáticas
Conforme o escopo da disciplina, a implementação não utiliza reflection, lazy loading, identity map nem controle de concorrência. Os relacionamentos N:N são carregados e manipulados explicitamente.

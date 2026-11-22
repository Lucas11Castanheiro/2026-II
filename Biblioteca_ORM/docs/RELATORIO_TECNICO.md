# Relatório Técnico — BibliotecaORM

**UNIVERSIDADE DO OESTE DE SANTA CATARINA – UNOESC**  
**Curso:** Ciência da Computação | **Disciplina:** Programação II  
**Professor:** Leandro Otavio Cordova Vieira  
**Aluno:** Lucas Castanheiro  

---

## 1. Objetivo do Trabalho
O trabalho consiste no desenvolvimento de uma biblioteca própria de mapeamento objeto-relacional (mini-ORM didático) denominada **BibliotecaORM**, em PHP puro e MySQL, sem uso de ORMs de terceiros. O foco é aplicar os conceitos de encapsulamento, herança, polimorfismo, interfaces e persistência via PDO com transações.

---

## 2. Decisões Arquiteturais
- **Data Mapper Simplificado:** Separação clara entre a camada de Domínio (`src/Domain`) e Infraestrutura (`src/Infrastructure`). As entidades (`Livro` e `Autor`) não possuem comandos SQL nem conhecem a conexão com o banco de dados.
- **Classe Abstrata (`AbstractRepository`):** Reutilização de código para operações CRUD básicas (`buscar`, `listar`, `salvar`, `excluir`). O método `salvar()` decide automaticamente entre `INSERT` e `UPDATE` verificando se o objeto possui ou não um identificador atribuído.
- **Interface e Polimorfismo (`RepositoryInterface`):** Define o contrato de repositório, permitindo que funções e serviços recebam a interface e operem de forma intercambiável sobre `LivroRepository` e `AutorRepository`.
- **Relacionamento N:N:** A associação entre livros e autores é persistida na tabela associativa `livros_autores`. Na entidade `Livro`, a coleção de autores é representada por um array de objetos, garantindo que não ocorram duplicatas no carregamento.
- **Segurança e Transações:** Uso obrigatório de prepared statements com parâmetros nomeados contra SQL Injection e suporte a transações PDO com rollback para garantir atomicidade.

---

## 3. Diagrama de Classes

```
          +----------------------------------+
          | <<interface>>                    |
          | RepositoryInterface              |
          +----------------------------------+
          | + buscar(id: int): ?object       |
          | + listar(): array                |
          | + salvar(entidade: object): void |
          | + excluir(id: int): void         |
          +----------------------------------+
                           ^
                           | implements
          +----------------------------------+
          | <<abstract>>                     |
          | AbstractRepository               |
          +----------------------------------+
          | # pdo: PDO                       |
          +----------------------------------+
          | + buscar(id: int): ?object       |
          | + listar(): array                |
          | + salvar(entidade: object): void |
          | + excluir(id: int): void         |
          | # {abstract} tabela(): string    |
          | # {abstract} colunas(): array    |
          | # {abstract} hidratar(): object  |
          | # {abstract} extrair(): array    |
          +----------------------------------+
                ^                       ^
                |                       |
+-------------------------------+ +-------------------------------+
| LivroRepository               | | AutorRepository               |
+-------------------------------+ +-------------------------------+
| + autoresDoLivro(id): array   | +-------------------------------+
| + associarAutor(l, a): void   |
+-------------------------------+

          +-----------------------+           +-----------------------+
          | Livro                 | 1       * | Autor                 |
          +-----------------------+-----------+-----------------------+
          | - id: ?int            |           | - id: ?int            |
          | - titulo: string      |           | - nome: string        |
          | - isbn: ?string       |           | - nacionalidade: ?str |
          | - anoPublicacao: ?int |           +-----------------------+
          | - autores: Autor[]    |           | + id(): ?int          |
          +-----------------------+           | + atribuirId(id): void|
          | + id(): ?int          |           | + nome(): string      |
          | + atribuirId(id): void|           | + nacionalidade(): str|
          | + alterarTitulo(t): vd|           +-----------------------+
          | + adicionarAutor(a):vd|
          | + autores(): array    |
          +-----------------------+
```

---

## 4. Evidências de Execução
O script `tests/smoke.php` demonstra e valida todas as 7 evidências solicitadas:
1. **Cadastro de Livro e Autor:** Entidades salvas no banco com identificadores gerados automaticamente pelo MySQL (`AUTO_INCREMENT`).
2. **Busca por ID:** Recuperação do registro e hidratação do objeto `Livro` com todas as propriedades preservadas.
3. **Atualização (UPDATE):** Alteração de título no objeto e persistência comprovada por nova consulta ao banco.
4. **Associação N:N de 2 Autores:** Vínculo de dois autores ao mesmo livro na tabela associativa e recuperação da coleção sem duplicações.
5. **Polimorfismo:** Função `buscarPolimorfico(RepositoryInterface $repo, int $id)` opera uniformemente sobre ambos os repositórios.
6. **Transação e Rollback:** Cadastro atômico com simulação de erro de FK proposital e reversão com `$pdo->rollBack()`, comprovando que o livro não permaneceu no banco.
7. **Exclusão Controlada e Restrição de FK:** O banco bloqueia a exclusão direta do livro devido às restrições de chave estrangeira em `livros_autores`. Demonstração da exclusão controlada removendo vínculos previamente.

---

## 5. Limitações Conhecidas
- A biblioteca não possui lazy loading automático (os autores são carregados explicitamente).
- Não há controle de concorrência otimista via coluna de versão.
- A exclusão em cascata não é automática no banco, exigindo remoção prévia na tabela associativa.

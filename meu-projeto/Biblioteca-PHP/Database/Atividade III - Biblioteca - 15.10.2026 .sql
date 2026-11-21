USE biblioteca;

-- Exercícios 1 e 2: estrutura e integridade

-- Ex. 1: Inspecionar
-- Chaves primárias: autor.id e livro.id.
-- A coluna livro.id_autor existe e o seu tipo é INT.

-- Ex. 2: Relacionar

-- ALTER TABLE livro ADD CONSTRAINT fk_livro_autor FOREIGN KEY (id_autor) REFERENCES autor(id);
-- A tabela livro já tem uma FK com o id_autor quando criei

-- Teste de referência inexistente
INSERT INTO livro (titulo, isbn, preco, quantidade, id_autor) VALUES ('Livro Teste FK', '0000000000000', 50, 10, 999);
-- Resultado: A execução falha. A FOREIGN KEY verifica a tabela 'autor' e bloqueia a inserção porque o ID 999 não existe, garantindo a integridade referencial.

-- Ex. 3: Cadastrar registros de teste

-- Autor sem livros
INSERT INTO autor (nome, nacionalidade) VALUES ('Autor Sem Livros', 'Brasileiro');
-- Livro sem autor 
INSERT INTO livro (titulo, isbn, preco, quantidade, id_autor) VALUES ('Livro Sem Autor', '1111111111111', 45, 5, NULL);

-- Ex. 4: Use INNER JOIN
SELECT livro.titulo, autor.nome
FROM livro
INNER JOIN autor ON livro.id_autor = autor.id
ORDER BY autor.nome ASC, livro.titulo ASC;

-- Ex. 5: Use LEFT JOIN
SELECT autor.nome, livro.titulo
FROM autor
LEFT JOIN livro ON autor.id = livro.id_autor;
-- Explicação dos NULL: O LEFT JOIN lista 100% dos registros da tabela da esquerda (autor). 
-- Quando um autor não possui livros associados, o banco preenche o espaço correspondente à tabela da direita com NULL.

-- Ex. 6: Reescreva com RIGHT JOIN
SELECT autor.nome, livro.titulo
FROM livro
RIGHT JOIN autor ON livro.id_autor = autor.id;
-- Comparação: O resultado é idêntico ao do exercício 5. Como foi mudada a ordem das tabelas no código e usei RIGHT JOIN, 
-- a tabela autor continua mandando na consulta.

-- Ex. 7: Localize livros sem autor
SELECT titulo 
FROM livro
WHERE id_autor IS NULL;
-- Explicação: Um campo NULL indica que a informação foi deixada em branco. Uma referência inválida (como no Ex 2) 
-- é uma tentativa de inserir um dado falso (um ID que não existe), o que é "barrado" pelo banco.

-- Ex. 8: Conte livros por autor
SELECT autor.nome, COUNT(livro.id) AS total_livros
FROM autor
LEFT JOIN livro ON autor.id = livro.id_autor
GROUP BY autor.id, autor.nome;
-- Desafio: Se eu usasse COUNT(*), o banco contaria a linha vazia gerada pelo LEFT JOIN e diria que o autor sem livro tem 1 livro. 
-- Usando COUNT(livro.id), ele olha para a coluna, vê que é NULL e retorna 0.

-- Ex. 9: Filtrar grupos
SELECT autor.nome, COUNT(livro.id) AS total_livros
FROM autor
INNER JOIN livro ON autor.id = livro.id_autor
GROUP BY autor.id, autor.nome
HAVING COUNT(livro.id) > 1;

-- Ex. 10: Integrar
SELECT 
    autor.nome, 
    COUNT(livro.id) AS quantidade_titulos, 
    SUM(livro.quantidade) AS total_exemplares, 
    SUM(livro.preco * livro.quantidade) AS valor_estoque
FROM autor
LEFT JOIN livro ON autor.id = livro.id_autor
GROUP BY autor.id, autor.nome
ORDER BY valor_estoque DESC;
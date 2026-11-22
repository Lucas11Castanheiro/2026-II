-- Script de carga inicial de dados (Seed) para o banco biblioteca_orm
USE biblioteca_orm;

-- Limpeza prévia para permitir reexecuções sem conflito de chaves
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE exemplares;
TRUNCATE TABLE livros_autores;
TRUNCATE TABLE livros;
TRUNCATE TABLE autores;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Inserção de Autores
INSERT INTO autores (id, nome, nacionalidade) VALUES
(1, 'Martin Fowler', 'Reino Unido'),
(2, 'Robert C. Martin', 'Estados Unidos'),
(3, 'Kent Beck', 'Estados Unidos'),
(4, 'Erich Gamma', 'Suíça'),
(5, 'Richard Helm', 'Holanda'),
(6, 'Ralph Johnson', 'Estados Unidos'),
(7, 'John Vlissides', 'Estados Unidos'),
(8, 'Andrew S. Tanenbaum', 'Holanda'),
(9, 'Thomas H. Cormen', 'Estados Unidos'),
(10, 'Donald E. Knuth', 'Estados Unidos');

-- 2. Inserção de Livros
INSERT INTO livros (id, titulo, isbn, ano_publicacao) VALUES
(1, 'Patterns of Enterprise Application Architecture', '9780321127426', 2002),
(2, 'Refactoring: Improving the Design of Existing Code', '9780201485677', 1999),
(3, 'Clean Code: A Handbook of Agile Software Craftsmanship', '9780132350884', 2008),
(4, 'Design Patterns: Elements of Reusable Object-Oriented Software', '9780201633610', 1994),
(5, 'Test Driven Development: By Example', '9780321146533', 2002),
(6, 'Sistemas Operacionais Modernos', '9788576052371', 2010),
(7, 'Algoritmos: Teoria e Prática', '9788535236996', 2012),
(8, 'The Art of Computer Programming, Vol. 1', '9780201896831', 1997);

-- 3. Inserção de Vínculos N:N (Livros e Autores)
INSERT INTO livros_autores (livro_id, autor_id) VALUES
(1, 1), -- Fowler -> PoEAA
(2, 1), -- Fowler -> Refactoring
(2, 3), -- Beck -> Refactoring (co-autor)
(3, 2), -- Uncle Bob -> Clean Code
(4, 4), -- Gamma -> Design Patterns (GoF)
(4, 5), -- Helm -> Design Patterns (GoF)
(4, 6), -- Johnson -> Design Patterns (GoF)
(4, 7), -- Vlissides -> Design Patterns (GoF)
(5, 3), -- Beck -> TDD
(6, 8), -- Tanenbaum -> Sistemas Operacionais
(7, 9), -- Cormen -> Algoritmos
(8, 10); -- Knuth -> Art of Computer Programming

-- 4. Inserção de Exemplares Físicos (1:N)
INSERT INTO exemplares (livro_id, codigo_patrimonio, status) VALUES
(1, 'PAT-0001', 'disponivel'),
(1, 'PAT-0002', 'emprestado'),
(2, 'PAT-0003', 'disponivel'),
(3, 'PAT-0004', 'disponivel'),
(3, 'PAT-0005', 'emprestado'),
(4, 'PAT-0006', 'disponivel'),
(4, 'PAT-0007', 'disponivel'),
(4, 'PAT-0008', 'manutencao'),
(5, 'PAT-0009', 'disponivel'),
(6, 'PAT-0010', 'disponivel'),
(7, 'PAT-0011', 'emprestado'),
(8, 'PAT-0012', 'disponivel');

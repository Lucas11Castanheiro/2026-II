-- Criar e selecionar biblioteca

CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;

-- Criado a tabela autor
CREATE TABLE autor (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL ,
    nome VARCHAR(100) NOT NULL,
    nacionalidade VARCHAR(100)
);

-- Criado a tabela livro 
CREATE TABLE livro (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    isbn VARCHAR(20) NOT NULL UNIQUE,
    id_autor INT NOT NULL,
    ano_publicacao DATE ,
    preco INT NOT NULL,
    quantidade INT NOT NULL,
    CONSTRAINT fk_livro_autor 
		FOREIGN KEY (id_autor) 
		REFERENCES autor(id)
);

-- 05 Inserir pelo menos 5 autores e 10 livros
INSERT INTO autor (nome , nacionalidade) VALUES
('Machado de Assis','Brasileiro'),
('J.R.R. Tolkien', 'Espanhol'),
('J.K. Rowling', ' Porto Riquenho'),
('George R.R. Martin', ' Inglês'),
('Agatha Christie', 'Alemã');

INSERT INTO livro (titulo, isbn, preco, quantidade, id_autor, ano_publicacao) VALUES
('Dom Casmurro', '9788508153619', 90, 250, 1, '1899-01-01'),
('Memórias Póstumas de Brás Cubas', '9788525055532', 74, 300, 2, '1881-01-01 '),
('O Senhor dos Anéis: A Sociedade do Anel', '9788533613379', 109, 500, 3, '1954-07-29'),
('O Hobbit', '9788533615540', 110, 1200, 4, '1937-09-21'),
('Harry Potter e a Pedra Filosofal', '9788532511010', 89, 160, 5, '1997-06-26 '),
('Harry Potter e a Câmara Secreta', '9788532511669', 89, 130, 5, '1998-07-02 '),
('A Guerra dos Tronos', '9788556510785', 49, 90, 4, '1996-08-01 '),
('A Fúria dos Reis', '9788556510792', 55, 100, 3, '1998-11-16 '),
('Assassinato no Expresso do Oriente', '9788525424529', 55, 50, 2, '1934-01-01 '),
('E Não Sobrou Nenhum', '9788525424536', 55, 85, 1, '1939-11-06');

-- Consulta com JOIN para mostrar dados correlacionados e ordenando o nome do autor de maneira ascendente
SELECT livro.titulo, livro.isbn, autor.nome
	FROM livro 
	INNER JOIN autor ON livro.id_autor = autor.id
	ORDER BY autor.nome ASC ;

SELECT * FROM LIVRO;

-- Atualização de um registo
UPDATE livro
	SET titulo = 'O Hobbit - Edição Especial'
	WHERE isbn = '9788533615540';

UPDATE livro
	SET ano_publicacao = NULL
	WHERE ID = 8;

-- Exclusão de um registo
DELETE FROM livro
	WHERE id = 10;

INSERT INTO LIVRO (titulo, isbn, preco, quantidade ,id_autor) VALUES
	('Diário de um banan', '978852542481', 50.5, 100, 2);
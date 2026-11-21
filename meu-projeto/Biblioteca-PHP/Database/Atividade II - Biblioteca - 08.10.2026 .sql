USE biblioteca;

SHOW TABLES;
DESCRIBE livro;
SELECT * FROM livro;

SELECT titulo, preco
  FROM livro
	WHERE preco >= 80
	ORDER BY preco DESC
	LIMIT 3;

-- RESOLUÇÃO 1

-- Apresente titulo, ano_publicacao e preco dos livros
-- com preço superior a R$ 80,00, do mais caro ao mais
-- barato.

SELECT titulo,ano_publicacao, preco
 FROM livro
	WHERE preco >= 80
    ORDER BY preco DESC;
    
-- RESOLUÇÃO 2

-- Recupere os três livros mais recentes com preço entre
-- R$ 50,00 e R$ 150,00; em empate no ano, ordene pelo
-- título

SELECT titulo,ano_publicacao, preco
 FROM livro
    WHERE preco BETWEEN 50 AND 150
    ORDER BY ano_publicacao DESC ,preco ASC
    LIMIT 3;
    
-- RESOLUÇÃO 3

-- Liste, sem repetições, os anos de publicação, excluindo
-- nulos, do mais antigo ao mais recente.

SELECT DISTINCT ANO_PUBLICACAO
	FROM LIVRO
    WHERE ANO_PUBLICACAO IS NOT NULL
    ORDER BY ANO_PUBLICACAO DESC;

-- RESOLUÇÃO 4

-- Escreva três consultas de contagem: 
-- (a) todos os livros;
-- (b) com ano informado; 
-- (c) anos distintos. 
-- Explique a diferença entre COUNT(*) e COUNT(coluna).

SELECT COUNT(*) AS TOTAL_LIVROS FROM LIVRO;
SELECT COUNT(ano_PUBLICACAO) AS TODOS_DATA_LIVROS FROM LIVRO;
SELECT COUNT(DISTINCT ANO_PUBLICACAO) AS DATAS_DISTINTAS FROM LIVRO;

-- O COUNT(*) conta o total de itens dentro da tabela 
-- enquanto o COUNT(coluna) seleciona apenas o número de itens com tal atributo não nulo

-- -------------------------------------------------------------------------------- --

-- RESOLUÇÃO 5

-- Calcule, na mesma consulta, o total de exemplares e o
-- valor financeiro total estimado (preco * quantidade).

SELECT 
    SUM(quantidade) AS total_exemplares_geral,
    SUM(preco * quantidade) AS valor_financeiro_total
FROM livro;

-- RESOLUÇÃO 6

-- Apresente o preço médio com duas casas decimais, o
-- menor e o maior preço.

SELECT 
    ROUND(AVG(preco), 2) AS preco_medio,
    MIN(preco) AS menor_preco,
    MAX(preco) AS maior_preco
FROM livro;

-- RESOLUÇÃO 7

-- Relatório com ano_publicacao, quantidade de títulos e
-- total de exemplares por ano, ordenado pelo ano.

SELECT 
    ano_publicacao,
    COUNT(id) AS qtd_titulos,
    SUM(quantidade) AS total_exemplares
FROM livro
GROUP BY ano_publicacao
ORDER BY ano_publicacao;
    
-- RESOLUÇÃO 8

-- Adapte o relatório para anos com pelo menos dois
-- títulos e explique por que HAVING é apropriado.

SELECT 
    ano_publicacao,
    COUNT(id) AS qtd_titulos,
    SUM(quantidade) AS total_exemplares
FROM livro
GROUP BY ano_publicacao
HAVING COUNT(id) >= 2
ORDER BY ano_publicacao;

-- RESOLUÇÃO 9

-- Exiba o título original, em maiúsculas, o número de
-- caracteres e o preço com reajuste hipotético de 8%,
-- com duas casas decimais, sem alterar os registros.

SELECT 
    titulo AS titulo_original,
    UPPER(titulo) AS titulo_maiusculo,
    CHAR_LENGTH(titulo) AS num_caracteres,
    preco AS preco_original,
    ROUND(preco * 1.08, 2) AS preco_reajustado
FROM livro;

-- RESOLUÇÃO 10

-- Para cada ano: quantidade de títulos, preço médio e
-- valor total estimado do estoque. Considere apenas 
-- livros com quantidade positiva, anos com pelo menos
-- dois títulos, ordenados pelo maior valor de estoque.

SELECT 
    ano_publicacao,
    COUNT(id) AS qtd_titulos,
    ROUND(AVG(preco), 2) AS preco_medio,
    SUM(preco * quantidade) AS valor_estoque
FROM livro
WHERE quantidade > 0
GROUP BY ano_publicacao
HAVING COUNT(id) >= 2
ORDER BY valor_estoque DESC;
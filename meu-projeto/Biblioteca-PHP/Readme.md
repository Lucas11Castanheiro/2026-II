Projeto Biblioteca (PHP + MySQL)

Diferença entre PDO, Repository e ORM

PDO: É a ponte de comunicação do PHP. A sua função é fazer a ligação com o MySQL e executar as instruções.   

Repository: É uma estratégia de organização de código. Em vez de deixar o SQL misturado com as regras de negócio ou telas, nós isolamos todas as operações de base de dados numa classe específica.   

Então, por que juntos eles não são um ORM (Object-Relational Mapping)?Porque em um ORM real, existe uma ferramenta que faz o trabalho pesado, ela mapeia automaticamente as propriedades da nossa classe (como os atributos do Livro) diretamente para as colunas da tabela no banco, gerando o SQL por baixo dos panos. Na nossa estrutura, nós usamos o PDO e o Repository para manter o projeto organizado, mas o controle continua sendo 100% manual: ainda somos nós que escrevemos os comandos SELECT e INSERT à mão e passamos os parâmetros um a um no código.
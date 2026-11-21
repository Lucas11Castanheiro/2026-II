<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../src/Model/Livro.php';
require_once __DIR__ . '/../src/Repository/LivroRepository.php';

putenv('DB_USER=root'); 
putenv('DB_PASSWORD=Lucas010905'); 

echo "<pre>";
echo "=== Verificação do Ambiente ===\n";
echo 'Versão do PHP: ' . phpversion() . "\n";
echo 'Drivers PDO: ' . implode(', ', PDO::getAvailableDrivers()) . "\n\n";

try {
    $pdo = Database::conectar();
    $repo = new LivroRepository($pdo);
    
    echo "Conexão MySQL estabelecida.\n\n";

    // Ex. 06: Buscar um livro por ID (Exemplo com ID inexistente)
    $id_pesquisa = 999;
    $livro = $repo->buscarPorId($id_pesquisa);
    if ($livro === null) {
        echo "Aviso: O livro pesquisado com ID {$id_pesquisa} não existe.\n\n";
    }

    // Ex. 07: Cadastrar um novo livro (Usando id_autor = 1, Machado de Assis)
    // O try/catch interno evita quebrar a tela se você der F5 e tentar inserir o mesmo ISBN único novamente
    try {
        $repo->cadastrar('O Alienista', '9781234567890', 1, 45, 100, '1882-01-01');
        echo "Novo livro 'O Alienista' cadastrado com sucesso!\n\n";
    } catch (PDOException $e) {
        echo "Aviso: O livro de teste já foi cadastrado anteriormente.\n\n";
    }

    // Ex. 05: Listar e exibir todos os livros em ordem alfabética
    $lista = $repo->listar();
    echo "Total de livros cadastrados: " . count($lista) . "\n";
    echo "--- Lista de Livros ---\n";
    foreach ($lista as $item) {
        echo "- " . $item['titulo'] . " (Preço: " . $item['preco'] . ")\n";
    }

} catch (PDOException $e) {
    error_log($e->getMessage());
    echo 'Erro: Não foi possível acessar os dados da biblioteca.';
}
echo "</pre>";
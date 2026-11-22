<?php
/**
 * Teste e demonstração das 7 evidências de execução da Avaliação Prática.
 * Execução: php -d zend.assertions=1 -d assert.exception=1 tests/smoke.php
 */
declare(strict_types=1);

require_once dirname(__DIR__) . '/src/Domain/Autor.php';
require_once dirname(__DIR__) . '/src/Domain/Livro.php';
require_once dirname(__DIR__) . '/src/Infrastructure/RepositoryInterface.php';
require_once dirname(__DIR__) . '/src/Infrastructure/AbstractRepository.php';
require_once dirname(__DIR__) . '/src/Infrastructure/AutorRepository.php';
require_once dirname(__DIR__) . '/src/Infrastructure/LivroRepository.php';
require_once dirname(__DIR__) . '/src/Infrastructure/Conexao.php';

use Biblioteca\Domain\Livro;
use Biblioteca\Domain\Autor;
use Biblioteca\Infrastructure\Conexao;
use Biblioteca\Infrastructure\LivroRepository;
use Biblioteca\Infrastructure\AutorRepository;
use Biblioteca\Infrastructure\RepositoryInterface;

// Função polimórfica: opera unicamente via contrato RepositoryInterface (R5 / Evidência 5)
function buscarPolimorfico(RepositoryInterface $repo, int $id): ?object
{
    return $repo->buscar($id);
}

$pdo = Conexao::abrir();
$livros = new LivroRepository($pdo);
$autores = new AutorRepository($pdo);
$tag = bin2hex(random_bytes(3));

echo "=== DEMONSTRACAO DAS EVIDENCIAS EXIGIDAS ===\n\n";

// 1. Cadastro de Livro e Autor, com identificadores gerados pelo MySQL
$autor1 = new Autor('Autor 1 ' . $tag, 'Brasil');
$autor2 = new Autor('Autor 2 ' . $tag, 'Portugal');
$autores->salvar($autor1);
$autores->salvar($autor2);

$livro = new Livro('Livro Teste ' . $tag, '1234567890123', 2026);
$livros->salvar($livro);

assert($autor1->id() !== null && $autor2->id() !== null && $livro->id() !== null);
echo "1. Cadastro OK: Autor ID {$autor1->id()}, Autor ID {$autor2->id()}, Livro ID {$livro->id()}\n";

// 2. Busca de Livro por ID e reconstrução de suas propriedades
$recuperado = $livros->buscar($livro->id());
assert($recuperado instanceof Livro);
assert($recuperado->titulo() === 'Livro Teste ' . $tag);
echo "2. Busca por ID e reconstrucao OK: '{$recuperado->titulo()}', ano {$recuperado->anoPublicacao()}\n";

// 3. Atualização e nova consulta comprovando a alteração
$recuperado->alterarTitulo('Livro Atualizado ' . $tag);
$livros->salvar($recuperado);
$consultado = $livros->buscar($livro->id());
assert($consultado->titulo() === 'Livro Atualizado ' . $tag);
echo "3. Atualizacao e consulta OK: Novo titulo '{$consultado->titulo()}'\n";

// 4. Associação de dois autores a um livro e recuperação da coleção
$livros->associarAutor($livro->id(), $autor1->id());
$livros->associarAutor($livro->id(), $autor2->id());

foreach ($livros->autoresDoLivro($livro->id()) as $autor) {
    $consultado->adicionarAutor($autor);
}
assert(count($consultado->autores()) === 2);
echo "4. Associacao de 2 autores OK: " . count($consultado->autores()) . " autores na colecao (sem duplicatas)\n";

// 5. Demonstração polimórfica utilizando o mesmo contrato para LivroRepository e AutorRepository
$itemLivro = buscarPolimorfico($livros, $livro->id());
$itemAutor = buscarPolimorfico($autores, $autor1->id());
assert($itemLivro instanceof Livro && $itemAutor instanceof Autor);
echo "5. Polimorfismo OK: buscarPolimorfico() consultou Livro e Autor via RepositoryInterface\n";

// 6. Demonstração de erro intencional em transação e rollback
$pdo->beginTransaction();
$livroTemp = new Livro('Livro Rollback ' . $tag, null, 2026);
$livros->salvar($livroTemp);
$tempId = $livroTemp->id();

try {
    // Força erro com autor inexistente (violação de FK no MySQL)
    $livros->associarAutor($tempId, 999999);
    $pdo->commit();
} catch (\Throwable $e) {
    $pdo->rollBack();
    echo "6. Transacao e rollback OK: Erro intencional gerado, rollback desfez o livro {$tempId}\n";
}
assert($livros->buscar($tempId) === null);

// 7. Exclusão controlada e explicação sobre restrições de chave estrangeira
// Explicação: Sem ON DELETE CASCADE na tabela livros_autores, o banco bloqueia a exclusão direta do livro
try {
    $livros->excluir($livro->id());
} catch (\PDOException $e) {
    echo "7. Restricao de FK OK: Banco bloqueou exclusao direta do livro devido a chave estrangeira em livros_autores\n";
}

// Exclusão controlada: remove vínculos primeiro, depois o livro e autores
$pdo->prepare('DELETE FROM livros_autores WHERE livro_id = :id')->execute(['id' => $livro->id()]);
$livros->excluir($livro->id());
$autores->excluir($autor1->id());
$autores->excluir($autor2->id());

assert($livros->buscar($livro->id()) === null);
echo "   Exclusao controlada OK: Vinculos e registros apagados com sucesso\n\n";

echo "TODAS AS 7 EVIDENCIAS FORAM DEMONSTRADAS COM SUCESSO!\n";

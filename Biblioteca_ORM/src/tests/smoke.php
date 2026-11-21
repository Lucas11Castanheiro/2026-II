<?php

require_once __DIR__ . '/../Domain/Autor.php';
require_once __DIR__ . '/../Domain/Livro.php';
require_once __DIR__ . '/../Infrastructure/RepositoryInterface.php';
require_once __DIR__ . '/../Infrastructure/AbstractRepository.php';
require_once __DIR__ . '/../Infrastructure/AutorRepository.php';
require_once __DIR__ . '/../Infrastructure/LivroRepository.php';
require_once __DIR__ . '/../Infrastructure/Conexao.php';

use Biblioteca\Domain\Autor;
use Biblioteca\Domain\Livro;
use Biblioteca\Infrastructure\AutorRepository;
use Biblioteca\Infrastructure\Conexao;
use Biblioteca\Infrastructure\LivroRepository;

$pdo = Conexao::abrir();
$pdo->beginTransaction();

try {
	$autores = new AutorRepository($pdo);
	$livros = new LivroRepository($pdo);

	$autor = new Autor('Autora Smoke ' . bin2hex(random_bytes(4)), 'Brasil');
	$livro = new Livro('Livro Smoke ' . bin2hex(random_bytes(4)), null, 2026);
	$autores->salvar($autor);
	$livros->salvar($livro);

	$autorId = $autor->id();
	$livroId = $livro->id();
	if ($autorId === null || $livroId === null) {
		throw new RuntimeException('Os repositórios não atribuíram os IDs.');
	}

	$livros->associarAutor($livroId, $autorId);
	$recuperado = $livros->buscar($livroId);
	if (!$recuperado instanceof Livro) {
		throw new RuntimeException('Não foi possível buscar o livro salvo.');
	}

	$autoresDoLivro = $livros->autoresDoLivro($livroId);
	if (
		count($autoresDoLivro) !== 1
		|| $autoresDoLivro[0]->id() !== $autorId
	) {
		throw new RuntimeException('A associação entre livro e autor falhou.');
	}

	$recuperado->alterarTitulo('Livro Smoke atualizado');
	$livros->salvar($recuperado);
	$atualizado = $livros->buscar($livroId);
	if (!$atualizado instanceof Livro || $atualizado->titulo() !== 'Livro Smoke atualizado') {
		throw new RuntimeException('A atualização do livro falhou.');
	}

	$pdo->rollBack();
	echo "Smoke test OK\n";
} catch (Throwable $e) {
	if ($pdo->inTransaction()) {
		$pdo->rollBack();
	}

	throw $e;
}
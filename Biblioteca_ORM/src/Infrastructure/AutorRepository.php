<?php

namespace Biblioteca\Infrastructure;

use Biblioteca\Domain\Autor;

final class AutorRepository extends AbstractRepository
{
	protected function tabela(): string
	{
		return 'autores';
	}

	protected function colunas(): array
	{
		return ['nome', 'nacionalidade'];
	}

	protected function hidratar(array $r): Autor
	{
		$autor = new Autor($r['nome'], $r['nacionalidade']);
		$autor->atribuirId((int) $r['id']);
		return $autor;
	}

	protected function extrair(object $e): array
	{
		if (!$e instanceof Autor) {
			throw new \InvalidArgumentException('Esperado Autor');
		}

		return ['nome' => $e->nome(), 'nacionalidade' => $e->nacionalidade()];
	}

	protected function identidade(object $e): ?int
	{
		if (!$e instanceof Autor) {
			throw new \InvalidArgumentException('Esperado Autor');
		}

		return $e->id();
	}

	protected function definirIdentidade(object $e, int $id): void
	{
		if (!$e instanceof Autor) {
			throw new \InvalidArgumentException('Esperado Autor');
		}

		$e->atribuirId($id);
	}
}

function consultarPorContrato(RepositoryInterface $repo, int $id): ?object
{
	return $repo->buscar($id);
}
    
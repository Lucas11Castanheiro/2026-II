<?php
namespace Biblioteca\Infrastructure;

/**
 * Interface - Contrato e polimorfismo
 */
interface RepositoryInterface
{
    public function buscar(int $id): ?object;
    public function listar(): array;
    public function salvar(object $entidade): void;
    public function excluir(int $id): void;
}

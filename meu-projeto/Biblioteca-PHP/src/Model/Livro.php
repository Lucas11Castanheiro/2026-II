<?php
class Livro {
    public function __construct(
        public int $id,
        public string $titulo,
        public string $isbn,
        public int $id_autor,
        public ?string $ano_publicacao,
        public int $preco,
        public int $quantidade
    ) {}
}
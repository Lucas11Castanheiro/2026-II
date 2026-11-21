<?php
final class LivroRepository {
    public function __construct(private PDO $pdo) {}

    public function listar(): array {
        $stmt = $this->pdo->query("SELECT * FROM livro ORDER BY titulo ASC");
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM livro WHERE id = :id');
        $stmt->execute(['id' => $id]);
        
        $linha = $stmt->fetch();
        return $linha === false ? null : $linha;
    }

    public function cadastrar(string $titulo, string $isbn, int $id_autor, int $preco, int $quantidade, ?string $ano_publicacao = null): void {
        $sql = 'INSERT INTO livro (titulo, isbn, id_autor, preco, quantidade, ano_publicacao) 
                VALUES (:titulo, :isbn, :id_autor, :preco, :quantidade, :ano_publicacao)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'titulo' => $titulo,
            'isbn' => $isbn,
            'id_autor' => $id_autor,
            'preco' => $preco,
            'quantidade' => $quantidade,
            'ano_publicacao' => $ano_publicacao
        ]);
    }
}
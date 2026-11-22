<?php
namespace Biblioteca\Infrastructure;

final class Conexao
{
    public static function abrir(): \PDO
    {
        // Carrega .env se existir na raiz
        $caminhoEnv = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
        if (file_exists($caminhoEnv)) {
            $linhas = file($caminhoEnv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($linhas as $linha) {
                if (str_starts_with(trim($linha), '#') || !str_contains($linha, '=')) {
                    continue;
                }
                [$chave, $valor] = explode('=', $linha, 2);
                $chave = trim($chave);
                $valor = trim(trim($valor), '"\'');
                if (getenv($chave) === false) {
                    putenv("$chave=$valor");
                }
            }
        }

        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $nome = getenv('DB_NAME') ?: 'biblioteca_orm';
        $usuario = getenv('DB_USER') ?: 'biblioteca';
        $senha = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';

        return new \PDO("mysql:host=$host;dbname=$nome;charset=utf8mb4", $usuario, $senha, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
}

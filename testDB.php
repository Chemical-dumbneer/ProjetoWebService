<?php
declare(strict_types=1);

require __DIR__ . '/bootstrap.php'; // carrega o autoload e o .env

try {
    $db = Database::getConnection(); // ou new Database() dependendo da tua implementação
    echo "✅ Conexão estabelecida com sucesso!\n";

    // Teste simples de consulta:
    $stmt = $db->query('SELECT version();');
    $version = $stmt->fetchColumn();
    echo "Versão do PostgreSQL: $version\n";

} catch (PDOException $e) {
    echo "❌ Erro na conexão: " . $e->getMessage() . "\n";
}
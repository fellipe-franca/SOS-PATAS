<?php

// Conectar com o MySQL usando a classe PDO
// Definir os parâmetros
$host = "localhost";
$user = "root";
$pass = "";
$db = "sospatas";

try {
    // Criar um objeto PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    // Configurar o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar uma consulta SQL para obter os dados das instituições
    $sql = "SELECT * FROM instituicoes";

    // Preparar um objeto PDOStatement com a consulta SQL
    $stmt = $pdo->prepare($sql);

    // Executar a consulta SQL
    $stmt->execute();

    // Obter todos os registros da consulta em um array associativo
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar os dados como JSON
    echo json_encode($data);
} catch (PDOException $e) {
    // Em caso de erro, você pode tratar a exceção e fornecer uma mensagem de erro adequada
    http_response_code(500); // Código de erro interno do servidor
    echo json_encode(['error' => 'Erro no servidor: ' . $e->getMessage()]);
}
?>

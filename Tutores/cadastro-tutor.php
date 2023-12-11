<?php

// Conectar com o MySQL usando a classe PDO
$host = "localhost";
$user = "root";
$pass = "";
$db = "sospatas";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'];

    $sql = "INSERT INTO tutores (name) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name]);

    // Redirecionar para onde você desejar após o cadastro
    header("Location: ..//Perfil/perfil-tutor.php");
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro no servidor: ' . $e->getMessage()]);
}

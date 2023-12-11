<?php
session_start(); // Certifique-se de iniciar a sessão se ainda não estiver

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifique se o usuário está autenticado (logado)
    if (isset($_SESSION['user_id'])) {
        // O usuário está autenticado, então obtenha o cod_usuario da sessão
        $user_id = $_SESSION['user_id'];

        // Defina os parâmetros de conexão com o banco de dados
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "sospatas";

        // Receba os dados enviados pelo formulário
        $name = $_POST['name'];
        $location = $_POST['location'];
        $about = $_POST['about'];
        $date = $_POST['date'];

        // Manipule o upload da imagem
        $imagePath = 'uploads/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

        $social = $_POST['social'];
        $contact = $_POST['contact'];

        // Conecte-se ao banco de dados usando PDO
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar a consulta SQL para inserir uma nova instituição
            $sql = "INSERT INTO instituicoes (usuario_id, name, location, about, date, image, social, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user_id, $name, $location, $about, $date, $imagePath, $social, $contact]);

            // Redirecionar para uma página de sucesso
            header("Location: ..//Perfil/perfil-instituicao.php");

            // Você também pode retornar uma resposta JSON de sucesso, se necessário
        } catch (PDOException $e) {
            // Em caso de erro, você pode tratar a exceção e fornecer uma mensagem de erro adequada
            http_response_code(500); // Código de erro interno do servidor
            echo json_encode(['error' => 'Erro no servidor: ' . $e->getMessage()]);
        }
    } else {
        // O usuário não está autenticado, redirecione para a página de login ou exiba uma mensagem de erro
        header("Location: pagina_de_login.php"); // Substitua pelo nome correto da página de login
    }
} else {
    // Redirecione o usuário de volta para o formulário se a solicitação não for POST
    header("Location: cadastro_instituicao.html"); // Substitua pelo nome correto do arquivo do formulário
}
?>

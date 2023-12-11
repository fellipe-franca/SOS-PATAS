<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e_mail = $_POST["e_mail"];
    $confirmasenha = $_POST["confirmasenha"];

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sospatas";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica as credenciais do usuário
    $sql = "SELECT cod_usuario, tipo_usuario FROM CADASTRO WHERE E_MAIL = '$e_mail' AND SENHA = '$confirmasenha'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['cod_usuario'];
        $_SESSION['user_type'] = $row['tipo_usuario'];

        // Redireciona com base no tipo de usuário
        if ($row['tipo_usuario'] == 'instituicao') {
            header("Location: ..//Instituições/index.html"); // Redireciona para a página de perfil da instituição
            exit(); // Encerra o script após o redirecionamento
        } elseif ($row['tipo_usuario'] == 'tutor') {
            header("Location: ..//Tutores/index.html"); // Redireciona para a página de perfil do tutor
            exit(); // Encerra o script após o redirecionamento
        }
    } else {
        echo "Credenciais inválidas. Por favor, tente novamente.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Seção de cabeçalho -->
</head>

<body>
    <?php
    // Verifique se há uma sessão ativa com o ID da instituição ou tutor
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
        if ($_SESSION['user_type'] == 'instituicao') {
            header("Location: ..//Perfil/perfil-instituicao.php"); // Redireciona para o perfil da instituição
            exit();
        } elseif ($_SESSION['user_type'] == 'tutor') {
            header("Location: ..//Perfil/perfil-tutor.php"); // Redireciona para o perfil do tutor
            exit();
        }
    }
    ?>
</body>

</html>

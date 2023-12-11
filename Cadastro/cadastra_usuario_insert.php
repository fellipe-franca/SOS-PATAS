<!DOCTYPE html>
<html>
<head>
  <link rel='stylesheet' href='CSS/site.css'>
  <meta charset="utf-8">
</head>
<body>

<?php
// Criação de variáveis
$e_mail = $_POST["e_mail"];
$senha = $_POST["senha"];
$confirmasenha = $_POST["confirmasenha"];
$tipo_usuario = $_POST["tipo_usuario"]; // Adicione o campo tipo_usuario no formulário

// Criação de variáveis para acessar o banco de dados
$servidor = "localhost"; // servidor-computador
$usuario_bd = "root";        // usuário do banco de dados
$senha_bd = "";        // senha do banco de dados
$bdnome = "sospatas";  // nome do banco de dados

// Cria a conexão MySQLi Procedural
$conexao = mysqli_connect($servidor, $usuario_bd, $senha_bd, $bdnome);

if (!$conexao) {
    echo "<h1>Falha na conexão: " .  mysqli_connect_error() . "</h1>";
} else {
    // Verifica se o e-mail já está cadastrado
    $verifica_email = "SELECT * FROM CADASTRO WHERE E_MAIL = '$e_mail'";
    $resultado = mysqli_query($conexao, $verifica_email);
    
    if (mysqli_num_rows($resultado) > 0) {
        echo "<h1>O e-mail já está cadastrado.</h1>";
    } else {
        // Monta o SQL para executar no Banco de Dados
        $sql = "INSERT INTO CADASTRO (E_MAIL, SENHA, CONFIRMASENHA, TIPO_USUARIO)
                VALUES ('$e_mail', '$senha', '$confirmasenha', '$tipo_usuario')";

        if (mysqli_query($conexao, $sql)) {
        // Email cadastrado com sucesso, exibe o alert
        echo '<script>alert("Email cadastrado com sucesso!");</script>';
        // Redireciona para a página de login
        echo '<script>location.href = "../Login/login.html";</script>';
        } else {
            echo "<h1>Error: " . $sql . "<br>" . mysqli_error($conexao) . "</h1>";
        }
    }
    
    mysqli_close($conexao);
}
?>

</body>
</html>

<?php
// Exibir erros do PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar ao banco de dados MySQL
$host = "localhost";
$dbname = "rota_segura";
$username = "root";
$password = "Phmelo1620*";
$port = 3307; // Porta correta do MySQL

// Criar a conexão com a porta especificada
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar e sanitizar os dados
    $nome = $conn->real_escape_string($_POST["nome"]);
    $data_nascimento = $conn->real_escape_string($_POST["data_nascimento"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $senha = $conn->real_escape_string($_POST["senha"]);
    $confirmar_senha = $conn->real_escape_string($_POST["confirmar_senha"]);

    // Verificar se as senhas são iguais
    if ($senha !== $confirmar_senha) {
        die("As senhas não coincidem.");
    }

    // Criptografar a senha
    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    // SQL para inserir os dados
    $sql = "INSERT INTO usuario (nome, data_nascimento, login, senha)
            VALUES ('$nome', '$data_nascimento', '$email', '$senha_hashed')";

    // Executar a query e verificar o resultado
    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

// Fechar a conexão
$conn->close();
?>

<?php
// Configurações de conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "atvidade_12";

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Função para validar os campos
function validateFields($name, $email, $password, $birthdate)
{
    $errors = [];
    if (empty($name)) {
        $errors[] = "O campo 'Nome' é obrigatório.";
    }
    if (empty($email)) {
        $errors[] = "O campo 'Email' é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "O campo 'Email' não possui um formato válido.";
    }
    if (empty($password)) {
        $errors[] = "O campo 'Senha' é obrigatório.";
    }
    if (empty($birthdate)) {
        $errors[] = "O campo 'Data de Nascimento' é obrigatório.";
    }
    return $errors;
}

// Verifica se a requisição é para inserir um registro
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];

    // Validação dos campos
    $errors = validateFields($name, $email, $password, $birthdate);
    if (count($errors) > 0) {
        echo "<div class='error'><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul></div>";
    } else {
        // Inserção do registro no banco de dados
        $sql = "INSERT INTO users (name, email, password, birthdate) VALUES ('$name', '$email', '$password', '$birthdate')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso.";
        } else {
            echo "Erro ao inserir o registro: " . $conn->error;
        }
    }
}

$conn->close();
?>

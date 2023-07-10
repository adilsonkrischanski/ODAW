<?php
// Configurações de conexão com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "odaw";

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta os registros cadastrados
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Data de Nascimento</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["birthdate"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn->close();
?>

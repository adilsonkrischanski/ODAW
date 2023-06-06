<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "odaw12a";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"])) {
        $ids = $_POST["id"];

        echo "<script>";
        echo "var confirmed = confirm('Tem certeza de que deseja excluir os registros selecionados?');";
        echo "if (confirmed) {";
        foreach ($ids as $id) {
            $sql = "DELETE FROM users WHERE id = $id";
            if ($conn->query($sql) !== TRUE) {
                echo "console.log('Erro ao excluir $id: " . $conn->error . "');";
            }
        }
        echo "window.location.href = 'delete.php';";
        echo "} else {";
        echo "window.location.href = 'delete.php';";
        echo "}";
        echo "</script>";
    } else {
        echo "Nenhum registro selecionado.";
    }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            tr:hover {
                background-color: #f5f5f5;
            }
            th {
                background-color: #f2f2f2;
                color: #333;
                font-weight: bold;
            }
            input[type='submit'] {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 10px 20px;
                font-weight: bold;
                cursor: pointer;
                border-radius: 5px;
            }
            input[type='submit']:hover {
                background-color: #45a049;
            }
        </style>";

    echo "<h2>Excluir Usuário</h2>";
    echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Sexo</th>
            <th>Excluir</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td><input type='checkbox' name='id[]' value='" . $row["id"] . "'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    echo "<input type='submit' value='Excluir'>";
    echo "</form>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn->close();
?>

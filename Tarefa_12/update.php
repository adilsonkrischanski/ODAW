<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "odaw12a";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"][$id];
    $phone = $_POST["phone"][$id];
    $address = $_POST["address"][$id];
    $gender = $_POST["gender"][$id];

    $sql = "UPDATE users SET name = '$name', phone = '$phone', address = '$address', gender = '$gender' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o registro: " . $conn->error;
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
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #e5e5e5;
            }
            th {
                background-color: #4CAF50;
                color: white;
                font-weight: bold;
            }
            input[type='text'], select {
                width: 100%;
                padding: 6px 10px;
                margin: 8px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type='submit'] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
        </style>";

    echo "<h2>Atualizar Usuário</h2>";
    echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
    echo "<label>Pesquisar por ID:</label>";
    echo "<input type='text' name='search_id'>";
    echo "<input type='submit' value='Pesquisar'>";
    echo "</form>";

    $search_id = isset($_POST["search_id"]) ? $_POST["search_id"] : "";
    
    echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Endereço</th><th>Sexo</th><th>Atualizar</th></tr>";
    while ($row = $result->fetch_assoc()) {
        if ($search_id === "" || $search_id == $row["id"]) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td><input type='text' name='name[" . $row["id"] . "]' value='" . $row["name"] . "' required></td>";
            echo "<td><input type='text' name='phone[" . $row["id"] . "]' value='" . $row["phone"] . "' required></td>";
            echo "<td><input type='text' name='address[" . $row["id"] . "]' value='" . $row["address"] . "' required></td>";
            echo "<td>";
            echo "<select name='gender[" . $row["id"] . "]' required>";
            echo "<option value='M' " . ($row["gender"] === "M" ? "selected" : "") . ">Masculino</option>";
            echo "<option value='F' " . ($row["gender"] === "F" ? "selected" : "") . ">Feminino</option>";
            echo "<option value='O' " . ($row["gender"] === "O" ? "selected" : "") . ">Outro</option>";
            echo "</select>";
            echo "</td>";
            echo "<td><input type='hidden' name='id' value='" . $row["id"] . "'><input type='submit' value='Atualizar'></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    echo "</form>";
} else {
    echo "Nenhum registro encontrado.";
}

$conn->close();



?>

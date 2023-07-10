<?php
// Função para validar CPF
function validarCPF($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF possui 11 dígitos
    if (strlen($cpf) !== 11) {
        return false;
    }

    // Verifica se todos os dígitos são iguais (CPF inválido)
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Calcula os dígitos verificadores
    for ($i = 9; $i < 11; $i++) {
        $sum = 0;
        for ($j = 0; $j < $i; $j++) {
            $sum += $cpf[$j] * (($i + 1) - $j);
        }
        $digit = ((10 * $sum) % 11) % 10;
        if ($cpf[$i] != $digit) {
            return false;
        }
    }

    return true;
}

// Verificar se os campos de login foram submetidos
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    // Verificar se os campos obrigatórios estão preenchidos
    if ($username !== '' && $password !== '' && $name !== '' && $cpf !== '') {
        // Verificar se o CPF é válido
        if (validarCPF($cpf)) {
            // Definir um cookie para indicar que o usuário está logado
            setcookie('autenticado', true, time() + (60), '/'); 

            // Redirecionar para a página de sucesso
            header('Location: sucesso.php');
            exit();
        } else {
            echo 'CPF inválido. Tente novamente.';
        }
    } else {
        echo 'Preencha todos os campos obrigatórios.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Login</title>
</head>
<body>
    <h1>Formulário de Login</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email"><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>

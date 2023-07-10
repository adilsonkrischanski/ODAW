<?php
// Verificar se os campos de login foram submetidos
if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
  
    
    // Verificar as credenciais do usuário (exemplo simples)echo 'Usuário autenticado com sucesso! Bem-vindo!';
    if($username == "usuario" && $password == "senha"){
        

        // Definir um cookie para indicar que o usuário está logado
        setcookie('autenticado', true, time() + (60), '/'); // Cookie válido por 30 dias

        
        // Redirecionar para a página de sucesso

        header('Location: sucesso.php');
        exit();
    } else {
        echo 'Credenciais inválidas. Tente novamente.';
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
        
        <input type="submit" value="Login">
    </form>
</body>
</html>



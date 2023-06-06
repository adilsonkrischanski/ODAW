<!DOCTYPE html>
<html>
<head>
    <title>Aplicação de Cadastro de Usuários</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Menu</h2>
    <button class="button" onclick="location.href='list.php'">Visualizar Usuários</button>
    <button class="button" onclick="location.href='create.php'">Cadastrar Usuário</button>
    <button class="button" onclick="location.href='update.php'">Atualizar Usuário</button>
    <button class="button" onclick="location.href='delete.php'">Excluir Usuário</button>
</body>
</html>

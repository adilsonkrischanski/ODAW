<?php
$nome = $email = $senha = $mensagem = $sexo = $aceitoTermos = $cor = "";
$erros = [];

function criptografarSenha($senha) {
    return $senha + 17;
}

function descriptografarSenha($senhaCriptografada) {
    return $senhaCriptografada - 17;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function limparEntrada($dados) {
        $dados = trim($dados);
        $dados = stripslashes($dados);
        $dados = htmlspecialchars($dados);
        return $dados;
    }

    if (empty($_POST["nome"])) {
        $erros[] = "O campo Nome é obrigatório.";
    } else {
        $nome = limparEntrada($_POST["nome"]);
    }

    if (empty($_POST["email"])) {
        $erros[] = "O campo E-mail é obrigatório.";
    } else {
        $email = limparEntrada($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "O e-mail digitado é inválido.";
        }
    }

    if (empty($_POST["senha"])) {
        $erros[] = "O campo Senha é obrigatório.";
    } else {
        $senha = limparEntrada($_POST["senha"]);

        $arquivoAutenticacao = "autenticacao.txt";

        if (file_exists($arquivoAutenticacao)) {
            $linhas = file($arquivoAutenticacao, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $senhaValida = false;

            foreach ($linhas as $linha) {
                list($username, $senhaArmazenada) = explode(':', $linha);
                if ($username === $email) {
                    if ($senha === $senhaArmazenada) {
                        $senhaValida = true;
                        break;
                    }
                }
            }

            // foreach ($linhas as $linha) {
            //     list($username, $hashSenha) = explode(':', $linha);
            //     if ($username === $email) {
            //         // Verificação manual da senha
            //         if (password_verify($senha, $hashSenha) == true) {

            //             $senhaValida = true;
            //             break;
            //         }
            //     }
            // }

            if (!$senhaValida) {
                $erros[] = "Senha inválida.";
            }
        } else {
            $erros[] = "Erro ao verificar a senha.";
        }
    }

    if (empty($_POST["mensagem"])) {
        $erros[] = "O campo Mensagem é obrigatório.";
    } else {
        $mensagem = limparEntrada($_POST["mensagem"]);
    }

    if (empty($_POST["sexo"])) {
        $erros[] = "O campo Sexo é obrigatório.";
    } else {
        $sexo = limparEntrada($_POST["sexo"]);
    }

    if (empty($_POST["aceito_termos"])) {
        $erros[] = "Você deve aceitar os termos.";
    } else {
        $aceitoTermos = limparEntrada($_POST["aceito_termos"]);
    }

    if (empty($_POST["cor"])) {
        $erros[] = "O campo Cor é obrigatório.";
    } else {
        $cor = limparEntrada($_POST["cor"]);
    }

    if (count($erros) === 0) {
        echo "<h3>Dados enviados com sucesso:</h3>";
        echo "<p><strong>Nome:</strong> $nome</p>";
        echo "<p><strong>E-mail:</strong> $email</p>";
        echo "<p><strong>Mensagem:</strong> $mensagem</p>";
        echo "<p><strong>Sexo:</strong> $sexo</p>";
        echo "<p><strong>Termos aceitos:</strong> $aceitoTermos</p>";
        echo "<p><strong>Cor favorita:</strong> $cor</p>";
    } else {
        echo "<h3>Erros encontrados:</h3>";
        echo "<ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Exemplo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        select,
        input[type="checkbox"],
        input[type="radio"] {
            margin-top: 5px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        .error {
            color: #ff0000;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Preencha o formulário:</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php if (count($erros) > 0): ?>
            <div class="error">
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?php echo $erro; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>
        </div>
        <div>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <div>
            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" cols="30" required><?php echo $mensagem; ?></textarea>
        </div>
        <div>
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="">Selecione</option>
                <option value="masculino" <?php if ($sexo === "masculino") echo "selected"; ?>>Masculino</option>
                <option value="feminino" <?php if ($sexo === "feminino") echo "selected"; ?>>Feminino</option>
            </select>
        </div>
        <div>
            <label for="aceito_termos">Aceito os termos:</label>
            <input type="checkbox" id="aceito_termos" name="aceito_termos" <?php if ($aceitoTermos === "on") echo "checked"; ?> required>
        </div>
        <div>
            <label for="cor">Cor favorita:</label><br>
            <input type="radio" id="cor_vermelha" name="cor" value="vermelha" <?php if ($cor === "vermelha") echo "checked"; ?> required>
            <label for="cor_vermelha">Vermelha</label><br>
            <input type="radio" id="cor_azul" name="cor" value="azul" <?php if ($cor === "azul") echo "checked"; ?> required>
            <label for="cor_azul">Azul</label><br>
            <input type="radio" id="cor_verde" name="cor" value="verde" <?php if ($cor === "verde") echo "checked"; ?> required>
            <label for="cor_verde">Verde</label>
        </div>
        <div>
            <input type="submit" value="Enviar">
            <input type="reset" value="Limpar">
        </div>
    </form>
</body>
</html>

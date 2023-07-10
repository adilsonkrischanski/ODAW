<?php
$nome = $email = $senha = $mensagem = $sexo = $aceitoTermos = $cor = "";
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Função para limpar e validar os dados de entrada
    function limparEntrada($dados) {
        $dados = trim($dados);
        $dados = stripslashes($dados);
        $dados = htmlspecialchars($dados);
        return $dados;
    }

    // Validação dos campos
    if (empty($_POST["nome"])) {
        $erros[] = "O campo Nome é obrigatório.";
    } else {
        $nome = limparEntrada($_POST["nome"]);
    }

    if (empty($_POST["email"])) {
        $erros[] = "O campo E-mail é obrigatório.";
    } else {
        $email = limparEntrada($_POST["email"]);
        // Exemplo de validação do e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "O e-mail digitado é inválido.";
        }
    }

    if (empty($_POST["senha"])) {
        $erros[] = "O campo Senha é obrigatório.";
    } else {
        $senha = limparEntrada($_POST["senha"]);

        // Validação da senha com base no arquivo autenticacao.txt
        $arquivoAutenticacao = "autenticacao.txt";
        
        if (file_exists($arquivoAutenticacao)) {
            $linhas = file($arquivoAutenticacao, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $senhaValida = false;
        
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

            foreach ($linhas as $linha) {
                list($username, $senhaArmazenada) = explode(':', $linha);
                if ($username === $email) {
                    // Verificação da senha em texto plano
                    if ($senha === $senhaArmazenada) {
                        $senhaValida = true;
                        break;
                    }
                }
            }
        
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

    // Verifica se há erros de validação
    if (count($erros) === 0) {
        // Exibe a mensagem de confirmação com as informações digitadas
        echo "<h3>Dados enviados com sucesso:</h3>";
        echo "<p><strong>Nome:</strong> $nome</p>";
        echo "<p><strong>E-mail:</strong> $email</p>";
        echo "<p><strong>Mensagem:</strong> $mensagem</p>";
        echo "<p><strong>Sexo:</strong> $sexo</p>";
        echo "<p><strong>Termos aceitos:</strong> $aceitoTermos</p>";
        echo "<p><strong>Cor favorita:</strong> $cor</p>";
    } else {
        // Exibe mensagens de erro
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
</head>
<body>
    <h2>Preencha o formulário:</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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

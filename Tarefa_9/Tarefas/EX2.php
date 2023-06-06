<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoItem = $_POST['novoItem'];
    $itens = isset($_POST['itens']) ? json_decode($_POST['itens'], true) : array();
    $itens[] = $novoItem;
    $listaCompras = json_encode($itens);
} else {
    $itens = array();
    $listaCompras = "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inserir Elementos na Lista</title>
</head>
<body>
    <h2>Inserir Elementos na Lista</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="novoItem">Novo Item:</label>
        <input type="text" id="novoItem" name="novoItem" required>
        <input type="hidden" name="itens" value="<?php echo htmlentities($listaCompras); ?>">
        <input type="submit" value="Adicionar">
    </form>

    <h3>Itens na lista:</h3>
    <?php if (!empty($itens)): ?>
        <ul>
        <?php foreach ($itens as $item): ?>
            <li><?php echo $item; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>A lista está vazia.</p>
    <?php endif; ?>
</body>
</html>

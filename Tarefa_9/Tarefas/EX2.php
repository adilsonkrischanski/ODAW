<?php
function listaCompras($itens) {
    $html = '<ul>';
    foreach ($itens as $item) {
        $html .= '<li>' . $item . '</li>';
    }
    $html .= '</ul>';
    return $html;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoItem = $_POST['novoItem'];
    $itens = isset($_POST['itens']) ? explode(',', $_POST['itens']) : array();
    $itens[] = $novoItem;
    echo listaCompras($itens);
    exit(); // Interrompe a execução do script para evitar exibir HTML completo
} else {
    $itens = array('Arroz', 'Feijão', 'Macarrão', 'Carne', 'Frutas', 'Legumes');
}

?>

<div id="listaCompras">
    <?php echo listaCompras($itens); ?>
</div>

<form id="formListaCompras">
    <label for="novoItem">Novo item:</label>
    <input type="text" name="novoItem" id="novoItem">
    <input type="hidden" name="itens" value="<?php echo htmlentities(implode(',', $itens)); ?>">
    <button id="btnAdicionar" type="submit">Adicionar</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#formListaCompras").submit(function(event) {
            event.preventDefault(); // Impede o envio tradicional do formulário

            var novoItem = $("#novoItem").val();

            $.ajax({
                url: '',
                method: 'POST',
                data: {
                    novoItem: novoItem,
                    itens: $("#formListaCompras input[name='itens']").val()
                },
                success: function(response) {
                    $("#novoItem").val('');
                    $("#listaCompras").html(response);
                }
            });
        });
    });
</script>

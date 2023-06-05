<?php
$counterFile = 'counter.txt'; // Nome do arquivo de contador

// Verifica se o arquivo de contador existe
if (file_exists($counterFile)) {
    // Lê o valor atual do contador do arquivo
    $counterValue = intval(file_get_contents($counterFile));
} else {
    // Cria o arquivo de contador e define o valor inicial como 0
    $counterValue = 0;
    file_put_contents($counterFile, $counterValue);
}

// Incrementa o contador
$counterValue++;

// Escreve o novo valor do contador no arquivo
file_put_contents($counterFile, $counterValue);

// Exibe o valor do contador na página
echo "Esta página foi atualizada $counterValue vezes.";

?>

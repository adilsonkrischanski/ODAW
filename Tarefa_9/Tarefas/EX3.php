<?php
$counterFile = 'counter.txt';

if (file_exists($counterFile)) {
    $counterValue = intval(file_get_contents($counterFile));
} else {
    $counterValue = 0;
    file_put_contents($counterFile, $counterValue);
}


$counterValue++;

file_put_contents($counterFile, $counterValue);

echo "Esta página foi atualizada $counterValue vezes.";

?>

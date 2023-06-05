<?php
$usuarios = [
    ['email' => 'usuario1@exemplo.com', 'senha' => 'senha123'],
    ['email' => 'usuario2@exemplo.com', 'senha' => 'abc456'],
    ['email' => 'usuario3@exemplo.com', 'senha' => 'qwerty789']
];

$fileContent = "";
foreach ($usuarios as $usuario) {
    $email = $usuario['email'];
    $senha = password_hash($usuario['senha'], PASSWORD_DEFAULT);
    $fileContent .= "$email:$senha\n";
}

file_put_contents("autenticacao.txt", $fileContent);
?>

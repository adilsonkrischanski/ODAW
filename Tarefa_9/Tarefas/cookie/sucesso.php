<?php
// Verificar se o cookie de autenticação existe e está definido como true
if(isset($_COOKIE['autenticado'])){
    echo "ENTROu";
    echo $_COOKIE;
    if($_COOKIE['autenticado'] == 1){
        echo 'Usuário autenticado com sucesso! Bem-vindo!';
    }
    
} else {
    echo 'Acesso não autorizado. Faça login primeiro.';
}
?>

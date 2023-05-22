<?php

// Zerando as variaveis globais do usuario e o coockie do usuario
unset($_COOKIE["email"]);
unset($_SESSION["email"]);
setcookie('email', null, -1, '/'); 

// Voltando para a pagina home
header("Location: ../../?secao=home");
exit();
?>
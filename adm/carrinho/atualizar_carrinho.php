
<?php

include_once("../../dao/manipular_dados.php");

$manipula = new manipular_dados();

// Atualizando no banco da dados a nova quantidade no carrinho
$manipula->updateProdutoCarrinho($_POST["id"], $_POST["new_qtd"]);

// Voltando para  apagina do carrinho
header("Location: ../../?secao=carrinho");
exit();


?>
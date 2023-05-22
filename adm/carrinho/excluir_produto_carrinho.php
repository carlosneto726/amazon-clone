<?php
session_start();
include_once("../../dao/manipular_dados.php");

$manipula = new manipular_dados();

// Pegando as informações do POST
$id_produto = $_GET['id'];

// Deletando o produto do carrinho
$manipula->dellProdutoCarrinho($id_produto);

// Voltando para a pagina do carrinho
header("Location: ../../?secao=carrinho");
exit();

?>
<?php
session_start();
include_once("../../dao/manipular_dados.php");

$manipula = new manipular_dados();

// Recebendo as variaveis do POST
$id_produto = $_POST['id_produto'];
$id_usuario = $manipula->getIdByEmail($_SESSION['email'])[0]['id'];
$qtd = $_POST['qtd'];

// Inserindo o produto no carrinho
$manipula->setTable("tb_carrinho");
$manipula->setFields("id_usuario,id_produto,qtd");
$manipula->setDados("'$id_usuario','$id_produto','$qtd'");
$manipula->insert();

$_SESSION['message_alertJs'] = "Produto adicionado ao <a href='?secao=carrinho'>carrinho</a>";
$_SESSION['type_alertJs'] = "success";

// Voltando para  apagina do carrinho
header("Location: ../../?secao=home");
exit();



?>
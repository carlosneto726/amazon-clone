<?php
include_once("../../dao/manipular_dados.php");

// Informações do formulário
$id_usuario = $_POST['id'];
$valor_total = $_POST['valor_total'];
date_default_timezone_set("America/Sao_Paulo");
$data = date("Y-m-d_H:i");


// Inserindo as informações da venda na tabela tb_vendas
$tb_venda = new manipular_dados();
$tb_venda->setTable("tb_vendas");
$tb_venda->setFields("id_usuario,preco_total,data");
$tb_venda->setDados("'$id_usuario','$valor_total','$data'");
$tb_venda->insert();


// Subtraindo os produtos comprados do estoque
$tb_carrinho = new manipular_dados();

foreach($tb_carrinho->getCarrinho($id_usuario) as $produto_carrinho){
    $produto = $tb_carrinho->getProdutosPorID($produto_carrinho['id_produto']);

    // Calculando e atualizando a quantidade de produtos subtraidos da compra
    $qtd = $produto[0]['qtd'] - $produto_carrinho['qtd'];
    $tb_carrinho->updateProduto($produto[0]['id'], $qtd);

    // Adicionando os produtos na tabela tb_intens_venda para cada produto no carrinho
    $tb_carrinho->setTable("tb_itens_venda");
    $tb_carrinho->setFields("id_produto,id_venda,qtd");
    $tb_carrinho->setDados("'".$produto[0]['id']."', '".$tb_venda->getAllDataTable()[count($tb_venda->getAllDataTable()) -1]['id']."', '".$produto_carrinho['qtd']."'");
    $tb_carrinho->insert();

}

// Deletando todos os produtos do carrinho
$tb_carrinho->dellAllProdutosCarrinho($id_usuario);



// Voltando para a seção home
header("Location: ../../?secao=home");
exit();

?>
<?php

include_once("../../dao/manipular_dados.php");

// Informações do formulário
$id_usuario = $_POST['id'];
$valor_total = $_POST['valor_total'];
date_default_timezone_set("America/Sao_Paulo");
$data = date("Y-m-d_H:i");

// ============================================== Parte do fpdf que o Pedro irá implementar ==============================================

$Ver_Usuario =  new manipular_dados();
$nome = $Ver_Usuario->getUsuarioById($id_usuario);

require "../../fpdf185/fpdf.php";
$pdf = new FPDF("L","pt","A4");
$pdf->AddPage();

$pdf->SetFont("Arial", "", 28);
$pdf->Ln(35);
//nome usuario da compra
$textoNome = utf8_decode("Nome:");
$pdf->Cell(160,7,$textoNome,0,0,"C");
$nomeUser = $nome[0]['nome'];
$pdf->Cell(50,7,$nomeUser,0,0,"C");
//valor da compra
$pdf->SetFont("Arial", "", 22);
$valor_total = "R$ ".utf8_decode(number_format($_POST['valor_total'],2,",","."));
$valor = utf8_decode("Valor total:");
$pdf->Cell(870,-20,$valor,0,0,"C");
$pdf->Ln(10);
$pdf->SetFont("Arial", "B", 15);
$pdf->Cell(1280,0,$valor_total,0,0,"C");
$pdf->Ln(50);

//produtos que foram comprardos

$lista_produtos = new manipular_dados();

$produtos_carrinho = $lista_produtos->getCarrinho( $lista_produtos->getIdByEmail($_COOKIE['email'])[0]['id'] );
$pdf->SetFont("Arial", "", 22);
$textoProduto = utf8_decode("Produtos:");
$pdf->MultiCell(0,17,$textoProduto,0,"C",false);
$pdf->Ln(30);




foreach($produtos_carrinho as $produto_carrinho){
    $produto = $lista_produtos->getProdutosPorID($produto_carrinho['id_produto']);
    

    $pdf->SetFont("Times", "", 14);
    $nomeProduto = utf8_decode($produto[0]['titulo']);

    $valorProduto = "R$ ".utf8_decode(number_format( $produto[0]['preco'],2,",","."));
    
    
    $pdf->Cell(600,7,$nomeProduto,0,0,"C");
    $pdf->Cell(-200,7,$valorProduto,0,0,"C");
    $pdf->Ln(15);
}


$pdf->Image("C:/xampp\htdocs/PW2-amazon-clone/img/CodigoBarras.png", 220, 390, 420, 200);


//linhas
$pdf->Line(35,25,806,25);
$pdf->Line(35,560,806,560);
$pdf->Line(35,100,806,100);
$pdf->Line(35,400,806,400);
//colunas
$pdf->Line(35,25,35,560);
$pdf->Line(806,25,806,560);
$pdf->Line(550,25,550,100);
//finalizando o pdf
$pdf->Output("I", "boleto.pdf", true);
// =======================================================================================================================================


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



?>



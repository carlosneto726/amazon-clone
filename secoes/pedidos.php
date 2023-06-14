<script>
    // Script apenas para deixar o fundo branco
    document.getElementById("body").style = "background-color: white;"
</script>

<div style="margin-top:120px; width:85%; margin-left:7%; " >
    <div class="w-100 fs-3"  style="margin-top: 50px;">Seus Pedidos</div><br>

    <?php
    include_once("dao/manipular_dados.php");
    $manipula = new manipular_dados();
    $manipula->setTable("tb_vendas");
    // Para cada venda na tabela tb_itens_venda do usuário passado por parametro (que no caso é o usuário logado)
    foreach($manipula->getVendasByUsuarioId($manipula->getIdByEmail($_COOKIE['email'])[0]['id']) as $vendas){?>

        <div class="shadow-none rounded-1 border border-dark-subtle" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="w-100 border-bottom border-dark-subtle p-2" style="background-color: #F0F2F2;">
                <!-- Tabela com as informções do "header" de cada venda-->
                <table>
                    <thead>
                        <tr>
                            <td>PEDIDO REALIZADO</td>
                            <td class="ps-5">TOTAL</td>
                            <td class="ps-5">ENVIAR PARA</td>
                            <td class="ps-5">NUMERO DO PEDIDO</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- Data da venda -->
                            <td><?= $vendas["data"] ?></td>
                            <!-- Preço total da venda -->
                            <td class="ps-5">R$ <?= number_format($vendas["preco_total"],2,",",".") ?></td>
                            <!-- Usuário que comprou -->
                            <td class="ps-5"><?= $manipula->getUsuarioByEmail($_COOKIE['email'])[0]['nome'] ?></td>
                            <!-- Id / numero da venda -->
                            <td class="ps-5">Nº <?= $vendas["id"] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
                // Para cada produto na venda
                foreach($manipula->getProdutosByVendaId($vendas['id']) as $itens_venda){?>
                <div class="hstack p-2">
                    <!-- Imagem do produto -->
                    <div class="ms-3 me-3">
                        <a href="?secao=produto&produtoid=<?= $manipula->getProdutosPorID($itens_venda['id_produto'])[0]['id']?>&produtocategoria=<?= $manipula->getProdutosPorID($itens_venda['id_produto'])[0]['categoria']?>" class='card-body text-decoration-none'>
                            <img id="imagem_produto_pedidos" src="<?= $manipula->getProdutosPorID($itens_venda['id_produto'])[0]['img_url'] ?>">
                        </a>
                    </div>
                    
                    <div>
                        <!-- Nome / Titulo do produto -->
                        <div>
                            <a href="?secao=produto&produtoid=<?= $manipula->getProdutosPorID($itens_venda['id_produto'])[0]['id']?>&produtocategoria=<?= $manipula->getProdutosPorID($itens_venda['id_produto'])[0]['categoria']?>" class='card-body text-decoration-none text-info-emphasis'>
                                 <?= $manipula->getProdutosPorID($itens_venda['id_produto'])[0]['titulo'] ?>
                            </a>
                        </div>
                        <!-- Quantidade que o usuario comprou do produto -->
                        <div class="d-inline-flex mt-2 ps-2 border border-1 border-dark-subtle rounded-5" style="width: 25px;"> 
                            <?= $itens_venda['qtd'] ?> 
                        </div>
                    </div>
                    <!-- Botão de comprar de novo -->
                    <div class="ms-auto">
                        <a class="btn btn rounded-5" href="?secao=produto&produtoid=<?= $manipula->getProdutosPorID($itens_venda['id_produto'])[0]['id']?>&produtocategoria=<?= $manipula->getProdutosPorID($itens_venda['id_produto'])[0]['categoria']?>" style="background-color:#FFD814; color:black;">Comprar novamente</a>
                    </div>


                </div>

            <?php }?>
        </div>

    <?php
    }?>

</div>


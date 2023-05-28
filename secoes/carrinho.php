<div class="hstack">
    <div class="carrinho">
        <h1>Carrinho de compras</h1>
        <p align="right">Preço</p>
        <hr>

        <?php

        $manipula = new manipular_dados();
        $produtos_carrinho = $manipula->getCarrinho( $manipula->getIdByEmail($_COOKIE['email'])[0]['id'] );
        $valor_total = 0;

        if(count($produtos_carrinho) == 0){
            echo "<h4>Você não possui produtos no carrinho.</h4>";
        }

        // Listando todos os itens do carrinho
        foreach($produtos_carrinho as $produto_carrinho){
            $produto = $manipula->getProdutosPorID($produto_carrinho['id_produto']);
            ?>

            <div class="produtos-carrinho hstack gap-3" style="padding: 20px;">
                <!-- Imagem do produto -->
                <img src="<?= $produto[0]['img_url'] ?>" style="width: 205px;">
                <div class="p-2" style="">
                    <!-- Link para o produto -->
                    <a href="?secao=produto&produtoid=<?= $produto[0]['id']?>&produtocategoria=<?= $produto[0]['categoria']?>"> <?= $produto[0]['titulo'] ?> </a>
                    <br>
                    <!-- Checando se te entoque do produto -->
                    <span><?php if($produto[0]['qtd'] > 0){echo "<span class='text-success'>Em estoque</span>";}else{echo "<span class='text-danger'>Indisponivel</span>";}?></span>
                    <br>
                    <div class="hstack gap-3">
                        <!-- Quantidade do produto inserido no carrinho -->
                        qtd: <input type="number" style="width: 45px;" value="<?= $produto_carrinho['qtd'] ?>">
                        <div class="vr"></div>
                        <!-- Botão para excluir o produto -->
                        <a href="adm/carrinho/excluir_produto_carrinho.php?id=<?=$produto_carrinho['id']?>" class="p-2">Excluir</a>
                    </div>
                </div>

                <!-- Preço do produto -->
                <div class="ms-auto fw-bold" style="margin-top: -200px;">R$ <?= number_format($produto[0]['preco'],2,",",".") ?> </div>
            </div>
            <hr>

            

        <?php
        // Calculando o valor total de cada subitem (preço do produto X quantidade do produto)
        $valor_total += ($produto[0]['preco'] * $produto_carrinho['qtd']);
        // Chaves para fechar o laço for
        }
        ?>
        <!-- Quantidade de produtos no carrinho e o valor total do carrinho -->
        <p align="right">Subtotal (<?= count($produtos_carrinho) ?> item): <span class="fw-bold">R$ <?= number_format($valor_total,2,",",".") ?> </span></p>

    </div>


    <!-- Botão de fechar o pedido -->
    <div class="ms-2 me-2 p-3" style="border:solid 1px #D5D9D9; width: 300px; height: 150px; background-color: white;">
        <!-- Formulário para contabilizar a compra do carrinho e gerar o boleto da compra -->
        <form action="adm/carrinho/contabilizar_compra.php" method="POST">
            <p class="fs-5">Subtotal (<?= count($produtos_carrinho) ?> item): <span class="fw-bold">R$ <?= number_format($valor_total,2,",",".") ?> </span></p>

            <!-- Informações escondidas (hidden) para o POST id do usuário e valor total -->
            <input type="text" value="<?= $manipula->getIdByEmail($_COOKIE['email'])[0]['id'] ?>" name="id" hidden>
            <input type="text" name="valor_total" value="<?= $valor_total ?>" hidden>
            <center>
                <button class="btn btn rounded-5" style="background-color:#FFD814; color:black; width: 200px;" type="submit">Fechar pedido</button>
            </center>
        </form>
    </div>

</div>
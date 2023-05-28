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
                    <a class="text-decoration-none text-primary-emphasis" href="?secao=produto&produtoid=<?= $produto[0]['id']?>&produtocategoria=<?= $produto[0]['categoria']?>"> <?= $produto[0]['titulo'] ?> </a>
                    <br>
                    <!-- Checando se te entoque do produto -->
                    <span><?php if($produto[0]['qtd'] > 0){echo "<span class='text-success'>Em estoque</span>";}else{echo "<span class='text-danger'>Indisponivel</span>";}?></span>
                    <br>
                    <div class="hstack gap-3">
                        <!-- Form para contabilizar a quantidade do produto inserido no carrinho no banco de dados -->
                        qtd:
                        <form action="adm/carrinho/atualizar_carrinho.php" method="POST">

                            <div class="dropdown">
                                <button class="btn border border-1 border-dark-subtle dropdown-toggle ms-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $produto_carrinho['qtd'] ?>
                                </button>
                                <!-- Input escondido para enviar as informações via POST -->
                                <input type="text" name="id" value="<?= $produto_carrinho['id'] ?>" hidden>
                                <ul class="dropdown-menu">
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="1">1</button></li>
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="2">2</button></li>
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="3">3</button></li>
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="4">4</button></li>
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="5">5</button></li>
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="6">6</button></li>
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="7">7</button></li>
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="8">8</button></li>
                                    <li><button class="dropdown-item" type="submit" name="new_qtd" value="9">9</button></li>
                                </ul>
                            </div>
                        </form>

                        <div class="vr"></div>
                        <!-- Botão para excluir o produto -->
                        <a class="text-decoration-none text-primary-emphasis" href="adm/carrinho/excluir_produto_carrinho.php?id=<?=$produto_carrinho['id']?>" class="p-2">Excluir</a>
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
        <p class="fs-5">Subtotal (<?= count($produtos_carrinho) ?> item): <span class="fw-bold">R$ <?= number_format($valor_total,2,",",".") ?> </span></p>

        <form action="adm/carrinho/contabilizar_compra.php" method="POST">
            <!-- Informações escondidas (hidden) para o POST id do usuário e valor total -->
            <input type="text" value="<?= $manipula->getIdByEmail($_COOKIE['email'])[0]['id'] ?>" name="id" hidden>
            <input type="text" name="valor_total" value="<?= $valor_total ?>" hidden>
            <center>
                <button class="btn btn rounded-5" style="background-color:#FFD814; color:black; width: 200px;" type="submit">Fechar pedido</button>
            </center>
        </form>
    
    </div>
</div>
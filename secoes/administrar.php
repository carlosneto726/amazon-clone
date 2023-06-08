
    <!-- Listagem de produtos em organizados por categoria -->
    <?php 
        $categorias = new manipular_dados();
        $categorias->setTable("tb_categorias");
        foreach($categorias->getAllDataTable() as $categoria){
    ?>

        <div class="categoria" style="max-width: 1460px; width: auto; margin-left: 220px; margin-top: 20px; background-color: white;">
            <h4 class="fw-bold mt-2 ms-2"><?= $categoria['nome'] ?></h4>
            <div class="produto-categoria">
                <?php 

                    $produtos = new manipular_dados();
                    $produtos->setTable("tb_produtos");
                    foreach($produtos->getProdutosPorCategoria($categoria['nome']) as $produto){
                ?>
                
                    <div class='img' style='max-width: 270px; max-height: 200px; width: auto; height: auto;'>
                        <a href="?secao=produto&produtoid=<?= $produto['id']?>&produtocategoria=<?= $produto['categoria']?>"><img src="<?= $produto['img_url'] ?>" id="imagem_produto"></a>
                    </div>

                <?php }
                ?>

            </div>
        </div>

    <?php
    }
    ?>


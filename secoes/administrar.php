
    <!-- Mensagem da operação  -->
    <?php
        echo @$_SESSION["alerta"];
        $_SESSION["alerta"]="";
    ?>

    <br/><br/><br/><br/><br/>
        <center><h1>Adicione seus Produtos Aqui</h1></center>
    <br/>

    <div class=" container estiloform">
            <form method="POST" class="form-floating" action="adm/crud_produtos/administrador.php" enctype="multipart/form-data" >
                
                <input type="text" name="titulo" class="form-control" id="floatingInputValue" placeholder="Titulo do Produto" >
                <label for="floatingInputValue">Titulo do Produto:</label>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Descrição do Produto:</label>
                    <input type="text" name="descricao" class="form-control" id="formGroupExampleInput2">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Loja:</label>
                    <input type="number" name="id_loja" class="form-control" id="formGroupExampleInput2">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">estrelas:</label>
                    <input type="number" name="estrelas" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:4.5">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Marca</label>
                    <input type="text" name="marca" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:Xbox">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Preço:</label>
                    <input type="number" name="preco" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:599.99">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Categoria:</label>
                    <input type="text" name="categoria" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:Games">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Quantidade:</label>
                    <input type="number" name="qtd" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:10">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Link da Img do produto:</label>
                    <input type="file" name="img_url" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:img/img.png">
                </div>

                <div class="col-12">
                    <input type="submit" class="btn btn-primary" name="acao" value="Enviar">
                    <input type="submit" class="btn btn-primary" name="acao" value="Deletar">
                </div>

            </form>
    </div>   



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


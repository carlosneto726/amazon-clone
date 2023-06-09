
    <!-- Mensagem da operação  -->
    <?php
        echo @$_SESSION["alerta"];
        $_SESSION["alerta"]="";
    ?>

    <br/><br/><br/><br/><br/>
        <center><h1>Adicione seus Produtos Aqui</h1></center>
    <br/>
    <!-- Formulario para o administrador consiga adicionar produtos-->
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

    <br/>
        <center><h1>Todos os produtos para Editar:</h1></center>
    <br/>

    <div class="container-fluid" style="width: 80%; margin-left: 11% ; ">
        <div class="row">
        <?php 
            
            $consulta = new manipular_dados();
            $consulta->setTable("tb_produtos");
            foreach($consulta->getAllDataTable() as $produto){

        ?>

            <div class="col-3 card border-light rounded-0" style="width: 350px; height: 20%; margin-left: 15px; margin-top: 15px;">
                <div class='card-body'>
                    <!-- Todo o conteudo do card pode ser editado assim permitindo que o administrador consiga fazer alterações nos produtos-->
                   
                        <h5 class="fw-bold" style="font-family: sans-serif !important; color: black;"><?= $produto['titulo']?></h5>

                        <div class='img'>
                            <img src="<?= $produto['img_url'] ?>" id="imagem_produto" style="height: 230px !important;">
                        </div>

                        <br>

                        <h6 class="card-subtitle mb-2 text-body-secondary">R$ <?= number_format($produto['preco'],2,",",".")?></h6>
                        <p class="card-text text-truncate"><?= $produto['descricao']?></p>
                        
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions<?php echo $produto['id']?>" aria-controls="offcanvasWithBothOptions"><Em>Edit</Em></button>

                                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="10" style="width: 70%;" id="offcanvasWithBothOptions<?php echo $produto['id']?>" aria-labelledby="offcanvasWithBothOptionsLabel">
                                <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"><?= $produto['titulo']?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                <div class=" container estiloform">
                                            <form method="POST" class="form-floating" action="adm/crud_produtos/administrador.php" enctype="multipart/form-data" >
                                                <input type="text" hidden name="id" value="<?= $produto['id']?>">
                                                <input type="text" name="titulo" class="form-control" id="floatingInputValue" placeholder="Titulo do Produto" value="<?= $produto['titulo']?>" >
                                                <label for="floatingInputValue">Titulo do Produto:</label>

                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2" class="form-label">Descrição do Produto:</label>
                                                    <input type="text" name="descricao" class="form-control" id="formGroupExampleInput2" value="<?= $produto['descricao']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2" class="form-label">Loja:</label>
                                                    <input type="number" name="id_loja" class="form-control" id="formGroupExampleInput2" value="<?= $produto['id_loja']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2" class="form-label">estrelas:</label>
                                                    <input type="number" name="estrelas" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:4.5" value="<?= $produto['estrelas']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2" class="form-label">Marca</label>
                                                    <input type="text" name="marca" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:Xbox" value="<?= $produto['marca']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2" class="form-label">Preço:</label>
                                                    <input type="number" name="preco" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:599.99" value="<?= $produto['preco']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2" class="form-label">Categoria:</label>
                                                    <input type="text" name="categoria" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:Games" value="<?= $produto['categoria']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2" class="form-label">Quantidade:</label>
                                                    <input type="number" name="qtd" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:10" value="<?= $produto['qtd']?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="formGroupExampleInput2" class="form-label">Link da Img do produto:</label>
                                                    <input type="file" name="img_url" class="form-control" id="formGroupExampleInput2" placeholder="Ex.:img/img.png" value="<?= $produto['img_url']?>">
                                                </div>

                                                <div class="col-12">
                                                    <input type="submit" class="btn btn-primary" name="acao" value="Atualizar">
                                                    <input type="submit" class="btn btn-primary" name="acao" value="Deletar">
                                                </div>

                                            </form>
                                    </div>  
                                </div>
                                </div>

                    
                </div>
            </div>

        <?php }
        ?>
        </div>
    </div>

    <br/>
        <center><h1>Todos os produtos separados por categoria para Editar:</h1></center>
    <br/>

    <!-- Edição dos produtos organizados por categoria -->
    <?php 
        
        $categorias = new manipular_dados();
        $categorias->setTable("tb_categorias");
        foreach($categorias->getAllDataTable() as $categoria){
    ?>

        <div class="categoria" style="width: 79%; margin-left: 11% ;background-color: white; margin-top: 15px;">
            <h4 class="fw-bold mt-2 ms-2"><?= $categoria['nome'] ?></h4>
            <div class="produto-categoria">
                <?php 

                    $produtos = new manipular_dados();
                    $produtos->setTable("tb_produtos");
                    foreach($produtos->getProdutosPorCategoria($categoria['nome']) as $produto){
                ?>
                
                    <div class='img card ' style='max-width: 270px; max-height: 200px; width: auto; height: auto;'>
                        <img src="<?= $produto['img_url'] ?>" id="imagem_produto" class="card-img" ">
                            <div class="card-img-overlay">
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions<?php echo $produto['id']?>" aria-controls="offcanvasWithBothOptions"><Em>Edit</Em></button>

                                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="10" style="width: 70%;" id="offcanvasWithBothOptions<?php echo $produto['id']?>" aria-labelledby="offcanvasWithBothOptionsLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"><?= $produto['titulo']?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                <div class="offcanvas-body">
                                     <div class=" container estiloform">
                                        <form method="POST" class="form-floating" action="adm/crud_produtos/administrador.php" enctype="multipart/form-data" >
                                            <input type="text" hidden name="id" value="<?= $produto['id']?>">
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
                                                <input type="submit" class="btn btn-primary" name="acao" value="Atualizar">
                                                <input type="submit" class="btn btn-primary" name="acao" value="Deletar">
                                            </div>

                                        </form>
                                    </div>  
                                </div>
                            </div>

                        </div>
                    </div>

                <?php 
                    }
                ?>

                                          
            </div>
        </div>


    <?php
    }
    ?>


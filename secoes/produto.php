

<?php 
include_once('dao/manipular_dados.php');
$manipula = new manipular_dados();

// Pegando do banco de dados o produto com o id do GET
$produto = $manipula->getProdutosPorID($_GET['produtoid']);
?>

<script>
    // Script apenas para trocar o fundo para branco, fiz isso para ser igual o site da Amazon original
    var body = document.getElementById("body");
    body.style = "background-color: white;";
</script>


<div class="container-fluid" style="margin-top: 150px;  ">
    <!-- O hstack posiciona os elementos horizontalmente, como se fosse um dispay inline -->
    <div class="hstack gap-3" style="width:80%; margin-left:11%;">
        <div class="ms-2 me-2" style="max-width: 100%; min-width: 40%;">
            <img src="<?= $produto[0]['img_url'] ?>" id="imagem_produto_pagina">
        </div>
        
        <!-- Div para o produto -->
        <div class="p-2" style="max-width: 100%; min-width: 30%;">
            <h5 class="fw-bold"><?= $produto[0]['titulo']?></h5>
            <br>
            Marca: <?= $produto[0]['marca']?>
            <br>
            Estrelas: <?= $produto[0]['estrelas']?>
            <hr>
            R$<span class="fs-4 fw-bold"><?= number_format($produto[0]['preco'],2,",",".");?></span>
            <br>
            <img class="d-none d-md-none  d-xxl-block" src="img/produto_placeholder.png" class="w-100">
            <br>
            <div class="d-none d-xxl-block">
                <span class="fw-bold d-none d-xxl-block">Marca</span>                          <span style="margin-left: 215px;"><?= $produto[0]['marca']?></span><br>
                <span class="fw-bold ">Cor</span>                            <span style="margin-left: 235px;">??</span><br>
                <span class="fw-bold">Tecnologia de conexão</span>          <span style="margin-left: 90px;">??</span><br>
                <span class="fw-bold">Material</span>                       <span style="margin-left: 200px;">??</span><br>
                <span class="fw-bold">Usos específicos do produto</span>    <span style="margin-left: 50px;">??</span><br>
            </div>
            <hr>
            <br>
            <span class="fw-bold">Sobre este item</span>
            <br>
            <p class="text-break text-truncate" style="max-width: 500px;">
                <?= $produto[0]['descricao']?>
            </p>
            <div class="d-block d-xl-none ">
                <form action="adm/carrinho/adicionar_carrinho.php" method="POST">
                    <div class="text-truncate">
                        <span>QTD:</span>
                        <select class="btn border border-1 border-dark-subtle dropdown-toggle ms-1" name="qtd">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>
                    <input name="id_produto" value="<?= $produto[0]['id'] ?>" hidden>
            <!-- Botão de adicionar ao carrinho, é desabilitado caso o produto não esteja em estoque -->
                    <p><button class="btn btn <?php if($produto[0]['qtd'] <= 0){echo "disabled";}?> rounded-5" style="background-color:#FFD814; color:black; width: 200px;" type="submit">Adicionar ao carrinho</button></p>
                        <!-- Botão de comprar agora, é desabilitado caso o produto não esteja em estoque -->
                    <p><button class="btn btn <?php if($produto[0]['qtd'] <= 0){echo "disabled";}?> rounded-5 mt-3" style="background-color:#FFA41C; color:black; width: 200px;" type="submit">Comprar agora</button></p>
                </form>
            </div>
        </div> 

        <!-- Card mais a direita com os botões de adicionar produto ao carrinho e comprar -->
        <div class="ms-2 me-2 rounded-2 d-none d-xl-block" style="border:solid 1px #D5D9D9; width: 245px; height: 530px;">
            <form action="adm/carrinho/adicionar_carrinho.php" method="POST">
            
                <div class="mt-2 ms-2">R$<span class="fs-5 fw-bold"><?= number_format($produto[0]['preco'],2,",",".");?></span></div>
                <div class="mt-2 ms-2"><span class="fs-6">Entrega R$ 23,51: 18 - 23 de Maio.</span></div>
                <div class="mt-2 ms-2 mb-3">
                    <span class="fs-4"><?php if($produto[0]['qtd'] > 0){echo "<span class='text-success'>Em estoque</span>";}else{echo "<span class='text-danger'>Indisponivel</span>";}?></span>
                    <br><br>

                    <div class="hstack">
                        <span>Quantidade:</span>
                        <select class="btn border border-1 border-dark-subtle dropdown-toggle ms-1" name="qtd">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                        </select>
                    </div>

                    <script>
                        function changeqtd(numero){
                            document.getElementById("qtd-button").innerHTML = numero.innerHTML;
                            document.getElementById("qtd").value = numero.innerHTML;
                        }
                    </script>

                    <input name="id_produto" value="<?= $produto[0]['id'] ?>" hidden>

                </div>
                <br>

                <center>
                    <!-- Botão de adicionar ao carrinho, é desabilitado caso o produto não esteja em estoque -->
                    <button class="btn btn <?php if($produto[0]['qtd'] <= 0){echo "disabled";}?> rounded-5" style="background-color:#FFD814; color:black; width: 200px;" type="submit">Adicionar ao carrinho</button>
                    <!-- Botão de comprar agora, é desabilitado caso o produto não esteja em estoque -->
                    <button class="btn btn <?php if($produto[0]['qtd'] <= 0){echo "disabled";}?> rounded-5 mt-3" style="background-color:#FFA41C; color:black; width: 200px;" type="submit">Comprar agora</button>
                    <br>
                    <br>
                    Enviado por <?= $manipula->getLojaByProdutoID($produto[0]['id_loja'])[0]['nome']?><br>
                    Vendido por <?= $manipula->getLojaByProdutoID($produto[0]['id_loja'])[0]['nome']?><br>
                </center>
            </form>    
        </div>
    </div>

    <!-- Horizontal Rule (Linha vertical para separar a seção do produto com a listagem de produtos relacionados) -->
    <hr style="width:80%; margin-left:11%;"/>
    <br/>
    <!-- Listagem de produtos relacionados -->
    <div style="width:80%; margin-left:11%;"><h4 class="fw-bold mt-2 ms-2">Produtos relacionados</h4></div>
    <div class="container-fluid" style="width:80%; margin-left:11%;">
        <div class="row">
            <?php 

                $produtos = new manipular_dados();
                $produtos->setTable("tb_produtos");
                foreach($produtos->getProdutosPorCategoria($_GET['produtocategoria']) as $produto){
            ?>
            
                <div class='img cols' style='max-width: 240px; max-height: 200px; width: auto; height: auto;'>
                    <a href="?secao=produto&produtoid=<?= $produto['id']?>&produtocategoria=<?= $produto['categoria']?>"><img src="<?= $produto['img_url'] ?>" id="imagem_produto"></a>
                </div>

            <?php }
            ?>
        </div>
    </div>
</div>
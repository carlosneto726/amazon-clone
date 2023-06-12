
<div>
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="z-n1 position-absolute carousel slide fixed-top" style="margin-top:100px; width: 100%;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <center><img src="img/carousel/img2.jpg" class="d-block" style="width: 80%; -webkit-mask-image: linear-gradient(to top, transparent 20%, white 70%);"></center>
            </div>
            <div class="carousel-item">
                <center><img src="img/carousel/img1.jpg" class="d-block" style="width:80%; -webkit-mask-image: linear-gradient(to top, transparent 20%, white 70%);"></center>
            </div>
            <div class="carousel-item">
                <center><img src="img/carousel/img3.jpg" class="d-block" style="width:80%; -webkit-mask-image: linear-gradient(to top, transparent 20%, white 70%);"></center>
            </div>
            <div class="carousel-item">
                <center><img src="img/carousel/img4.jpg" class="d-block" style="width:80%; -webkit-mask-image: linear-gradient(to top, transparent 20%, white 70%);"></center>
            </div>
            <div class="carousel-item">
                <center><img src="img/carousel/img5.jpg" class="d-block" style="width:80%; -webkit-mask-image: linear-gradient(to top, transparent 20%, white 70%);"></center>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
    



    <!-- Os produtos com as maiores estrelas -->
    <div class="container-fluid" style="width: 80%; margin-left: 11% ; margin-top: 19%; ">
        <div class="row">
        <?php 
            $i = 0;
            $consulta = new manipular_dados();
            $consulta->setTable("tb_produtos");
            foreach($consulta->getProdutosOrderByEstrelas() as $produto){

                // Limitador de produtos que aparecem na home (limita para apenas 8 produtos)
                $i++;
                if($i > 8){
                    break;
                }
                
        ?>

            <div class='col-3 card border-light rounded-0' style='width: 357px; height: 420px; margin-left: 11px; margin-top: 15px;'>
                <div class='card-body'>
                    <!-- Todo o conteudo do car está em um link para o usuário poder acessar a página do produto -->
                    <a href="?secao=produto&produtoid=<?= $produto['id']?>&produtocategoria=<?= $produto['categoria']?>" class='card-body text-decoration-none'>
                        <h5 class="fw-bold" style="font-family: sans-serif !important; color: black;"><?= $produto['titulo']?></h5>

                        <div class='img'>
                            <img src="<?= $produto['img_url'] ?>" id="imagem_produto" style="height: 230px !important;">
                        </div>

                        <br>

                        <h6 class="card-subtitle mb-2 text-body-secondary">R$ <?= number_format($produto['preco'],2,",",".")?></h6>
                        <p class="card-text text-truncate"><?= $produto['descricao']?></p>
                    </a>
                </div>
            </div>

        <?php }
        ?>
        </div>
    </div>



    <!-- Listagem de produtos em organizados por categoria -->
    <?php 
        $categorias = new manipular_dados();
        $categorias->setTable("tb_categorias");
        foreach($categorias->getAllDataTable() as $categoria){
    ?>

        <div class="categoria" style="width: 76.9%; margin-left: 11.5% ;background-color: white; margin-top: 15px;">
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


    <!-- Botão que jsAlert que avisa quando um produto é adicionado ao carrinho -->
    <?php if(@$_SESSION['message_alertJs'] != ""){?>
        <div class="position-fixed bottom-0 end-0 z-1 m-5">
            <div id="liveAlertPlaceholder"></div>
        </div>
    <?php }?>
    


    <script>
        // Script que faz aparecer um jsAlert toda vez que um produto é adicionado ao carrinho
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
        const appendAlert = (message, type) => {
        const wrapper = document.createElement('div')
        wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
        ].join('')

        alertPlaceholder.append(wrapper)
        }

        // Variaveis que são passadas pelo o arquivo adm/carrinho/adicionar_carrinho.php
        var mensagem = "<?php echo @$_SESSION['message_alertJs']; ?>";
        var tipo = "<?php echo @$_SESSION['type_alertJs']; ?>";

        appendAlert(mensagem, tipo)

    </script>
    
</div>


<?php 
// Limpando as variáveis globais
$_SESSION['message_alertJs'] = ""; 
$_SESSION['type_alertJs'] = ""; 
?>
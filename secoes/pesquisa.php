<?php
    include_once("dao/manipular_dados.php");
    $manipula = new manipular_dados();

    // Post da pesquisa do menu
    $pesquisa = $_POST['pesquisa'];
?>


<h5 style="margin-top: 120px; margin-left:420px;">Exibindo resultados para <span class="fw-bold"><?= $pesquisa ?>.</span></h5>
<h4 class="fw-bold" style="margin-left:420px;">Resultados</h4>


<div class="hstack">
    <!-- Sidenav -->
    <div style="width:420px; height: 100%;">
        <p style="margin-left: 60px;">
            <span class="fw-bold">Avaliação do Cliente</span> <br>
                <!-- 1 estrela e acima -->
                <img src="img/icons/star-fill.svg"><img src="img/icons/star.svg"><img src="img/icons/star.svg"><img src="img/icons/star.svg"><img src="img/icons/star.svg"> e acima <br>
                <!-- 2 estrela e acima -->
                <img src="img/icons/star-fill.svg"><img src="img/icons/star-fill.svg"><img src="img/icons/star.svg"><img src="img/icons/star.svg"><img src="img/icons/star.svg"> e acima <br>
                <!-- 3 estrela e acima -->
                <img src="img/icons/star-fill.svg"><img src="img/icons/star-fill.svg"><img src="img/icons/star-fill.svg"><img src="img/icons/star.svg"><img src="img/icons/star.svg"> e acima <br>
                <!-- 4 estrela e acima -->
                <img src="img/icons/star-fill.svg"><img src="img/icons/star-fill.svg"><img src="img/icons/star-fill.svg"><img src="img/icons/star-fill.svg"><img src="img/icons/star.svg"> e acima <br>

                <br>
                <br>

            Preços de Games <br>
                Até R$500 <br>
                R$500 a R$1000 <br>
                R$1000 a R$1500 <br> 
                R$2000 a R$2500 <br>
                Mais de R$2500 <br>
        </p>
    </div>

    <div class="grid-container-pesquisa" >

    <!-- Listagem dos produtos contendo a pesquisa -->
    <?php
        foreach($manipula->getPesquisa($pesquisa) as $produto){
            ?>  

            <!-- Card dos produtos -->
            <div class='card border-light rounded-0' style='width: 350px; height: 420px;'>
                <!-- O card inteiro está dentro da tag <a> para redirecionar o usuario para a pagina do produto -->
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
    <?php }?>

    </div>

</div>










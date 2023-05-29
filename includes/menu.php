<?php 
session_start();

// Variavel que retorna um boolean caso o usuário esteja logado = true, deslogado = false
$isset = IsSet($_COOKIE['email']);

?>

<div class="container-fluid">
    <a class="navbar-brand p-2" href="?secao=home"><img src="img/amazon_logo.svg" width="100"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav me-auto mb-2 mb-lg-0">

            <div class="nav-item me-2">
                <a class="nav-link fw-bold" href="#"><img class="mb-1 me-1" src="img/icons/geo.svg">Selecione o endereço</a>
            </div>


            <div class="nav-item">
                <div class="input-group">
                <form class="d-flex" role="search" action="?secao=pesquisa" method="POST">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Todos
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Todos os departamentos</a></li>
                            <li><a class="dropdown-item" href="#">Alexa Skills</a></li>
                            <li><a class="dropdown-item" href="#">Alimentos</a></li>
                        </ul>
                    </div>

                    <input class="form-control" style="width:1045px;" type="search" placeholder="Pesquisa AmazonClone.com.br" aria-label="Search" name="pesquisa">
                    <button class="btn btn" style="background-color:#FEBD69;color:black;" type="submit"><img src="img/icons/search.svg"></button>
                </form>
                </div>
            </div>
            
            <?php 
            include_once("dao/manipular_dados.php");

            $manipula = new manipular_dados();
            // Caso o usuario logado seja o adm@adm
            if(@$_COOKIE['email'] == "adm@adm"){?>
                <div class="dropdown nav-item ms-2">
                    <a class="nav-link fw-bold dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo "Olá ". $manipula->getUsuarioByEmail($_COOKIE['email'])[0]['nome'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="adm/crud_produtos/administrador.php">Administração de produtos</a></li>
                        <li><a class="dropdown-item" href="adm/login/sair.php">Sair</a></li>
                    </ul>
                </div>
            <?php

            
            }else if($isset){ 
            // Caso o usuario esteja logado, irá aparecer o dropdown com os botões
            ?>

                <div class="dropdown nav-item ms-2">
                    <a class="nav-link fw-bold dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo "Olá ". $manipula->getUsuarioByEmail($_COOKIE['email'])[0]['nome'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Sua conta</a></li>
                        <li><a class="dropdown-item" href="?secao=pedidos">Seus pedidos</a></li>
                        <li><a class="dropdown-item" href="adm/login/sair.php">Sair</a></li>
                    </ul>
                </div>


                <div class="nav-item ms-2">
                    <a class="nav-link fw-bold" aria-current="page" href="?secao=pedidos">Pedidos</a>
                </div>

                <div class="nav-item ms-2">
                    <a class="nav-link fw-bold" aria-current="page" href="?secao=carrinho"><img src="img/icons/cart.svg"> Carrinho</a>
                </div>
                                
            <?php
            // Caso não aparecerá apenas o botão de login
            }else{ ?>


                <div class="nav-item ms-2">
                    <a class="nav-link fw-bold" aria-current="page" href="adm/login/login.php">Login</a>
                </div>

                <div class="nav-item ms-2">
                    <a class="nav-link fw-bold" aria-current="page" href="adm/login/login.php">Pedidos</a>
                </div>

                <div class="nav-item ms-2">
                    <a class="nav-link fw-bold" aria-current="page" href="adm/login/login.php"><img src="img/icons/cart.svg"> Carrinho</a>
                </div>

            <?php } ?>


        </div>
    </div>
</div>
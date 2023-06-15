<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="../../css/app.css?v=<?php echo time();?>" id="appcss">
    <link rel="icon" href="../../img/icons/amazon_a.svg">
    <title>Acessar AmazonClone</title>
</head>


<body style="background-color:white; color:black;">
    
    <center><a href="../../index.php"><img src="../../img/icons/amazonblack_logo.svg" class="mt-3 mb-3" style="height:35px;"></a></center>

    <!-- Card para fazer o login -->
    <div class="container card" style="max-width:350px; color:black;">
        <div class="card-body">
        <h4>Fazer login</h4>

            <p class="card-text text-break">
                <div class="center-login">
                    <form method="post" action="validar_cookie.php">
                        <div>
                            <h6>Email</h6>
                            <input class="w-100" type="email" name='email'>
                        </div>
                        <div class="mt-2">
                            <h6>Senha</h6>
                            <input class="w-100" type="password" name='password'>
                        </div>

                        <button type="submit" class="btn btn w-100 mt-3" style="background-color:#FFD814;">Fazer login</button>
                    </form>
                </div>
                </p>
            </div>
        </div>
        <div id="liveAlertPlaceholder" class="z-3 position-fixed bottom-0 end-0"></div>
    </div>

    <center class="mt-4">
        <hr class="w-100" style="max-width:100px; margin-right:235px;">
        <h6 style="width:150px; margin-top:-26px;">Novo na Amazon?<h6/>
        <hr class="w-100" style="max-width:100px; margin-left:235px; margin-top:-15px;">
    </center>



    <!-- Botão para o usuário cadastrar uma conta -->
    <center>
        <button class="btn btn w-100 mt-3" style="max-width:350px; border:solid 1px black;" data-bs-toggle="modal" data-bs-target="#modal">Criar a sua conta da Amazon</button>
    </center>

    
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Crie a sua conta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="cadastrar.php">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Seu nome</label>
                                <input type="text" class="form-control" name="nome">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Seu endereço Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                                <div id="emailHelp" class="form-text">Coloque a sua melhor senha.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="senha">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Criar Conta</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    

    <!-- Rodapé -->
    <center><img  style="min-width:30%; max-width:80%;"src="../../img/rodape1_login.png" alt=""></center>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
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

</body>
</html>


<?php 
// Limpando as variáveis globais
$_SESSION['message_alertJs'] = ""; 
$_SESSION['type_alertJs'] = ""; 
?>
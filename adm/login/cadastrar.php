<?php

    session_start();
    include_once('../../dao/manipular_dados.php');

    $checkusers = new manipular_dados();

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];


    $checkusers->setTable("tb_usuarios");
    $users = $checkusers->getAllDataTable();

    $cadastrado = $checkusers->validarLoginExistente($email);

    if($cadastrado){
        $_SESSION['message_alertJs'] = "Erro ao cadastrar usuário, e-mail já registrado.";
        $_SESSION['type_alertJs'] = "danger";
        
        header("Location: login.php");
        exit();
    }else{
        $checkusers->setFields("nome,email,senha");
        $checkusers->setDados("'$nome','$email','$senha'");
        $checkusers->insert();


        $_SESSION['message_alertJs'] = "Usuário cadastrado com sucesso!";
        $_SESSION['type_alertJs'] = "success";
        header("Location: login.php");
        exit();
    }
    
?>

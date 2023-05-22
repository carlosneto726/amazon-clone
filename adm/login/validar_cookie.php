<?php

    session_start();
    include_once('../../dao/manipular_dados.php');

    $manipula = new manipular_dados();

    // Recebendo as variaveis do POST
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Definindo a tebela da consulta do banco de dados
    $manipula->setTable("tb_usuarios");

    // Retorna a quantidade de usuarios registrados com o email e usuarios passados como parametro
    $linhas = $manipula->validarLogin($email, $password);

    // Caso não exista um usuário registrado no banco de dados
    if($linhas == 0){
        $_SESSION['jsAlert'] = "<script>alert('Usuário e/ou senha incorreto(s)')</script>";
        header("Location: ../../index.php");
        exit();
    }else{
        // Definindo a variavel global e o coockie  email
        $_SESSION['email'] = $email;
        setcookie("email", $email, time() + (86400 * 30), "/");  

        // Voltando para o index
        header("Location: ../../index.php");
        exit();
    }
?>
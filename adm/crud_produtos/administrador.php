<?php
    include_once("../../dao/manipular_dados.php");
    session_start();

    
    $acao =  $_POST["acao"];
    if ($acao == "Deletar"){
        $id =  $_POST["id"];
        $delete = new manipular_dados();
        $delete->delete($id);

        $_SESSION["alerta"] = "<script>alert('Apagado com Sucesso!')</script>";

        header("Location: ../../?secao=administrar");
        exit();

    }
    if($acao == "Enviar"){
        $id_loja =  $_POST["id_loja"];
        $titulo =  $_POST["titulo"];
        $descricao =  $_POST["descricao"];
        $estrelas =  $_POST["estrelas"];
        $marca =  $_POST["marca"];
        $preco =  $_POST["preco"];
        $categoria =  $_POST["categoria"];
        $qtd = $_POST["qtd"];
        $nome_arquivo =  $_FILES["img_url"]['name'];
        if(!empty($nome_arquivo)) {
            $url_local = "img/produtos/".$nome_arquivo;
            $url_local_salvo = "../../img/produtos/".$nome_arquivo;
            move_uploaded_file($_FILES['img_url']['tmp_name'], $url_local_salvo);
        }
        $enviar = new manipular_dados();
        $enviar->setTable("tb_produtos");
        $enviar->setFields("id_loja, titulo, descricao, estrelas, marca, preco, categoria, qtd, img_url");
        $enviar->setDados("'$id_loja','$titulo','$descricao','$estrelas', '$marca', '$preco', '$categoria', '$qtd', '$url_local' ");
        $enviar->insert();
        $_SESSION["alerta"] = "<script>alert('Enviado com Sucesso!')</script>";

        header("Location: ../../?secao=administrar");
        exit();

    }if($acao == "Atualizar"){
        $id_loja =  $_POST["id_loja"];
        $titulo =  $_POST["titulo"];
        $descricao =  $_POST["descricao"];
        $estrelas =  $_POST["estrelas"];
        $marca =  $_POST["marca"];
        $preco =  $_POST["preco"];
        $categoria =  $_POST["categoria"];
        $qtd = $_POST["qtd"];
        $nome_arquivo =  $_FILES["img_url"]['name'];
        if(!empty($nome_arquivo)) {
            $url_local = "img/produtos/".$nome_arquivo;
            $url_local_salvo = "../../img/produtos/".$nome_arquivo;
            move_uploaded_file($_FILES['img_url']['tmp_name'], $url_local_salvo);
        }
        $update = new manipular_dados();
        $update->update($id_loja, $titulo, $descricao, $estrelas, $marca, $preco, $categoria, $qtd, $url_local);

        $_SESSION["alerta"] = "<script>alert('Atualizado com Sucesso!')</script>";

        header("Location: ../../?secao=administrar");
        exit();

    }
    

?>
<?php

include_once("conexao.php");

class manipular_dados extends conexao{
    protected $table, $fields, $dados, $status, $fieldId, $valueId;

    public function setTable($tabela){
        $this->table = $tabela;
    }

    public function setFields($campos){
        $this->fields = $campos;
    }

    public function setFieldId($chavep){
        $this->fieldId = $chavep;
    }

    public function setValueId($valorchave){
        $this->valueId = $valorchave;
    }

    public function setDados($valores){
        $this->dados = $valores;
    }

    public function getStatus(){
        return $this->status;
    }


    // Insere uma linha na tabela especificada com setTable('tabela');
    // com os campos definidos pelo setFields("'col1','col2','col3'");
    // e com os dados definidos pelo setDados("'val1', 'val2', 'val3'");
    public function insert(){
        $this->sql = "INSERT INTO $this->table($this->fields) VALUES ($this->dados);";

        if(self::exeSQL($this->sql)){
            $this->status = "Cadastro com sucesso";
        }else{
            $this->status = "Erro ao cadastrar".mysqli_error(self::connect());
        }
    }

    // Retorna uma lista com todos os item da tabela definica pelo setTable('tabela')
    public function getAllDataTable(){
        $this->sql = "SELECT * FROM $this->table;";
        $this->qr = self::exeSQL($this->sql);

        $listaresp = array();

        while($row = @mysqli_fetch_assoc($this->qr)){
            array_push($listaresp, $row);
        }

        return $listaresp;
    }


    // Retorna uma lista com todos os produtos com a categoria especificada
    public function getProdutosPorCategoria($categoria){
        $this->sql = "SELECT * FROM $this->table WHERE categoria = '".$categoria."';";
        $this->qr = self::exeSQL($this->sql);

        $listaresp = array();

        while($row = @mysqli_fetch_assoc($this->qr)){
            array_push($listaresp, $row);
        }
        
        return $listaresp;
    }


    // Retorna os produtos com o id especificado
    public function getProdutosPorID($id){
        $this->sql = "SELECT * FROM tb_produtos WHERE id = $id;";
        $this->qr = self::exeSQL($this->sql);

        $listaresp = array();

        while($row = @mysqli_fetch_assoc($this->qr)){
            array_push($listaresp, $row);
        }
        
        return $listaresp;
    }

    // Retorna uma lista de lojas do id espeficicado
    public function getLojaByProdutoID($id){
        $this->sql = "SELECT * FROM tb_lojas WHERE id = $id;";
        $this->qr = self::exeSQL($this->sql);

        $listaresp = array();

        while($row = @mysqli_fetch_assoc($this->qr)){
            array_push($listaresp, $row);
        }
        
        return $listaresp;
    }


    // Retorna a quantidade de usuários com o email e a senha especificada (caso seja 0, não existe o usuário)
    public function validarLogin($email, $senha){

        $this->sql = "SELECT * FROM tb_usuarios WHERE email ='$email' and senha ='$senha'";
        $this->qr = self::exeSQL($this->sql);
        $linhas = @mysqli_num_rows($this->qr);
        return $linhas;
    }


    // Retorna o carrinho de um id de um usuário especificado
    public function getCarrinho($id){

        $this->sql = "SELECT * FROM tb_carrinho WHERE id_usuario = $id";
        $this->qr = self::exeSQL($this->sql);

        $listaresp = array();

        while($row = @mysqli_fetch_assoc($this->qr)){
            array_push($listaresp, $row);
        }
        
        return $listaresp;
    }


    // Deleta um produto especifico de um carrinho pelo o id de um produto do carrinho
    public function dellProdutoCarrinho($id_carrinho){
        $this->sql = "DELETE FROM tb_carrinho WHERE id = $id_carrinho;";
        $this->qr = self::exeSQL($this->sql);
    }

    // Deleta todos os produtos do carrinho especificando o id de um usuário
    public function dellAllProdutosCarrinho($id){
        $this->sql = "DELETE FROM tb_carrinho WHERE id_usuario = $id;";
        $this->qr = self::exeSQL($this->sql);
    }

    // Retorna uma lista de usuários com o email especificado
    public function getIdByEmail($email){

        $this->sql = "SELECT * FROM tb_usuarios WHERE email = '".$email."'";
        $this->qr = self::exeSQL($this->sql);
        
        $listaresp = array();

        while($row = @mysqli_fetch_assoc($this->qr)){
            array_push($listaresp, $row);
        }
        
        return $listaresp;
    }

    // Atualizando a quantidade de produtos no banco de dados
    public function updateProduto($id, $qtd){
        $this->sql = "UPDATE tb_produtos SET qtd = '".$qtd."' WHERE id = $id ;";
        $this->qr = self::exeSQL($this->sql);
    }


    // Retorna uma lista de produtos com o nome especificado
    public function getPesquisa($str){

        $this->sql = "SELECT * FROM tb_produtos WHERE titulo like '%".$str."%';";
        $this->qr = self::exeSQL($this->sql);

        $listaresp = array();

        while($row = @mysqli_fetch_assoc($this->qr)){
            array_push($listaresp, $row);
        }
        
        return $listaresp;
        
    }

    // Retorna todos os produtos ordenado pela a quantidade de estrelas do maior para o menor e com quantidade de estoque maior que 0
    public function getProdutosOrderByEstrelas(){

        $this->sql = "SELECT * FROM tb_produtos WHERE qtd > 0 ORDER BY estrelas DESC;";
        $this->qr = self::exeSQL($this->sql);

        $listaresp = array();

        while($row = @mysqli_fetch_assoc($this->qr)){
            array_push($listaresp, $row);
        }
        
        return $listaresp;
        
    }

}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.html">Home</a>
    <hr>
    <h2>Cadastro de produtos</h2>

    <div>
        <form method="post">
            <label for="nome" id="lblNome">Nome:</label>
            <input type="text" name="nome" id="nome">
            <br>
            <br>
            <label for="preco" id="lblPreco">Preço:</label>
            <input type="text" name="preco" id="preco">
            <br>
            <br>
            <label for="cod" id="lblCod">Código:</label>
            <input type="text" name="cod" id="cod">
            <br>
            <br>
            <label for="desc" id="lblDescr">Descricao:</label>
            <input type="text" name="desc" id="desc">
            <br>
            <br>
            <br>
            <input type="submit" id="btn" name="botao" value="Cadastrar">
        </form>
    </div>
</body>
</html>


<?php  
    

    function Cadastrar($cod,$nome,$desc,$valor){
        try {          
            if ((trim($cod) == "") || (trim($nome) == "")|| (trim($desc) == "")|| (trim($valor) == "")) {
                echo "<span id='warning'>Todos os campos são necessarios são obrigatórios!</span>";
            } else {
                $floatValor = floatval($valor);
                $intCod = intval($cod);

                include("conexaoBD.php");

                //verificando se o cod informado já existe no BD para não dar exception

                $stmt = $pdo->prepare("select * from ProdutosPHP where cod = :cod");
                $stmt->bindParam(':cod', $intCod); 

                $stmt->execute();

                $rows = $stmt->rowCount();

                if ($rows <= 0) {
                    $stmt = $pdo->prepare("insert into ProdutosPHP (cod, nome,descricao,valor) values(:cod, :nome, :descricao, :valor)");
                    $stmt->bindParam(':cod', $intCod);
                    $stmt->bindParam(':nome', $nome);
                    $stmt->bindParam(':descricao', $desc);
                    $stmt->bindParam(':valor', $valor);
                    $stmt->execute();

                    echo "<span id='sucess'>Produto Cadastrado!</span>";
                } else {
                    echo "<span id='error'>Produto com mesmo código já existente!</span>";
                }
            }

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        $pdo = null;
    }

    if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["botao"])) {
        $cod = $_POST["cod"];
    $nome = $_POST["nome"];
    $desc = $_POST["desc"];
    $valor = $_POST["preco"];
        Cadastrar($cod,$nome,$desc,$valor);
        
    }
?>
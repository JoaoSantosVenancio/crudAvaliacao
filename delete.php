<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <a href="index.html"> Home</a> | <a href="consulta.php">Consulta</a>
    <hr>

</body>
</html>


<?php
    if(!isset($_GET["cod"])){
        echo "Selecione o aluno a ser excluído";
    }else{
        $cod = $_GET["cod"];

        try{
            include("conexaoBD.php");

            $stmt = $pdo -> prepare('DELETE FROM ProdutosPHP WHERE cod = :cod'); 
            $stmt -> bindParam(':cod', $cod); 

             $stmt -> rowCount();
            echo "<h2> Produto $cod Removido com Sucesso </h2>";
            
            $stmt -> execute();

        }catch(PDOException $e){
            echo 'Error: ' . $e -> getMessage();
        }

        $pdo = null;
    }
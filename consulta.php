<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<title>Consulta</title>
</head>
<body>
	<a href="index.html"> Inicio </a>

	<h2>Meus Produtos</h2>
	<form method="post">
		<input type="text" size="10" name="cod">
		<input type="submit" name="busca">
	</form>

	<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST"){
		include ("conexaoBD.php");

		if (isset($_POST["cod"]) && (trim($_POST["cod"] != ""))){ 
			$cod = $_POST["cod"];

			$stmt = $pdo->prepare("select * from ProdutosPHP where cod = :cod");
			$stmt->bindParam(':cod', $cod);
		}
		else {
			$stmt = $pdo->prepare("select * from ProdutosPHP order by cod");
		}

		try{
			$stmt->execute();

			echo "<table border='1px'>";
			echo "<tr>";
			echo "<th>Código</th>";
			echo "<th>Nome</th>";
			echo "<th>Descrição</th>";
            echo "<th>Valor</th>";
			echo "<th> Remover </th>";
			echo "</tr>";

			$stmt->execute();

			while ($row = $stmt->fetch()){
				echo "<tr>";
				echo "<td>" . $row['cod'] . "</td>";
				echo "<td>" . $row['nome'] . "</td>";
				echo "<td>" . $row['descricao'] . "</td>";
                echo "<td>" . $row['valor'] . "</td>";

				echo "<td>";

				echo "<a href='delete.php?cod=" . $row['cod'] . "'><img src='remover.png' width='20px'></a>";

				echo "</td>";
			}
			echo "</table>";
		}catch (PDOException $e){
			echo 'Error' . $e->getMessage();
		}

		$pdo = null;
	}
	?>
</body>
</html>

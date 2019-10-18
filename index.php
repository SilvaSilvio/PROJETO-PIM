<!DOCTYPE html>
<html>
<head>
	<title>Principal</title>
</head>

<body>
	<fieldset>
		<legend>Produto</legend>
		<form method=get>
			Nome <input type=text name=produtoNome><br>
			Valor Venda <input type=text name=produtoPreco_venda maxlength=11><br>
			<input type=submit name=produtoCadastrar value=Cadastrar>
			<input type=submit name=produtoListar value=Listar>
		</form>
	</fieldset>

<?php
	session_start();

	if ( isset($_SESSION["usernameUsuario"]) )
	{
		include_once "Produto.php";

		// mysqli
		//$p= new \produto\Produto($conexaodb->real_escape_string($_GET['produtoNome']), $conexaodb->real_escape_string($_GET['produtoPreco_venda']));

		// pdo
		$p= new \produto\Produto($_GET['produtoNome'], $_GET['produtoPreco_venda']);

		if ( isset($_GET["produtoCadastrar"]) )
		{
			$p->inserir($conexaodb);

			\produto\listar($conexaodb);
		}

		if ( isset($_GET["produtoListar"]) )
			\produto\listar($conexaodb);

		//mysqli_close($conexaodb);
	}
?>

</body>
</html>
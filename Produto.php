<?php namespace produto; ?>
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

<?php //namespace produto;

use PDO;

	include_once 'db.inc';

	class Produto
	{
		private $id, $nome, $preco_venda;

		function __construct(...$parametros)
		{
			switch ( count($parametros) )
			{
				case 0:
					break;

				case 2:
					$this->nome= $parametros[0];
					$this->preco_venda= $parametros[1];
					break;

				case 3:
					$this->id= $parametros[0];
					$this->nome= $parametros[1];
					$this->preco_venda= $parametros[2];
					break;

				default:
					echo "Objeto criado com quantidade incompatível de parâmetros";
					break;
			}
		}

		function __set($atributo, $valor)
		{
			$this->$atributo= $valor;
		}

		function __get($atributo)
		{
			return $this->$atributo;
		}

		public function inserir($conexaodb)
		{
			// mysqli
			/*$conexaodb->query("INSERT INTO PRODUTO (nome, preco_venda) VALUES ('{$conexaodb->real_escape_string($this->nome)}', {$conexaodb->real_escape_string($this->preco_venda)})") or die(mysqli_error($conexaodb));*/

			// pdo
			$conexaodb->prepare("INSERT INTO PRODUTO (nome, preco_venda) VALUES ('{$this->nome}', {$this->preco_venda})")->execute();

			echo "Inserido com sucesso<br>";
		}
	}


?>	<form method=get>
		<div>
<?php
	function listar($conexaodb)
	{
		// mysqli
		//$consulta= $conexaodb->query("select * from PRODUTO") or die(mysqli_error($conexaodb));

		// mysqli
		//while ( $item = $consulta->fetch_assoc() )

		// pdo
		foreach ( $conexaodb->query("select * from PRODUTO order by id")->fetchAll(PDO::FETCH_ASSOC) as $item )
		{ ?>
				<input type=checkbox style="min-width: 10PX;" name=selecaoProdutos[] value=<?=$item['id']?>>
			<form method=get style="display:inline-block;">
				<input type=text name=idProduto value=<?=$item['id']?> readonly>
				<input type=text name=nomeProduto value=<?=$item['nome']?>>
				<input type=text name=preco_vendaProduto value=<?=$item['preco_venda']?>>
				<input type=submit name=editarProduto value=Editar>
				<input type=submit name=deletarProduto value=Deletar>
			</form> <br>
	<?php } ?>

		<input type=submit name=excluirSelecaoProdutos value='Excluir Selecionados'>
		</div>

<?php } ?>

	</form>

<?php
	if ( isset($_GET['excluirSelecaoProdutos']) )
	{
		foreach ( $_GET['selecaoProdutos'] as $selecionados )
		{
			// mysqli
			//$conexaodb->query("delete from PRODUTO where id = {$conexaodb->real_escape_string($selecionados)}");

			// pdo
			$conexaodb->prepare("delete from PRODUTO where id = {$selecionados}")->execute();

		}

		listar($conexaodb);
	}

	//if ( idfuncao == (dono || vendedor) )
	elseif ( isset($_GET['deletarProduto']) )
	{
		// mysqli
		//$conexaodb->query("delete from PRODUTO WHERE id = {$conexaodb->real_escape_string($_GET['idProduto'])}");

		// pdo
		$conexaodb->prepare("delete from PRODUTO WHERE id = {$_GET['idProduto']}")->execute();

		listar($conexaodb);
	}

	elseif ( isset($_GET['editarProduto']) )
	{
		// mysqli
		//$conexaodb->query("update PRODUTO set nome = '{$conexaodb->real_escape_string($_GET['nomeProduto'])}' where id = {$conexaodb->real_escape_string($_GET['idProduto'])}");

		// pdo
		$conexaodb->prepare("update PRODUTO set nome = '{$_GET['nomeProduto']}' where id = {$_GET['idProduto']}")->execute();

		listar($conexaodb);
	}

	// código abaixo chama as funções e métodos caso o usuário esteja autenticado
	session_start();

	if ( isset($_SESSION["idUsuario"]) && $_SESSION["usernameUsuario"] && $_SESSION["senhaUsuario"] )
	{
		//include_once "Produto.php";

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
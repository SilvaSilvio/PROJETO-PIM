<?php namespace produto; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Produtos</title>
</head>
<body>
<?php

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
			
			$conexaodb->prepare("INSERT INTO PRODUTO (nome, preco_venda) VALUES ('{$this->nome}', '{$this->preco_venda}')")->execute();
			echo "Inserido com sucesso<br>";
		}
	}

?>
	<form method=get>
		<div>
<?php
	function consulta($conexaodb, $orderBy)
	{

		foreach ( $conexaodb->query("select * from PRODUTO {$orderBy}")->fetchAll(PDO::FETCH_ASSOC) as $item )
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
	
	function listar($conexaodb)
	{
		consulta($conexaodb, "order by id");
	}

	function filtrar($conexaodb)
	{
		consulta($conexaodb, "where PRODUTO.nome ilike '{$_GET["produtoNome"]}%' order by PRODUTO.id");
	}

	if ( isset($_GET['excluirSelecaoProdutos']) )
	{
		foreach ( $_GET['selecaoProdutos'] as $selecionados )
		{
			$conexaodb->prepare("delete from PRODUTO where id = {$selecionados}")->execute();

		}

		listar($conexaodb);
	}

	elseif ( isset($_GET['deletarProduto']) )
	{
		$conexaodb->prepare("delete from PRODUTO WHERE id = {$_GET['idProduto']}")->execute();

		listar($conexaodb);
	}

	elseif ( isset($_GET['editarProduto']) )
	{
		
		$conexaodb->prepare("update PRODUTO set nome = '{$_GET['nomeProduto']}' where id = {$_GET['idProduto']}")->execute();

		listar($conexaodb);
	}

	session_start();

	if ( isset($_SESSION["idUsuario"]) && $_SESSION["usernameUsuario"] && $_SESSION["senhaUsuario"] )
	{
		$p= new \produto\Produto($_GET['produtoNome'], $_GET['produtoPreco_venda']);

		if ( isset($_GET["produtoCadastrar"]) )
		{
			$p->inserir($conexaodb);

			\produto\listar($conexaodb);
		}

		if ( isset($_GET["produtoListar"]) )
			\produto\listar($conexaodb);

		if ( isset($_GET["produtoBuscar"]) )
			\produto\filtrar($conexaodb);

	}
?>
</body>
</html>
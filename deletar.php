<?php
	include_once 'db.inc';

?>	<form action=deletar.php method=get>
		<table>

<?php
	function buscar($conexaodb)
	{
		$consulta= $conexaodb->query("select * from PRODUTO") or die(mysqli_error($conexaodb));
?>

<?php
		while ( $item = $consulta->fetch_assoc() )
		{?>
			<tr>
				<td><input type=checkbox name="selecaoProdutos[]" value="<?=$item['id']?>"></td>
				<td><?=$item[id]?></td> <td><?=$item[nome]?></td> <td><?=$item[valor_compra]?></td>
				<td>
					<form method=get>
						<input type=hidden name=idProduto value=<?=$item['id']?>>
						<input type=submit name=deletarProduto value=Deletar>
					</form>
				</td>
			</tr>
	<?php } ?>

		</table>
		<input type=submit name=excluirSelecao value='Excluir Selecionados'>
<?php } ?>

	</form>

<?php
	if ( isset($_GET[excluirSelecao]) )
		foreach ($_GET[selecaoProdutos] as $selecionados )
			$conexaodb->query("delete from PRODUTO where id = {$selecionados}");

	if ( isset($_GET[deletarProduto]) )
		$conexaodb->query("delete from PRODUTO WHERE id = {$_GET[idProduto]}");

	buscar($conexaodb);
?>
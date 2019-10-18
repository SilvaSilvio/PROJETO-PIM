<!--div class="container"-->
	<form action="mult.php" method="GET">

			<?php
			include 'db.inc';

?>			<table>

<?php		function buscar($conexaodb)
			{
				$consulta= $conexaodb->query("SELECT * FROM PRODUTO ORDER BY id");
?>

<?php
			while ($result = $consulta->fetch_row())
			{
			?>

			<tr>
				<th scope="row"><?=$result[0]?></th>
				<td><?=$result[1]?></td>
				<td><input type="checkbox" value="<?=$result[0]?>" name="selecionado[]"></td>
			</tr>

			<?php } ?>
		</table>

		

		<input type="submit" value="excluir">
	<?php }

			if (isset($_GET['selecionado']))
				foreach($_GET['selecionado'] as $cod)
					$conexaodb->query("DELETE FROM PRODUTO WHERE id = $cod");
			else
				echo 'não foi submetido';
	 ?>
	</form>
	<?php buscar($conexaodb); ?>
<!--/div--> 
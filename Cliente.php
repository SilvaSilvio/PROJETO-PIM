<?php namespace Cliente;?>

<?php
use PDO;

	include_once 'db.inc';

	class Cliente
	{
		private $id_cliente, $nome_cliente, $cpf_cliente, $tel_cliente, $end_cliente;

		/*function __construct(...$parametros)
		{
			switch ( count($parametros) )
			{
				case 0:
					$this->nome_cliente= $parametros[0];
					$this->cpf_cliente= $parametros[1];
					$this->tel_cliente= $parametros[2];
					$this->end_cliente=$parametros[3];
					echo "passou";

				break;

				default:
					echo "Objeto criado com quantidade incompatível de parâmetros";
			}
			*/
		}

		function __set($atributo, $valor)
		{
			$this->$atributo = $valor;
		}

		function __get($atributo)
		{
			return $this->$atributo;
		}

		public function inserir($conexaodb)
		{
	$conexaodb->prepare("INSERT INTO CLIENTE (nome_cliente, cpf_cliente, tel_cliente, end_cliente) VALUES ('{$this->nome_cliente}', '{$this->cpf_cliente}', '{$this->tel_cliente}', '{$this->end_cliente}')")->execute();

			echo "Inserido com sucesso<br>";
		}
	}

		$cliente = new \Cliente\Cliente($_GET['nomeCliente'], $_GET['cpfCliente'], $_GET['telefoneCliente'], $_GET['enderecoCliente']);

		if ( isset($_GET["clienteCadastrar"]) )
		{
			$cliente->inserir($conexaodb);

		}

		if ( isset($_GET["clienteListar"]) )
			\produto\listar($conexaodb);

		if ( isset($_GET["clienteBuscar"]) )
			\produto\filtrar($conexaodb);


?>

</body>
</html>
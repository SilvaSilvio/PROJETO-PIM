<form method=get>
	username <input type=text name=usernameUsuario> <br>
	senha <input type=text name=senhaUsuario> <br>
	<input type=submit value=Logar>
</form>

<?php
include_once 'db.inc';

	foreach ( $conexaodb->query("select * from USUARIO")->fetchAll(PDO::FETCH_ASSOC) as $usuario )
		if ( $_GET["usernameUsuario"] == $usuario["username"] && $_GET["senhaUsuario"] == $usuario["senha"] )
		{
			header("Location: Produto.php");

			session_start();
			$_SESSION["idUsuario"]= $usuario["id"];
			$_SESSION["usernameUsuario"]= $usuario["username"];
			$_SESSION["senhaUsuario"]= $usuario["senha"];

			break;
		}

	if ( isset($_SESSION["usernameUsuario"]) && isset($_SESSION["senhaUsuario"]) )
		foreach ( $conexaodb->query("select * from \"USUARIO-FUNCAO\"")->fetchAll(PDO::FETCH_ASSOC) as $funcaoUsuario )
			if ( $funcaoUsuario["id_usuario"] == $_SESSION["idUsuario"] )
				$_SESSION["idFuncaoUsuario"]= $funcaoUsuario["id_funcao"];

	if ( empty($_SESSION["usernameUsuario"]) && empty($_SESSION["senhaUsuario"]) && ( isset($_GET["usernameUsuario"]) || isset($_GET["senhaUsuario"]) ) )
	{ ?>
		<h1>Usuário não cadastrado</h1>
<?php } ?>
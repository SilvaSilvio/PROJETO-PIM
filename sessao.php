<!DOCTYPE html>
<html>
<head>
	<title>Principal</title>
</head>

<body>

<?php
	session_start();

	print_r($_SESSION["idUsuario"] . $_SESSION["usernameUsuario"] . $_SESSION["senhaUsuario"]);

?>
</body>
</html>
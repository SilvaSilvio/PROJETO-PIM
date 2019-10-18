<?php

	//$servidor= 'localhost', $usuario= 'finder', $senha= 'finder', $db= 'finder';
	/*try { $conexaodb= mysqli_connect('finder.local', 'finder', 'finder', 'finder'); }
	catch ( Exception $e ) { echo $e->getMessage(); }*/

	//$pdo= new PDO('mysql:host=finder.local;dbname=finder','finder','finder');
	try
	{
		$conexaodb= new PDO('pgsql:host=localhost;port=5432;dbname=sgr', 'postgres', 'postgres');
		$conexaodb->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
   		$conexaodb->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    	$conexaodb->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
	catch ( PDOException $e ) { echo $e->getMessage(); }
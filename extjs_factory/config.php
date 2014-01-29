<?php

/***************************************************************************
* 		Variables para la Conexion a la Base de Datos
* 
* 		$dbms		: Manejador de Base de Datos 
* 		$dbhost		: Nombre de la Maquina o Host
* 		$dbuser		: Nombre del usuario 
* 		$dbpasswd	: Clave o Contraseña del usuario
* 		$dbname		: Nombre de la Base de Datos en este caso ext
***************************************************************************/

$dbms = 'mysql4';		// Si te necesitas conectar a cualquier otro manejador solo cambia este parametro y todo
						// lo demas continuará trabajando igual para opciones ver /includes/db.php
						// Ejemplo para postgres
						// $dbms = 'postgres';
$dbhost = 'localhost';		
$dbuser = 'root';
$dbpasswd = 'abc123';
$dbname = 'ubtjr';

?>

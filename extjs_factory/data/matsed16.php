<?php

	$pass=$_REQUEST['co_cedula'];
	$dbhost = 'matsed16';
	$dbuser = 'root';
	$dbpasswd = '%r0My156Sql%';
	$dbname = 'cne';
 	$conexion = mysql_connect($dbhost,$dbuser,$dbpasswd);
	mysql_select_db($dbname,$conexion);


	$res=mysql_query("SELECT cedula as ci_estudiante,apellidos_nombres as nb_estudiante FROM electores WHERE cedula='".$pass."' and nacionalidad='V'");
	$row=mysql_fetch_array($res);
	$var=utf8_encode($row['nb_estudiante']);
	$row2['nb_estudiante']=$var;
	$row2['respuesta']="SI";
	$row2['ci_estudiante'] = utf8_encode($row['ci_estudiante']);

	//print_r ($row);
	//echo mysql_fetch_array($res);
	echo $resultado2=json_encode($row2);
	mysql_close();
?>

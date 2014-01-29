<?php
/***************************************************************************
 *                                common.php
 *                            -------------------
 *   begin                : Saturday, Feb 23, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: common.php,v 1.74.2.17 2005/02/21 19:29:30 acydburn Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/
//
// La Capa de Acceso a Datos (DATABASE ABSTRACTION LAYER) de phpBB 2.0 fue   
// tomada prestada para hacer este ejemplo en la linea de abajo la incluimos
//

include('../config.php');		// Informacion acerca de la conexion a la Base de Datos Usuario, Host, Constraseña y BD
include('includes/db.php');		// Capa de Abstraccion de la Base de Datos permite trabajar con las BD mas populares 

//
// Ejemplo de como se relizaran los querys
// los nombre de las tablas son tomados del
// archivo constants al igual que los mensajes de error
/*
$sql = "SELECT *	
	FROM app_estados";
if( !($result = $db->sql_query($sql)) )
{
	die($sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$board_config[$row['co_estado']] = $row['nb_estado'];
}

print_r($board_config);
 */
?>

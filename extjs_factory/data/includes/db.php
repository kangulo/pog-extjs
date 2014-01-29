<?php
/***************************************************************************
 *                                 db.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: db.php,v 1.10 2002/03/18 13:35:22 psotfx Exp $
 *
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

switch($dbms)
{
	case 'mysql':
		include('db/mysql.php');
		break;

	case 'mysql4':
		include('db/mysql4.php');
		break;

	case 'postgres':
		include('db/postgres7.php');
		break;

	case 'mssql':
		include('db/mssql.php');
		break;

	case 'oracle':
		include('db/oracle.php');
		break;

	case 'msaccess':
		include('db/msaccess.php');
		break;

	case 'mssql-odbc':
		include('db/mssql-odbc.php');
		break;
}

// Make the database connection.
$db = new sql_db($dbhost, $dbuser, $dbpasswd, $dbname, false);
if(!$db->db_connect_id)
{
   message_die(CRITICAL_ERROR, "Could not connect to the database");
}
else
{
 	// print "Se conecto";
}

?>

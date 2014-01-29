<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `propietario` (
	`cedula` VARCHAR(255) NOT NULL,
	`nombre` VARCHAR(255) NOT NULL,
	`telefono` VARCHAR(255) NOT NULL,
	`fax` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`rol` VARCHAR(255) NOT NULL,
	`clave` VARCHAR(255) NOT NULL, PRIMARY KEY  (`cedula`)) ENGINE=MyISAM;
*/

/**
* <b>propietario</b> class with integrated CRUD methods.
* @author Kevin Angulo extended from Php Object Generator
* @version POG 3.0d / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=propietario&attributeList=array+%28%0A++0+%3D%3E+%27cedula%27%2C%0A++1+%3D%3E+%27nombre%27%2C%0A++2+%3D%3E+%27telefono%27%2C%0A++3+%3D%3E+%27fax%27%2C%0A++4+%3D%3E+%27email%27%2C%0A++5+%3D%3E+%27rol%27%2C%0A++6+%3D%3E+%27clave%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B4%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B5%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B6%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2529
*/
include_once('class.pog_base.php');
class propietario extends POG_Base
{
	/**
	 * @var VARCHAR(255)
	 */
	public $cedula;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $nombre;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $telefono;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $fax;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $email;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $rol;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $clave;
	
	public $pog_attribute_type = array(
		"cedula" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"nombre" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"telefono" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"fax" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"email" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"rol" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"clave" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function propietario($cedula='', $nombre='', $telefono='', $fax='', $email='', $rol='', $clave='')
	{
		$this->cedula = $cedula;
		$this->nombre = $nombre;
		$this->telefono = $telefono;
		$this->fax = $fax;
		$this->email = $email;
		$this->rol = $rol;
		$this->clave = $clave;
	}
	
	
	/**
	* Gets object from database
	* @param integer $cedula 
	* @return object $propietario
	*/
	function Get($cedula)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `propietario` where `cedula`='".$cedula."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->cedula = $this->Unescape($row['cedula']);
			$this->nombre = $this->Unescape($row['nombre']);
			$this->telefono = $this->Unescape($row['telefono']);
			$this->fax = $this->Unescape($row['fax']);
			$this->email = $this->Unescape($row['email']);
			$this->rol = $this->Unescape($row['rol']);
			$this->clave = $this->Unescape($row['clave']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $propietarioList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `propietario` ";
		$propietarioList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "nombre";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$propietario = new $thisObjectName();
			$propietario->cedula = $this->Unescape($row['cedula']);
			$propietario->nombre = $this->Unescape($row['nombre']);
			$propietario->telefono = $this->Unescape($row['telefono']);
			$propietario->fax = $this->Unescape($row['fax']);
			$propietario->email = $this->Unescape($row['email']);
			$propietario->rol = $this->Unescape($row['rol']);
			$propietario->clave = $this->Unescape($row['clave']);
			$propietarioList[] = $propietario;
		}
		return $propietarioList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $cedula
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `cedula` from `propietario` where `cedula`='".$this->cedula."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `propietario` set 
			`nombre`='".$this->Escape($this->nombre)."', 
			`telefono`='".$this->Escape($this->telefono)."', 
			`fax`='".$this->Escape($this->fax)."', 
			`email`='".$this->Escape($this->email)."', 
			`rol`='".$this->Escape($this->rol)."', 
			`clave`='".$this->Escape($this->clave)."' where `cedula`='".$this->cedula."'";
		}
		else
		{
			$this->pog_query = "insert into `propietario` (`cedula`, `nombre`, `telefono`, `fax`, `email`, `rol`, `clave` ) values (
			'".$this->Escape($this->cedula)."', 
			'".$this->Escape($this->nombre)."', 
			'".$this->Escape($this->telefono)."', 
			'".$this->Escape($this->fax)."', 
			'".$this->Escape($this->email)."', 
			'".$this->Escape($this->rol)."', 
			'".$this->Escape($this->clave)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->cedula == "")
		{
			$this->cedula = $insertId;
		}
		return $this->cedula;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $cedula
	*/
	function SaveNew()
	{
		$this->cedula = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `propietario` where `cedula`='".$this->cedula."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `propietario` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
}
?>

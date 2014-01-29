<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `edificio` (
	`id_edificio` int(11) NOT NULL auto_increment,
	`nombre` VARCHAR(255) NOT NULL,
	`ubicacion` VARCHAR(255) NOT NULL,
	`area_const` FLOAT NOT NULL,
	`tp_edificio` VARCHAR(255) NOT NULL, PRIMARY KEY  (`id_edificio`)) ENGINE=MyISAM;
*/

/**
* <b>edificio</b> class with integrated CRUD methods.
* @author Kevin Angulo extended from Php Object Generator
* @version POG 3.0d / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=edificio&attributeList=array+%28%0A++0+%3D%3E+%27nombre%27%2C%0A++1+%3D%3E+%27ubicacion%27%2C%0A++2+%3D%3E+%27area_const%27%2C%0A++3+%3D%3E+%27tp_edificio%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527FLOAT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2529
*/
include_once('class.pog_base.php');
class edificio extends POG_Base
{
	public $id_edificio = '';

	/**
	 * @var VARCHAR(255)
	 */
	public $nombre;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $ubicacion;
	
	/**
	 * @var FLOAT
	 */
	public $area_const;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $tp_edificio;
	
	public $pog_attribute_type = array(
		"id_edificio" => array('db_attributes' => array("NUMERIC", "INT")),
		"nombre" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"ubicacion" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"area_const" => array('db_attributes' => array("NUMERIC", "FLOAT")),
		"tp_edificio" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function edificio($nombre='', $ubicacion='', $area_const='', $tp_edificio='')
	{
		$this->nombre = $nombre;
		$this->ubicacion = $ubicacion;
		$this->area_const = $area_const;
		$this->tp_edificio = $tp_edificio;
	}
	
	
	/**
	* Gets object from database
	* @param integer $id_edificio 
	* @return object $edificio
	*/
	function Get($id_edificio)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `edificio` where `id_edificio`='".intval($id_edificio)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->id_edificio = $row['id_edificio'];
			$this->nombre = $this->Unescape($row['nombre']);
			$this->ubicacion = $this->Unescape($row['ubicacion']);
			$this->area_const = $this->Unescape($row['area_const']);
			$this->tp_edificio = $this->Unescape($row['tp_edificio']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $edificioList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `edificio` ";
		$edificioList = Array();
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
			$sortBy = "id_edificio";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$edificio = new $thisObjectName();
			$edificio->id_edificio = $row['id_edificio'];
			$edificio->nombre = $this->Unescape($row['nombre']);
			$edificio->ubicacion = $this->Unescape($row['ubicacion']);
			$edificio->area_const = $this->Unescape($row['area_const']);
			$edificio->tp_edificio = $this->Unescape($row['tp_edificio']);
			$edificioList[] = $edificio;
		}
		return $edificioList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $id_edificio
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `id_edificio` from `edificio` where `id_edificio`='".$this->id_edificio."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `edificio` set 
			`nombre`='".$this->Escape($this->nombre)."', 
			`ubicacion`='".$this->Escape($this->ubicacion)."', 
			`area_const`='".$this->Escape($this->area_const)."', 
			`tp_edificio`='".$this->Escape($this->tp_edificio)."' where `id_edificio`='".$this->id_edificio."'";
		}
		else
		{
			$this->pog_query = "insert into `edificio` (`nombre`, `ubicacion`, `area_const`, `tp_edificio` ) values (
			'".$this->Escape($this->nombre)."', 
			'".$this->Escape($this->ubicacion)."', 
			'".$this->Escape($this->area_const)."', 
			'".$this->Escape($this->tp_edificio)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->id_edificio == "")
		{
			$this->id_edificio = $insertId;
		}
		return $this->id_edificio;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $id_edificio
	*/
	function SaveNew()
	{
		$this->id_edificio = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `edificio` where `id_edificio`='".$this->id_edificio."'";
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
			$pog_query = "delete from `edificio` where ";
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

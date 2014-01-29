<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `estudiantes` (
	`estudiantesid` int(11) NOT NULL auto_increment,
	`ci_estudiante` INT NOT NULL,
	`nb_estudiante` VARCHAR(255) NOT NULL,
	`tx_correo_particular` VARCHAR(255) NOT NULL,
	`fe_nacimiento` DATE NOT NULL,
	`tx_lugar_nacimiento` VARCHAR(255) NOT NULL,
	`tlf_particular` VARCHAR(255) NOT NULL,
	`dir_estudiante` VARCHAR(255) NOT NULL,
	`tx_cargo` VARCHAR(255) NOT NULL, PRIMARY KEY  (`estudiantesid`)) ENGINE=MyISAM;
*/

/**
* <b>Estudiantes</b> class with integrated CRUD methods.
* @author Kevin Angulo extended from Php Object Generator
* @version POG 3.0d / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=Estudiantes&attributeList=array+%28%0A++0+%3D%3E+%27ci_estudiante%27%2C%0A++1+%3D%3E+%27nb_estudiante%27%2C%0A++2+%3D%3E+%27tx_correo_particular%27%2C%0A++3+%3D%3E+%27fe_nacimiento%27%2C%0A++4+%3D%3E+%27tx_lugar_nacimiento%27%2C%0A++5+%3D%3E+%27tlf_particular%27%2C%0A++6+%3D%3E+%27dir_estudiante%27%2C%0A++7+%3D%3E+%27tx_cargo%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527DATE%2527%252C%250A%2B%2B4%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B5%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B6%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B7%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2529
*/
include_once('class.pog_base.php');
class Estudiantes extends POG_Base
{
	public $estudiantesId = '';

	/**
	 * @var INT
	 */
	public $ci_estudiante;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $nb_estudiante;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $tx_correo_particular;
	
	/**
	 * @var DATE
	 */
	public $fe_nacimiento;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $tx_lugar_nacimiento;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $tlf_particular;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $dir_estudiante;
	
	/**
	 * @var VARCHAR(255)
	 */
	public $tx_cargo;
	
	public $pog_attribute_type = array(
		"estudiantesId" => array('db_attributes' => array("NUMERIC", "INT")),
		"ci_estudiante" => array('db_attributes' => array("NUMERIC", "INT")),
		"nb_estudiante" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"tx_correo_particular" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"fe_nacimiento" => array('db_attributes' => array("NUMERIC", "DATE")),
		"tx_lugar_nacimiento" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"tlf_particular" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"dir_estudiante" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"tx_cargo" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
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
	
	function Estudiantes($ci_estudiante='', $nb_estudiante='', $tx_correo_particular='', $fe_nacimiento='', $tx_lugar_nacimiento='', $tlf_particular='', $dir_estudiante='', $tx_cargo='')
	{
		$this->ci_estudiante = $ci_estudiante;
		$this->nb_estudiante = $nb_estudiante;
		$this->tx_correo_particular = $tx_correo_particular;
		$this->fe_nacimiento = $fe_nacimiento;
		$this->tx_lugar_nacimiento = $tx_lugar_nacimiento;
		$this->tlf_particular = $tlf_particular;
		$this->dir_estudiante = $dir_estudiante;
		$this->tx_cargo = $tx_cargo;
	}
	
	
	/**
	* Gets object from database
	* @param integer $estudiantesId 
	* @return object $Estudiantes
	*/
	function Get($estudiantesId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `estudiantes` where `estudiantesid`='".intval($estudiantesId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->estudiantesId = $row['estudiantesid'];
			$this->ci_estudiante = $this->Unescape($row['ci_estudiante']);
			$this->nb_estudiante = $this->Unescape($row['nb_estudiante']);
			$this->tx_correo_particular = $this->Unescape($row['tx_correo_particular']);
			$this->fe_nacimiento = $row['fe_nacimiento'];
			$this->tx_lugar_nacimiento = $this->Unescape($row['tx_lugar_nacimiento']);
			$this->tlf_particular = $this->Unescape($row['tlf_particular']);
			$this->dir_estudiante = $this->Unescape($row['dir_estudiante']);
			$this->tx_cargo = $this->Unescape($row['tx_cargo']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $estudiantesList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `estudiantes` ";
		$estudiantesList = Array();
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
			$sortBy = "estudiantesid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$estudiantes = new $thisObjectName();
			$estudiantes->estudiantesId = $row['estudiantesid'];
			$estudiantes->ci_estudiante = $this->Unescape($row['ci_estudiante']);
			$estudiantes->nb_estudiante = $this->Unescape($row['nb_estudiante']);
			$estudiantes->tx_correo_particular = $this->Unescape($row['tx_correo_particular']);
			$estudiantes->fe_nacimiento = $row['fe_nacimiento'];
			$estudiantes->tx_lugar_nacimiento = $this->Unescape($row['tx_lugar_nacimiento']);
			$estudiantes->tlf_particular = $this->Unescape($row['tlf_particular']);
			$estudiantes->dir_estudiante = $this->Unescape($row['dir_estudiante']);
			$estudiantes->tx_cargo = $this->Unescape($row['tx_cargo']);
			$estudiantesList[] = $estudiantes;
		}
		return $estudiantesList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $estudiantesId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `estudiantesid` from `estudiantes` where `estudiantesid`='".$this->estudiantesId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `estudiantes` set 
			`ci_estudiante`='".$this->Escape($this->ci_estudiante)."', 
			`nb_estudiante`='".$this->Escape($this->nb_estudiante)."', 
			`tx_correo_particular`='".$this->Escape($this->tx_correo_particular)."', 
			`fe_nacimiento`='".$this->fe_nacimiento."', 
			`tx_lugar_nacimiento`='".$this->Escape($this->tx_lugar_nacimiento)."', 
			`tlf_particular`='".$this->Escape($this->tlf_particular)."', 
			`dir_estudiante`='".$this->Escape($this->dir_estudiante)."', 
			`tx_cargo`='".$this->Escape($this->tx_cargo)."' where `estudiantesid`='".$this->estudiantesId."'";
		}
		else
		{
			$this->pog_query = "insert into `estudiantes` (`ci_estudiante`, `nb_estudiante`, `tx_correo_particular`, `fe_nacimiento`, `tx_lugar_nacimiento`, `tlf_particular`, `dir_estudiante`, `tx_cargo` ) values (
			'".$this->Escape($this->ci_estudiante)."', 
			'".$this->Escape($this->nb_estudiante)."', 
			'".$this->Escape($this->tx_correo_particular)."', 
			'".$this->fe_nacimiento."', 
			'".$this->Escape($this->tx_lugar_nacimiento)."', 
			'".$this->Escape($this->tlf_particular)."', 
			'".$this->Escape($this->dir_estudiante)."', 
			'".$this->Escape($this->tx_cargo)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->estudiantesId == "")
		{
			$this->estudiantesId = $insertId;
		}
		return $this->estudiantesId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $estudiantesId
	*/
	function SaveNew()
	{
		$this->estudiantesId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `estudiantes` where `estudiantesid`='".$this->estudiantesId."'";
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
			$pog_query = "delete from `estudiantes` where ";
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

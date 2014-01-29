<?php 
/** 
 * * <b>GetJSON</b> * 
 * * Returns a JSON string representing the array of objects returned by a GetList- 
 * * style call. 
 * * Use the [optional] SetJSON plugin to customize returned attributes and format. 
 * * * NOTE: Passed parameters behave in the same manner as $POGobject- GetList(...)
 * * * NOTE: Requires PHP5 with json_decode [see extension json.so] 
 * * * TODO: unit tests, PHP implementation of json_encode 
 * * @author Brice Burgess <b....@iceburg.net> 
 * * @version 0.1 
 * * @copyright Free for personal & commercial use. (Offered under the BSD license) 
 * * @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
 * * @param string $sortBy 
 * * @param boolean $ascending 
 * * @param int limit 
 * * @return string $json 
 */ 

class GetJSON 
{ 
	private $sourceObject; 
	private $argv; 
	public $version = '0.1';

	function Version() 
	{ 
		return $this->version; 
	}

	function GetJSON($sourceObject,$argv) 
	{ 
		$this->sourceObject = $sourceObject; 
		$this->argv = $argv; 
	}

	function Execute() 
	{ 
		// set defaults (override with SetJSON) 
		$attributes = (isset($this->sourceObject->_jsonAttributes)) ? $this->sourceObject->_jsonAttributes : array();
		$includeName = (isset($this->sourceObject->_jsonIncludeName)) ? $this->sourceObject->_jsonIncludeName : true;

		// bb 
		/** 
		 * * Mimick POG's GetList() w/ slight modifications (marked "//bb") 
		 * * Runs a manual DB query for performance sake!!! 
		*/

		$fcv_array = isset($this->argv[0]) ? $this->argv[0] : array(); 
		$sortBy = isset($this->argv[1]) ? $this->argv[1] : ''; 
		$ascending = isset($this->argv[2]) ? $this->argv[2] : true; 		
		$limit = isset($this->argv[3]) ? $this->argv[3] : '';

		// bb 
		$columns = (empty($attributes)) ? '*' : implode($attributes,','); 
		$objectName = get_class($this->sourceObject);
		$connection = Database::Connect(); 
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');

		// bb 
		$this->pog_query = "select $columns from `".strtolower ($objectName)."` ";
		// kk
		$full_query = "select $columns from `".strtolower ($objectName)."` ";
		
		$list = Array(); 
		if (sizeof($fcv_array) > 0) 
		{ 
			$this->pog_query .= " where "; 
			// kk
			$full_where .= " where ";
			
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++) 
			{ 
				if (sizeof($fcv_array[$i]) == 1) 
				{ 
					$this->pog_query .= " ".$fcv_array[$i][0]." "; 
					// kk
					$full_where .= " ".$fcv_array[$i][0]." "; 
					continue; 
				}
				else
				{ 
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1) 
					{ 
						$this->pog_query .= " AND "; 
						// kk
						$full_where .= " AND "; 
					} 
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]] ['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]] ['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type [$fcv_array[$i][0]]['db_attributes'][0] != 'SET') 
					{ 
						if ($GLOBALS['configuration']['db_encoding'] == 1) 
						{ 
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE (".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'"; 
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ". $fcv_array[$i][1]." ".$value; 
							// kk
							$full_where .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ". $fcv_array[$i][1]." ".$value; 
						} 
						else 
						{ 
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i] [2] : "'".$this->Escape($fcv_array[$i][2])."'"; 
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i] [1]." ".$value; 
							// kk
							$full_where .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i] [1]." ".$value; 
						} 
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i] [2] : "'".$fcv_array[$i][2]."'"; 						
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i] [1]." ".$value; 
						// kk
						$full_where .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i] [1]." ".$value; 
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
			// bb 
			$sortBy = $objectName.'id'; 
		} 
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		
		// kk
		$full_query .= $full_where;
		
		//bb 
		$result = array();
        
		// kk - debug
		//return $this->pog_query;
		 
		$cursor = Database::Reader($this->pog_query, $connection); 
		$row_count = Database::NonQuery($full_query, $connection); 
		
		while ($row = Database::Read($cursor)) 
		{ 
			// bb 
			if($includeName) 
			{ 
				$result['data'][] = $row; 
			}
			else
			{ 
				$a = array(); 
				foreach($attributes as $col) 
				{ 
					$a[] = $row[$col]; 
				} 
				$result['data'][] = $a; 
			} 			
		} 		
		$result['rows'] = $row_count;
		$result['success'] = true;
		$result['message'] = "Registros Cargados Exitosamente";
		$result['sql'] = $this->pog_query;
		
		return json_encode($result); 
	}

	function SetupRender() 
	{ 
		echo '<p>Returns a JSON string representing the array of objects returned by a GetList-style call.</p>'; 
		echo '<p>Use the [optional] SetJSON plugin to customize returned attributes and format.</p>';

		if ($this->PerformUnitTest() === false) 
		{ 
			echo get_class($this).' failed unit test'; 
		}
		else
		{ 
			echo get_class($this).' passed unit test'; 
		} 
	}

	function AuthorPage() 
	{ 
		return 'http://iceburg.net/'; 
	}

	function PerformUnitTest() 
	{ 
		return true; 
	} 
} 
?>

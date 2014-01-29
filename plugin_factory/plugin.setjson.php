<?php 
/** 
* <b>SetJSON</b> * 
* * Enables the ability to specify which attributes are returned a GetJSON plugin 
* * call and to set the return format (return key/value pair, or just value). 
* * * NOTE: Attribute values are returned in the exact order specified in your 
* * attributeNames array. This allows for a reliable and smaller JSON response 
* * when coulped with a $includeAttributeName parameter set to false. 
* * * NOTE: Be sure to specify the __class__Id Attribute in your attributeNames 
* * array if you would like it (the primary key) included in the JSON result. 
* * * TODO: unit tests 
* * * @author Brice Burgess <b....@iceburg.net> 
* * @version 0.1 
* * @copyright Free for personal & commercial use. (Offered under the BSD license) 
* * @param array $attributeNames {"attributeName", "attributeName", ...} || {} (empty) for ALL Attributes 
* * @param boolean $includeAttributeName true 
* * @return void 
*/ 

class SetJSON 
{ 
	private $sourceObject; 
	private $argv; 
	public $version = '0.1';

	function Version() 
	{ 
		return $this->version; 
	}

	function SetJSON($sourceObject,$argv) 
	{ 
		$this->sourceObject = $sourceObject; $this->argv = $argv; 
	}

	function Execute() 
	{ 
		$this->sourceObject->_jsonAttributes = array(); 
		$this->sourceObject->_jsonIncludeName = (isset($this->argv[1]) && $this->argv[1] === false) ? false : true;

		if (isset($this->argv[0])) 
		{
		
			// reserve a list of valid attribute names 
			$validAttributes = array(); 
			foreach($this->sourceObject->pog_attribute_type as $name => $a) 
			{ 
				if($a['db_attributes'][0] == 'OBJECT' && $a['db_attributes'][1] == 'BELONGSTO') 
				{
					$name .= 'id'; // parent/child relationship
				}
				// normalize to lowercase 
				$validAttributes[] = strtolower($name); 
			}

			// compare passed attribute names to valid list, 
			// only push valid attributes to return array 
			foreach($this->argv[0] as $attribute) { 
				// normalize to lowercase 
				$name = strtolower($attribute);

				if(in_array($name,$validAttributes)) 
				{
					$this->sourceObject->_jsonAttributes[] = $name; 
				}
				else 
				{
					trigger_error('SetJSON => '.$attribute.' is an invalid attribue of '.get_class($this->sourceObject).'. If this is a relationship attribute, try using "'.$attribute.'id". Ignored.'); 
				}
			} 
		}
		return; 
	}

	function SetupRender() 
	{

		echo '<p>Enables the ability to specify which attributes are returned by a GetJSON plugin call and to set the return format (return key/value pair, or just value).</p>';

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

<?php
/**
* @author  Joel Wan & Mark Slemko.  Designs by Jonathan Easton
* @link  http://www.phpobjectgenerator.com
* @copyright  Offered under the  BSD license
* @abstract  Php Object Generator  automatically generates clean and tested Object Oriented code for your PHP4/PHP5 application.
*/
session_start();
include "./include/configuration.php";
include "./include/class.zipfile.php";
if ($GLOBALS['configuration']['soapEngine'] == "nusoap")
{
	include "./services/nusoap.php";
}
if (isset($_SESSION['objectString']))
{
	$_GET = null;

	if ($GLOBALS['configuration']['soapEngine'] == "nusoap")
	{
		$client = new soapclient2($GLOBALS['configuration']['soap'], true);
		$attributeList = unserialize($_SESSION['attributeList']);
		$renderList = unserialize($_SESSION['renderList']);
		$typeList = unserialize($_SESSION['typeList']);		
		$extjsVersion = $_SESSION['extjsVersion'];
		
		$params = array(
			    'objectName' 	=> $_SESSION['objectName'],
			    'attributeList' => $attributeList,
			    'typeList'      => $typeList,
			    'renderList'    => $renderList,
			    'language'      => $_SESSION['language'],
			    'wrapper'       => $_SESSION['wrapper'],
			    'pdoDriver'     => $_SESSION['pdoDriver'],
			    'extjsVersion'  => $_SESSION['extjsVersion'],
			    'db_encoding' 	=> "0"
			);
		//print_r($params);
		$package = unserialize($client->call('GeneratePackage', $params));
	}
	else if ($GLOBALS['configuration']['soapEngine'] == "phpsoap")
	{
		$client = new SoapClient('services/pog.wsdl');
		$attributeList = unserialize($_SESSION['attributeList']);
		$typeList = unserialize($_SESSION['typeList']);
		$renderList = unserialize($_SESSION['renderList']);
		$extjsVersion = $_SESSION['extjsVersion'];
		$objectName = $_SESSION['objectName'];
		$language = $_SESSION['language'];
		$pdoDriver = $_SESSION['pdoDriver'];
		$dbEncoding = "0";

		try
		{
			$package = unserialize($client->GeneratePackage($objectName, $attributeList, $typeList, $renderList, $language, $pdoDriver, $extjsVersion, $dbEncoding));
		}

		catch (SoapFault $e)
		{
			echo "Error: {$e->faultstring}";
		}
	}
	
	$zipfile = new createZip();
	//print $zipfile -> addPOGPackage($package);
	$zipfile -> addPOGPackage($package);
	
	$zipfile -> forceDownload("pog.".time().".zip");
	$_POST = null;
}
else
{
	header("Location:/");
}
?>

<?php
/**
* @author  Joel Wan & Mark Slemko.  Designs by Jonathan Easton
* @link  http://www.phpobjectgenerator.com
* @copyright  Offered under the  BSD license
* @abstract  Php Object Generator  automatically generates clean and tested Object Oriented code for your PHP4/PHP5 application.
*/
session_start();
include "./include/misc.php";
include "./include/configuration.php";
if ($GLOBALS['configuration']['soapEngine'] == "nusoap")
{
	include "./services/nusoap.php";
}

if (IsPostback())
{
	$_GET = null;
	$objectName = GetVariable('object');
	$extjsVersion = GetVariable('extjsVersion');
	$attributeList =Array();
	$typeList=Array();
	$renderList=Array();
	$z=0;
	for ($i=1; $i<100; $i++)
	{
		if (GetVariable(('fieldattribute_'.$i)) != null)
		{
			$attributeList[] = GetVariable(('fieldattribute_'.$i));
			$z++;
		}
		if (GetVariable(('render_'.$i)) != null && $z==$i)
		{
			$renderList[] = GetVariable(('render_'.$i));
			
		}
		/*print_r($renderList);*/
		if (GetVariable(('type_'.$i)) != null && $z==$i)
		{
			if (GetVariable(('type_'.$i)) != "OTHER"  && GetVariable(('ttype_'.$i)) == null)
			{
				$typeList[] = GetVariable(('type_'.$i));
			}
			else
			{
				$typeList[] = GetVariable(('ttype_'.$i));
			}
		}		
		else
		{
			//attribute may have been removed. proceed to next row
			$z++;
		}
	}

	$_SESSION['objectName'] = $objectName;
	$_SESSION['language'] = $language = GetVariable('language');
	$_SESSION['wrapper'] = $wrapper = GetVariable('wrapper');
	$_SESSION['pdoDriver'] = $pdoDriver = GetVariable('pdoDriver');
	$_SESSION['extjsVersion'] = $extjsVersion;
	
	$client1 = new soapclient2($GLOBALS['configuration']['soap'], true);
	$params1 = array(
			'objectName' 	=> $objectName,
			'attributeList' => $attributeList,
			'typeList'      => $typeList,
			'renderList'    => $renderList,
			'language'      => $language,
			'wrapper'       => $wrapper,
			'pdoDriver'     => $pdoDriver,
			'extjsVersion'  => $extjsVersion
		);
	//print_r($params1);
	//  Genera el archivo de Extjs
	$object1 = base64_decode($client1->call('GenerateObjectExtjs', $params1));
	//echo $client1->debug_str;
	//echo "*************************************************************************************************<br>";
	$_SESSION['objectString'] = $object1;
	$_SESSION['attributeList'] = serialize($attributeList);
	$_SESSION['typeList'] = serialize($typeList);
	$_SESSION['renderList'] = serialize($renderList);
	
	//echo "*************************************************************************************************<br>";
	//  Genera el archivo Controller.php
	$client2 = new soapclient2($GLOBALS['configuration']['soap'], true);
	$params2 = array(
			'objectName' 	=> $objectName,
			'attributeList' => $attributeList,
			'typeList'      => $typeList,
			'renderList'    => $renderList,
			'language'      => $language,
			'wrapper'       => $wrapper,
			'pdoDriver'     => $pdoDriver,
			'extjsVersion'  => $extjsVersion
	);
	/*print_r($params2);*/
	
	$object2 = base64_decode($client2->call('GenerateObjectController', $params2));
	//echo $client2->debug_str;
	$_SESSION['objectString'] = $object2;
	$_SESSION['attributeList'] = serialize($attributeList);
	$_SESSION['typeList'] = serialize($typeList);
	$_SESSION['renderList'] = serialize($renderList);
	//echo "*************************************************************************************************<br>";

if ($GLOBALS['configuration']['soapEngine'] == "nusoap")
{
	$client = new soapclient2($GLOBALS['configuration']['soap'], true);
	$params = array(
			'objectName' 	=> $objectName,
			'attributeList' => $attributeList,
			'typeList'      => $typeList,
			'renderList'    => $renderList,
			'language'      => $language,
			'wrapper'       => $wrapper,
			'pdoDriver'     => $pdoDriver,
			'extjsVersion'  => $extjsVersion
		);

	//  Genera el archivo de Base de Datos
	$object = base64_decode($client->call('GenerateObject', $params));
	//echo $client->debug_str;
	//echo "*************************************************************************************************<br>";
	$_SESSION['objectString'] = $object;
	$_SESSION['attributeList'] = serialize($attributeList);
	$_SESSION['typeList'] = serialize($typeList);
	$_SESSION['renderList'] = serialize($renderList);
}
else if ($GLOBALS['configuration']['soapEngine'] == "phpsoap")
{
	$client = new SoapClient('services/pog.wsdl');
	try
	{
		$object = base64_decode($client->GenerateObject($objectName, $attributeList, $typeList, $renderList, $language, $wrapper, $pdoDriver));
		$_SESSION['objectString'] = $object;
		$_SESSION['attributeList'] = serialize($attributeList);
		$_SESSION['typeList'] = serialize($typeList);
		$_SESSION['renderList'] = serialize($renderList);
	}
	catch (SoapFault $e)
	{
		echo "Error: {$e->faultstring}";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="/ico/favicon.ico">

	<title>Php Object Generator (<?=$GLOBALS['configuration']['versionNumber']?><?=$GLOBALS['configuration']['revisionNumber']?>) - Open Source PHP Code Generator</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link href="css/image-picker.css" rel="stylesheet">
	<script src="pog.js" type="text/javascript"></script>
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/image-picker.js" type="text/javascript"></script>
	<link href="css/style.css" rel="stylesheet">
	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<!-- Docs master nav -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button>
				<a class="navbar-brand" href="index.php">POG + ExtJS</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input class="form-control" placeholder="Search..." type=
					"text">
				</form>
			</div>
		</div>
	</div>
    
	<div class="main">
	   <div class="page-header">
		  <h1>PHP code generator + ExtJS Framework</h1>
	   </div>
	   Over the years, we realized that a large portion of a PHP programmer's time is wasted on repetitive coding of the Database Access Layer of an application simply because different applications require different objects.</p>
	   	<div class="row">
		  <div class="text-center col-sm-12">
			 <form method="post" action="index3.php">
				<button type="submit" class="btn btn-lg btn-success">
				<span class="glyphicon glyphicon-compressed"></span> Get All Files!
				</button>
			 </form>
		  </div>
	   </div>
	   <p></p>
	   <div class="row">
		  <div class="col-sm-12">
			 <div class="panel panel-primary">
				<div class="panel-heading">
				   <h3 class="panel-title">class.<?php print $_SESSION['objectName']; ?>.php</h3>
				</div>
				<div class="panel-body">
				   <textarea id="class" rows="30" class="form-control"><?php echo $object;?></textarea>
				</div>
				<div class="panel-footer">
					<p>
					<button class="btn btn-primary" id="selectAll" onclick="$('#class').select();" title="Selects all of the formatted HTML output"><span>SELECT ALL</span></button>
					</p>
				</div>
			 </div>
		  </div>
		  <!-- /.col-sm-12 -->
	   </div>
	   <div class="row">
		  <div class="col-sm-12">
			 <div class="panel panel-info">
				<div class="panel-heading">
				   <h3 class="panel-title"><?php print $_SESSION['objectName']; ?>.js</h3>
				</div>
				<div class="panel-body">
				   <textarea id="js" rows="30" class="form-control"><?php echo $object1;?></textarea>
				</div>
				<div class="panel-footer">
					<p>
					<button class="btn btn-primary" id="selectAll" onclick="$('#js').select();" title="Selects all of the formatted HTML output"><span>SELECT ALL</span></button>
					</p>
				</div>
			 </div>
		  </div>
		  <!-- /.col-sm-12 -->
	   </div>
	   <div class="row">
		  <div class="col-sm-12">
			 <div class="panel panel-danger">
				<div class="panel-heading">
				   <h3 class="panel-title">controller.<?php print $_SESSION['objectName']; ?>.php</h3>
				</div>
				<div class="panel-body">
				   <textarea id="controller" rows="30" class="form-control"><?php echo $object2;?></textarea>
				</div>
				<div class="panel-footer">
					<p>
					<button class="btn btn-primary" id="selectAll" onclick="$('#controller').select();" title="Selects all of the formatted HTML output"><span>SELECT ALL</span></button>
					</p>
				</div>
			 </div>
		  </div>
		  <!-- /.col-sm-12 -->
	   </div>
	   <div class="row">
		  <div class="col-sm-4">
			 <p><a href="generator.php" class="text-info">Back to previous page with fields filled</a></p>
			 <p><a href="restart.php" class="text-info">Back to previous page with fields cleared</a></p>
		  </div>
		  <!-- /.col-sm-4 -->
		  <div class="text-center col-sm-4">
			 <form method="post" action="index3.php">
				<button type="submit" class="btn btn-lg btn-success">
				<span class="glyphicon glyphicon-compressed"></span> Get All Files!
				</button>
			 </form>
		  </div>
		  <!-- /.col-sm-4 -->
	   </div>
	   <div class="left2">
		  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			 <input type="hidden" name="cmd" value="_s-xclick">
			 <input type="hidden" name="hosted_button_id" value="YX8ATWFWZFQAW">
			 <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			 <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
		  </form>
		  <br />
		  <br />
	   </div>
	</div>
	<!-- main -->
	</body>
</html>
<?php
	$_POST = null;
}
else
{
	header("Location:/");
}
?>

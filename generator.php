<?php
/**
* @author  Joel Wan & Mark Slemko.  Designs by Jonathan Easton
* @link  http://www.phpobjectgenerator.com
* @copyright  Offered under the  BSD license
* @abstract  Php Object Generator  automatically generates clean and tested Object Oriented code for your PHP4/PHP5 application.
*/
include "./include/class.misc.php";
include "./include/configuration.php";

$misc = new Misc(array());
session_cache_limiter('nocache');
$cache_limiter = session_cache_limiter();
session_start();
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
header('Expires: 0');

if ($misc->GetVariable('objectName')!= null)
{
	$objectName = $misc->GetVariable('objectName');
}
if ($misc->GetVariable('attributeList') != null)
{
	if (isset($_GET['attributeList']))
		eval ("\$attributeList =". stripcslashes(urldecode($_GET['attributeList'])).";");
	else
		@$attributeList=unserialize($_SESSION['attributeList']);
}
if ($misc->GetVariable('typeList') != null)
{
	if (isset($_GET['typeList']))
	{
		if (ini_get('magic_quotes_gpc') == true)
		{
			$typeList = stripcslashes(urldecode($_GET['typeList']));
		}
		else
		{
			$typeList = urldecode($_GET['typeList']);
		}
		if (ini_get('magic_quotes_gpc') == true)
		{
			$typeList = stripcslashes(urldecode($_GET['typeList']));
		}
		else
		{
			$typeList = urldecode($_GET['typeList']);
		}
		eval ("\$typeList =".trim($typeList).";");
		for($i=0; $i<sizeof($typeList); $i++)
		{
			$typeList[$i] = stripcslashes($typeList[$i]);
		}
	}
	else
	{
		@$typeList = unserialize($_SESSION['typeList']);
		if (count($typeList) == 0)
		{
			$typeList = null;
		}
	}
}
if ($misc->GetVariable('renderList') != null)
{
	if (isset($_GET['renderList']))
	{
		if (ini_get('magic_quotes_gpc') == true)
		{
			$renderList = stripcslashes(urldecode($_GET['renderList']));
		}
		else
		{
			$renderList = urldecode($_GET['renderList']);
		}
		if (ini_get('magic_quotes_gpc') == true)
		{
			$renderList = stripcslashes(urldecode($_GET['renderList']));
		}
		else
		{
			$renderList = urldecode($_GET['renderList']);
		}
		eval ("\$renderList =".trim($renderList).";");
		for($i=0; $i<sizeof($renderList); $i++)
		{
			$renderList[$i] = stripcslashes($renderList[$i]);
		}
	}
	else
	{
		@$renderList = unserialize($_SESSION['renderList']);
		if (count($renderList) == 0)
		{
			$renderList = null;
		}
	}
}
$pdoDriver = ($misc->GetVariable('pdoDriver')!=null?$misc->GetVariable('pdoDriver'):'mysql');
/*
print !isset($renderList[0]) ? "no" : "si";
print $renderList[2];
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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

<body data-spy="scroll" data-target="#navegacion">
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

    <div class="container-fluid">
      <div class="row">
        <div id="navegacion" class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
			<li class="active">
			  <a href="#select-section">1. Select your CRUD</a>
			</li>
			<li class="">
			  <a href="#object-section">2. Set Object Name</a>
			</li>
			<li class="">
			  <a href="#attributes-section">3. Define your fields</a>
			</li>
		  </ul>
        </div>
	<form method="post" action="index2.php" role="form" onsubmit="return WarnMinInput();">     
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<!-- Select-section
============================tooltip====================== -->
			<section id="select-section">
          <h1 class="page-header">POG+ExtJS Code Generator v<?=$GLOBALS['configuration']['versionNumber']?><?=$GLOBALS['configuration']['revisionNumber']?></h1>
		  <h2 class="sub-header">
			1. Select your CRUD
		  </h2>
			<p>Choose your type of CRUD, we planned expand to more types for more options. Works with Php 5+</p>
			<div style="display:none;">
			<select name="language" id="FirstField" onchange="CascadePhpVersion()">
				<option value="php5.1" selected>PHP 5.1+</option>
			</select>			
			<select name="wrapper" id="wrapper">
				<option value="PDO" selected>PDO</option>
			</select> 
			<select name="pdoDriver" id="PDOdriver">
				<option value="mysql" selected>MYSQL</option>
			</select>
			</div>
			<select name="extjsVersion" id="extjsVersion" class="image-picker show-labels show-html">
				<option value=""></option>
				<option data-img-src='img/RowEditorThumb.png' value="31" <?=($misc->GetVariable('extjsVersion') != null && $misc->GetVariable('extjsVersion')=="31"?"selected":"")?>>Row Editor</option>
				<option data-img-src="img/FormBindingThumb.png" value="30" <?=($misc->GetVariable('extjsVersion') != null && $misc->GetVariable('extjsVersion')=="30"?"selected":"")?>>Form Binding</option>
				<option data-img-src='img/FormBinding42Thumb.png' value="42" <?=($misc->GetVariable('extjsVersion') != null && $misc->GetVariable('extjsVersion')=="42"?"selected":"")?>>Form Binding 4.2</option>
                                <option data-img-src='img/FormBinding42Thumb.png' value="JQB" <?=($misc->GetVariable('extjsVersion') != null && $misc->GetVariable('extjsVersion')=="JQB"?"selected":"")?>>Responsive</option>
			</select>
		  </section>
<!-- Object-section
============================tooltip====================== -->
		   <section class="tooltip-examples" id="object-section"><br><br>
			<h2 class="sub-header">2. Set Object Name</h2>
			<p>The name of PHP classes generated by POG+ExtJS have 5 public methods which allow you to perform atomic database operations using the objects.
			These are often referred to as CRUD operations (CREATE, READ, UPDATE and DELETE). The 5 methods generated by POG+ExtJS are named: Save, SaveNew, Get, GetList and Delete.</p>
			<div class="row">
				<div class="col-sm-4">
				<span class="span-inline">
					<h4><span for="objName" data-original-title="Name used for class and database objects" rel="tooltip" class="label label-primary">Object Name</span></h4>
					<div>
					  <input type="text" class="form-control" id="objName" name="object" placeholder="Object Name" value="<?=(isset($objectName)?$objectName:'')?>">
					</div>
				</span>
				</div>
			</div>
			<br>
			<br><br>
			<br><br>
			<br><br>

		 </section>
<!-- attributes-section
============================tooltip====================== -->
		 <section class="tooltip-examples" id="attributes-section"><br><br>
			<h2 class="sub-header">3. Define Your Fields</h2>
			<p>Define the attributes which form the object with data type and the interface control to be used in the front-end</p>
			<table class="table table-striped table-responsive">
              <thead>
                <tr id="header">
                  <th><h4><span class="label label-primary"># Field</span></h4></th>
                  <th><h4><span class="label label-primary" data-original-title="Name of fields" rel="tooltip">Name Attributes</span></h4></th>
                  <th><h4><span class="label label-primary" data-original-title="MySQL datatype to database" rel="tooltip">DataTypes</span></h4></th>
                  <th><h4><span class="label label-primary" data-original-title="ExtJS render control" rel="tooltip">ControlTypes</span></h4></th>
                </tr>                
                <tbody>
					<tr>
						<td>
							1
						</td>
						<td>
							<input  type="text" class="form-control" name="fieldattribute_1" class="i" value="<?=(isset($attributeList)&&isset($attributeList[0])?$attributeList[0]:'')?>" onkeydown="javascript:Reposition(this,event);"></input>
						</td>
						<td>
							<select class="s" style="display:<?=(!isset($typeList[0])||$misc->TypeIsKnown($typeList[0]) ?"inline":"none")?>" onchange="ConvertDDLToTextfield('type_1')" name="type_1" id="type_1">
							<?php
								$dataTypeIndex = 0;
								eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
							?>
							</select>
						</td>
						<td>
							  <select class="s" style="display:<?=(!isset($renderList[0])||$misc->RenderTypeIsKnown($renderList[0]) ?"inline":"none")?>" name="render_1" id="render_1">
							<?php
								$dataRenderIndex = 0;
								eval("include \"./include/rendertype.extjs.inc.php\";");
							?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							2
						</td>
						<td>
							<input  type="text" class="form-control" name="fieldattribute_2" class="i" value="<?=(isset($attributeList)&&isset($attributeList[1])?$attributeList[1]:'')?>" onkeydown="javascript:Reposition(this,event);"></input>
						</td>
						<td>
							<select class="s" style="display:<?=(!isset($typeList[1])||$misc->TypeIsKnown($typeList[1]) ?"inline":"none")?>" onchange="ConvertDDLToTextfield('type_2')" name="type_2" id="type_2">
								<?php
									$dataTypeIndex = 1;
									eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
								?>
							</select>
						</td>
						<td>
							<select class="s" style="display:<?=(!isset($renderList[1])||$misc->RenderTypeIsKnown($renderList[1]) ?"inline":"none")?>" name="render_2" id="render_2">
								<?php
									$dataRenderIndex = 1;
									eval("include \"./include/rendertype.extjs.inc.php\";");
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							3
						</td>
						<td>
							<input  type="text" class="form-control" name="fieldattribute_3" class="i" value="<?=(isset($attributeList)&&isset($attributeList[2])?$attributeList[2]:'')?>" onkeydown="javascript:Reposition(this,event);"></input>
						</td>
						<td>
							<select class="s" style="display:<?=(!isset($typeList[2])||$misc->TypeIsKnown($typeList[2]) ?"inline":"none")?>" onchange="ConvertDDLToTextfield('type_3')" name="type_3" id="type_2">
								<?php
									$dataTypeIndex = 2;
									eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
								?>
							</select>
						</td>
						<td>
							<select class="s" style="display:<?=(!isset($renderList[2])||$misc->RenderTypeIsKnown($renderList[2]) ?"inline":"none")?>" name="render_3" id="render_3">
								<?php
									$dataRenderIndex = 2;
									eval("include \"./include/rendertype.extjs.inc.php\";");
								?>
							</select>
						</td>
					</tr>
					<?php
					if (isset($attributeList))
					{
						$max = count($attributeList);
						for ($j=4; $j<= $max; $j++)
						{			
							echo '
							<tr id="attribute_'.$j.'">
								<td>
									'.$j.'
								</td>
								<td>
									<input type="text" class="form-control" name="fieldattribute_'.$j.'" class="i" id="fieldattribute_'.$j.'" value="'.(isset($attributeList)&&isset($attributeList[$j-1])?$attributeList[$j-1]:'').'" onkeydown="javascript:Reposition(this,event);"/>
								</td>
								<td>
									<select class="s" style="display:'.(!isset($typeList[$j-1])||$misc->TypeIsKnown($typeList[$j-1])?"inline":"none").'" onchange="ConvertDDLToTextfield(\'type_'.$j.'\')" name="type_'.$j.'" id="type_'.$j.'">';

									$dataTypeIndex = $j-1;
									eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
					
									echo '</select>
								</td>
								<td>
									<select class="s" style="display:'.(!isset($renderList[$j-1])||$misc->RenderTypeIsKnown($renderList[$j-1])?"inline":"none").'" name="render_'.$j.'" id="render_'.$j.'">';

										$dataRenderIndex = $j-1;
										eval("include \"./include/rendertype.extjs.inc.php\";");
						
										echo '</select>
								</td>
							</tr>';
						}
						
						$max++;
						
						if ($max < 3)
						{
							$max = 3;
						}
						
						for ($j=$max+1; $j<100; $j++)
						{	
							echo '
							<tr class="hide_me" id="attribute_'.$j.'">
								<td>
									'.$j.'
								</td>
								<td>
									<input type="text" class="form-control" name="fieldattribute_'.$j.'" class="i" id="fieldattribute_'.$j.'" value="" onkeydown="javascript:Reposition(this,event);"/>
								</td>
								<td>
									<select class="s" style="display:inline" onchange="ConvertDDLToTextfield(\'type_'.$j.'\')" name="type_'.$j.'" id="type_'.$j.'">';

									$dataTypeIndex = $j;
									eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
					
									echo '</select>
								</td>
								<td>
									<select class="s" style="display:inline" name="render_'.$j.'" id="render_'.$j.'">';

									$dataRenderIndex = $j;
									eval("include \"./include/rendertype.extjs.inc.php\";");
					
									echo '</select>
								</td>
							</tr>';
						}
					}
					else
					{
						for ($j=4; $j<100; $j++)
						{
							echo '<tr class="hide_me" id="attribute_'.$j.'">
								<td>
									'.$j.'
								</td>
								<td>
									<input type="text" class="form-control" name="fieldattribute_'.$j.'" class="i" id="fieldattribute_'.$j.'" onkeydown="javascript:Reposition(this,event);"/>
								</td>
								<td>
									<select class="s" style="display:inline" onchange="ConvertDDLToTextfield(\'type_'.$j.'\')" name="type_'.$j.'" id="type_'.$j.'">';
										
										$dataTypeIndex = $j;
										eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
						
						
										echo '</select>
								</td>
								<td>
									<select class="s" style="display:inline" name="render_'.$j.'" id="render_'.$j.'">';

										$dataRenderIndex = $j;
										eval("include \"./include/rendertype.extjs.inc.php\";");
						
										echo '</select>
								</td>
							</tr>';
						}
					}
					?>
                </tbody>
            </table>
            <div class="submit">
			
			 <p class="pull-right"><a class="btn btn-info" href="#" onclick="AddField();return false;" role="button"><span class='glyphicon glyphicon-plus'></span> Add Attribute</a>&nbsp;
			 <a class="btn btn-danger" href="#" onclick="ResetFields();return false" role="button"><span class='glyphicon glyphicon-refresh'></span> Reset</a></p>
			 
			 <p><br><br><br><button type="submit" class="btn btn-success"><span class='glyphicon glyphicon-play'></span> Generate Code!</button></p>
		</div>
		</section>
        <br><br>
        
<br><br><div class="row">
        <div class="col-sm-6">
          <div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">
				  TODO:
				</h3>
			</div>
			<div class="panel-body">
				<p><span class='glyphicon glyphicon-pushpin'></span> Make others type of form, like Master-Detail Form</p>
				<p><span class='glyphicon glyphicon-pushpin'></span><strike> Make it Compatible ExtJS 4.+</strike>&nbsp;<span class="glyphicon glyphicon-ok"></span></p>
				<p><span class='glyphicon glyphicon-pushpin'></span> Work with another databases like Postgres</p>
				<p><span class='glyphicon glyphicon-pushpin'></span> Create reporst and charts</p>
			</div>
		</div>        
      </div>
		<br><br><br><br>
		<br><br>
		<br><br><br><br>
		<br><br>
		<br><br><br><br>
		<br><br>
		<br><br><br><br>
		<br><br>
		<br><br><br><br>
		<br><br>
		<br><br><br><br>
		<br><br>
		<br><br><br><br>
		<br><br>
		<br><br>

        </div>
      </div>
    </div>
  </form>
  
	<!-- Modal Alert 1
	================================================== -->
	<div id="alert1" style="display: none;" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="panel panel-default">
		  <div class="panel-heading">
			Information
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  </div>
		  <div class="panel-body">
			You have more than 1 attribute with the same value. Attributes must be unique.
		  </div>
		  <div class="panel-footer text-center">
			<button type="button" class="btn btn-default" data-dismiss="modal">
			  <span class="glyphicon glyphicon-remove">
			  </span>
			  Close
			</button>
		  </div>
		</div>
	  </div>
	  <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Modal Alert 2
	================================================== -->

	<div id="alert2" style="display: none;" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="panel panel-default">
		  <div class="panel-heading">
			Information
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  </div>
		  <div class="panel-body">
			An object cannot relate to itself recursively. Make sure attribute names are different from the object name.
		  </div>
		  <div class="panel-footer text-center">
			<button type="button" class="btn btn-default" data-dismiss="modal">
			  <span class="glyphicon glyphicon-remove">
			  </span>
			  Close
			</button>
		  </div>
		</div>
	  </div>
	  <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<!-- Modal Alert 3
	================================================== -->

	<div id="alert3" style="display: none;" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="panel panel-default">
		  <div class="panel-heading">
			Information
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		  </div>
		  <div class="panel-body">
			Without any object attributes, POG may generate an invalid PHP object. You need to have at least 1 non-parent/child attribute.
		  </div>
		  <div class="panel-footer text-center">
			<button type="button" class="btn btn-default" data-dismiss="modal">
			  <span class="glyphicon glyphicon-remove">
			  </span>
			  Close
			</button>
		  </div>
		</div>
	  </div>
	  <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<script type="text/javascript">

		jQuery("select.image-picker").imagepicker({
		  hide_select:  false,
		});

		jQuery("select.image-picker.show-labels").imagepicker({
		  hide_select:  true,
		  show_label:   true,
		});

		jQuery("select.image-picker.limit_callback").imagepicker({
		  limit_reached:  function(){alert('We are full!')},
		  hide_select:    false
		});
		
		$(document).ready(function(){
			$(".tooltip-examples span").tooltip({
					placement : 'top'
			});
		});	
    
	</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" href="./phpobjectgenerator.css" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" >
<title>Php Object Generator (v<?=$GLOBALS['configuration']['versionNumber']?><?=$GLOBALS['configuration']['revisionNumber']?>) - Open Source ExtJs Code Generator</title>
<script src="./pog.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
 function nameDefined(ckie,nme)
{
   var splitValues
   var i
   for (i=0;i<ckie.length;++i)
   {
      splitValues=ckie[i].split("=")
      if (splitValues[0]==nme) return true
   }
   return false
}

function delBlanks(strng)
{
   var result=""
   var i
   var chrn
   for (i=0;i<strng.length;++i) {
      chrn=strng.charAt(i)
      if (chrn!=" ") result += chrn
   }
   return result
}
function getCookieValue(ckie,nme)
{
   var splitValues
   var i
   for(i=0;i<ckie.length;++i) {
      splitValues=ckie[i].split("=")
      if(splitValues[0]==nme) return splitValues[1]
   }
   return ""
}
function insertCounter() {
 readCookie()
 displayCounter()
}
 function displayCounter() {
 document.write('<H3 ALIGN="CENTER">')
 document.write("You've visited this page ")
 if(counter==1) document.write("the first time.")
 else document.write(counter+" times.")
 document.writeln('</H3>')
 }
function readCookie() {
 var cookie=document.cookie
 counter=0
 var chkdCookie=delBlanks(cookie)  //are on the client computer
 var nvpair=chkdCookie.split(";")
 if(nameDefined(nvpair,"pageCount"))
 counter=parseInt(getCookieValue(nvpair,"pageCount"))
 ++counter
 var futdate = new Date()
 var expdate = futdate.getTime()
 expdate += 3600000 * 24 *30  //expires in 1 hour
 futdate.setTime(expdate)

 var newCookie="pageCount="+counter
 newCookie += "; expires=" + futdate.toGMTString()
 window.document.cookie=newCookie
}
// -->
</SCRIPT>
<style>
body {
	font-family:helvetica,tahoma,verdana,sans-serif;
	padding:20px;
    padding-top:32px;
    font-size:13px;
	background-color:#fff !important;
}
p {
	margin-bottom:15px;
}
h1 {
	font-size:large;
	margin-bottom:20px;
}
h2 {
	font-size:14px;
    color:#333;
    font-weight:bold;
    margin:10px 0;
}
</style>

</head>
<body>
	<div class="greyboxes">
	<h1>POG+ExtJS Code Generator v3.0d</h1>
	<br><br>
	<div>You are the visitor number <?php include "./include/header.inc.php"; ?></div>
	<div><h2>For now just work selecting language Php5.1 and MySQL </h2></div>
	</div>
	<form method="post" action="index2.php">
		
		<div class="greyboxes">
			<span class="line">
				<img src="./images/generar_para.jpg" alt="object attribute" width="200" height="18"/>
				<select class="s" name="language" id="FirstField" onchange="CascadePhpVersion()">
				<option value="php5" <?=($misc->GetVariable('language') != null && $misc->GetVariable('language')=="php5"?"selected":"")?>>PHP 5</option>
				<option value="php5.1" <?=($misc->GetVariable('language') != null && $misc->GetVariable('language')=="php5.1"?"selected":"")?>>PHP 5.1+</option>
				<option value="php4" <?=($misc->GetVariable('language') != null && $misc->GetVariable('language')=="php4"?"selected":"")?>>PHP 4</option>
				</select>
			</span><br><br>
			<span class="line">
				<img src="./images/capa_basedatos.jpg" alt="object attribute" width="200" height="18"/>
				<select class="s" name="wrapper" id="wrapper" onchange="IsPDO()">
					<option value="POG"  <?= ($misc->GetVariable('wrapper') != null&& strtoupper($misc->GetVariable('wrapper'))=="POG"?"selected":"")?>>POG</option>
					<?
					if (($misc->GetVariable('wrapper') != null&& strtoupper($misc->GetVariable('wrapper'))=="PDO"))
					{
					?>
						<option value="PDO" <?= ($misc->GetVariable('wrapper') != null&& strtoupper($misc->GetVariable('wrapper'))=="PDO"?"selected":"")?>>PDO</option>
					<?
					}
					?>
				</select>
				<select class="s" name="pdoDriver" id="PDOdriver" style="display:<?= ($misc->GetVariable('wrapper') != null&& strtoupper($misc->GetVariable('wrapper'))=="PDO"?"inline":"none")?>">
					<option value="mysql" <?= ($misc->GetVariable('pdoDriver') != null&& $misc->GetVariable('pdoDriver')=="mysql"?"selected":"")?>>MYSQL</option>
					<!--<option value="oci" <?= ($misc->GetVariable('pdoDriver') != null&& $misc->GetVariable('pdoDriver')=="oci"?"selected":"")?>>OCI</option>-->
					<!--<option value="dblib" <?= ($misc->GetVariable('pdoDriver') != null&& $misc->GetVariable('pdoDriver')=="dblib"?"selected":"")?>>DBLIB</option>-->
					<!--untested pdo drivers have been commented out. uncomment once they are tested-->
					<!--<option value="firebird" <?= ($misc->GetVariable('pdoDriver') != null&& $misc->GetVariable('pdoDriver')=="firebird"?"selected":"")?>>FIREBIRD</option>
					<option value="odbc" <?= ($misc->GetVariable('pdoDriver') != null&& $misc->GetVariable('pdoDriver')=="odbc"?"selected":"")?>>ODBC</option>
					<option value="pgsql" <?= ($misc->GetVariable('pdoDriver') != null&& $misc->GetVariable('pdoDriver')=="pgsql"?"selected":"")?>>PGSQL</option>
					<option value="sqlite" <?= ($misc->GetVariable('pdoDriver') != null&& $misc->GetVariable('pdoDriver')=="sqlite"?"selected":"")?>>SQLITE</option>-->
				</select>
			</span><br><br>
			<span class="line">
				<img src="./images/tipo_crud.jpg" alt="object attribute" width="200" height="18"/>
				<select class="s" name="extjsVersion" id="extjsVersion">				
					<option value="31" <?=($misc->GetVariable('extjsVersion') != null && $misc->GetVariable('extjsVersion')=="31"?"selected":"")?>>Row Editor</option>
					<option value="30" <?=($misc->GetVariable('extjsVersion') != null && $misc->GetVariable('extjsVersion')=="30"?"selected":"")?>>Form Binding</option>
				</select>
			</span><br><br>
			<span class="line">
				<img src="./images/nombre_crud.jpg" alt="object attribute" width="200" height="18"/>
				<input type="text" id="objName" name="object" class="i" value="<?=(isset($objectName)?$objectName:'')?>"/>
			</span><br><br>
		</div>
		
		<div class="greybox">
			<table width="100%" >
				<tr><td align=center><H2>Field</H2> </td>
				<td align=center><H2>POG</H2></td>
				<td align=center><H2>ExtJS</H2></td></tr>			
			</table>
		</div>
		<div class="greybox">
			<span class="line">
				<img src="./images/atributo.jpg" alt="object attribute" width="70" height="18"/>
				<input  type="text" name="fieldattribute_1" class="i" value="<?=(isset($attributeList)&&isset($attributeList[0])?$attributeList[0]:'')?>" onkeydown="javascript:Reposition(this,event);"></input>
				<img src="./images/tipo.jpg" alt="object attribute" width="75" height="18"/>
				<select class="s" style="display:<?=(!isset($typeList[0])||$misc->TypeIsKnown($typeList[0]) ?"inline":"none")?>" onchange="ConvertDDLToTextfield('type_1')" name="type_1" id="type_1">
                	<?
                		$dataTypeIndex = 0;
						eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
					?>
                </select><input style="display:<?=(!isset($typeList[0])||$misc->TypeIsKnown($typeList[0])?"none":"inline")?>" type="text" name="ttype_1" class="i" id="ttype_1" value="<?=(isset($typeList)&&isset($typeList[0])&&!$misc->TypeIsKnown($typeList[0])?$typeList[0]:'')?>"></input>
				<img src="./images/render.jpg" alt="object attribute" width="80" height="18"/>
				<select class="s" style="display:<?=(!isset($renderList[0])||$misc->RenderTypeIsKnown($renderList[0]) ?"inline":"none")?>" name="render_1" id="render_1">
                	<?
                		$dataRenderIndex = 0;
						eval("include \"./include/rendertype.extjs.inc.php\";");
					?>
				</select>
			</span><br/><br/>
			<span class="line">
				<img src="./images/atributo.jpg" alt="object attribute" width="70" height="18"/>
				<input  type="text" name="fieldattribute_2" class="i" value="<?=(isset($attributeList)&&isset($attributeList[1])?$attributeList[1]:'')?>" onkeydown="javascript:Reposition(this,event);"></input>
				<img src="./images/tipo.jpg" alt="object attribute" width="75" height="18"/>
				<select class="s" style="display:<?=(!isset($typeList[1])||$misc->TypeIsKnown($typeList[1]) ?"inline":"none")?>" onchange="ConvertDDLToTextfield('type_2')" name="type_2" id="type_2">
                	<?
                		$dataTypeIndex = 1;
						eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
					?>
                </select>
				<input style="display:<?=(!isset($typeList[1])||$misc->TypeIsKnown($typeList[1])?"none":"inline")?>" type="text" name="ttype_2" class="i" id="ttype_2" value="<?=(isset($typeList)&&isset($typeList[1])&&!$misc->TypeIsKnown($typeList[1])?$typeList[1]:'')?>"></input>
				<img src="./images/render.jpg" alt="object attribute" width="80" height="18"/>
				<select class="s" style="display:<?=(!isset($renderList[1])||$misc->RenderTypeIsKnown($renderList[1]) ?"inline":"none")?>" name="render_2" id="render_2">
                	<?
                		$dataRenderIndex = 1;
						eval("include \"./include/rendertype.extjs.inc.php\";");
					?>
				</select>
			</span><br/><br/>
			<span class="line">
				<img src="./images/atributo.jpg" alt="object attribute" width="70" height="18"/>
				<input  type="text" name="fieldattribute_3" class="i" value="<?=(isset($attributeList)&&isset($attributeList[2])?$attributeList[2]:'')?>" onkeydown="javascript:Reposition(this,event);"></input>
				<img src="./images/tipo.jpg" alt="object attribute" width="75" height="18"/>
				<select class="s" style="display:<?=(!isset($typeList[2])||$misc->TypeIsKnown($typeList[2]) ?"inline":"none")?>" onchange="ConvertDDLToTextfield('type_3')" name="type_3" id="type_2">
                	<?
                		$dataTypeIndex = 2;
						eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
					?>
                </select>
				<input style="display:<?=(!isset($typeList[2])||$misc->TypeIsKnown($typeList[2])?"none":"inline")?>" type="text" name="ttype_3" class="i" id="ttype_3" value="<?=(isset($typeList)&&isset($typeList[2])&&!$misc->TypeIsKnown($typeList[2])?$typeList[2]:'')?>"></input>
				<img src="./images/render.jpg" alt="object attribute" width="80" height="18"/>
				<select class="s" style="display:<?=(!isset($renderList[2])||$misc->RenderTypeIsKnown($renderList[2]) ?"inline":"none")?>" name="render_3" id="render_3">
                	<?
                		$dataRenderIndex = 2;
						eval("include \"./include/rendertype.extjs.inc.php\";");
					?>
				</select>
			</span><br/><br/>
				
			<?
			if (isset($attributeList))
			{
				$max = count($attributeList);
				for ($j=4; $j<= $max; $j++)
				{			
					echo '<div style="display:block" id="attribute_'.$j.'">
						<br>
						<span class="line">
							<img src="./images/atributo.jpg" alt="object attribute" width="70" height="18"/>
							<input type="text" name="fieldattribute_'.$j.'" class="i" id="fieldattribute_'.$j.'" value="'.(isset($attributeList)&&isset($attributeList[$j-1])?$attributeList[$j-1]:'').'" onkeydown="javascript:Reposition(this,event);"/>
							<img src="./images/tipo.jpg" alt="object attribute" width="75" height="18"/>
							<select class="s" style="display:'.(!isset($typeList[$j-1])||$misc->TypeIsKnown($typeList[$j-1])?"inline":"none").'" onchange="ConvertDDLToTextfield(\'type_'.$j.'\')" name="type_'.$j.'" id="type_'.$j.'">';

							$dataTypeIndex = $j-1;
							eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
			
							echo '</select>
							<input style="display:'.(!isset($typeList[$j-1])||$misc->TypeIsKnown($typeList[$j-1]) ?"none":"inline").'" type="text" id="ttype_'.$j.'"  name="ttype_'.$j.'" class="i" value="'.(isset($typeList)&&isset($typeList[$j-1])&&!$misc->TypeIsKnown($typeList[$j-1])?$typeList[$j-1]:'').'"></input>
							<img src="./images/render.jpg" alt="object attribute" width="80" height="18"/>
							<select class="s" style="display:'.(!isset($renderList[$j-1])||$misc->RenderTypeIsKnown($renderList[$j-1])?"inline":"none").'" name="render_'.$j.'" id="render_'.$j.'">';

							$dataRenderIndex = $j-1;
							eval("include \"./include/rendertype.extjs.inc.php\";");
			
							echo '</select>
						</span>						  
						</div>';
						 
				}
				
				$max++;
				
				if ($max < 3)
				{
					$max = 3;
				}
				
				for ($j=$max+1; $j<100; $j++)
				{	
					echo '<div style="display:none" id="attribute_'.$j.'">
						<br>
						<span class="line">
							<img src="./images/atributo.jpg" alt="object attribute" width="70" height="18"/>
							<input type="text" name="fieldattribute_'.$j.'" class="i" id="fieldattribute_'.$j.'" value="" onkeydown="javascript:Reposition(this,event);"/>
							<img src="./images/tipo.jpg" alt="object attribute" width="75" height="18"/>
							<select class="s" style="display:inline" onchange="ConvertDDLToTextfield(\'type_'.$j.'\')" name="type_'.$j.'" id="type_'.$j.'">';

							$dataTypeIndex = $j;
							eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
			
							echo '</select>
							<input style="display:none" type="text" id="ttype_'.$j.'" name="ttype_'.$j.'" class="i"></input>
							<img src="./images/render.jpg" alt="object attribute" width="80" height="18"/>
							<select class="s" style="display:inline" name="render_'.$j.'" id="render_'.$j.'">';

							$dataRenderIndex = $j;
							eval("include \"./include/rendertype.extjs.inc.php\";");
			
							echo '</select>
						</span>
						</div>';

				}
			}
			else
			{
				for ($j=4; $j<100; $j++)
				{
			
					echo   '<div style="display:none" id="attribute_'.$j.'">
						    <br>
							<span class="line">
								<img src="./images/atributo.jpg" alt="object attribute" width="70" height="18"/>
								<input type="text" name="fieldattribute_'.$j.'" class="i" id="fieldattribute_'.$j.'" onkeydown="javascript:Reposition(this,event);"/>
								<img src="./images/tipo.jpg" alt="object attribute" width="75" height="18"/>
								<select class="s" style="display:inline" onchange="ConvertDDLToTextfield(\'type_'.$j.'\')" name="type_'.$j.'" id="type_'.$j.'">';
								
								$dataTypeIndex = $j;
								eval("include \"./include/datatype.".$pdoDriver.".inc.php\";");
				
				
								echo '</select>
								<input style="display:none" type="text" id="ttype_'.$j.'" name="ttype_'.$j.'" class="i"></input>
								<img src="./images/render.jpg" alt="object attribute" width="80" height="18"/>
								<select class="s" style="display:inline" name="render_'.$j.'" id="render_'.$j.'">';

								$dataRenderIndex = $j;
								eval("include \"./include/rendertype.extjs.inc.php\";");
				
								echo '</select>
							</span>
							</div>';
				}
			}
			?>
		</div>
		
		

		
		<!--<div class="generate">
			<a href="#" onclick="AddField();return false;"><img src="./images/addattribute.jpg" border="0" alt="add attribute"/></a> <a href="#" onclick="ResetFields();return false"><img src="./images/resetfields.jpg" border="0" alt="reset fields"/></a>		</div>-->

		<div class="submit">
			<a href="#" onclick="AddField();return false;"><img src="./images/addattribute.jpg" border="0" alt="add attribute"/></a> <a href="#" onclick="ResetFields();return false"><img src="./images/resetfields.jpg" border="0" alt="reset fields"/></a><br><br>
			<input type="image"  src="./images/generate.jpg" alt="Generate!" onclick="WarnMinInput();"/>
		</div><!-- submit -->
		<br>
		<div class="greybox">
			TODO:
			<ul align="right"><li>Make another type of form, like Master-Detail Form</li>
			<li>Make it Compatible ExtJS 4.+</li>
			<li>Work with another databases like Postgres</li>
			<li>And more improvements...</li>
			</ul>
		</div>
</form>
</body>
</html>
<?php
	unset($_SESSION);
?>

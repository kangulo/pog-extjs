<?php
class ObjectExtjs
{
	var $string;
	var $sql;
	var $objectName;
	var $attributeList;
	var $typeList;
	var $totalAttributes;
	var $renderList;
	var $separator = "";
	var $pdoDriver = "";
	var $language = 'php5.1';
	var $extjsVersion = '30';
	var $arrayControls = array();

	// -------------------------------------------------------------
	function ObjectExtjs($objectName, $attributeList = '', $typeList ='', $renderList ='', $pdoDriver = '', $language = 'php5.1', $extjsVersion = '3')
	{
		$this->objectName = $objectName;
		$this->attributeList = $attributeList;
		$this->typeList = $typeList;
		$this->renderList = $renderList;
		$this->pdoDriver = $pdoDriver;
		$this->language = $language;
		$this->extjsVersion = $extjsVersion;
		$this->totalAttributes = count($typeList);
	}

	// -------------------------------------------------------------
	function CreateCargarFunction()
	{
		$this->string .="\n/**";
		$this->string .="\n*  Inicializa los valores del formulario y carga y muestra el grid";
		$this->string .="\n*  @return void";
		$this->string .="\n*/\n\t";	
		$this->string .="\nCargar = function () {\n";
		$this->string .="\n\t// Habilita los Tooltiptext";
		$this->string .="\n\tExt.QuickTips.init();\n";	
		$this->string .="\n\t// Activar la validacion de errores al lado del control";
		$this->string .="\n\tExt.form.Field.prototype.msgTarget = 'side';\n";			
		$this->string .= "\n\t/**";
		$this->string .= "\n\t* Definimos los campos que podra contener el panel which this Panel contains.";
		$this->string .= "\n\t* @return {Ext.form.BasicForm} The {@link Ext.form.BasicForm Form} which this Panel contains.";
		$this->string .= "\n\t*/\n\t";
		$this->string .="\n\t// creamos el id co_".rtrim(strtolower($this->objectName),s);
		$this->string .="\n\tvar co_".rtrim(strtolower($this->objectName),s)." = new Ext.form.TextField({ ";
		$this->string .="\n\t\tid        :'co_".rtrim(strtolower($this->objectName),s)."',";
		$this->string .="\n\t\tname      :'co_".rtrim(strtolower($this->objectName),s)."',";
		$this->string .="\n\t\tfieldLabel:'co_".rtrim(strtolower($this->objectName),s)."',";
		$this->string .="\n\t\tdisabled  :true,";
		$this->string .="\n\t\thidden  :true,";
		$this->string .="\n\t\t//hideLabel  :true,";
		$this->string .="\n\t\ttabIndex  :".($x+1)."";
		$this->string .="\n\t});\n\t";
		$this->string .="\n\t// creamos el listener para el KeyUp evento";
		$this->string .="\n\tco_".rtrim(strtolower($this->objectName),s).".on('keyup', function(el,e) { ";
		$this->string .="\n\t\tif (e.getKey() == Ext.EventObject.ESC) {";
		$this->string .="\n\t\t\tExt.getCmp('form').getForm().reset();";
		$this->string .="\n\t\t\tDeshabilitar(store);";
		$this->string .="\n\t\t\tExt.getCmp('grid').focus();";
		$this->string .="\n\t\t}\n\t";	
		$this->string .="\n\t});\n\t";	
		$this->string .="\n\tco_".rtrim(strtolower($this->objectName),s).".on('focus', function() { ";
		$this->string .="\n\t\tthis.selectText();";
		$this->string .="\n\t});\n\t";					
		$this->arrayControls[] = "co_".rtrim(strtolower($this->objectName),s);
		
		$x = 0;
		foreach ($this->attributeList as $attribute)
		{
			//$this->string .= $this->renderList[$x];
			if ($this->renderList[$x] == "Ext.form.TextField")
			{
				$this->string .="\n\t// creamos el TextField ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.form.TextField({ ";
				$this->string .="\n\t\tid        :'".strtolower($attribute)."',";
				$this->string .="\n\t\tname      :'".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\tenableKeyEvents  :true,";
				$this->string .="\n\t\tallowBlank  :true,";
				$this->string .="\n\t\tdisabled  :true,";
				$this->string .="\n\t\ttabIndex  :".($x+1)."";
				$this->string .="\n\t});\n\t";	
				$this->string .="\n\t// creamos el listener para el KeyUp evento";
				$this->string .="\n\t".strtolower($attribute).".on('keyup', function(el,e) { ";
				$this->string .="\n\t\tif (e.getKey() == Ext.EventObject.ESC) {";
				$this->string .="\n\t\t\tExt.getCmp('form').getForm().reset();";
				$this->string .="\n\t\t\tDeshabilitar(store);";
				$this->string .="\n\t\t\tExt.getCmp('grid').focus();";
				$this->string .="\n\t\t}\n\t";	
				$this->string .="\n\t});\n\t";	
				$this->string .="\n\t".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\tthis.selectText();";
				$this->string .="\n\t});\n\t";	
				$this->arrayControls[] = strtolower($attribute);
			}
			else if ($this->renderList[$x] == "Ext.form.ComboBox")
			{
				
				// AQUI VA EL DS DEL COMBO
				// Combo de los cmb
				
				$this->string .="\n\t/**";
				$this->string .="\n\t*  JsonStore que provee los valores para llenara un Combo";
				$this->string .="\n\t*  y se carga Automaticamente =>  autoLoad=true";
				$this->string .="\n\t*/\n\t";				
				$this->string .="\n\t// Descomenta el siguiente Bloque de codigo si tu combo";
				$this->string .="\n\t// Usa un JsonStore y se carga desde la base de datos";
				$this->string .="\n\t/*";
				$this->string .="\n\tvar ds".ucfirst($attribute)." = new Ext.data.JsonStore({";
				$this->string .="\n\t\turl     : 'controller.".$this->objectName.".php?accion=get".ucfirst($attribute)."',";
				$this->string .="\n\t\troot    : '".ucfirst($attribute)."',";
				$this->string .="\n\t\tautoLoad: true,";
				$this->string .="\n\t\tfields  : [{";
				$this->string .="\n\t\t\tname: 'co_".strtolower($attribute)."',";
				$this->string .="\n\t\t\ttype: 'int'";
				$this->string .="\n\t\t},";
				$this->string .="\n\t\t{";
				$this->string .="\n\t\t\tname: 'nb_".strtolower($attribute)."',";
				$this->string .="\n\t\t\ttype: 'string'";
				$this->string .="\n\t\t}]";
				$this->string .="\n\t});";
				$this->string .="\n\t*/\n\t";
				
				$this->string .="\n\t// creamos el ComboBox ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.form.ComboBox({";
				$this->string .="\n\t\tid            : '".strtolower($attribute)."',";
				$this->string .="\n\t\tname          : '".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel    : '".strtolower($attribute)."',";
				$this->string .="\n\t\thiddenName    : '".strtolower($attribute)."',";
				$this->string .="\n\t\tvalueField    : '".strtolower($attribute)."',";
				$this->string .="\n\t\tdisplayField  : 'nb_".strtolower($attribute)."',";
				$this->string .="\n\t\ttabIndex      :".($x+1).",";
				$this->string .="\n\t\tstore         : new Ext.data.SimpleStore({\t//ds".ucfirst($attribute).",";
				$this->string .="\n\t\t\tfields: ['".strtolower($attribute)."', 'nb_".strtolower($attribute)."'],";
				$this->string .="\n\t\t\tdata  : [";
				$this->string .="\n\t\t\t\t['".strtolower($attribute)."1', 'nb_".strtolower($attribute)."1'],";
				$this->string .="\n\t\t\t\t['".strtolower($attribute)."2', 'nb_".strtolower($attribute)."2']";				
				$this->string .="\n\t\t]}),";
				$this->string .="\n\t\ttypeAhead     : true,";
				$this->string .="\n\t\tforceSelection: true,";
				$this->string .="\n\t\tmode          : 'local',";
				$this->string .="\n\t\ttriggerAction : 'all',";
				$this->string .="\n\t\temptyText     : 'Seleccione un ".strtolower($attribute)."...',";
				$this->string .="\n\t\twidth         : 160";
				$this->string .="\n\t});\n\t";
				$this->string .="\n\t// creamos el listener para el KeyUp evento";
				$this->string .="\n\t".strtolower($attribute).".on('keyup', function(el,e) { ";
				$this->string .="\n\t\tif (e.getKey() == Ext.EventObject.ESC) {";
				$this->string .="\n\t\t\tExt.getCmp('form').getForm().reset();";
				$this->string .="\n\t\t\tDeshabilitar(store);";
				$this->string .="\n\t\t\tExt.getCmp('grid').focus();";
				$this->string .="\n\t\t}\n\t";	
				$this->string .="\n\t});\n\t";	
				$this->string .="\n\t".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\tthis.selectText();";
				$this->string .="\n\t});\n\t";	
				$this->arrayControls[] = strtolower($attribute);
					
			}
			else if ($this->renderList[$x] == "Ext.form.DateField")
			{
				$this->string .="\n\t// creamos el DateField ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.ux.form.XDateField({";
				$this->string .="\n\t\tid        : '".strtolower($attribute)."',";
				$this->string .="\n\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel: '".strtolower($attribute)."',";
				$this->string .="\n\t\tenableKeyEvents  :true,";
				$this->string .="\n\t\tallowBlank  :true,";
				$this->string .="\n\t\tdisabled  :true,";
				$this->string .="\n\t\ttabIndex   :".($x+1).",";
				$this->string .="\n\t\tformat    : 'd/m/Y',";
				$this->string .="\n\t\tsubmitFormat:'Y-m-d'";
				$this->string .="\n\t});\n\t";
				$this->string .="\n\t// creamos el listener para el KeyUp evento";
				$this->string .="\n\t".strtolower($attribute).".on('keyup', function(el,e) { ";
				$this->string .="\n\t\tif (e.getKey() == Ext.EventObject.ESC) {";
				$this->string .="\n\t\t\tExt.getCmp('form').getForm().reset();";
				$this->string .="\n\t\t\tDeshabilitar(store);";
				$this->string .="\n\t\t\tExt.getCmp('grid').focus();";
				$this->string .="\n\t\t}\n\t";	
				$this->string .="\n\t});\n\t";	
				$this->string .="\n\t".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\tthis.selectText();";
				$this->string .="\n\t});\n\t";	
				$this->arrayControls[] = "".strtolower($attribute)."";  
			}
			else if ($this->renderList[$x] == "Ext.form.TextArea")
			{
				$this->string .="\n\t// creamos el TextArea ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.form.TextArea({ ";
				$this->string .="\n\t\tid        : '".strtolower($attribute)."',";
				$this->string .="\n\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\tenableKeyEvents  :true,";
				$this->string .="\n\t\tallowBlank  :true,";
				$this->string .="\n\t\tdisabled  :true,";
				$this->string .="\n\t\ttabIndex  :".($x+1).",";
				$this->string .="\n\t\thideLabel : true,";
				$this->string .="\n\t\twidth     : 275,";
				$this->string .="\n\t\theight    : 100";
				$this->string .="\n\t});\n\t";
				$this->string .="\n\t// creamos el listener para el KeyUp evento";
				$this->string .="\n\t".strtolower($attribute).".on('keyup', function(el,e) { ";
				$this->string .="\n\t\tif (e.getKey() == Ext.EventObject.ESC) {";
				$this->string .="\n\t\t\tExt.getCmp('form').getForm().reset();";
				$this->string .="\n\t\t\tDeshabilitar(store);";
				$this->string .="\n\t\t\tExt.getCmp('grid').focus();";
				$this->string .="\n\t\t}\n\t";	
				$this->string .="\n\t});\n\t";	
				$this->string .="\n\t".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\tthis.selectText();";
				$this->string .="\n\t});\n\t";	
				$this->arrayControls[] = strtolower($attribute);
			}
			else if ($this->renderList[$x] == "Ext.form.Checkbox")
			{
				$this->string .="\n\t// creamos el XCheckbox ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.ux.form.XCheckbox({ ";
				$this->string .="\n\t\tid        : '".strtolower($attribute)."',";
				$this->string .="\n\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\ttabIndex  :".($x+1).",";
				$this->string .="\n\t\tsubmitOffValue: 0,";
				$this->string .="\n\t\tsubmitOnValue:1";
				$this->string .="\n\t});\n\t";				
				$this->arrayControls[] = strtolower($attribute);
			}
/*
			else if ($this->renderList[$x] == "Ext.form.Checkbox")
			{
				$this->string .="\n\t// creamos el Checkbox ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.form.Checkbox({ ";
				$this->string .="\n\t\tid        : '".strtolower($attribute)."',";
				$this->string .="\n\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\ttabIndex  :".($x+1)."";
				$this->string .="\n\t});\n\t";				
				$this->arrayControls[] = strtolower($attribute);
			}
*/
			else if ($this->renderList[$x] == "Ext.form.HtmlEditor")
			{
				$this->string .="\n\t// creamos el TextArea ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.form.HtmlEditor({ ";
				$this->string .="\n\t\tid        : '".strtolower($attribute)."',";
				$this->string .="\n\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\ttabIndex  :".($x+1).",";
				$this->string .="\n\t\thideLabel : true,";
				$this->string .="\n\t\tanchor    : '98%',";
				$this->string .="\n\t\theight    : 200";
				$this->string .="\n\t});\n\t";
				$this->string .="\n\t// creamos el listener para el KeyUp evento";
				$this->string .="\n\t".strtolower($attribute).".on('keyup', function(el,e) { ";
				$this->string .="\n\t\tif (e.getKey() == Ext.EventObject.ESC) {";
				$this->string .="\n\t\t\tExt.getCmp('form').getForm().reset();";
				$this->string .="\n\t\t\tDeshabilitar(store);";
				$this->string .="\n\t\t\tExt.getCmp('grid').focus();";
				$this->string .="\n\t\t}\n\t";	
				$this->string .="\n\t});\n\t";	
				$this->string .="\n\t".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\tthis.selectText();";
				$this->string .="\n\t});\n\t";	
				$this->arrayControls[] = strtolower($attribute);
			}
			else if ($this->renderList[$x] == "Ext.form.TimeField")
			{
				$this->string .="\n\t// creamos el TextField ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.form.TimeField({ ";
				$this->string .="\n\t\tid        : '".strtolower($attribute)."',";
				$this->string .="\n\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel: '".strtolower($attribute)."',";
				$this->string .="\n\t\ttabIndex  :".($x+1).",";
				$this->string .="\n\t\tminValue  : '8:00am',";
				$this->string .="\n\t\tmaxValue  : '6:00pm'";
				$this->string .="\n\t});\n\t";
				$this->string .="\n\t// creamos el listener para el KeyUp evento";
				$this->string .="\n\t".strtolower($attribute).".on('keyup', function(el,e) { ";
				$this->string .="\n\t\tif (e.getKey() == Ext.EventObject.ESC) {";
				$this->string .="\n\t\t\tExt.getCmp('form').getForm().reset();";
				$this->string .="\n\t\t\tDeshabilitar(store);";
				$this->string .="\n\t\t\tExt.getCmp('grid').focus();";
				$this->string .="\n\t\t}\n\t";	
				$this->string .="\n\t});\n\t";	
				$this->string .="\n\t".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\tthis.selectText();";
				$this->string .="\n\t});\n\t";	
				$this->arrayControls[] = strtolower($attribute);
			}
			else
			{
				$this->string .="\n\t// creamos el TextField ".strtolower($attribute)."";
				$this->string .="\n\tvar ".strtolower($attribute)." = new Ext.form.TextField({ ";
				$this->string .="\n\t\tid        :'".strtolower($attribute)."',";
				$this->string .="\n\t\tname      :'".strtolower($attribute)."',";
				$this->string .="\n\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\ttabIndex  :".($x+1)."";
				$this->string .="\n\t});\n\t";
				$this->string .="\n\t// creamos el listener para el KeyUp evento";
				$this->string .="\n\t".strtolower($attribute).".on('keyup', function(el,e) { ";
				$this->string .="\n\t\tif (e.getKey() == Ext.EventObject.ESC) {";
				$this->string .="\n\t\t\tExt.getCmp('form').getForm().reset();";
				$this->string .="\n\t\t\tDeshabilitar(store);";
				$this->string .="\n\t\t\tExt.getCmp('grid').focus();";
				$this->string .="\n\t\t}\n\t";	
				$this->string .="\n\t});\n\t";	
				$this->string .="\n\t".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\tthis.selectText();";
				$this->string .="\n\t});\n\t";	
				$this->arrayControls[] = strtolower($attribute);
			}
			$x++;
		}
		// Cerramos el objeto
		//$this->string .= $this->EndObject();
		
	}

	// -------------------------------------------------------------
	function EndObject()
	{
		$this->string .= "\n});\t//Fin del Script ";
	}

	// -------------------------------------------------------------
	function CreateConstructor()
	{
		$this->string .= "\n\t\n\tfunction ".$this->objectName."(";
		$i = 0;
		$j = 0;
		foreach ($this->attributeList as $attribute)
		{
			if ($this->typeList[$i] != "BELONGSTO" && $this->typeList[$i] != "HASMANY" && $this->typeList[$i] != "JOIN")
			{
				if ($j == 0)
				{
					$this->string .= '$'.$attribute.'=\'\'';
				}
				else
				{
					$this->string .= ', $'.$attribute.'=\'\'';
				}
				$j++;
			}
			$i++;
		}
		$this->string .= ")\n\t{";
		$x = 0;
		foreach ($this->attributeList as $attribute)
		{
			if ($this->typeList[$x] == "HASMANY" || $this->typeList[$x] == "JOIN")
			{
				$this->string .="\n\t\t\$this->_".strtolower($attribute)."List = array();";
			}
			else if ($this->typeList[$x] != "BELONGSTO")
			{
				$this->string .= "\n\t\t\$this->".$attribute." = $".$attribute.";";
			}
			$x++;
		}
		$this->string .= "\n\t}";
	}

	// -------------------------------------------------------------
	function CreateSQLQuery()
	{
		$this->sql .= "\tCREATE TABLE `".strtolower($this->objectName)."` (\n\t`co_".rtrim(strtolower($this->objectName),s)."` int(11) NOT NULL auto_increment,";
		$x=0;
		$indexesToBuild = array();
		foreach ($this->attributeList as $attribute)
		{
			if ($this->typeList[$x] == "BELONGSTO")
			{
				$indexesToBuild[] = "`co_".rtrim(strtolower($attribute),s)."`";
				$this->sql .= "\n\t`co_".rtrim(strtolower($attribute),s)."` int(11) NOT NULL,";
			}
			else if ($this->typeList[$x] != "HASMANY" && $this->typeList[$x] != "JOIN")
			{
				$this->sql .= "\n\t`".strtolower($attribute)."` ".stripcslashes($this->typeList[$x])." NOT NULL,";
			}
			$x++;
		}
		if (sizeof($indexesToBuild) > 0)
		{
			$this->sql .= " INDEX(".implode(',', $indexesToBuild)."),";
		}
		$this->sql .= " PRIMARY KEY  (`co_".rtrim(strtolower($this->objectName),s)."`)) ENGINE=MyISAM;";
	}

	// -------------------------------------------------------------
	function CreateComments($description='', $parameterDescriptionArray='', $returnType='')
	{
		$this->string .= "/**\n"
 		."\t* $description\n";
 		if ($parameterDescriptionArray != '')
 		{
	 		foreach ($parameterDescriptionArray as $parameter)
	 		{
	 			$this->string .= "\t* @param $parameter \n";
	 		}
 		}
	     $this->string .= "\t* @return $returnType\n"
	     ."\t*/\n";
	}

	// -------------------------------------------------------------
	function CreatePreface()
	{
		$this->string .= "\n/*!";
		$this->string .= "\n* Ext JS Library 3.1 - Form Binding CRUD";
		$this->string .= "\n* Copyright(c) 2006-2009 Ext JS, LLC";
		$this->string .= "\n* licensing@extjs.com";
		$this->string .= "\n* http://www.extjs.com/license";
		$this->string .= "\n*";
		$this->string .= "\n* <b>".$this->objectName."</b> Clase ExtJs integrada con Metodos CRUD.";
		$this->string .= "\n* @author ".$GLOBALS['configuration']['author'];
		$this->string .= "\n* @fecha  ".date('l jS \of F Y h:i:s A');
		$this->string .= "\n* @link http://localhost/pog_extjs/?language=".$this->language."&wrapper=pdo&pdoDriver=".$this->pdoDriver."&extjsVersion=".$this->extjsVersion."&objectName=".urlencode($this->objectName)."&attributeList=".urlencode(var_export($this->attributeList, true))."&typeList=".urlencode(urlencode(var_export($this->typeList, true)))."&renderList=".urlencode(urlencode(var_export($this->renderList, true)));
		$this->string .= "\n*/\n";
		$this->string .= "\nExt.SSL_SECURE_URL  = 'images/s.gif';";
		$this->string .= "\nExt.BLANK_IMAGE_URL = 'images/s.gif';";
		$this->string .= "\n\n";
		$this->string .= "\nExt.onReady(function () {";
		$this->string .= "\n\tnew Cargar();";
		$this->string .= "\n});\n";
	}

	function Debug()
	{
		$this->string .= $this->CreatePreface();
		$this->string .="\nExt.onReady(function () {\n";
		$this->string .="\n\t// Habilita los Tooltiptext";
		$this->string .="\n\tExt.QuickTips.init();\n";	
		$this->string .="\n\t// Activar la validacion de errores en el lado del control";
		$this->string .="\n\tExt.form.Field.prototype.msgTarget = 'side';\n";	
		
		$this->string .= $this->EndObject();
	}

	// Essential functions

	// -------------------------------------------------------------
	function CreateJsonReaderFunction()
	{
		$this->string .="\n\t\t/**";
		$this->string .="\n\t\t*  JsonReader crea un arreglo de objectos desde una respuesta en json y";
		$this->string .="\n\t\t*  los mapea segun el tipo de datos";
		$this->string .="\n\t\t*/\t";	
		$this->string .="\n\t\tvar reader = new Ext.data.JsonReader({";
		$this->string .="\n\t\t\ttotalProperty: 'rows',\t\t\t\t//<--- el total de filas en el caso que se le quiera agregar paginacion.";
		$this->string .="\n\t\t\tsuccessProperty: 'success',\t\t\t//<--- el successproperty indica la propiedad que define si se ha insertado/actualizado o borrado con éxito.";
		$this->string .="\n\t\t\tmessageProperty: 'message',\t\t\t//<--- mensage de feedback sobre el status de la accion.";
		$this->string .="\n\t\t\tidProperty: 'co_".rtrim(strtolower($this->objectName),s)."',\t\t\t\t//<--- el campo clave primaria de los registros.";		
		$this->string .="\n\t\t\troot: 'data',\t\t\t\t\t//<--- este es el nombre del parámetro que llega al servidor con el JSON modificado que posee todos los campos.";
		$this->string .="\n\t\t\tfields:[";	
		$this->string .="\n\t\t\t{";
		$this->string .="\n\t\t\t\tname: 'co_".rtrim(strtolower($this->objectName),s)."',";
		$this->string .="\n\t\t\t\ttype: 'int',";							
		$this->string .="\n\t\t\t\tmapping: 'co_".rtrim(strtolower($this->objectName),s)."'";
		$this->string .="\n\t\t\t},";
		$x = 0;		
		foreach ($this->attributeList as $attribute)
		{			
			if ($this->typeList[$x] == "VARCHAR(255)")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'string',";							
				$this->string .="\n\t\t\t\tmapping: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "TEXT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'string',";							
				$this->string .="\n\t\t\t\tmapping: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}	
			else if ($this->typeList[$x] == "DATE")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'date',";							
				$this->string .="\n\t\t\t\tmapping: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\tdateFormat: 'Y-m-d'\t\t// Formato como viene desde la base de datos";
				$this->string .="\n\t\t\t}";
			}	
			else if ($this->typeList[$x] == "INT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'int',";							
				$this->string .="\n\t\t\t\tmapping: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "TINYINT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'bool',";							
				$this->string .="\n\t\t\t\tmapping: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "FLOAT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'float',";							
				$this->string .="\n\t\t\t\tmapping: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}
			else			
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'string',";							
				$this->string .="\n\t\t\t\tmapping: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}
			$x++;
			if ($x != $this->totalAttributes)
			{
				$this->string .=",";
			}			
		}
		$this->string .="\n\t\t\t]";
		$this->string .="\n\t\t});";
		$this->string .= "\n\t".$this->separator."\n\t";
	}

	// -------------------------------------------------------------
	function CreateProxyFunction()
	{
		$this->string .="\n\t\t/**";
		$this->string .="\n\t\t*  Creamos una instancia de un HttpProxy";
		$this->string .="\n\t\t*  pero con especificamos los metodos CRUD \"read\", \"create\", \"update\" y \"destroy\"";
		$this->string .="\n\t\t*  con su accion respectiva";
		$this->string .="\n\t\t*/";	
		$this->string .="\n\t\tvar proxy = new Ext.data.HttpProxy({";		
		$this->string .="\n\t\t\tapi: {";
		$this->string .="\n\t\t\t\tread   : \"controller.".strtolower($this->objectName).".php?accion=Listar\",";
		$this->string .="\n\t\t\t\tcreate : \"controller.".strtolower($this->objectName).".php?accion=Nuevo\",";
		$this->string .="\n\t\t\t\tupdate : \"controller.".strtolower($this->objectName).".php?accion=Guardar\",";
		$this->string .="\n\t\t\t\tdestroy: \"controller.".strtolower($this->objectName).".php?accion=Eliminar\"";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t});";
		$this->string .= "\n\t".$this->separator."\n\t";
		$this->string .="\n\t// Se dispara si un error de HTTP status es devuelto desde el sevidor.";		
		$this->string .="\n\t// Maneja cualquier excepcion que pueda ocurrir con la conexion y el http request.";
		$this->string .="\n\tproxy.getConnection().on('requestexception', requestFailed);";
		$this->string .= "\n\t".$this->separator."\n\t";
		$this->string .="\n\t/**";
		$this->string .="\n\t* Maneja la ocurrencia de algun error HTTP y verifica el status retornado desde el servidor. ";
		$this->string .="\n\t* Ver HTTP Status Code Definitions para mas detalles de los codigos de status HTTP.";
		$this->string .="\n\t* @param {Ext.data.Connection} connection El Objeto Conexion.";
		$this->string .="\n\t* @param {Object} response El Objeto XHR que contiene los datos de la respuesta. ";
		$this->string .="\n\t*		Ver http://www.w3.org/TR/XMLHttpRequest/ para mas detalles para acceder a los elementos";
		$this->string .="\n\t*		del response.";
		$this->string .="\n\t* @param {Object} options configura el objeto pasado al metodo.";
		$this->string .="\n\t*/";
		$this->string .="\n\tfunction requestFailed(connection, response, options) {";
		$this->string .="\n\t\tExt.MessageBox.alert('Error Message',";
		$this->string .="'Please contact support with the following: ' + ";
		$this->string .="'Status: ' + response.status + ";
		$this->string .="', Status Text: ' + response.statusText);";
		$this->string .="\n\t}";
		$this->string .= "\n\t".$this->separator."\n\t";
		$this->string .= $this->CreateWriterFunction();
		$this->string .= "\n\t".$this->separator."\n\t";
		$this->string .= "\n\t// El Objeto Store encapsula un cache de los registros en el lado del cliente de los cuales";
		$this->string .= "\n\t// proveen datos para los componentes tales como el GridPanel, el ComboBox, ";
		$this->string .= "\n\t// o el DataView.";
		$this->string .= "\n\t// Un Objeto Store usa la implementacion del DataProxy para acceder ";
		$this->string .= "\n\t// a un objecto de datos a menos que hagas el llamado del metodo loadData directamente y pases los datos.";
		$this->string .="\n\tvar store = new Ext.data.Store({";
        $this->string .="\n\t\tproxy: proxy,";
        $this->string .="\n\t\treader: reader,";
        $this->string .="\n\t\twriter: writer";
		$this->string .="\n\t});\n\t";				
		$this->string .="\n\t// Se dispara si ocurre una excepcion en la carga del store.";		
		$this->string .="\n\t// maneja cualquier excepcion que pueda ocurrir en el Proxy durante la carda de los datos.";
		$this->string .="\n\tstore.on('loadexception', loadFailed);";
		$this->string .= "\n\t".$this->separator."\n\t";		
		$this->string .="\n\t// Funcion que de dispara luego que los datos han sido cargados exitosamente.";
		$this->string .="\n\tstore.on('load', loadSuccessful);";
		$this->string .= "\n\t".$this->separator."\n\t";				
		$this->string .="\n\t// Usa un callback metodo para crear y cargar el grid.";
		$this->string .="\n\tstore.load({";
		$this->string .="\n\t\tparams: {";
		$this->string .="\n\t\t\tstart: 0,";
		$this->string .="\n\t\t\tlimit: 5";
		$this->string .="\n\t\t},";
		$this->string .="\n\t\tcallback: LoadAndShowGrid";
		$this->string .="\n\t});";
		$this->string .= "\n\t".$this->separator."\n\t";
		$this->string .="\n\tfunction loadFailed(proxy, options, response, error) {";
		$this->string .="\n\t\t// Decodes (parses) a JSON string to an object. If the JSON is invalid, ";
		$this->string .="\n\t\t// this function throws a SyntaxError.";
		$this->string .="\n\t\tvar object = Ext.util.JSON.decode(response.responseText);";
		$this->string .="\n\t\tvar errorMessage = 'Error loading data.';";
		$this->string .="\n\t\t// If the load from the server was successful and this method was called then";
		$this->string .="\n\t\t// the reader could not read the response.";
		$this->string .="\n\t\tif (object.success) {";
		$this->string .= "\n\t\t\tif (object.rows == 0) {";
		$this->string .= "\n\t\t\t\terrorMessage = 'No existen registros en la Base de Datos';\t";
		$this->string .= "\n\t\t\t\tvar grid = Ext.getCmp('grid');";
		$this->string .= "\n\t\t\t\tif (grid)";
		$this->string .= "\n\t\t\t\t{";
		$this->string .= "\n\t\t\t\t\t//grid.getStore().removeAll();";
		$this->string .= "\n\t\t\t\t\tgrid.getView().emptyText = 'No hay datos';";
		$this->string .= "\n\t\t\t\t\tgrid.getView().refresh();";
		$this->string .= "\n\t\t\t\t\tExt.getCmp('form').getForm().reset();";
		$this->string .= "\n\t\t\t\t\tExt.getCmp('form').btnEliminar.disable();";
		$this->string .= "\n\t\t\t\t\tDeshabilitar(store);";
		$this->string .= "\n\t\t\t\t}\t\t\t\t";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t\telse";
		$this->string .= "\n\t\t\t{";
		$this->string .= "\n\t\t\t\terrorMessage = 'The data returned from the server is in the wrong format. Please notify support with the following information: ' + response.responseText;";
		$this->string .= "\n\t\t\t}";
		$this->string .="\n\t\t} else {";
		$this->string .="\n\t\t\t// Error on the server side will include an error message in ";
		$this->string .="\n\t\t\t// the response.";
		$this->string .="\n\t\t\terrorMessage = object.message;";
		$this->string .="\n\t\t}";
		$this->string .="\n\t\tExt.MessageBox.alert('Error Message', errorMessage);";
		$this->string .="\n\t}";
		$this->string .= "\n\t".$this->separator."\n\t";
		$this->string .="\n\tfunction loadSuccessful(store, recordArray, options) {";
		$this->string .="\n\t\tvar count = store.getCount();";
		$this->string .="\n\t\tvar form = Ext.getCmp('form');";
		$this->string .="\n\t\tif (count===0){";
		$this->string .="\n\t\t\tExt.MessageBox.alert('Message',' No hay Resultados');";
		$this->string .="\n\t\t}";
		$this->string .="\n\t\telse";
		$this->string .="\n\t\t{";
		$this->string .="\n\t\t\tif (form) {";
		$this->string .="\n\t\t\t\tform.btnEliminar.enable();";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t}";
		$this->string .="\n\t}";		
	}

	function CreateWriterFunction()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Creamos el writer que nos permitira escribir los cambio en la base de datos.";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/";
        $this->string .= "\n\t\tvar writer = new Ext.data.JsonWriter({";
        $this->string .= "\n\t\t\t//encode: true,		 //<--- por defecto es true";
        $this->string .= "\n\t\t\twriteAllFields: true //<--- decide si se manda al servidor solamente los campos modificados o todos";
        $this->string .= "\n\t\t});";
	}
	// -------------------------------------------------------------
	function BeginObject()
	{
		$misc = new Misc(array());
		$this->string .= $this->CreatePreface();
	}
	
	function CreateFiltersFunction()
	{
		$this->string .= "\n\t/**";
		$this->string .= "\n\t*  Creamos los filtros para cada uno de los campos";
		$this->string .= "\n\t*  ";
		$this->string .= "\n\t*/";
		$this->string .= "\n";
		$this->string .= "\n\tvar filters = new Ext.ux.grid.GridFilters({";
		$this->string .= "\n\t\t// encode and local configuration options defined previously for easier reuse";
		$this->string .= "\n\t\tencode: false, // json encode the filter query";
		$this->string .= "\n\t\tlocal: false,  // defaults to false (remote filtering)";
		$this->string .= "\n\t\tfilters: [";
		$this->string .= "\n\t\t\t{";		
		$this->string .= "\n\t\t\t\ttype: 'numeric',";							
		$this->string .= "\n\t\t\t\tdataIndex: 'co_".rtrim(strtolower($this->objectName),s)."'";
		$this->string .= "\n\t\t\t},";	
		$x = 0;		
		foreach ($this->attributeList as $attribute)
		{			
			if ($this->typeList[$x] == "VARCHAR(255)")
			{
				$this->string .= "\n\t\t\t{";		
				$this->string .= "\n\t\t\t\ttype: 'string',";							
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "TEXT")
			{
				$this->string .= "\n\t\t{";		
				$this->string .= "\n\t\t\ttype: 'string',";							
				$this->string .= "\n\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t}";
			}	
			else if ($this->typeList[$x] == "DATE")
			{
				$this->string .= "\n\t\t\t{";		
				$this->string .= "\n\t\t\t\ttype: 'date',";							
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t\t}";
			}	
			else if ($this->typeList[$x] == "TINYINT")
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\ttype: 'boolean',";							
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t\t}";
			}
			else if ( ($this->typeList[$x] == "FLOAT")  || ($this->typeList[$x] == "INT") || ($this->typeList[$x] == "DOUBLE") )
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\ttype: 'numeric',";							
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t\t}";
			}
			else			
			{
				$this->string .= "\n\t\t\t{";		
				$this->string .= "\n\t\t\t\ttype: 'string',";							
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t\t}";
			}
			$x++;
			if ($x != $this->totalAttributes)
			{
				$this->string .=",";
			}			
		}
		$this->string .="\n\t\t]";
		$this->string .="\n\t});";
		$this->string .= "\n\t".$this->separator."\n\t";
	}

	// -------------------------------------------------------------
	function CreateLoadAndShowGridFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= $this->CreateComments("Carga y Muestra el Grid con los Datos","","form");
		$this->string .= "\tfunction LoadAndShowGrid(recordArray, options, success){";
		$this->string .= $this->CreateColumnModelFunction();
		$this->string .= $this->CreatePagingFunction();
		$this->string .= $this->CreateGridFunction();
		$this->string .= $this->CreateFormFunction();
		$this->string .= "\n\t$this->separator\n\t";		
		$this->string .= "\n\t\t// Renderizamos el formulario al cuerpo del HTML";
		$this->string .= "\n\t\tform.render(Ext.getBody());";
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\tgrid.on('rowdblclick', function(grid, rowIndex, e){";
		$this->string .= "\n\t\t\tHabilitar();";
		$this->string .= "\n\t\t\t//form.btnAgregar.disable();";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\t// El siguiente bloque es para forzar el renderizado de todos los tabs";
		$this->string .= "\n\t\t// por supuesto es para cuando se tiene mas de un tab";
		$this->string .= "\n\t\t// la Variable i debe de ser igual al numero de tabs";
		$this->string .= "\n\t\t/*";
		$this->string .= "\n\t\tfor (i=1; i>0; i--){";
		$this->string .= "\n\t\t\tExt.getCmp('TabContent').setActiveTab('tab'+i);";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\tExt.getCmp('TabContent').setActiveTab('tab1');\n\t\t*/";
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\tstore.on('load', function() {";
		$this->string .= "\n\t\t\tvar countRowsGrid = store.getCount();    //Cuenta la cantidad de registros en el grid";
		$this->string .= "\n\t\t\t// verificamos la cantidad de registros";
		$this->string .= "\n\t\t\tif (countRowsGrid>0) {";	
		$this->string .= "\n\t\t\t\t// forzamos la seleccion del primer registro";
		$this->string .= "\n\t\t\t\tgrid.getSelectionModel().selectFirstRow();";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t$this->separator\n\t";
        $this->string .= "\n\t\tstore.load({";
		$this->string .= "\n\t\t\tparams: {";
		$this->string .= "\n\t\t\t\tstart: 0,";
		$this->string .= "\n\t\t\t\tlimit: 5\t\t// limite de la paginación";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\tsetTimeout(function(){";
		$this->string .= "\n\t\t\tExt.get('loading').remove();";
		$this->string .= "\n\t\t\tExt.get('loading-mask').fadeOut({remove:true});	";
		$this->string .= "\n\t\t}, 250);";		
		$this->string .= "\n\t}\t//Fin funcion LoadAndShowGrid";
		$this->string .= "\n}\t//Fin funcion Cargar";
	}

	// -----------------------------------------------------------------
	function CreateColumnModelFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\tvar columns = new Ext.grid.ColumnModel([";
		$this->string .= "\n\t\t\t// Esta es un clase utilitaria que puede ser pasada al Ext.grid.ColumnModel ";
		$this->string .= "\n\t\t\t// como una configuracion de columnas que provee un enumaramiento automatico.";
		$this->string .= "\n\t\t\t// Aqui se renderizan todas las columnas con el fin de dejar a tu eleccion las que quieras mostrar.";
		$this->string .= "\n\t\t\tnew Ext.grid.RowNumberer(),";
		$x = 0;		
		foreach ($this->attributeList as $attribute)
		{			
			
			if ($x == 0)
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\tid: 'co_".rtrim(strtolower($this->objectName),s)."',";
				$this->string .= "\n\t\t\t\theader: 'Id',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\tsortable: true,";
				$this->string .= "\n\t\t\t\thidden: true,";
				$this->string .= "\n\t\t\t\tdataIndex: 'co_".rtrim(strtolower($this->objectName),s)."'";
				$this->string .= "\n\t\t\t},";
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\theader: '".ucfirst(strtolower($attribute))."',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\tsortable: true,";
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t\t}";
			}		
			else if ($this->typeList[$x] == "DATE")
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\theader: '".ucfirst(strtolower($attribute))."',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\tsortable: true,";
				$this->string .= "\n\t\t\t\t// Formato para Mostrar en el grid";
	            $this->string .= "\n\t\t\t\trenderer: Ext.util.Format.dateRenderer('d/m/Y'),";
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t\t}";
			}
			else	
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\theader: '".ucfirst(strtolower($attribute))."',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\tsortable: true,";
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .= "\n\t\t\t}";
			}
			$x++;
			if ($x != $this->totalAttributes)
			{
				$this->string .=",";
			}
		}
		$this->string .= "\n\t\t]);";
	}

	// -------------------------------------------------------------
	function CreatePagingFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\t// Agrega una barra de paginado al pie del grid.  ";
        $this->string .= "\n\t\tvar pagingToolbar = new Ext.PagingToolbar({";
        $this->string .= "\n\t\t\tpageSize: 5,  // Registros por pagina";
        $this->string .= "\n\t\t\tdisplayInfo: true,";
        $this->string .= "\n\t\t\tdisplayMsg: 'Un total de {2} registros encontrados. Actualmente mostrando {0} - {1}',";
        $this->string .= "\n\t\t\temptyMsg: 'No se encontraron registros',";
		$this->string .= "\n\t\t\tplugins: [filters],";
        $this->string .= "\n\t\t\tstore: store";
        $this->string .= "\n\t\t});";
	}

	// -------------------------------------------------------------
	function CreateLimpiarFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= $this->CreateComments("Limpiar los controles del Formulario",'',"void");
		$this->string .= "Limpiar = function ()\n{";	
		$this->string .="\n\tExt.getCmp('co_".rtrim(strtolower($this->objectName),s)."').reset();";			
		$x = 0;
		foreach ($this->attributeList as $attribute)
		{
			if ($this->renderList[$x] == "Ext.form.ComboBox")
			{
				$this->string .="\n\tExt.getCmp('".strtolower($attribute)."').clearValue();";					
			}
			else 
			{
				$this->string .="\n\tExt.getCmp('".strtolower($attribute)."').reset();";	
			}
			if ($x == 0)
			{
				//$focus	= "\n\tExt.getCmp('".strtolower($attribute)."').focus();";
			}			
			$x++;
		}
		//$this->string .= $focus;
		$this->string .= "\n\tHabilitar();";
		$this->string .= "\n}";
	}
	
	// -------------------------------------------------------------
	function CreateHabilitarFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= $this->CreateComments("Habilitar los controles del Formulario",'',"void");
		$this->string .= "Habilitar = function ()\n{";	
		$this->string .="\n\tExt.getCmp('co_".rtrim(strtolower($this->objectName),s)."').enable();";
		$x = 0;
		foreach ($this->attributeList as $attribute)
		{
			if ($this->renderList[$x] == "Ext.form.ComboBox")
			{
				$this->string .="\n\tExt.getCmp('".strtolower($attribute)."').enable();";					
			}
			else 
			{
				$this->string .="\n\tExt.getCmp('".strtolower($attribute)."').enable();";	
			}
			if ($x == 0)
			{
				$focus	= "\n\tExt.getCmp('".strtolower($attribute)."').focus();";
			}			
			$x++;
		}
		$this->string .="\n\tExt.getCmp('form').btnGuardar.enable();";	
		$this->string .="\n\tExt.getCmp('form').btnEliminar.disable();";	
		$this->string .="\n\tExt.getCmp('form').btnAgregar.disable();";	
		$this->string .= $focus;		
		$this->string .= "\n}";
	}
	
	// -------------------------------------------------------------
	function CreateDeshabilitarFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= $this->CreateComments("Deshabilitar los controles del Formulario",'',"void");
		$this->string .= "Deshabilitar = function (ds)\n{";	
		$this->string .="\n\tExt.getCmp('co_".rtrim(strtolower($this->objectName),s)."').disable();";			
		$x = 0;
		foreach ($this->attributeList as $attribute)
		{
			if ($this->renderList[$x] == "Ext.form.ComboBox")
			{
				$this->string .="\n\tExt.getCmp('".strtolower($attribute)."').disable();";					
			}
			else 
			{
				$this->string .="\n\tExt.getCmp('".strtolower($attribute)."').disable();";	
			}
			if ($x == 0)
			{
				$focus	= "\n\tExt.getCmp('".strtolower($attribute)."').focus();";
			}			
			$x++;
		}
		$this->string .= "\n\tExt.getCmp('form').btnGuardar.disable();";	
		$this->string .= "\n\tExt.getCmp('form').btnAgregar.enable();";	
		$this->string .= "\n\tvar countRowsGrid = ds.getTotalCount();    //Cuenta la cantidad de registros en el grid";
		$this->string .= "\n\t// verificamos la cantidad de registros";
		$this->string .= "\n\tif (countRowsGrid>0) {";	
		$this->string .= "\n\t\t// forzamos la seleccion del primer registro";
		$this->string .= "\n\t\tExt.getCmp('grid').getSelectionModel().selectFirstRow();";
		$this->string .= "\n\t}";
		$this->string .= "\n\telse {";	
		$this->string .= "\n\t\t// Deshabilitamos el boton de eliminar ya que no hay nada que eliminar";
		$this->string .= "\n\t\tExt.getCmp('form').btnEliminar.disable();";
		$this->string .= "\n\t}";
		$this->string .= "\n}";
	}

	// -------------------------------------------------------------
	function CreateGuardarFunction()
	{
		$this->string .= "\n/**";
		$this->string .= "\n * Este metodo es llamado cuando el usario hace click en el boton de guardar.";
		$this->string .= "\n * El metodo valida primero si el formulario es valido para luego enviarlo al";
		$this->string .= "\n * servidor para salvar la informacion.";
		$this->string .= "\n * Si el formulario no es valido se lo hace saber al usuario. ";
		$this->string .= "\n * Maneja las respuestas desde el servidor si fue exitoso o fallo.";
		$this->string .= "\n * @param {ds} El dataStore. ";
		$this->string .= "\n * @return void";
		$this->string .= "\n */";
		$this->string .= "\nGuardar = function (ds) {";
		$this->string .= "\n\tvar form = Ext.getCmp('form');";
		$this->string .= "\n\t// Check if the form is valid. ";
		$this->string .= "\n\tif (form.form.isValid()) {";
		$this->string .= "\n\t\t// If the form is valid, submit it.";
		$this->string .= "\n\t\t// To enable normal browser submission of the Ext Form contained in this ";
		$this->string .= "\n\t\t// FormPanel, override the submit method.";
		$this->string .= "\n\t\t// Important: Ajax server requests are asynchronous, and this ";
		$this->string .= "\n\t\t// call will return before the response has been recieved. ";
		$this->string .= "\n\t\t// Process any returned data in a callback function. ";
		$this->string .= "\n\t\tnew Ext.data.Connection().request({";
		$this->string .= "\n\t\t\turl:'controller.".strtolower($this->objectName).".php?accion=Guardar',";
		$this->string .= "\n\t\t\tmethod: 'POST',";
		$this->string .= "\n\t\t\twaitTitle: ' ',";
		$this->string .= "\n\t\t\twaitMsg: 'Guardando...',";
		$this->string .= "\n\t\t\tparams: {data: Ext.encode(form.getForm().getValues())},";
		$this->string .= "\n\t\t\tsuccess:requestSuccessful,";
		$this->string .= "\n\t\t\tfailure: requestFailed";
		$this->string .= "\n\t\t});                  ";		
		$this->string .= "\n\t\t// Recargar los registros del cache desde el proxy a traves del JsonReader configurado.";
		$this->string .= "\n\t\tds.reload();";
		$this->string .= "\n\t} else {";
		$this->string .= "\n\t\t// If the form is invalid.";
		$this->string .= "\n\t\tExt.MessageBox.alert('Error Message', 'Por favor corriga los errrores señalados.');";
		$this->string .= "\n\t}    ";
		$this->string .= "\n    ";
		$this->string .= "\n\t/**";
		$this->string .= "\n\t* Handle a successful connection and http request to the server.";
		$this->string .= "\n\t* The response from the application may still be unsuccessful so";
		$this->string .= "\n\t* that needs to be checked.";
		$this->string .= "\n\t* @param {Object} response The XMLHttpRequest object containing the ";
		$this->string .= "\n\t* \t\tresponse data. See http://www.w3.org/TR/XMLHttpRequest/ for ";
		$this->string .= "\n\t*\t\tdetails about accessing elements of the response.";
		$this->string .= "\n\t* @param {Object} options The parameter to the request call.";
		$this->string .= "\n\t*/ ";
		$this->string .= "\n\tfunction requestSuccessful(response, options) {\t";
		$this->string .= "\n\t";
		$this->string .= "\n\t\t// Decodes (parses) a JSON string to an object. If the JSON is invalid, ";
		$this->string .= "\n\t\t// this function throws a SyntaxError.";
		$this->string .= "\n\t\t// The response text from the server is:";
		$this->string .= "\n\t\t// {success: true, message: 'Person was deleted successfully.'}";
		$this->string .= "\n\t\t// The object will contain two variables: success and message.";
		$this->string .= "\n\t\tvar object = Ext.util.JSON.decode(response.responseText);";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\t// If the delete was successfully executed on server.";
		$this->string .= "\n\t\tif (object.success) {";
		$this->string .= "\n\t\t\tExt.MessageBox.alert('Confirm', object.message);";
		$this->string .= "\n\t\t} else {";
		$this->string .= "\n\t\t\tExt.MessageBox.alert('Error Message', object.message);";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t}";
		$this->string .= "\n    ";
		$this->string .= "\n\t/**";
		$this->string .= "\n\t* Handle an unsuccessful connection or http request to the server.";
		$this->string .= "\n\t* This has nothing to do with the response from the application.";
		$this->string .= "\n\t* @param {Object} response The XMLHttpRequest object containing the ";
		$this->string .= "\n\t* \t\tresponse data. See http://www.w3.org/TR/XMLHttpRequest/ for ";
		$this->string .= "\n\t*\t\tdetails about accessing elements of the response.";
		$this->string .= "\n\t* @param {Object} options The parameter to the request call.";
		$this->string .= "\n\t*/";
		$this->string .= "\n\tfunction requestFailed(response, options) {";
		$this->string .= "\n\t\t// Devolvio error la peticion hecha al servidor.";
		$this->string .= "\n\t\tExt.MessageBox.alert('Error Message', ";
		$this->string .= "\n\t\t\t'No se pudo borrar el Registro ');";
		$this->string .= "\n\t}";
		$this->string .= "\n}";
	}
	
	function CreateEliminarFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n/**";
		$this->string .= "\n* Elimina un registro seleccionado en el grid";
		$this->string .= "\n* @param {ds} El dataStore.";
		$this->string .= "\n* @param {grid} El grid donde se visualizan los datos del Store.";
		$this->string .= "\n* @return void";
		$this->string .= "\n*/";
		$this->string .= "\n";
		$this->string .= "\nEliminar = function(ds, grid) {";
		$this->string .= "\n";
		$this->string .= "\n\t// Devuelve el registro seleccionado en el grid";
		$this->string .= "\n\tvar selectedItems = grid.selModel.getSelections();";
		$this->string .= "\n";
		$this->string .= "\n\t// Chequea si hay algun registro seleccionado";
		$this->string .= "\n\tif (selectedItems.length > 0) {";
		$this->string .= "\n\t";
		$this->string .= "\n\t\tExt.MessageBox.confirm('Mensaje', ";
		$this->string .= "\n\t\t\t'Esta seguro de eliminar el registro?', ";
		$this->string .= "\n\t\t\tfunction(btn) {";
		$this->string .= "\n\t\t\t     ";
		$this->string .= "\n\t\t\tif (btn == 'yes') {";
		$this->string .= "\n\t\t\t\t";
		$this->string .= "\n\t\t\t\t// Send a HTTP request to a remote server.";
		$this->string .= "\n\t\t\t\t// Important: Ajax server requests are asynchronous, and this ";
		$this->string .= "\n\t\t\t\t// call will return before the response has been recieved. ";
		$this->string .= "\n\t\t\t\t// Process any returned data in a callback function. ";
		$this->string .= "\n\t\t\t\tnew Ext.data.Connection().request({";
		$this->string .= "\n\t\t\t\t\turl: 'controller.".strtolower($this->objectName).".php?accion=Eliminar',";
		$this->string .= "\n\t\t\t\t\t// Obtenemos el id del item seleccionado";
		$this->string .= "\n\t\t\t\t\tparams: {data: selectedItems[0].id},";
		$this->string .= "\n\t\t\t\t\tfailure: requestFailed,";
		$this->string .= "\n\t\t\t\t\tsuccess: requestSuccessful";
		$this->string .= "\n\t\t\t\t});";
		$this->string .= "\n\t\t\t\t";
		$this->string .= "\n\t\t\t\t// Recargar los registros del cache desde el proxy a traves del JsonReader configurado.";
		$this->string .= "\n\t\t\t\tds.reload();";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t}";
		$this->string .= "\n\telse";
		$this->string .= "\n\t{";
		$this->string .= "\n\t\tExt.MessageBox.alert('Error', ";
		$this->string .= "\n\t\t'Para ejecutar la accion de Eliminar, tiene que seleccionar un registro en el grid.'";
		$this->string .= "\n\t\t);";
		$this->string .= "\n\t}";
		$this->string .= "\n    ";
		$this->string .= "\n\t/**";
		$this->string .= "\n\t* Handle a successful connection and http request to the server.";
		$this->string .= "\n\t* The response from the application may still be unsuccessful so";
		$this->string .= "\n\t* that needs to be checked.";
		$this->string .= "\n\t* @param {Object} response The XMLHttpRequest object containing the ";
		$this->string .= "\n\t* \t\tresponse data. See http://www.w3.org/TR/XMLHttpRequest/ for ";
		$this->string .= "\n\t*\t\tdetails about accessing elements of the response.";
		$this->string .= "\n\t* @param {Object} options The parameter to the request call.";
		$this->string .= "\n\t*/ ";
		$this->string .= "\n\tfunction requestSuccessful(response, options) {\t";
		$this->string .= "\n\t";
		$this->string .= "\n\t\t// Decodes (parses) a JSON string to an object. If the JSON is invalid, ";
		$this->string .= "\n\t\t// this function throws a SyntaxError.";
		$this->string .= "\n\t\t// The response text from the server is:";
		$this->string .= "\n\t\t// {success: true, message: 'Person was deleted successfully.'}";
		$this->string .= "\n\t\t// The object will contain two variables: success and message.";
		$this->string .= "\n\t\tvar object = Ext.util.JSON.decode(response.responseText);";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\t// If the delete was successfully executed on server.";
		$this->string .= "\n\t\tif (object.success) {";
		$this->string .= "\n\t\t\tExt.MessageBox.alert('Confirm', object.message);";
		$this->string .= "\n\t\t} else {";
		$this->string .= "\n\t\t\tExt.MessageBox.alert('Error Message', object.message);";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t}";
		$this->string .= "\n    ";
		$this->string .= "\n\t/**";
		$this->string .= "\n\t* Handle an unsuccessful connection or http request to the server.";
		$this->string .= "\n\t* This has nothing to do with the response from the application.";
		$this->string .= "\n\t* @param {Object} response The XMLHttpRequest object containing the ";
		$this->string .= "\n\t* \t\tresponse data. See http://www.w3.org/TR/XMLHttpRequest/ for ";
		$this->string .= "\n\t*\t\tdetails about accessing elements of the response.";
		$this->string .= "\n\t* @param {Object} options The parameter to the request call.";
		$this->string .= "\n\t*/";
		$this->string .= "\n\tfunction requestFailed(response, options) {";
		$this->string .= "\n\t\t// Devolvio error la peticion hecha al servidor.";
		$this->string .= "\n\t\tExt.MessageBox.alert('Error Message', ";
		$this->string .= "\n\t\t\t'No se pudo borrar el Registro ');";
		$this->string .= "\n\t}";
		$this->string .= "\n}";
	}
	// Relations {Many-Many} functions

	// -------------------------------------------------------------
	function CreateGridFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\t// Crea el grid.  ";
		$this->string .= "\n\t\tvar grid = new Ext.grid.GridPanel({";
		$this->string .= "\n\t\t\tid   : 'grid',";
		$this->string .= "\n\t\t\tstore: store,";
		$this->string .= "\n\t\t\tcm: columns,";
		$this->string .= "\n\t\t\tsm: new Ext.grid.RowSelectionModel({";
		$this->string .= "\n\t\t\t\tsingleSelect: true,";
		$this->string .= "\n\t\t\t\tlisteners: {";
		$this->string .= "\n\t\t\t\t\trowselect: function (sm, row, rec) {";
		$this->string .= "\n\t\t\t\t\t\tExt.getCmp('form').getForm().loadRecord(rec);									";
		$this->string .= "\n\t\t\t\t\t}";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t}),";
		$this->string .= "\n\t\t\tviewConfig: {";
		$this->string .= "\n\t\t\t\tforceFit: true,";
		$this->string .= "\n\t\t\t\temptyText:'No existen registros'";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\t//autoExpandColumn: 'nb_estudiante',";
		$this->string .= "\n\t\t\tplugins: [filters],";
		$this->string .= "\n\t\t\theight: 350,";
		$this->string .= "\n\t\t\tborder: true,";
		$this->string .= "\n\t\t\tlisteners: {";
		$this->string .= "\n\t\t\t\trender: function (g) {";
		$this->string .= "\n\t\t\t\t\tg.getSelectionModel().selectRow(0);";
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\tdelay: 10 // Allow rows to be rendered.";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";

	}

	//-------------------------------------------------------------
	function CreateFormFunction()
	{
		$this->string .= "\n\t".$this->separator."\n\t";
		$this->string .= "\n\t\t// Creamos el formulario";
		$this->string .= "\n\t\tvar form = new Ext.form.FormPanel({";
		$this->string .= "\n\t\t\tid: 'form',";
		$this->string .= "\n\t\t\tframe: true,";
		$this->string .= "\n\t\t\tlabelAlign: 'left',";
		$this->string .= "\n\t\t\ttitle: '".ucfirst(strtolower($this->objectName))."',";
		$this->string .= "\n\t\t\t//bodyStyle: 'padding:5px',";
		$this->string .= "\n\t\t\t//width: 750,";
		$this->string .= "\n\t\t\tautoHeight: true,";
		$this->string .= "\n\t\t\tlayout: 'column',";
		$this->string .= "\n\t\t\t// Especifica que los items ahora seran ordenados en columnas";
		$this->string .= "\n\t\t\titems: [{";
		$this->string .= "\n\t\t\t\tcolumnWidth: 0.4,";
		$this->string .= "\n\t\t\t\tlayout: 'fit',						";
		$this->string .= "\n\t\t\t\tbodyStyle: 'padding:0 10px 0 0px',";
		$this->string .= "\n\t\t\t\titems: grid";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\t{";
		$this->string .= "\n\t\t\t\tcolumnWidth: 0.6,";
		$this->string .= "\n\t\t\t\tbodyStyle: Ext.isIE ? 'padding:0 0 5px 15px;' : 'padding:10px 15px;',";
		$this->string .= "\n\t\t\t\txtype: 'tabpanel',";
		$this->string .= "\n\t\t\t\tid   : 'tabContent',";
		$this->string .= "\n\t\t\t\tplain: true,";
		$this->string .= "\n\t\t\t\tactiveTab: 0,";
		$this->string .= "\n\t\t\t\tforceLayout:true,";
		$this->string .= "\n\t\t\t\theight: 400,";
		$this->string .= "\n\t\t\t\titems: [{";
		$this->string .= "\n\t\t\t\t\ttitle: 'Datos',";
		$this->string .= "\n\t\t\t\t\tid   : 'tab1',";
		$this->string .= "\n\t\t\t\t\tlayout: 'column',";
		$this->string .= "\n\t\t\t\t\tlabelAlign: 'top',";
		$this->string .= "\n\t\t\t\t\tlabelWidth: 60,";
		$this->string .= "\n\t\t\t\t\tdefaults: {";
		$this->string .= "\n\t\t\t\t\t\twidth: 230";
		$this->string .= "\n\t\t\t\t\t},";
		$this->CreateGetColumnItems();
		$this->string .= "\n\t\t\t\t\t\t/*,";
		$this->string .= "\n\t\t\t\t\t\t{";
		$this->string .= "\n\t\t\t\t\t\t\tcolumnWidth: 1,";
		$this->string .= "\n\t\t\t\t\t\t\tlayout: 'form',";
		$this->string .= "\n\t\t\t\t\t\t\tlabelWidth: 46,";
		$this->string .= "\n\t\t\t\t\t\t\titems: [{";
		$this->string .= "\n\t\t\t\t\t\t\t\txtype: 'textarea',";
		$this->string .= "\n\t\t\t\t\t\t\t\tname: 'dir_estudiante',";
		$this->string .= "\n\t\t\t\t\t\t\t\tid: 'dir_estudiante',";
		$this->string .= "\n\t\t\t\t\t\t\t\tfieldLabel: 'Direccion',";
		$this->string .= "\n\t\t\t\t\t\t\t\twidth: '96%'";
		$this->string .= "\n\t\t\t\t\t\t\t}]";
		$this->string .= "\n\t\t\t\t\t\t}*/";
		$this->string .= "\n\t\t\t\t\t]";
		$this->string .= "\n\t\t\t\t}],";
		$this->string .= "\n\t\t\t\tbuttons: [{";
		$this->string .= "\n\t\t\t\t\tid: 'btnAgregar',";
		$this->string .= "\n\t\t\t\t\ttext: 'Agregar',";
		$this->string .= "\n\t\t\t\t\tdisabled: false,";
		$this->string .= "\n\t\t\t\t\ticonCls: 'add-icon',";
		$this->string .= "\n\t\t\t\t\tref: '../../btnAgregar',";
		$this->string .= "\n\t\t\t\t\thandler: Limpiar";
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\t{";
		$this->string .= "\n\t\t\t\t\tid: 'btnGuardar',";
		$this->string .= "\n\t\t\t\t\ttext: 'Guardar',";
		$this->string .= "\n\t\t\t\t\tdisabled: true,";
		$this->string .= "\n\t\t\t\t\ticonCls: 'save-icon',";
		$this->string .= "\n\t\t\t\t\tref: '../../btnGuardar',";
		$this->string .= "\n\t\t\t\t\thandler: function () {";
		$this->string .= "\n\t\t\t\t\t\t// Guarda el registro Actual";
		$this->string .= "\n\t\t\t\t\t\tnew Guardar(store);";
		$this->string .= "\n\t\t\t\t\t\tDeshabilitar(store);";
		$this->string .= "\n\t\t\t\t\t}";
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\t{";
		$this->string .= "\n\t\t\t\t\tid: 'btnEliminar',";
		$this->string .= "\n\t\t\t\t\ttext: 'Eliminar',";
		$this->string .= "\n\t\t\t\t\ticonCls: 'delete-icon',";
		$this->string .= "\n\t\t\t\t\tref: '../../btnEliminar',";
		$this->string .= "\n\t\t\t\t\thandler: function () {";
		$this->string .= "\n\t\t\t\t\t\t// Elimina el registro Actual";
		$this->string .= "\n\t\t\t\t\t\tnew Eliminar(store,grid);";
		$this->string .= "\n\t\t\t\t\t}";
		$this->string .= "\n\t\t\t\t}]";
		$this->string .= "\n\t\t\t}],";
		$this->string .= "\n\t\t\tbbar: pagingToolbar";
		$this->string .= "\n\t\t\t/*";
		$this->string .= "\n\t\t\ttbar: [";
		$this->string .= "\n\t\t\t'Buscar: ', ' ',";
		$this->string .= "\n\t\t\t],";
		$this->string .= "\n\t\t\t*/";
		$this->string .= "\n\t\t});\t//Fin creacion del formulario";
		$this->string .= "\n\t".$this->separator."\n\t";
		/*$this->string .= "\n\t\t// Agregamos algunos botones utiles para los filtros";
		$this->string .= "\n\t\tform.getBottomToolbar().add([";
		$this->string .= "\n\t\t\t'->',";
		$this->string .= "\n\t\t\t{";
		$this->string .= "\n\t\t\t\ttext: 'All Filter Data',";
		$this->string .= "\n\t\t\t\ttooltip: 'Get Filter Data for Grid',";
		$this->string .= "\n\t\t\t\thandler: function () {";
		$this->string .= "\n\t\t\t\t\tvar data = Ext.encode(grid.filters.getFilterData());";
		$this->string .= "\n\t\t\t\t\tExt.Msg.alert('All Filter Data',data);";
		$this->string .= "\n\t\t\t\t} ";
		$this->string .= "\n\t\t\t},{";
		$this->string .= "\n\t\t\t\ttext: 'Clear Filter Data',";
		$this->string .= "\n\t\t\t\thandler: function () {";
		$this->string .= "\n\t\t\t\t\tgrid.filters.clearFilters();";
		$this->string .= "\n\t\t\t\t} ";
		$this->string .= "\n\t\t\t},{";
		$this->string .= "\n\t\t\t\ttext: 'Reconfigure Grid',";
		$this->string .= "\n\t\t\t\thandler: function () {";
		$this->string .= "\n\t\t\t\t\tgrid.reconfigure(dsEstudiantes, createColModel(6));";
		$this->string .= "\n\t\t\t\t} ";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t]);";*/
		$this->string .= "\n\t".$this->separator."\n\t";
		$this->string .= "\n\t\tform.on('render',function(form){";
		$this->string .= "\n\t\t\tvar store = Ext.getCmp('grid').getStore();";
		$this->string .= "\n\t\t\tvar count = store.getCount(); \t\t ";
		$this->string .= "\n\t\t\tif (count===0){";
		$this->string .= "\n\t\t\t\tExt.MessageBox.alert('Message',' No hay Resultados');";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t\telse";
		$this->string .= "\n\t\t\t{";
		$this->string .= "\n\t\t\t\tExt.getCmp('form').btnEliminar.enable();";
		$this->string .= "\n\t\t\t\t//Ext.MessageBox.alert('Message',' Count = ' + count);";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		
	}

	// -------------------------------------------------------------
	function CreateGetColumnItems()
	{
		$itemsColumna1;
		$itemsColumna2;
		$campo;
		$count = count($this->arrayControls);
		$x = 0;		
		$this->string .= $this->separator;
		$this->string .= "//".$count." Campos distribuidos en 2 Columnas;";
		$this->string .= $this->separator;
		foreach ($this->arrayControls as $control)
		{			
			if (($x % 2) != 0)
			{ // es par 
				$itemsColumna1 .= $control;
				if (($x != $count - 1) && ($x != $count - 2))
				{
					$itemsColumna1 .= ",";
				}
			}
			else
			{ //es impar
				$itemsColumna2 .= $control;
				if (($x != $count - 1) && ($x != $count - 2))
				{
					$itemsColumna2 .= ",";
				}
			} 			
			$x++;
		}		
		$this->string .= "\n\t\t			items: [{";
		$this->string .= "\n\t\t					columnWidth: .5,";
		$this->string .= "\n\t\t					layout: 'form',";
		$this->string .= "\n\t\t					labelWidth: 50,";
		$this->string .= "\n\t\t					border: false,";
		$this->string .= "\n\t\t					items: [".$itemsColumna1."]";
		$this->string .= "\n\t\t				},";
		$this->string .= "\n\t\t				{";
		$this->string .= "\n\t\t					columnWidth: .5,";
		$this->string .= "\n\t\t					layout: 'form',";
		$this->string .= "\n\t\t					labelWidth: 50,";
		$this->string .= "\n\t\t					border: false,";
		$this->string .= "\n\t\t					items: [".$itemsColumna2."]";
		$this->string .= "\n\t\t				}";
	}

}
?>

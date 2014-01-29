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
	var $extjsVersion = '31';
	var $arrayControls = array();

	// -------------------------------------------------------------
	function ObjectExtjs($objectName, $attributeList = '', $typeList ='', $renderList ='', $pdoDriver = '', $language = 'php5.1', $extjsVersion = '31')
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
		$this->string .= $this->CreateDataReaderFunction();		
	}
	
	function CreateInsertarFunction()
	{
		$this->string .="\n\t\t/**";
		$this->string .="\n\t\t*  Insertar";
		$this->string .="\n\t\t*";
		$this->string .="\n\t\t*/";	
		$this->string .="\n\t\tfunction Insertar(btn, ev) {";
		$this->string .="\n\t\t\tvar u = new grid.store.recordType({";
		$x = 0;		
		foreach ($this->attributeList as $attribute)
		{			
			$this->string .= "\n\t\t\t\t".strtolower($attribute).":''";
			$x++;
			if ($x != $this->totalAttributes)
			{
				$this->string .=",";
			}			
		}
		$this->string .="\n\t\t\t});";
		$this->string .="\n\t\t\teditor.stopEditing();";
		$this->string .="\n\t\t\tgrid.store.insert(0, u);";
		$this->string .="\n\t\t\tgrid.getView().refresh();";
		$this->string .="\n\t\t\tgrid.getSelectionModel().selectRow(0);";
		$this->string .="\n\t\t\teditor.startEditing(0,1);";
		$this->string .="\n\t\t\teditor.values = {};	";
		$this->string .="\n\t\t}";	
	}
	
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
			else if ( ($this->typeList[$x] == "FLOAT")  || ($this->typeList[$x] == "DOUBLE") )
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
		$this->string .= "\n\t\t".$this->separator."\n\t";
	}
	
	function CreateFiltersFunction()
	{
		$this->string .="\n\t\t/**";
		$this->string .="\n\t\t*  Creamos los filtros para cada uno de los campos";
		$this->string .="\n\t\t*";
		$this->string .="\n\t\t*/";	
		$this->string .="\n\t\tvar filters = new Ext.ux.grid.GridFilters({";
		$this->string .="\n\t\t\tencode: false,\t\t\t// encode and local configuration options defined previously for easier reuse";
		$this->string .="\n\t\t\tlocal: false,\t\t\t// defaults to false (remote filtering";
		$this->string .="\n\t\t\tfilters:[";	
		$this->string .="\n\t\t\t{";
		$this->string .="\n\t\t\t\ttype: 'numeric',";							
		$this->string .="\n\t\t\t\tdataIndex: 'co_".rtrim(strtolower($this->objectName),s)."'";
		$this->string .="\n\t\t\t},";	
		$x = 0;		
		foreach ($this->attributeList as $attribute)
		{			
			if ($this->typeList[$x] == "VARCHAR(255)")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\ttype: 'string',";							
				$this->string .="\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "TEXT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\ttype: 'string',";							
				$this->string .="\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}	
			else if ($this->typeList[$x] == "DATE")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\ttype: 'date',";							
				$this->string .="\n\t\t\t\tdataIndex: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "TINYINT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\ttype: 'boolean',";							
				$this->string .="\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}
			else if ( ($this->typeList[$x] == "FLOAT")  || ($this->typeList[$x] == "INT") || ($this->typeList[$x] == "DOUBLE") )
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\ttype: 'numeric',";							
				$this->string .="\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
				$this->string .="\n\t\t\t}";
			}
			else			
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\ttype: 'string',";							
				$this->string .="\n\t\t\t\tdataIndex: '".strtolower($attribute)."'";
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
		$this->string .= "\n\t\t".$this->separator."\n\t";
	}
	
	// -------------------------------------------------------------
	function CreateProxyFunction()
	{
		$this->string .= "\n\t".$this->separator."\n\t";
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
	}
	
	// -------------------------------------------------------------
	function BeginObject()
	{
		$misc = new Misc(array());
		$this->string .= $this->CreatePreface();
		$this->string .= "\nExt.ns(\"com.pogextjs.".$this->objectName."\");";
		$this->string .= "\n\t$this->separator";
		$this->string .= "\ncom.pogextjs.".$this->objectName." = { ";
		$this->string .= "\n\tinit: function () {";
		$this->string .= $this->CreateInstanceMessage();
		$this->string .= $this->CreateProxyFunction();
		$this->string .= "\n\t$this->separator";
		$this->string .= "\n\t\tvar formatoFecha = Ext.util.Format.dateRenderer('d-m-Y');\n";
		$this->string .= $this->CreateJsonReaderFunction();		
		$this->string .= $this->CreateFiltersFunction();		
		$this->string .= $this->CreateWriterFunction();		
		$this->string .= $this->CreateStoreFunction();			
		$this->string .= $this->CreateDataProxyListener();			
		$this->string .= "\n\t$this->separator";		
		$this->string .= "\n\t\t//	Configuramos el selection model para que aparezca un checkbox en una columna del grid";
        $this->string .= "\n\t\tvar sm = new Ext.grid.CheckboxSelectionModel();";
		$this->string .= $this->CreateEditorFunction();	   	   			   		
		$this->string .= "\n\t\tvar ContadorRegistros = new Ext.Toolbar.TextItem('Registros:');";	   		
		$this->string .= $this->CreatePagingToolbarFunction();		
		$this->string .= $this->CreateGridFunction();
		$this->string .= $this->CreateWindowFunction();	
		$this->string .= "\n\t$this->separator";	
		$this->string .= "\n\t\tgrid.getSelectionModel().on('selectionchange', function (sm) {";
        $this->string .= "\n\t\t\tgrid.getTopToolbar().removeBtn.setDisabled(sm.getCount() < 1);";
        $this->string .= "\n\t\t});";
        $this->string .= "\n\t$this->separator";
        $this->string .= $this->CreateInsertarFunction();	
        $this->string .= "\n\t$this->separator";
        $this->string .= $this->CreateEliminarFunction();	
        $this->string .= $this->CreateLoadSuccessfulFunction();	
        $this->string .= $this->CreateLoadFailedFunction();	        
        $this->string .= $this->SetTimeOut();	        
		$this->string .= "\n\t}";
		$this->string .= "\n}";
		$this->string .= "\nExt.onReady(com.pogextjs.".$this->objectName.".init, com.pogextjs.".$this->objectName.");";
		
	}
	
	function CreatePreface()
	{
		$this->string .= "\n/*!";
		$this->string .= "\n* Ext JS Library 3.1 - Row Editor CRUD";
		$this->string .= "\n* Copyright(c) 2006-2009 Ext JS, LLC";
		$this->string .= "\n* licensing@extjs.com";
		$this->string .= "\n* http://www.extjs.com/license";
		$this->string .= "\n*";
		$this->string .= "\n* <b>".$this->objectName."</b> Clase ExtJs integrada con Metodos CRUD.";
		$this->string .= "\n* @author ".$GLOBALS['configuration']['author'];
		$this->string .= "\n* @version POG ".$GLOBALS['configuration']['versionNumber'].$GLOBALS['configuration']['revisionNumber']." / ".strtoupper($this->language);
		$this->string .= "\n* @fecha  ".date('l jS \of F Y h:i:s A');
		$this->string .= "\n* @copyright ".$GLOBALS['configuration']['copyright'];
		$this->string .= "\n* @link http://localhost/pog_extjs/?language=".$this->language."&wrapper=pdo&pdoDriver=".$this->pdoDriver."&extjsVersion=".$this->extjsVersion."&objectName=".urlencode($this->objectName)."&attributeList=".urlencode(var_export($this->attributeList, true))."&typeList=".urlencode(urlencode(var_export($this->typeList, true)))."&renderList=".urlencode(var_export($this->renderList, true));
		$this->string .= "\n*/\n";
		$this->string .= "\nExt.SSL_SECURE_URL  = 'images/s.gif';";
		$this->string .= "\nExt.BLANK_IMAGE_URL = 'images/s.gif';";
		$this->string .= "\n\n";
	}

	
	function CreateInstanceMessage()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Application instance for showing user-feedback messages.";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/";
        $this->string .= "\n\t\tvar App = new Ext.App({});";
	}
	
	function CreateEditorFunction()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Usamos el RowEditor para editar y le configuramos el mensaje de salvar";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/";
        $this->string .= "\n\t\tvar editor = new Ext.ux.grid.RowEditor({";
        $this->string .= "\n\t\t\tsaveText: 'Guardar'";
        $this->string .= "\n\t\t});";
        $this->string .= "\n\t\t// El cancelar la edicion verificamos si el registro esta marcado como Dirty o es un registro fantasma ";
		$this->string .= "\n\t\t// para eliminarlo";
		$this->string .= "\n\t\teditor.on('canceledit',";
		$this->string .= "\n\t\t\tfunction(roweditor, forced) {";
		$this->string .= "\n\t\t\t\teditor.stopEditing();";
		$this->string .= "\n\t\t\t\tvar s = grid.getSelectionModel().getSelections();";
		$this->string .= "\n\t\t\t\tfor (var i = 0; i < s.length; i++) {";
		$this->string .= "\n\t\t\t\t\tr = s[i];";
		$this->string .= "\n\t\t\t\t\tif (r.phantom==true)";
		$this->string .= "\n\t\t\t\t\t{";
		$this->string .= "\n\t\t\t\t\t\tgrid.getStore().remove(r);";
		$this->string .= "\n\t\t\t\t\t}";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t);";		
		/*
		$this->string .= "\n\t\t// Debido no se si a un Bug con el RowEditor cuando el formato de fecha es (d-m-Y), que despues de ";
		$this->string .= "\n\t\t// editar no coloca la fecha en el grid cuando el campo es del tipo date, si lo quitamos ";
		$this->string .= "\n\t\t// lo hace bien pero entonces formatea la fecha mal desde la base de datos ya que en mysql el formato es Y-m-d";
		$this->string .= "\n\t\t// Entonces forzamos la recarga del store para poder visualizar el registro completo con la fecha.";
		$this->string .= "\n\t\teditor.on('afteredit',function() {";
		$this->string .= "\n\t\t\tstore.reload({}, true);";
		$this->string .= "\n\t\t\tExt.fly(ContadorRegistros.getEl()).update('Registros: '+store.getCount());";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t);";        
		*/
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
	
	function CreateEliminarFunction()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Eliminar.";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/"; 
        $this->string .= "\n\t\tfunction Eliminar() {";              
        $this->string .= "\n\t\t\tvar rec = grid.getSelectionModel().getSelected();";
        $this->string .= "\n\t\t\tif (!rec) {";
        $this->string .= "\n\t\t\t\treturn false;";
        $this->string .= "\n\t\t\t}";
        $this->string .= "\n\t\t\tgrid.store.remove(rec);";
        $this->string .= "\n\t\t\tExt.fly(ContadorRegistros.getEl()).update('Registros: '+grid.store.getCount());";
        $this->string .= "\n\t\t}";
	}
	
	function CreateLoadSuccessfulFunction()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Carga satisfactoria del grid.";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/"; 
        $this->string .= "\n\t\tfunction loadSuccessful (store, recordArray, options) {";              
        $this->string .= "\n\t\t\tvar count = store.getCount();";
        $this->string .= "\n\t\t\tif (count === 0) {";
        $this->string .= "\n\t\t\t\tApp.setAlert(false, ' No hay Resultados');";
        $this->string .= "\n\t\t\t\tExt.fly(ContadorRegistros.getEl()).update('No hay Resultados');";
        $this->string .= "\n\t\t\t\tExt.fly(ContadorRegistros.getEl()).update('No hay Resultados');";
        $this->string .= "\n\t\t\t}";
        $this->string .= "\n\t\t\tExt.fly(ContadorRegistros.getEl()).update('Registros: '+count);";
        $this->string .= "\n\t\t}";
	}
	
	function CreateLoadFailedFunction()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Ocurrió un error al cargar el grid.";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/"; 
        $this->string .= "\n\t\tfunction loadFailed (proxy, options, response, error) {";              
        $this->string .= "\n\t\t\t// Decodes (parses) a JSON string to an object. If the JSON is invalid,";
        $this->string .= "\n\t\t\t// this function throws a SyntaxError.";
        $this->string .= "\n\t\t\tvar object = Ext.util.JSON.decode(response.responseText);";
        $this->string .= "\n\t\t\tvar errorMessage = 'Error loading data.';";
        $this->string .= "\n\t\t\t// If the load from the server was successful and this method was called then";
        $this->string .= "\n\t\t\t// the reader could not read the response.";
        $this->string .= "\n\t\t\tif (object.success) {";
        $this->string .= "\n\t\t\t\tif (object.rows == 0) {";
        $this->string .= "\n\t\t\t\t\terrorMessage = 'No existen registros en la Base de Datos';";
        $this->string .= "\n\t\t\t\t\tvar grid = Ext.getCmp('grid');";
        $this->string .= "\n\t\t\t\t\tif (grid) {";
        $this->string .= "\n\t\t\t\t\t\t//grid.getGridEl().disabled= true;";
        $this->string .= "\n\t\t\t\t\t\t//grid.disableSelection = true;";
        $this->string .= "\n\t\t\t\t\t\tgrid.getView().emptyText = 'No hay datos';";
        $this->string .= "\n\t\t\t\t\t\tgrid.getView().refresh();";
        $this->string .= "\n\t\t\t\t\t}";
        $this->string .= "\n\t\t\t\t} else {";
		$this->string .= "\n\t\t\t\terrorMessage = 'The data returned from the server is in the wrong format. Please notify support with the following information: ' + response.responseText;";
		$this->string .= "\n\t\t\t\t}";
        $this->string .= "\n\t\t\t}else {";
		$this->string .= "\n\t\t\t\t// Error on the server side will include an error message in ";
		$this->string .= "\n\t\t\t\t// the response.";
		$this->string .= "\n\t\t\t\t\terrorMessage = object.message;";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t\tApp.setAlert(false, errorMessage);";
		$this->string .= "\n\t\t\t//Ext.MessageBox.alert('Error Message', errorMessage);";
        $this->string .= "\n\t\t}";
	}
	
	function CreateWindowFunction()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Creamos la ventana.";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/";
        $this->string .= "\n\t\tvar win = new Ext.Window({";
        $this->string .= "\n\t\t\tid: 'win',";
        $this->string .= "\n\t\t\ttitle: 'CRUD " . strtoupper($this->objectName) . " Generado por POG_ExtJS - Plugins: RowEditor & Filtering Example',";
        $this->string .= "\n\t\t\tlayout: 'fit',";
        $this->string .= "\n\t\t\twidth: 900,";
        $this->string .= "\n\t\t\theight: 300,";
        $this->string .= "\n\t\t\titems: [grid]";
        $this->string .= "\n\t\t});";
        $this->string .= "\n\t\twin.show();";
	}
	
	function CreatePagingToolbarFunction()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Agrega una barra de paginado al pie del grid.";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/";
        $this->string .= "\n\t\tvar pagingToolbar = new Ext.PagingToolbar({";
        $this->string .= "\n\t\t\t//pageSize: 5,  // Registros por pagina";
        $this->string .= "\n\t\t\thideLabel : true,";
        $this->string .= "\n\t\t\tdisplayInfo: true,";
        $this->string .= "\n\t\t\t//displayMsg: 'Un total de {2} registros encontrados. Actualmente mostrando {0} - {1}',";
        $this->string .= "\n\t\t\tdisplayMsg: 'Un total de {2} registros',";
        $this->string .= "\n\t\t\temptyMsg: 'No se encontraron registros',";
        $this->string .= "\n\t\t\t//plugins: [filters],";
        $this->string .= "\n\t\t\tstore: store";
        $this->string .= "\n\t\t});";
	}
	
	function CreateDataProxyListener()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t////";
        $this->string .= "\n\t\t// ***New*** centralized listening of DataProxy events \"beforewrite\", \"write\" and \"writeexception\"";
        $this->string .= "\n\t\t// upon Ext.data.DataProxy class.  This is handy for centralizing user-feedback messaging into one place rather than";
        $this->string .= "\n\t\t// attaching listenrs to EACH Store.";
        $this->string .= "\n\t\t//";
        $this->string .= "\n\t\t// Listen to all DataProxy beforewrite events";
        $this->string .= "\n\t\t//";
        $this->string .= "\n\t\t//Ext.data.DataProxy.addListener('beforewrite', function(proxy, action) {";
        $this->string .= "\n\t\t//	App.setAlert(App.STATUS_NOTICE, \"Before \" + action);";
        $this->string .= "\n\t\t//	//store.reload();";
        $this->string .= "\n\t\t//});";
        $this->string .= "\n\t\t////";
        $this->string .= "\n\t\t// all write events";
        $this->string .= "\n\t\t//";
        $this->string .= "\n\t\tExt.data.DataProxy.addListener('write', function (proxy, action, result, res, rs) {";
        $this->string .= "\n\t\t\t//App.setAlert(true, action + ':' + res.message);";
        $this->string .= "\n\t\t\tApp.setAlert(true, res.message);";
        $this->string .= "\n\t\t});";
        $this->string .= "\n\t\t////";
        $this->string .= "\n\t\t// all exception events";
        $this->string .= "\n\t\t//";
        $this->string .= "\n\t\t//Ext.data.DataProxy.addListener('exception', function(proxy, type, action, options, res) {";
        $this->string .= "\n\t\t\t//	App.setAlert(false, \"No se han arrojado datos para la Consulta. Accion: \" + action);";
        $this->string .= "\n\t\t//});";
	}
	
	function CreateStoreFunction()
	{
		$this->string .= "\n\t\t$this->separator";
		$this->string .= "\n\t\t/**";
        $this->string .= "\n\t\t*  Creamos el store y le asignamos el proxy, reader y el writer.";
        $this->string .= "\n\t\t*  ";
        $this->string .= "\n\t\t*/";
        $this->string .= "\n\t\tvar store = new Ext.data.Store({";
        $this->string .= "\n\t\t\tid: 'co_".rtrim(strtolower($this->objectName),s)."',";
        $this->string .= "\n\t\t\tproxy: proxy,";
        $this->string .= "\n\t\t\treader: reader,";
        $this->string .= "\n\t\t\twriter: writer";
        $this->string .= "\n\t\t});\n";
        $this->string .= "\n\t\t// Se dispara si ocurre una excepcion en la carga del store.";
        $this->string .= "\n\t\t// maneja cualquier excepcion que pueda ocurrir en el Proxy durante la carda de los datos.";
        $this->string .= "\n\t\tstore.on('loadexception', loadFailed);\n";
        $this->string .= "\n\t\t// Funcion que de dispara luego que los datos han sido cargados exitosamente.";
        $this->string .= "\n\t\tstore.on('load', loadSuccessful);\n";
		$this->string .= "\n\t\t// Cargamos el grid inmediatamente";
        $this->string .= "\n\t\tstore.load();";
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
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\tds".ucfirst(rtrim(strtolower($this->objectName),s)).".on('load', function() {";
		$this->string .= "\n\t\t\tvar countRowsGrid = ds".ucfirst(rtrim(strtolower($this->objectName),s)).".getCount();    //Cuenta la cantidad de registros en el grid";
		$this->string .= "\n\t\t\t// verificamos la cantidad de registros";
		$this->string .= "\n\t\t\tif (countRowsGrid>0) {";	
		$this->string .= "\n\t\t\t\t// forzamos la seleccion del primer registro";
		$this->string .= "\n\t\t\t\tgrid.getSelectionModel().selectFirstRow();";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t$this->separator\n\t";
        $this->string .= "\n\t\tds".ucfirst(rtrim(strtolower($this->objectName),s)).".load({";
		$this->string .= "\n\t\t\tparams: {";
		$this->string .= "\n\t\t\t\tstart: 0,";
		$this->string .= "\n\t\t\t\tlimit: 5\t\t// limite de la paginación";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";		
		$this->string .= "\n\t}\t//Fin funcion LoadAndShowGrid";
		$this->string .= $this->CreateLayout();
		$this->string .= "\n}\t//Fin funcion Cargar";
	}
	
	function CreateColumnModelFunction()
	{
		$this->string .= "\n\t\t\tcolumns:[";
		$this->string .= "\n\t\t\tnew Ext.grid.RowNumberer(),";
		$this->string .= "\n\t\t\t{";
		$this->string .= "\n\t\t\t\tid: 'co_".rtrim(strtolower($this->objectName),s)."',";
		$this->string .= "\n\t\t\t\theader: 'Id',";
		$this->string .= "\n\t\t\t\twidth: 30,";
		$this->string .= "\n\t\t\t\tsortable: true,";
		$this->string .= "\n\t\t\t\thidden: true,";
		$this->string .= "\n\t\t\t\tdataIndex: 'co_".rtrim(strtolower($this->objectName),s)."'";
		$this->string .= "\n\t\t\t},";
		$x = 0;		
		foreach ($this->attributeList as $attribute)
		{			
			
			if ($this->typeList[$x] == "VARCHAR(255)")
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\theader: '".ucfirst(strtolower($attribute))."',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\tsortable: true,";
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."',";
				$this->string .= "\n\t\t\t\t\teditor: {";
				$this->string .= "\n\t\t\t\t\t\txtype: 'textfield',";
				$this->string .= "\n\t\t\t\t\t\tallowBlank  :true,";
				$this->string .= "\n\t\t\t\t\t}";
				$this->string .= "\n\t\t\t}";
			}		
			else if ($this->typeList[$x] == "DATE")
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\txtype: 'datecolumn',";
				$this->string .= "\n\t\t\t\theader: '".ucfirst(strtolower($attribute))."',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\tsortable: true,";
				$this->string .= "\n\t\t\t\t// Formato para Mostrar en el grid";
	            $this->string .= "\n\t\t\t\tformat: 'd/m/Y',";
	            $this->string .= "\n\t\t\t\trenderer: formatoFecha,";
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\t\teditor: {";
				$this->string .="\n\t\t\t\t\t\txtype: 'xdatefield',";
				$this->string .="\n\t\t\t\t\t\tallowBlank  :true,";
				$this->string .="\n\t\t\t\t\t\tformat: 'd/m/Y',";
				$this->string .="\n\t\t\t\t\t\t//minValue: '01/01/2006',";
				$this->string .="\n\t\t\t\t\t\t//minText: 'Can\'t have a start date before the company existed!',";
				$this->string .="\n\t\t\t\t\t\t//maxValue: (new Date()).format('m/d/Y'),";
				$this->string .="\n\t\t\t\t\t\tsubmitFormat:'Y-m-d'";
				$this->string .="\n\t\t\t\t\t}";
				$this->string .= "\n\t\t\t}";
			}
			else if ( ($this->typeList[$x] == "FLOAT") || ($this->typeList[$x] == "INT") || ($this->typeList[$x] == "DOUBLE") )
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\txtype: 'numbercolumn',";
				$this->string .= "\n\t\t\t\theader: '".ucfirst(strtolower($attribute))."',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\tsortable: true,";
				$this->string .= "\n\t\t\t\talign: 'right',";
				$this->string .= "\n\t\t\t\t// Formato para Mostrar en el grid";
	            $this->string .= "\n\t\t\t\tformat: '$0,0.00',";
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\t\teditor: {";
				$this->string .="\n\t\t\t\t\t\txtype: 'numberfield',";
				$this->string .="\n\t\t\t\t\t\tallowBlank  :true,";
				$this->string .="\n\t\t\t\t\t\t//minValue: '1',";
				$this->string .="\n\t\t\t\t\t\t//manText: 'Can\'t u have a lot of money!',";
				$this->string .="\n\t\t\t\t\t\t//maxValue: '1000'";
				$this->string .="\n\t\t\t\t\t}";
				$this->string .= "\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "TINYINT")
			{			
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\txtype: 'booleancolumn',";
				$this->string .= "\n\t\t\t\theader: '".ucfirst(strtolower($attribute))."',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\t// Formato para Mostrar en el grid";
	            $this->string .= "\n\t\t\t\ttrueText: 'Yes',";
	            $this->string .= "\n\t\t\t\tfalseText: 'No',";
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\t\teditor: {";
				$this->string .="\n\t\t\t\t\t\txtype: 'xcheckbox',";
				$this->string .="\n\t\t\t\t\t}";
				$this->string .= "\n\t\t\t}";
			}
			else	
			{
				$this->string .= "\n\t\t\t{";
				$this->string .= "\n\t\t\t\theader: '".ucfirst(strtolower($attribute))."',";
				$this->string .= "\n\t\t\t\twidth: 30,";
				$this->string .= "\n\t\t\t\tsortable: true,";
				$this->string .= "\n\t\t\t\tdataIndex: '".strtolower($attribute)."',";
				$this->string .= "\n\t\t\t\t\teditor: {";
				$this->string .= "\n\t\t\t\t\t\txtype: 'textfield',";
				$this->string .= "\n\t\t\t\t\t\tallowBlank  :true,";
				$this->string .= "\n\t\t\t\t\t}";
				$this->string .= "\n\t\t\t}";
			}
			$x++;
			if ($x != $this->totalAttributes)
			{
				$this->string .=",";
			}
		}
		$this->string .= "\n\t\t\t],";
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
        $this->string .= "\n\t\t\tstore: ds".ucfirst($this->objectName)."";
        $this->string .= "\n\t\t});";
	}
	
	// -------------------------------------------------------------
	function CreateGridFunction()
	{
		$this->string .= "\n\t$this->separator\n\t";
		$this->string .= "\n\t\t// Crea el grid.  ";
		$this->string .= "\n\t\tvar grid = new Ext.grid.GridPanel({";
		$this->string .= "\n\t\t\tid   : 'grid',";
		$this->string .= "\n\t\t\tstore: store,";
		$this->string .= "\n\t\t\tplugins: [editor, filters],";
		$this->string .= "\n\t\t\tviewConfig: {";
		$this->string .= "\n\t\t\t\tforceFit: true,";
		$this->string .= "\n\t\t\t\temptyText: 'No existen registros'";
		$this->string .= "\n\t\t\t},";
		$this->string .="\n\t\t\ttbar: [{";
		$this->string .="\n\t\t\t\ticonCls: 'save-icon',";
		$this->string .="\n\t\t\t\ttext: 'Agregar',";
		$this->string .="\n\t\t\t\thandler: Insertar";
		$this->string .="\n\t\t\t},{";
		$this->string .="\n\t\t\t\tref: 'removeBtn',";
		$this->string .="\n\t\t\t\ticonCls: 'delete-icon',";
		$this->string .="\n\t\t\t\ttext: 'Eliminar',";
		$this->string .="\n\t\t\t\tdisabled: true,";
		$this->string .="\n\t\t\t\thandler: Eliminar";
		$this->string .="\n\t\t\t}],";
		$this->string .="\n\t\t\tbbar: [ContadorRegistros,'->',";
		$this->string .="\n\t\t\t{";
		$this->string .="\n\t\t\t\ttext: 'Quitar Todos los Filtros',";
		$this->string .="\n\t\t\t\thandler: function () {";
		$this->string .="\n\t\t\t\t\tgrid.filters.clearFilters();";
		$this->string .="\n\t\t\t\t}";
		$this->string .="\n\t\t\t}],";
		$this->string .= $this->CreateColumnModelFunction();
		$this->string .= "\n\t\t\tsm: sm,";
        $this->string .= "\n\t\t\tborder: false,";
        $this->string .= "\n\t\t\tstripeRows: true";
		$this->string .= "\n\t\t});";
	}
	
	// -------------------------------------------------------------
	function SetTimeOut()
	{
		$this->string .= "\n\t\tsetTimeout(function(){";
		$this->string .= "\n\t\t\tExt.get('loading').remove();";
		$this->string .= "\n\t\t\tExt.get('loading-mask').fadeOut({remove:true});	";
		$this->string .= "\n\t\t}, 250);";	
	}
	
	function Create()
	{
		$this->string .="\n\t// hideous function to generate employee data";
		$this->string .="\n\tvar genData = function(){";
		$this->string .="\n\t\tvar data = [];";
		$this->string .="\n\t\tvar s = new Date(2007, 0, 1);";
		$this->string .="\n\t\tvar now = new Date(), i = -1;";
		$this->string .="\n\t\twhile(s.getTime() < now.getTime()){";
		$this->string .="\n\t\t\tvar ecount = Ext.ux.getRandomInt(0, 3);";
		$this->string .="\n\t\t\tfor(var i = 0; i < ecount; i++){";
		$this->string .="\n\t\t\t\tvar name = Ext.ux.generateName();";
		$this->string .="\n\t\t\t\tdata.push({";
		$this->string .="\n\t\t\t\t\tstart : s.clearTime(true).add(Date.DAY, Ext.ux.getRandomInt(0, 27)),";
		$this->string .="\n\t\t\t\t\tname : name,";
		$this->string .="\n\t\t\t\t\temail: name.toLowerCase().replace(' ', '.') + '@exttest.com',";
		$this->string .="\n\t\t\t\t\tactive: true,";
		$this->string .="\n\t\t\t\t\tsalary: Math.floor(Ext.ux.getRandomInt(35000, 85000)/1000)*1000";
		$this->string .="\n\t\t\t\t});";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t\ts = s.add(Date.MONTH, 1);";
		$this->string .="\n\t\t}";
		$this->string .="\n\t\treturn data;";
		$this->string .="\n\t}";
		$this->string .="\n";

		$this->string .="\n\tvar store = new Ext.data.GroupingStore({";
		$this->string .="\n\t\treader: new Ext.data.JsonReader({fields: Employee}),";
		$this->string .="\n\t\tdata: genData(),";
		$this->string .="\n\t\tsortInfo: {field: 'start', direction: 'ASC'}";
		$this->string .="\n\t});";
		$this->string .="\n";
		$this->string .="\n\t var editor = new Ext.ux.grid.RowEditor({";
		$this->string .="\n\t\tsaveText: 'Update'";
		$this->string .="\n\t});";
		$this->string .="\n";
		$this->string .="\n\t var grid = new Ext.grid.GridPanel({";
		$this->string .="\n\t\tstore: store,";
		$this->string .="\n\t\twidth: 600,";
		$this->string .="\n\t\tregion:'center',";
		$this->string .="\n\t\tmargins: '0 5 5 5',";
		$this->string .="\n\t\tautoExpandColumn: 'name',";
		$this->string .="\n\t\tplugins: [editor],";
		$this->string .="\n\t\tview: new Ext.grid.GroupingView({";
		$this->string .="\n\t\t\tmarkDirty: false";
		$this->string .="\n\t\t}),";
		$this->string .="\n\t\ttbar: [{";
		$this->string .="\n\t\t\ticonCls: 'icon-user-add',";
		$this->string .="\n\t\t\ttext: 'Add Employee',";
		$this->string .="\n\t\t\thandler: function(){";
		$this->string .="\n\t\t\t\tvar e = new Employee({";
		$this->string .="\n\t\t\t\t\tname: 'New Guy',";
		$this->string .="\n\t\t\t\t\temail: 'new@exttest.com',";
		$this->string .="\n\t\t\t\t\tstart: (new Date()).clearTime(),";
		$this->string .="\n\t\t\t\t\tsalary: 50000,";
		$this->string .="\n\t\t\t\t\tactive: true";
		$this->string .="\n\t\t\t\t});";
		$this->string .="\n\t\t\t\teditor.stopEditing();";
		$this->string .="\n\t\t\t\tstore.insert(0, e);";
		$this->string .="\n\t\t\t\tgrid.getView().refresh();";
		$this->string .="\n\t\t\t\tgrid.getSelectionModel().selectRow(0);";
		$this->string .="\n\t\t\t\teditor.startEditing(0);";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t},{";
		$this->string .="\n\t\t\tref: 'removeBtn',";
		$this->string .="\n\t\t\ticonCls: 'icon-user-delete',";
		$this->string .="\n\t\t\ttext: 'Remove Employee',";
		$this->string .="\n\t\t\tdisabled: true,";
		$this->string .="\n\t\t\thandler: function(){";
		$this->string .="\n\t\t\t\teditor.stopEditing();";
		$this->string .="\n\t\t\t\tvar s = grid.getSelectionModel().getSelections();";
		$this->string .="\n\t\t\t\tfor(var i = 0, r; r = s[i]; i++){";
		$this->string .="\n\t\t\t\t\tstore.remove(r);";
		$this->string .="\n\t\t\t\t}";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t}],";
		$this->string .="\n";
		$this->string .="\n\t\t columns: [";
		$this->string .="\n\t\tnew Ext.grid.RowNumberer(),";
		$this->string .="\n\t\t{";
		$this->string .="\n\t\t\tid: 'name',";
		$this->string .="\n\t\t\theader: 'First Name',";
		$this->string .="\n\t\t\tdataIndex: 'name',";
		$this->string .="\n\t\t\twidth: 220,";
		$this->string .="\n\t\t\tsortable: true,";
		$this->string .="\n\t\t\teditor: {";
		$this->string .="\n\t\t\t\txtype: 'textfield',";
		$this->string .="\n\t\t\t\tallowBlank  :true";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t},{";
		$this->string .="\n\t\t\theader: 'Email',";
		$this->string .="\n\t\t\tdataIndex: 'email',";
		$this->string .="\n\t\t\twidth: 150,";
		$this->string .="\n\t\t\tsortable: true,";
		$this->string .="\n\t\t\teditor: {";
		$this->string .="\n\t\t\t\txtype: 'textfield',";
		$this->string .="\n\t\t\t\tallowBlank  :true,";
		$this->string .="\n\t\t\t\tvtype: 'email'";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t},{";
		$this->string .="\n\t\t\txtype: 'datecolumn',";
		$this->string .="\n\t\t\theader: 'Start Date',";
		$this->string .="\n\t\t\tdataIndex: 'start',";
		$this->string .="\n\t\t\tformat: 'm/d/Y',";
		$this->string .="\n\t\t\twidth: 100,";
		$this->string .="\n\t\t\tsortable: true,";
		$this->string .="\n\t\t\tgroupRenderer: Ext.util.Format.dateRenderer('M y'),";
		$this->string .="\n\t\t\teditor: {";
		$this->string .="\n\t\t\t\txtype: 'datefield',";
		$this->string .="\n\t\t\t\tallowBlank  :true,";
		$this->string .="\n\t\t\t\tminValue: '01/01/2006',";
		$this->string .="\n\t\t\t\tminText: 'Can\'t have a start date before the company existed!',";
		$this->string .="\n\t\t\t\tmaxValue: (new Date()).format('m/d/Y')";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t},{";
		$this->string .="\n\t\t\txtype: 'numbercolumn',";
		$this->string .="\n\t\t\theader: 'Salary',";
		$this->string .="\n\t\t\tdataIndex: 'salary',";
		$this->string .="\n\t\t\tformat: '$0,0.00',";
		$this->string .="\n\t\t\twidth: 100,";
		$this->string .="\n\t\t\tsortable: true,";
		$this->string .="\n\t\t\teditor: {";
		$this->string .="\n\t\t\t\txtype: 'numberfield',";
		$this->string .="\n\t\t\t\tallowBlank  :true,";
		$this->string .="\n\t\t\t\tminValue: 1,";
		$this->string .="\n\t\t\t\tmaxValue: 150000";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t},{";
		$this->string .="\n\t\t\txtype: 'booleancolumn',";
		$this->string .="\n\t\t\theader: 'Active',";
		$this->string .="\n\t\t\tdataIndex: 'active',";
		$this->string .="\n\t\t\talign: 'center',";
		$this->string .="\n\t\t\twidth: 50,";
		$this->string .="\n\t\t\ttrueText: 'Yes',";
		$this->string .="\n\t\t\tfalseText: 'No',";
		$this->string .="\n\t\t\teditor: {";
		$this->string .="\n\t\t\t\txtype: 'checkbox'";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t}]";
		$this->string .="\n\t});";
		$this->string .="\n";
		$this->string .="\n\t var cstore = new Ext.data.JsonStore({";
		$this->string .="\n\t\tfields:['month', 'employees', 'salary'],";
		$this->string .="\n\t\tdata:[],";
		$this->string .="\n\t\trefreshData: function(){";
		$this->string .="\n\t\t\tvar o = {}, data = [];";
		$this->string .="\n\t\t\tvar s = new Date(2007, 0, 1);";
		$this->string .="\n\t\t\tvar now = new Date(), i = -1;";
		$this->string .="\n\t\t\twhile(s.getTime() < now.getTime()){";
		$this->string .="\n\t\t\t\tvar m = {";
		$this->string .="\n\t\t\t\t\tmonth: s.format('M y'),";
		$this->string .="\n\t\t\t\t\temployees: 0,";
		$this->string .="\n\t\t\t\t\tsalary: 0,";
		$this->string .="\n\t\t\t\t\tindex: ++i";
		$this->string .="\n\t\t\t\t}";
		$this->string .="\n\t\t\t\tdata.push(m);";
		$this->string .="\n\t\t\t\to[m.month] = m;";
		$this->string .="\n\t\t\t\ts = s.add(Date.MONTH, 1);";
		$this->string .="\n\t\t\t}";
		$this->string .="\n\t\t\tstore.each(function(r){";
		$this->string .="\n\t\t\t\tvar m = o[r.data.start.format('M y')];";
		$this->string .="\n\t\t\t\tfor(var i = m.index, mo; mo = data[i]; i++){";
		$this->string .="\n\t\t\t\t\tmo.employees += 10000;";
		$this->string .="\n\t\t\t\t\tmo.salary += r.data.salary;";
		$this->string .="\n\t\t\t\t}";
		$this->string .="\n\t\t\t});";
		$this->string .="\n\t\t\tthis.loadData(data);";
		$this->string .="\n\t\t}";
		$this->string .="\n\t});";
		$this->string .="\n\tcstore.refreshData();";
		$this->string .="\n\tstore.on('add', cstore.refreshData, cstore);";
		$this->string .="\n\tstore.on('remove', cstore.refreshData, cstore);";
		$this->string .="\n\tstore.on('update', cstore.refreshData, cstore);";
		$this->string .="\n";
		$this->string .="\n\t var chart = new Ext.Panel({";
		$this->string .="\n\t\twidth:600,";
		$this->string .="\n\t\theight:200,";
		$this->string .="\n\t\tlayout:'fit',";
		$this->string .="\n\t\tmargins: '5 5 0',";
		$this->string .="\n\t\tregion: 'north',";
		$this->string .="\n\t\tsplit: true,";
		$this->string .="\n\t\tminHeight: 100,";
		$this->string .="\n\t\tmaxHeight: 500,";
		$this->string .="\n";
		$this->string .="\n\t\t items: {";
		$this->string .="\n\t\t\txtype: 'columnchart',";
		$this->string .="\n\t\t\tstore: cstore,";
		$this->string .="\n\t\t\turl:'../../resources/charts.swf',";
		$this->string .="\n\t\t\txField: 'month',";
		$this->string .="\n\t\t\tyAxis: new Ext.chart.NumericAxis({";
		$this->string .="\n\t\t\t\tdisplayName: 'Employees',";
		$this->string .="\n\t\t\t\tlabelRenderer : Ext.util.Format.numberRenderer('0,0')";
		$this->string .="\n\t\t\t}),";
		$this->string .="\n\t\t\ttipRenderer : function(chart, record, index, series){";
		$this->string .="\n\t\t\t\tif(series.yField == 'salary'){";
		$this->string .="\n\t\t\t\t\treturn Ext.util.Format.number(record.data.salary, '$0,0') + ' total salary in ' + record.data.month;";
		$this->string .="\n\t\t\t\t}else{";
		$this->string .="\n\t\t\t\t\treturn Ext.util.Format.number(Math.floor(record.data.employees/10000), '0,0') + ' total employees in ' + record.data.month;";
		$this->string .="\n\t\t\t\t}";
		$this->string .="\n\t\t\t},";
		$this->string .="\n";
		$this->string .="\n\t\t\t // style chart so it looks pretty";
		$this->string .="\n\t\t\tchartStyle: {";
		$this->string .="\n\t\t\t\tpadding: 10,";
		$this->string .="\n\t\t\t\tanimationEnabled: true,";
		$this->string .="\n\t\t\t\tfont: {";
		$this->string .="\n\t\t\t\t\tname: 'Tahoma',";
		$this->string .="\n\t\t\t\t\tcolor: 0x444444,";
		$this->string .="\n\t\t\t\t\tsize: 11";
		$this->string .="\n\t\t\t\t},";
		$this->string .="\n\t\t\t\tdataTip: {";
		$this->string .="\n\t\t\t\t\tpadding: 5,";
		$this->string .="\n\t\t\t\t\tborder: {";
		$this->string .="\n\t\t\t\t\t\tcolor: 0x99bbe8,";
		$this->string .="\n\t\t\t\t\t\tsize:1";
		$this->string .="\n\t\t\t\t\t},";
		$this->string .="\n\t\t\t\t\tbackground: {";
		$this->string .="\n\t\t\t\t\t\tcolor: 0xDAE7F6,";
		$this->string .="\n\t\t\t\t\t\talpha: .9";
		$this->string .="\n\t\t\t\t\t},";
		$this->string .="\n\t\t\t\t\tfont: {";
		$this->string .="\n\t\t\t\t\t\tname: 'Tahoma',";
		$this->string .="\n\t\t\t\t\t\tcolor: 0x15428B,";
		$this->string .="\n\t\t\t\t\t\tsize: 10,";
		$this->string .="\n\t\t\t\t\t\tbold: true";
		$this->string .="\n\t\t\t\t\t}";
		$this->string .="\n\t\t\t\t},";
		$this->string .="\n\t\t\t\txAxis: {";
		$this->string .="\n\t\t\t\t\tcolor: 0x69aBc8,";
		$this->string .="\n\t\t\t\t\tmajorTicks: {color: 0x69aBc8, length: 4},";
		$this->string .="\n\t\t\t\t\tminorTicks: {color: 0x69aBc8, length: 2},";
		$this->string .="\n\t\t\t\t\tmajorGridLines: {size: 1, color: 0xeeeeee}";
		$this->string .="\n\t\t\t\t},";
		$this->string .="\n\t\t\t\tyAxis: {";
		$this->string .="\n\t\t\t\t\tcolor: 0x69aBc8,";
		$this->string .="\n\t\t\t\t\tmajorTicks: {color: 0x69aBc8, length: 4},";
		$this->string .="\n\t\t\t\t\tminorTicks: {color: 0x69aBc8, length: 2},";
		$this->string .="\n\t\t\t\t\tmajorGridLines: {size: 1, color: 0xdfe8f6}";
		$this->string .="\n\t\t\t\t}";
		$this->string .="\n\t\t\t},";
		$this->string .="\n\t\t\tseries: [{";
		$this->string .="\n\t\t\t\ttype: 'column',";
		$this->string .="\n\t\t\t\tdisplayName: 'Salary',";
		$this->string .="\n\t\t\t\tyField: 'salary',";
		$this->string .="\n\t\t\t\tstyle: {";
		$this->string .="\n\t\t\t\t\timage:'../chart/bar.gif',";
		$this->string .="\n\t\t\t\t\tmode: 'stretch',";
		$this->string .="\n\t\t\t\t\tcolor:0x99BBE8";
		$this->string .="\n\t\t\t\t}";
		$this->string .="\n\t\t\t}]";
		$this->string .="\n\t\t}";
		$this->string .="\n\t});";
		$this->string .="\n";

		$this->string .="\n\tvar layout = new Ext.Panel({";
		$this->string .="\n\t\ttitle: 'Employee Salary by Month',";
		$this->string .="\n\t\tlayout: 'border',";
		$this->string .="\n\t\tlayoutConfig: {";
		$this->string .="\n\t\t\tcolumns: 1";
		$this->string .="\n\t\t},";
		$this->string .="\n\t\twidth:600,";
		$this->string .="\n\t\theight: 600,";
		$this->string .="\n\t\titems: [chart, grid]";
		$this->string .="\n\t});";
		$this->string .="\n\tlayout.render(Ext.getBody());";
		$this->string .="\n";
		$this->string .="\n\t grid.getSelectionModel().on('selectionchange', function(sm){";
		$this->string .="\n\t\tgrid.removeBtn.setDisabled(sm.getCount() < 1);";
		$this->string .="\n\t});";
		$this->string .="\n});";
		
	}
	function CreateLayout()
	{
		$this->string .="\n\tvar layout = new Ext.Panel({";
		$this->string .="\n\t\ttitle: 'Employee Salary by Month',";
		$this->string .="\n\t\tlayout: 'border',";
		$this->string .="\n\t\tlayoutConfig: {";
		$this->string .="\n\t\t\tcolumns: 1";
		$this->string .="\n\t\t},";
		$this->string .="\n\t\twidth:600,";
		$this->string .="\n\t\theight: 600,";
		$this->string .="\n\t\titems: [grid]";
		$this->string .="\n\t});";
		$this->string .="\n\tlayout.render(Ext.getBody());";
		$this->string .="\n";
		$this->string .="\n\t grid.getSelectionModel().on('selectionchange', function(sm){";
		$this->string .="\n\t\tgrid.removeBtn.setDisabled(sm.getCount() < 1);";
		$this->string .="\n\t});";
		
	}	// -------------------------------------------------------------
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
}
?>

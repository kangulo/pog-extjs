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
	var $extjsVersion = '42';
	var $arrayControls = array();

	function ObjectExtjs($objectName, $attributeList = '', $typeList ='', $renderList ='', $pdoDriver = '', $language = 'php5.1', $extjsVersion = '42')
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
	
	function BeginObject()
	{
		$misc = new Misc(array());
		//$this->string .= $this->CreatePreface();
		$this->string .= $this->CreateGridFunction();
		$this->string .= $this->CreateFormFunction();
		//$this->string .= $this->CreateMainKedruxFunction();
		$this->string .= $this->CreateMainFunction();
	}

	function CreateGridFunction()
	{
		$this->string .= "\n/**";
		$this->string .= "\n * ".$GLOBALS['configuration']['app']."";
		$this->string .= "\n *";
		$this->string .= "\n * Clase generada con POG+EXTJS - ExtJS 4.2 integrada con Metodos CRUD.";
		$this->string .= "\n *";
		$this->string .= "\n * \$Id:			".$this->objectName."_grid.php $";
		$this->string .= "\n * @package		".$GLOBALS['configuration']['app']."";
		$this->string .= "\n * @author		".$GLOBALS['configuration']['author'];
		$this->string .= "\n * @copyright	© 2013, POG+EXTJS - Kayak Innovations, C.A.";
		$this->string .= "\n * @version		v1.0";
		$this->string .= "\n * @created		".date('l jS \of F Y h:i:s A');
		$this->string .= "\n * @link		http://localhost/pog+extjs/?language=".$this->language."&wrapper=pdo&pdoDriver=".$this->pdoDriver."&extjsVersion=".$this->extjsVersion."&objectName=".urlencode($this->objectName)."&attributeList=".urlencode(var_export($this->attributeList, true))."&typeList=".urlencode(urlencode(var_export($this->typeList, true)))."&renderList=".urlencode(urlencode(var_export($this->renderList, true)));
		$this->string .= "\n *";
		$this->string .= "\n * This program is free software; you can redistribute it and/or modify";
		$this->string .= "\n * it under the terms of the GNU General Public License v3 (2007)";
		$this->string .= "\n * as published by the Free Software Foundation.";
		$this->string .= "\n */";
		$this->string .= "\n\n";
		$this->string .= "Ext.namespace(\"".$GLOBALS['configuration']['app'].".".$this->objectName."\");";
		$this->string .= "\n\n";
		$this->string .= "\nExt.define('".$GLOBALS['configuration']['app'].".".$this->objectName.".Grid', {";
		$this->string .= "\n\textend: 'Ext.grid.Panel',";
		$this->string .= "\n";
		$this->string .= "\n\tconstructor: function (config) {";
		$this->string .= "\n\t\tconfig = config || {};";
		$this->string .= "\n\t\tconfig.border = false;";
		$this->string .= "\n\t\tconfig.height = 380;";
		$this->string .= "\n\t\tconfig.viewConfig = {";
		$this->string .= "\n\t\t\temptyText: 'No hay Registros'";
		$this->string .= "\n\t\t};";
		$this->string .= "\n";
		$this->string .= $this->CreateGridModelFunction();
		$this->string .= "\n"; 
		$this->string .= $this->CreateGridStoreFunction();
		$this->string .= "\n"; 
		$this->string .= "\n\t\tconfig.store = Store_".$this->objectName.";";
		$this->string .= "\n"; 
		$this->string .= $this->CreateGridColumnModelFunction();
		$this->string .= "\n"; 
		$this->string .= "\n\t\tconfig.txtSearch = Ext.create('Ext.form.TextField', {";
		$this->string .= "\n\t\t\twidth: 300,";
		$this->string .= "\n\t\t\temptyText: '".$this->attributeList[0]."',";
		$this->string .= "\n\t\t\tenableKeyEvents: true,";
		$this->string .= "\n\t\t\tlisteners:{";
		$this->string .= "\n\t\t\t\tscope: this,";
		$this->string .= "\n\t\t\t\tkeypress : function (el, e) {";
		$this->string .= "\n\t\t\t\t\tif (e.getKey() == e.ENTER) {";
		$this->string .= "\n\t\t\t\t\t\tthis.onSearch();";
		$this->string .= "\n\t\t\t\t\t}";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		$this->string .= "\n";
		$this->string .= "\n\t\tconfig.tbar = [";
		$this->string .= "\n\t\t\t'Buscar:',";
		$this->string .= "\n\t\t\tconfig.txtSearch, ";
		$this->string .= "\n\t\t\t'->', ";
		$this->string .= "\n\t\t\t{ ";
		$this->string .= "\n\t\t\t\ttext: 'Refrescar',";
		$this->string .= "\n\t\t\t\ticonCls: 'icon-refresh',";
		$this->string .= "\n\t\t\t\thandler: this.onSearch,";
		$this->string .= "\n\t\t\t\tscope: this";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t];";
		$this->string .= "\n";  
		$this->string .= "\n\t\tconfig.listeners = {";
		$this->string .= "\n\t\t\tselectionchange: this.onSelectionChange ";
		$this->string .= "\n\t\t}; ";
		$this->string .= "\n";
		$this->string .= "\n\t\tthis.addEvents({";
		$this->string .= "\n\t\t\t'load_form_data': true";
		$this->string .= "\n\t\t});";
		$this->string .= "\n";
		$this->string .= "\n\t\tthis.callParent([config]);";
		$this->string .= "\n\t},";
		$this->string .= "\n"; 
		$this->string .= $this->CreateOnSearchFunction();
		$this->string .= $this->CreateOnSelectionChangeFunction();
		$this->string .= "\n});";
		$this->string .= "\n/* End of file ".$this->objectName."_grid.php - ".$GLOBALS['configuration']['app']." */";
		$this->string .= "\n";
	}
	
		// -----------------------------------------------------------------
	function CreateGridColumnModelFunction()
	{
		$this->string .= "\n\t\tconfig.columns = [";
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
		$this->string .= "\n\t\t];";
	}
	
	function CreateOnSearchFunction()
	{
		$this->string .="\n\t/**";
		$this->string .="\n\t*  Evento al buscar en el Grid";
		$this->string .="\n\t*/";
		$this->string .= "\n\tonSearch: function() {";
		$this->string .= "\n\t\tvar searchField = this.txtSearch.getValue() || null;";
		$this->string .= "\n\t\tvar store = this.getStore();";
		$this->string .= "\n";
		$this->string .= "\n\t\tstore.getProxy().extraParams['search'] = searchField;";
		$this->string .= "\n\t\tstore.load();";
		$this->string .= "\n\t},";
		$this->string .= "\n";
	}
	
	function CreateOnSelectionChangeFunction()
	{
		$this->string .="\n\t/**";
		$this->string .="\n\t*  Evento al Seleccionar una fila del Grid";
		$this->string .="\n\t*/";
		$this->string .= "\n\tonSelectionChange: function(sm, m, o) {";
		$this->string .= "\n\t\tif (!Ext.isEmpty(m))";
		$this->string .= "\n\t\t{";
		$this->string .= "\n\t\t\tvar sel = sm.getSelection();";
		$this->string .= "\n\t\t\tmodel = sel[0];";
		$this->string .= "\n\t\t\tthis.fireEvent('load_form_data', model);";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t}";
	}
	
	function CreateGridModelFunction()
	{
		$this->string .="\n\t\t/**";
		$this->string .="\n\t\t*  Crea el Modelo";
		$this->string .="\n\t\t*/";
		$this->string .="\n\t\tExt.define('Model.".$this->objectName."', {";
		$this->string .="\n\t\t\textend: 'Ext.data.Model',";
		$this->string .="\n\t\t\tidProperty: 'co_".rtrim(strtolower($this->objectName),s)."',//<--- el campo clave primaria de los registros.";		
		$this->string .="\n\t\t\tfields:[";	
		$this->string .="\n\t\t\t{";
		$this->string .="\n\t\t\t\tname: 'co_".rtrim(strtolower($this->objectName),s)."',";
		$this->string .="\n\t\t\t\ttype: 'string',";							
		$this->string .="\n\t\t\t},";
		$x = 0;		
		foreach ($this->attributeList as $attribute)
		{			
			if ($this->typeList[$x] == "VARCHAR(255)")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'string',";							
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "TEXT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'string',";							
				$this->string .="\n\t\t\t}";
			}	
			else if ($this->typeList[$x] == "DATE")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'date',";							
				$this->string .="\n\t\t\t}";
			}	
			else if ($this->typeList[$x] == "INT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'int',";							
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "TINYINT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'bool',";							
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "FLOAT")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'float',";							
				$this->string .="\n\t\t\t}";
			}
			else if ($this->typeList[$x] == "DOUBLE")
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'float',";							
				$this->string .="\n\t\t\t}";
			}
			else			
			{
				$this->string .="\n\t\t\t{";
				$this->string .="\n\t\t\t\tname: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\t\ttype: 'string',";							
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
		$this->string .= "\n";
	}

	function CreateGridStoreFunction()
	{
		$this->string .="\n\t\t/**";
		$this->string .="\n\t\t*  Crea el Store";
		$this->string .="\n\t\t*/\t";
		$this->string .= "\n\t\tvar Store_".$this->objectName." = Ext.create('Ext.data.Store', {";
		$this->string .= "\n\t\t\tautoLoad: true,";
		$this->string .= "\n\t\t\tmodel: Model.".$this->objectName.",";
		$this->string .= "\n\t\t\tproxy: {";
		$this->string .= "\n\t\t\t\ttype: 'ajax',";
		$this->string .= "\n\t\t\t\turl: 'controllers/controller.".$this->objectName.".php?accion=Listar',";
		$this->string .= "\n\t\t\t\treader: {";
		$this->string .= "\n\t\t\t\t\ttype: 'json',";
		$this->string .= "\n\t\t\t\t\troot: 'data',";
		$this->string .= "\n\t\t\t\t\ttotalProperty: 'rows'";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\tlisteners: {";
		$this->string .= "\n\t\t\t\tload: function() {";
		$this->string .= "\n\t\t\t\t\tgrid.getSelectionModel().select(0);";
		$this->string .= "\n\t\t\t\t\tgrid.fireEvent('rowclick', grid, 0);";
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\tscope: this";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
	}
	
	function CreatePreface()
	{
		$this->string .= "\n\tExt.define('".$GLOBALS['configuration']['app'].".desktop.".ucfirst(strtolower($this->objectName))."Window', {";
		$this->string .= "\n\t\textend: '".$GLOBALS['configuration']['app'].".desktop.Module',";
		$this->string .= "\n";
		$this->string .= "\n\t\tappType: 'win',";
		$this->string .= "\n\t\tid: '".strtolower($this->objectName)."-win',";
		$this->string .= "\n\t\ttitle: 'Modulo de ".$this->objectName."',";
		$this->string .= "\n\t\tinit: function () {";
		$this->string .= "\n\t\t\tthis.launcher = {";
		$this->string .= "\n\t\t\t\ttext: this.title,";
		$this->string .= "\n\t\t\t\ticonCls: 'icon-grid',";
		$this->string .= "\n\t\t\t\tscope: this";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t});";
	}

	function CreateFormFunction()
	{
		$this->string .= "\n/**";
		$this->string .= "\n * ".$GLOBALS['configuration']['app']."";
		$this->string .= "\n *";
		$this->string .= "\n * Clase generada con POG+EXTJS - ExtJS 4.2 integrada con Metodos CRUD.";
		$this->string .= "\n *";
		$this->string .= "\n * \$Id:			".$this->objectName."_form.php $";
		$this->string .= "\n * @package		".$GLOBALS['configuration']['app']."";
		$this->string .= "\n * @author		".$GLOBALS['configuration']['author'];
		$this->string .= "\n * @copyright	© 2013, POG+EXTJS - Kayak Innovations, C.A.";
		$this->string .= "\n * @version		v1.0";
		$this->string .= "\n * @created		".date('l jS \of F Y h:i:s A');
		$this->string .= "\n * @link		http://localhost/pog+extjs/?language=".$this->language."&wrapper=pdo&pdoDriver=".$this->pdoDriver."&extjsVersion=".$this->extjsVersion."&objectName=".urlencode($this->objectName)."&attributeList=".urlencode(var_export($this->attributeList, true))."&typeList=".urlencode(urlencode(var_export($this->typeList, true)))."&renderList=".urlencode(urlencode(var_export($this->renderList, true)));
		$this->string .= "\n *";
		$this->string .= "\n * This program is free software; you can redistribute it and/or modify";
		$this->string .= "\n * it under the terms of the GNU General Public License v3 (2007)";
		$this->string .= "\n * as published by the Free Software Foundation.";
		$this->string .= "\n */";
		$this->string .= "\n";
		$this->string .= "\nExt.namespace(\"".$GLOBALS['configuration']['app'].".".$this->objectName."\");";
		$this->string .= "\n";
		$this->string .= "\nExt.define('".$GLOBALS['configuration']['app'].".".$this->objectName.".Form', {";
		$this->string .= "\n\textend: 'Ext.form.Panel',";
		$this->string .= "\n";
		$this->string .= "\n\tinit: function () {";
		$this->string .= "\n\t\tvar me = this;";
		$this->string .= "\n\t\tme.modo = 'NUEVO';";
		$this->string .= "\n\t\tme.callParent();";
		$this->string .= "\n\t},";
		$this->string .= "\n\t";
		$this->string .= "\n\tconstructor: function (config) {";
		$this->string .= "\n\t\tconfig = config || {};";
		$this->string .= "\n";
		$this->string .= "\n\t\tconfig.title = 'Datos de ".ucfirst($this->objectName)."';";
		$this->string .= "\n\t\tconfig.border = false;";
		$this->string .= "\n\t\tconfig.modo = 'NUEVO';";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\tconfig.layout = {";
		$this->string .= "\n\t\t\ttype: 'border',";
		$this->string .= "\n\t\t\tpadding: 5";
		$this->string .= "\n\t\t};";
		$this->string .= "\n\t\tconfig.border = false;";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\tconfig.items = this.buildForm();";
		$this->string .= "\n";
		$this->string .= "\n\t\tconfig.buttons = [{";
		$this->string .= "\n\t\t\ttext: 'Nuevo',";
		$this->string .= "\n\t\t\tname: 'btnNuevo',";
		$this->string .= "\n\t\t\ticonCls: 'icon-add',";
		$this->string .= "\n\t\t\thandler: this.onNuevo";
		$this->string .= "\n\t\t},";
		$this->string .= "\n\t\t{";
		$this->string .= "\n\t\t\ttext: 'Eliminar',";
		$this->string .= "\n\t\t\tname: 'btnEliminar',";
		$this->string .= "\n\t\t\ticonCls: 'icon-delete',";
		$this->string .= "\n\t\t\thandler: this.onEliminar";
		$this->string .= "\n\t\t},";
		$this->string .= "\n\t\t{";
		$this->string .= "\n\t\t\ttext: 'Cancelar',";
		$this->string .= "\n\t\t\tname: 'btnCancelar',";
		$this->string .= "\n\t\t\ticonCls: 'icon-anulado',";
		$this->string .= "\n\t\t\thandler: this.onCancelar,";
		$this->string .= "\n\t\t\thidden: true";
		$this->string .= "\n\t\t},";
		$this->string .= "\n\t\t{";
		$this->string .= "\n\t\t\ttext: 'Guardar',";
		$this->string .= "\n\t\t\tname: 'btnGuardar',";
		$this->string .= "\n\t\t\ticonCls: 'icon-save',";
		$this->string .= "\n\t\t\thandler: this.onGuardar";
		$this->string .= "\n\t\t}];";
		$this->string .= "\n";
		$this->string .= "\n\t\tthis.addEvents({";
		$this->string .= "\n\t\t\t'load': true";
		$this->string .= "\n\t\t});";
		$this->string .= "\n";
		$this->string .= "\n\t\tthis.callParent([config]);";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\tbuildForm: function () {";
		$this->string .= "\n";
		$this->string .= "\n\t\tthis.frm".ucfirst($this->objectName)." = Ext.create('Ext.form.Panel', {";
		$this->string .= "\n\t\t\tname: 'form',";
		$this->string .= "\n\t\t\tframe: true,";
		$this->string .= "\n\t\t\tborder: false,";
		$this->string .= "\n\t\t\tbodyPadding: 5,";
		$this->string .= "\n\t\t\tlayout: {";
		$this->string .= "\n\t\t\t\ttype: 'vbox',";
		$this->string .= "\n\t\t\t\talign: 'stretch'";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\titems: [this.getContentPanel()]";
		$this->string .= "\n\t\t});";
		$this->string .= "\n";
		$this->string .= "\n\t\treturn this.frm".ucfirst($this->objectName).";";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\tgetContentPanel: function () {";
		$this->string .= "\n\t\tvar me = this;";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\tvar required = '<span style=\"color:red;font-weight:bold\" data-qtip=\"Required\">*</span>';";
		$this->string .= "\n";
		$this->string .= $this->CreateFormFieldsFunction();
		$this->string .= "\n";
		$this->string .= "\n\t\tthis.pnlData = Ext.create('Ext.Panel', {";
		$this->string .= "\n\t\t\tlayout: {";
		$this->string .= "\n\t\t\t\ttype: 'vbox',";
		$this->string .= "\n\t\t\t\talign: 'stretch'";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\tautoScroll: true,";
		$this->string .= "\n\t\t\theight: 300,";
		$this->string .= "\n\t\t\twidth: 545,";
		$this->string .= "\n\t\t\tborder: false,";
		$this->string .= "\n\t\t\tbodyPadding: 6,";
		$this->CreateGetColumnItems();
		$this->string .= "\n\t\t});";
		$this->string .= "\n";
		$this->string .= "\n\t\treturn this.pnlData;";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->CreateFormGuardarFunction();
		$this->string .= "\n";
		$this->CreateFormNuevoFunction();
		$this->string .= "\n";
		$this->CreateFormEliminarFunction();
		$this->string .= "\n";
		$this->CreateFormCancelarFunction();
		$this->string .= "\n});";
		$this->string .= "\n";
	}
	
	function CreateFormGuardarFunction()
	{
		$this->string .= "\n\t/**";
		$this->string .= "\n\t*  Guardar un nuevo registro o modifica uno ya existente";
		$this->string .= "\n\t*/";
		$this->string .= "\n\tonGuardar: function () {";
		$this->string .= "\n\t\tif (form.form.isValid()) {";
		$this->string .= "\n\t\t\tExt.Ajax.request({";
		$this->string .= "\n\t\t\t\turl: 'controllers/controller.".$this->objectName.".php?accion=Guardar',";
		$this->string .= "\n\t\t\t\tparams: {";
		$this->CreateFormGuardarParametrosFunction();
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\t//params: {data: Ext.encode(form.getForm().getValues())},";
		$this->string .= "\n\t\t\t\tscope: this,";
		$this->string .= "\n\t\t\t\tsuccess: function (r, o) {";
		$this->string .= "\n\t\t\t\t\tvar object = Ext.JSON.decode(r.responseText);";
		$this->string .= "\n\t\t\t\t\tExt.MessageBox.alert('Informacion', object.message);";
		$this->string .= "\n\t\t\t\t\tvar selectionModel = grid.getSelectionModel();";
		$this->string .= "\n\t\t\t\t\tvar selection = selectionModel.getSelection(); ";
		$this->string .= "\n\t\t\t\t\tvar model = selection[0];";
		$this->string .= "\n\t\t\t\t\tgrid.getStore().load({";
		$this->string .= "\n\t\t\t\t\t\t\t callback: function(records, operation, success) {";
		$this->string .= "\n\t\t\t\t\t\t\t\t// the operation object";
		$this->string .= "\n\t\t\t\t\t\t\t\t// contains all of the details of the load operation";
		$this->string .= "\n\t\t\t\t\t\t\t\t selectionModel.select(grid.getStore().getById(object.co_".rtrim(strtolower($this->objectName),s).").index);";
		$this->string .= "\n\t\t\t\t\t\t\t\t}";
		$this->string .= "\n\t\t\t\t\t\t});";
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\tfailure: function (r, o) {";
		$this->string .= "\n\t\t\t\t\talert(\"fail: \" + r.responseText);";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t});";
		$this->string .= "\n\t\t\t";
		$this->string .= "\n\t\t} else {";
		$this->string .= "\n\t\t\tExt.MessageBox.alert('Falta Informacion!', 'Debe completar los campos indicados.');";
		$this->string .= "\n";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t},";
		$this->string .= "\n";
	}
	
	function CreateFormNuevoFunction()
	{
		$this->string .= "\n\t/**";
		$this->string .= "\n\t*  Entrar en modo de creacion de un nuevo registro";
		$this->string .= "\n\t*/";
		$this->string .= "\n\tonNuevo: function () {";
		$this->string .= "\n\t\tform.getForm().reset();";
		$this->string .= "\n\t\tform.".$this->attributeList[0].".focus(true, 10);";
		$this->string .= "\n\t\tform.down('button[name=btnNuevo]').setVisible(false);";
		$this->string .= "\n\t\tform.down('button[name=btnEliminar]').setVisible(false);";
		$this->string .= "\n\t\tform.down('button[name=btnCancelar]').setVisible(true);";
		$this->string .= "\n\t},";
		$this->string .= "\n";
	}
	
	function CreateFormCancelarFunction()
	{
		$this->string .= "\n\t/**";
		$this->string .= "\n\t*  Cancelar la creacion un nuevo registro";
		$this->string .= "\n\t*/";
		$this->string .= "\n\tonCancelar: function () {";
		$this->string .= "\n\t\trecord = grid.getView().getSelectionModel().getSelection()[0];";
		$this->string .= "\n\t\tif (record) ";
		$this->string .= "\n\t\t{";
		$this->string .= "\n\t\t\tform.getForm().loadRecord(record);";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t\telse";
		$this->string .= "\n\t\t{";
		$this->string .= "\n\t\t\tgrid.txtSearch.setValue(null);";
		$this->string .= "\n\t\t\tgrid.onSearch();";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t\tform.down('button[name=btnNuevo]').setVisible(true);";
		$this->string .= "\n\t\tform.down('button[name=btnEliminar]').setVisible(true);";
		$this->string .= "\n\t\tform.down('button[name=btnCancelar]').setVisible(false);";
		$this->string .= "\n\t},";
	}
	
	function CreateFormEliminarFunction()
	{
		$this->string .= "\n\t/**";
		$this->string .= "\n\t*  Eliminar un registro seleccionado en el grid";
		$this->string .= "\n\t*/";
		$this->string .= "\n\tonEliminar: function () {";
		$this->string .= "\n\t\tif (form.co_".rtrim(strtolower($this->objectName),s).".getValue() !== '') {";
		$this->string .= "\n\t\t\tExt.MessageBox.confirm('Eliminar', 'Estas seguro que desea Eliminar el registro?',";
		$this->string .= "\n";
		$this->string .= "\n\t\t\tfunction (btn) {";
		$this->string .= "\n\t\t\t\tif (btn == 'yes') {";
		$this->string .= "\n\t\t\t\t\tExt.Ajax.request({";
		$this->string .= "\n\t\t\t\t\t\turl: 'controllers/controller.".strtolower($this->objectName).".php?accion=Eliminar',";
		$this->string .= "\n\t\t\t\t\t\tparams: {";
		$this->string .= "\n\t\t\t\t\t\t\tco_".rtrim(strtolower($this->objectName),s).": form.co_".rtrim(strtolower($this->objectName),s).".getValue()";
		$this->string .= "\n\t\t\t\t\t\t},";
		$this->string .= "\n\t\t\t\t\t\tscope: this,";
		$this->string .= "\n\t\t\t\t\t\tsuccess: function (r, o) {";
		$this->string .= "\n\t\t\t\t\t\t\tvar object = Ext.JSON.decode(r.responseText);";
		$this->string .= "\n\t\t\t\t\t\t\tExt.MessageBox.alert('Informacion', object.message);";
		$this->string .= "\n\t\t\t\t\t\t\tgrid.getStore().load();";
		$this->string .= "\n\t\t\t\t\t\t},";
		$this->string .= "\n\t\t\t\t\t\tfailure: function (r, o) {";
		$this->string .= "\n\t\t\t\t\t\t\talert(\"fail: \" + r.responseText);";
		$this->string .= "\n\t\t\t\t\t\t}";
		$this->string .= "\n\t\t\t\t\t});";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t});";
		$this->string .= "\n\t\t} else {";
		$this->string .= "\n\t\t\tExt.MessageBox.alert('".$this->objectName."', 'No se puede Eliminar');";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t},";
		$this->string .= "\n";
	}
	
	function CreateFormModificarFunction()
	{ 
		$this->string .= "\n\tonModificar: function () {";
		$this->string .= "\n\t\t//console.log(me.modo);";
		$this->string .= "\n\t\tme.frm".ucfirst($this->objectName).".form.findField('txtCodigo').setReadOnly(false);";
		$this->string .= "\n\t\tme.frm".ucfirst($this->objectName).".form.findField('txtCodigo').setDisabled(false);";
		$this->string .= "\n\t\tme.frm".ucfirst($this->objectName).".getForm().reset();";
		$this->string .= "\n\t\tExt.data.StoreManager.lookup('storeItemobras').loadData([], false);";
		$this->string .= "\n\t\tme.frm".ucfirst($this->objectName).".form.findField('txtCodigo').focus(true, 10);";
		$this->string .= "\n\t\tme.modo = 'MODIFICAR';";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\tonReimprimir: function () {";
		$this->string .= "\n\t\t// create the window on the first click and reuse on subsequent clicks   // <-- you might show a form on a dialog here";
		$this->string .= "\n\t\tExt.MessageBox.prompt('Reimprimir Orden', 'Introduzca el codigo del obras:',";
		$this->string .= "\n";
		$this->string .= "\n\t\tfunction (btn, text) {";
		$this->string .= "\n";
		$this->string .= "\n\t\t\tif (btn == 'ok') {";
		$this->string .= "\n\t\t\t\t//window.location = \"rpt/rpt.entrada_pdf.php?co_entrada=\" + text;";
		$this->string .= "\n\t\t\t\twindow.open(\"rpt/rpt.entrada_pdf.php?co_entrada=\" + text + \"&co_centro_acopio=\" + ".$GLOBALS['configuration']['app'].".CONF.CENTRODEACOPIO, \" obras \" + text);";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\tonAnular: function () {";
		$this->string .= "\n\t\tif ((me.frm".ucfirst($this->objectName).".form.findField('txtCodigo').getValue != '') && (me.modo == 'MODIFICAR')) {";
		$this->string .= "\n\t\t\t//Ext.getCmp('grid').mask('Guardando...');";
		$this->string .= "\n\t\t\tExt.MessageBox.confirm('Anulacion', 'Estas seguro que desea ANULAR la Orden de obras ' + me.frm".ucfirst($this->objectName).".form.findField('txtCodigo').getValue() + ' ?',";
		$this->string .= "\n";
		$this->string .= "\n\t\t\tfunction (btn) {";
		$this->string .= "\n\t\t\t\t//alert(btn);";
		$this->string .= "\n\t\t\t\tif (btn == 'yes') {";
		$this->string .= "\n\t\t\t\t\tExt.Ajax.request({";
		$this->string .= "\n\t\t\t\t\t\turl: 'controllers/controller.".$this->objectName.".php?accion=Anular',";
		$this->string .= "\n\t\t\t\t\t\tparams: {";
		$this->string .= "\n\t\t\t\t\t\t\tco_entrada: me.frm".ucfirst($this->objectName).".form.findField('txtCodigo').getValue(),";
		$this->string .= "\n\t\t\t\t\t\t\tco_centro_acopio: ".$GLOBALS['configuration']['app'].".CONF.CENTRODEACOPIO // OJO Cambiar el centro de acopio";
		$this->string .= "\n\t\t\t\t\t\t},";
		$this->string .= "\n\t\t\t\t\t\tscope: this,";
		$this->string .= "\n\t\t\t\t\t\tsuccess: function (r, o) {";
		$this->string .= "\n\t\t\t\t\t\t\tvar object = Ext.JSON.decode(r.responseText);";
		$this->string .= "\n\t\t\t\t\t\t\tExt.MessageBox.alert('Informacion', object.message);";
		$this->string .= "\n\t\t\t\t\t\t\tme.getLastID();";
		$this->string .= "\n\t\t\t\t\t\t},";
		$this->string .= "\n\t\t\t\t\t\tfailure: function (r, o) {";
		$this->string .= "\n\t\t\t\t\t\t\talert(\"fail: \" + r.responseText);";
		$this->string .= "\n\t\t\t\t\t\t}";
		$this->string .= "\n\t\t\t\t\t});";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t});";
		$this->string .= "\n\t\t} else {";
		$this->string .= "\n\t\t\tExt.MessageBox.alert('Codigo de obras', 'No se puede Anular');";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\tonNuevo: function () {";
		$this->string .= "\n\t\t//var me = this;";
		$this->string .= "\n\t\t//console.log(this);";
		$this->string .= "\n\t\t//console.log(me);";
		$this->string .= "\n\t\t//console.log(form);";
		$this->string .= "\n\t\tform.getForm().reset();";
		$this->string .= "\n\t\t//form.CboObras.focus(true, 10);";
		$this->string .= "\n\t\tform.getNewID();";
		$this->string .= "\n\t\t//me.frm".ucfirst($this->objectName).".down('button[name=btnAnular]').setDisabled(false);";
		$this->string .= "\n\t   // me.frm".ucfirst($this->objectName).".down('button[name=btnGuardar]').setDisabled(false);";
		$this->string .= "\n\t\tme.modo = 'NUEVO';";
		$this->string .= "\n\t\t//this.up('window').hide();";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\tgetNewID: function () {";
		$this->string .= "\n\t\tme = this;";
		$this->string .= "\n\t\t//alert(Usuario);";
		$this->string .= "\n\t\tExt.Ajax.request({";
		$this->string .= "\n\t\t\turl: 'controllers/controller.catalogo.php?accion=getNewID',";
		$this->string .= "\n\t\t\tparams: {";
		$this->string .= "\n\t\t\t\tco_centro_acopio: ".$GLOBALS['configuration']['app'].".CONF.CENTRODEACOPIO //OJO Cambiar el Centro de Acopio";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\tsuccess: function (r, o) {";
		$this->string .= "\n\t\t\t\tvar object = Ext.JSON.decode(r.responseText);";
		$this->string .= "\n\t\t\t\tme.txtCodigo.setValue(me.formatoId(object.lastid));";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\tfailure: function (r, o) {";
		$this->string .= "\n\t\t\t\talert(\"fail: \" + r.responseText);";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\tgetLastID: function () {";
		$this->string .= "\n\t\tme = this;";
		$this->string .= "\n\t\tExt.Ajax.request({";
		$this->string .= "\n\t\t\turl: 'controllers/controller.".$this->objectName.".php?accion=getLastID',";
		$this->string .= "\n\t\t\tparams: {";
		$this->string .= "\n\t\t\t\tco_centro_acopio: ".$GLOBALS['configuration']['app'].".CONF.CENTRODEACOPIO, //OJO Cambiar el Centro de Acopio";
		$this->string .= "\n\t\t\t\ttx_usuario: ".$GLOBALS['configuration']['app'].".CONF.CO_USUARIO";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\tsuccess: function (r, o) {";
		$this->string .= "\n\t\t\t\tvar object = Ext.JSON.decode(r.responseText);";
		$this->string .= "\n\t\t\t\t//alert(co_nomina+\"|\"+co_empleado+\"|\"+co_concepto);";
		$this->string .= "\n";
		$this->string .= "\n\t\t\t\t//~ window.open((me.modo == 'NUEVO') ? \"rpt/rpt.entrada_pdf.php?co_entrada=\" + r.responseText + \"&co_centro_acopio=\" + ".$GLOBALS['configuration']['app'].".CONF.CENTRODEACOPIO: \"rpt/rpt.entrada_pdf.php?co_entrada=\" + me.txtCodigo.getValue() + \"&co_centro_acopio=\" + ".$GLOBALS['configuration']['app'].".CONF.CENTRODEACOPIO );";
		$this->string .= "\n\t\t\t\t// OJO: despues de crear el reporte descomentar las siguientes dos lineas";
		$this->string .= "\n\t\t\t\t//window.open((me.modo == 'NUEVO') ? \"rpt/rpt.entrada_pdf.php?co_entrada=\" + r.responseText + \"&co_centro_acopio=\" + ".$GLOBALS['configuration']['app'].".CONF.CENTRODEACOPIO : \"rpt/rpt.entrada_pdf.php?co_entrada=\" + me.txtCodigo.getValue() + \"&co_centro_acopio=\" + ".$GLOBALS['configuration']['app'].".CONF.CENTRODEACOPIO, \"".$this->objectName."\" + (me.modo == 'NUEVO') ? r.responseText : me.txtCodigo.getValue());";
		$this->string .= "\n\t\t\t\tme.onNuevo();";
		$this->string .= "\n";
		$this->string .= "\n\t\t\t\t//".$GLOBALS['configuration']['app'].".".$this->objectName."Window.getNewID();";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\tfailure: function (r, o) {";
		$this->string .= "\n\t\t\t\talert(\"fail: \" + r.responseText);";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t},";
		$this->string .= "\n ";
		$this->string .= "\n\tformatoId: function (s) {";
		$this->string .= "\n\t\tvar r = '000000' + s;";
		$this->string .= "\n\t\treturn r.substring(r.length, r.length - 6);";
		$this->string .= "\n\t}";
		$this->string .= "\n});";
		$this->string .= "\n/* End of file ".$this->objectName."_form.php - ".$GLOBALS['configuration']['app']." */";
		$this->string .= "\n/* Location: TODO: ./extmodules/".$this->objectName."/".$this->objectName."_form.php */ ";
	}
	
	// -------------------------------------------------------------
	function CreateGetColumnItems()
	{
		$items;
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
			$items .= "this.".$control;
			if ($x != $count - 1) 
			{
				$items .= ",";
			}
			$x++;
		}
		$this->string .= "\n\t\t\titems: [".$items."]";
		if (($count % 2) == 0)
		{ // es par 
			$cf1 = $count / 2;
			$cf2 = $count / 2;
		}
		else
		{ //es impar
			$cf1 = floor($count / 2);
			$cf2 = $count - $cf1;
		}
		for ($i = 0; $i <= $cf1 -1; $i++) {
			$itemsColumna1  .= "this.".$this->arrayControls[$i];
			if ($i != $cf1 -1)
			{
				$itemsColumna1  .= ",";
			}
		}
		for ($i = $cf1; $i <= $count -1; $i++) {
			$itemsColumna2 .= "this.".$this->arrayControls[$i];
			if ($i != $count -1)
			{
				$itemsColumna2 .= ",";
			}
		}
		/*
		foreach ($this->arrayControls as $control)
		{			
			if (($x % 2) != 0)
			{ // es par 
				$itemsColumna1 .= "this.".$control;
				if (($x != $count - 1) && ($x != $count - 2))
				{
					$itemsColumna1 .= ",";
				}
			}
			else
			{ //es impar
				$itemsColumna2 .= "this.".$control;
				if (($x != $count - 1) && ($x != $count - 2))
				{
					$itemsColumna2 .= ",";
				}
			} 			
			$x++;
		}		
		*/
		$this->string .= "\n\t\t\t/* Si se desea la informacion en dos filas";
		$this->string .= "\n\t\t\titems: [";
		$this->string .= "\n\t\t\t\t{";
		$this->string .= "\n\t\t\t\t\txtype: 'fieldcontainer',";
		$this->string .= "\n\t\t\t\t\tlabelStyle: 'font-weight:bold;padding:0',";
		$this->string .= "\n\t\t\t\t\tlayout: 'hbox',";
		$this->string .= "\n\t\t\t\t\tdefaults: {margins: '0 0 0 5'},";
		$this->string .= "\n\t\t\t\t\titems: [".$itemsColumna1."]";
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\t{";
		$this->string .= "\n\t\t\t\t\txtype: 'fieldcontainer',";
		$this->string .= "\n\t\t\t\t\tlabelStyle: 'font-weight:bold;padding:0',";
		$this->string .= "\n\t\t\t\t\tlayout: 'hbox',";
		$this->string .= "\n\t\t\t\t\tdefaults: {margins: '0 0 0 5'},";
		$this->string .= "\n\t\t\t\t\titems: [".$itemsColumna2."]";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t]";
		$this->string .= "\n\t\t\t*/";
	}
	
	function CreateFormGuardarParametrosFunction()
	{
		$count = count($this->arrayControls);
		$x = 0;
		$this->string .= $this->separator;
		$this->string .= "\n\t\t\t\t\t//Parametros;";
		$this->string .= $this->separator;
		foreach ($this->arrayControls as $control)
		{
			$this->string .= "\n\t\t\t\t\t$control: form.$control.getValue()";
			if ($x != $count - 1) 
			{
				$this->string .= ",";
			}
			$x++;
		}
	}
	
	// -------------------------------------------------------------
	function CreateFormFieldsFunction()
	{
		$this->string .="\n\t\t/**";
		$this->string .="\n\t\t*  Crea los campos del formulario";
		$this->string .="\n\t\t*  @return void";
		$this->string .="\n\t\t*/\n\t";	
		$this->string .="\n\t\t// creamos el id co_".rtrim(strtolower($this->objectName),s);
		$this->string .="\n\t\tthis.co_".rtrim(strtolower($this->objectName),s)." = Ext.create('Ext.form.TextField', { ";
		$this->string .="\n\t\t\tname      :'co_".rtrim(strtolower($this->objectName),s)."',";
		$this->string .="\n\t\t\tfieldLabel:'co_".rtrim(strtolower($this->objectName),s)."',";
		$this->string .="\n\t\t\tlabelAlign: 'top',";
		$this->string .="\n\t\t\tenableKeyEvents: true,";
		$this->string .="\n\t\t\tafterLabelTextTpl: required,";
		$this->string .="\n\t\t\treadOnly  :true,";
		$this->string .="\n\t\t\thidden  :true,";
		$this->string .="\n\t\t\t//hideLabel  :true,";
		$this->string .="\n\t\t\ttabIndex  :".($x+1)."";
		$this->string .="\n\t\t});\n\t";
		$this->string .="\n\t\t// creamos el listener para el keypress evento";
		$this->string .="\n\t\tthis.co_".rtrim(strtolower($this->objectName),s).".on('keypress', function(el,e) { ";
		$this->string .="\n\t\t\tif (e.getKey() == e.ENTER) {";
		//$this->string .="\n\t\t\t\t//me.Field.focus(true, 10);";
		$this->string .="\n\t\t\t\tme.".$this->attributeList[1].".focus(true, 10);";
		$this->string .="\n\t\t\t}";	
		$this->string .="\n\t\t});\n\t";	
		$this->string .="\n\t\tthis.co_".rtrim(strtolower($this->objectName),s).".on('focus', function() { ";
		$this->string .="\n\t\t\tthis.selectText();";
		$this->string .="\n\t\t});";
		$this->string .="\n";
		$this->arrayControls[] = "co_".rtrim(strtolower($this->objectName),s);
		$count = count($this->attributeList);
		
		$x = 0;
		foreach ($this->attributeList as $attribute)
		{
			$j = $x+1;
			$focus_control = $this->attributeList[$j];
			//$this->string .= $this->renderList[$x];
			if ($this->renderList[$x] == "Ext.form.TextField")
			{
				$this->string .="\n\t\t//creamos el TextField ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.TextField', {";
				$this->string .="\n\t\t\tname      :'".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\t\tenableKeyEvents  :true,";
				$this->string .="\n\t\t\tlabelAlign: 'top',";
				$this->string .="\n\t\t\ttabIndex  :".($x+1)."";
				$this->string .="\n\t\t});";
				$this->string .="\n";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\t\tthis.selectText();";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
			}
			elseif ($this->renderList[$x] == "Ext.form.NumberField")
			{
				$this->string .="\n\t\t//creamos el NumberField ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.NumberField', {";
				$this->string .="\n\t\t\tname      :'".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\t\tenableKeyEvents  :true,";
				$this->string .="\n\t\t\tlabelAlign: 'top',";
				$this->string .="\n\t\t\ttabIndex  :".($x+1)."";
				$this->string .="\n\t\t});";
				$this->string .="\n";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\t\tthis.selectText();";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
			}
			elseif ($this->renderList[$x] == "Ext.form.Radio")
			{
				$this->string .="\n\t\t//creamos el RadioGroup ".strtolower($attribute)."";
				$this->string .= "\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.RadioGroup', { ";
				$this->string .= "\n\t\t\tdefaults: {";
				$this->string .= "\n\t\t\t\tflex: 1";
				$this->string .= "\n\t\t\t},";
				$this->string .= "\n\t\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .= "\n\t\t\tlabelAlign: 'top',";
				$this->string .= "\n\t\t\tlayout: 'hbox',";
				$this->string .= "\n\t\t\titems: [";
				$this->string .= "\n\t\t\t\t{";
				$this->string .= "\n\t\t\t\t\tboxLabel  : 'V',";
				$this->string .= "\n\t\t\t\t\tname      : '".strtolower($attribute)."',";
				$this->string .= "\n\t\t\t\t\tinputValue: 'V',";
				$this->string .= "\n\t\t\t\t}, {";
				$this->string .= "\n\t\t\t\t\tboxLabel  : 'E',";
				$this->string .= "\n\t\t\t\t\tname      : '".strtolower($attribute)."',";
				$this->string .= "\n\t\t\t\t\tinputValue: 'E',";
				$this->string .= "\n\t\t\t\t}";
				$this->string .= "\n\t\t\t]";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
			}
			else if ($this->renderList[$x] == "Ext.form.ComboBox")
			{
				
				// AQUI VA EL DS DEL COMBO
				// Combo de los cmb
				
				$this->string .="\n";
				$this->string .="\n\t\t/**";
				$this->string .="\n\t\t*  Store que provee los valores para llenara un Combo";
				$this->string .="\n\t\t*  y se carga Automaticamente =>  autoLoad=true";
				$this->string .="\n\t\t*/";
				$this->string .="\n\t\t// Si usas un Store y se carga desde la base de datos desomenta el siguiente bloque";
				$this->string .= "\n\t\t/*Ext.define('Model_".ucfirst($attribute)."', {";
				$this->string .= "\n\t\t\textend: 'Ext.data.Model',";
				$this->string .= "\n\t\t\tfields: [";
				$this->string .= "\n\t\t\t\t{name: 'co_".strtolower($attribute)."', type: 'int'},";
				$this->string .= "\n\t\t\t\t{name: 'nb_".strtolower($attribute)."',  type: 'string'}";
				$this->string .= "\n\t\t\t]";
				$this->string .= "\n\t\t});";
				$this->string .= "\n";
				$this->string .= "\n\t\tvar Store_".ucfirst($attribute)." = Ext.create('Ext.data.Store', {";
				$this->string .= "\n\t\t\tmodel: 'Model_".ucfirst($attribute)."',";
				$this->string .= "\n\t\t\tproxy: {";
				$this->string .= "\n\t\t\t\ttype: 'ajax',";
				$this->string .= "\n\t\t\t\turl: 'controllers/controller.".$this->objectName.".php?accion=getCombo".ucfirst($attribute)."',";
				$this->string .= "\n\t\t\t\treader: {";
				$this->string .= "\n\t\t\t\t\ttype: 'json',";
				$this->string .= "\n\t\t\t\t\troot: 'data'";
				$this->string .= "\n\t\t\t\t}";
				$this->string .= "\n\t\t\t},";
				$this->string .= "\n\t\t\tautoLoad: true";
				$this->string .= "\n\t\t});*/";
				$this->string .= "\n";
				$this->string .="\n\t\t// Un Store simple de prueba";
				$this->string .= "\n\t\tvar Store_".ucfirst($attribute)." = Ext.create('Ext.data.Store', {";
				$this->string .= "\n\t\t\tfields: ['co_".strtolower($attribute)."', 'nb_".strtolower($attribute)."'],";
				$this->string .= "\n\t\t\tdata : [";
				$this->string .= "\n\t\t\t\t{'co_".strtolower($attribute)."':'1', 'nb_".strtolower($attribute)."':'Option 1'},";
				$this->string .= "\n\t\t\t\t{'co_".strtolower($attribute)."':'2', 'nb_".strtolower($attribute)."':'Option 2'}";
				$this->string .= "\n\t\t\t]";
				$this->string .= "\n\t\t});";
				$this->string .= "\n";
				$this->string .="\n\t\t// creamos el ComboBox ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.ComboBox', {";
				$this->string .="\n\t\t\tname          : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tlabelAlign: 'top',";
				$this->string .="\n\t\t\tfieldLabel    : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\thiddenName    : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tvalueField    : 'co_".strtolower($attribute)."',";
				$this->string .="\n\t\t\tdisplayField  : 'nb_".strtolower($attribute)."',";
				$this->string .="\n\t\t\ttabIndex      :".($x+1).",";
				$this->string .="\n\t\t\tstore         : Store_".ucfirst($attribute).",";
				$this->string .="\n\t\t\ttypeAhead     : true,";
				$this->string .="\n\t\t\tforceSelection: true,";
				$this->string .="\n\t\t\tmode          : 'local',";
				$this->string .="\n\t\t\ttriggerAction : 'all',";
				$this->string .="\n\t\t\temptyText     : 'Seleccione un ".strtolower($attribute)."...',";
				$this->string .="\n\t\t\twidth         : 160";
				$this->string .="\n\t\t});\n\t";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\t\tthis.selectText();";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
					
			}
			else if ($this->renderList[$x] == "Ext.form.DateField")
			{
				$this->string .="\n\t\t// creamos el DateField ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.DateField', {";
				$this->string .="\n\t\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tenableKeyEvents  :true,";
				$this->string .="\n\t\t\tlabelAlign: 'top',";
				$this->string .="\n\t\t\ttabIndex   :".($x+1).",";
				$this->string .="\n\t\t\tformat    : 'd/m/Y',";
				$this->string .="\n\t\t\tsubmitFormat:'Y-m-d'";
				$this->string .="\n\t\t});";
				$this->string .="\n";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\t\tthis.selectText();";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = "".strtolower($attribute)."";  
			}
			else if ($this->renderList[$x] == "Ext.form.TextArea")
			{
				$this->string .="\n\t\t// creamos el TextArea ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.TextArea', { ";
				$this->string .="\n\t\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\t\tenableKeyEvents  :true,";
				$this->string .="\n\t\t\tlabelAlign: 'top',";
				$this->string .="\n\t\t\ttabIndex  :".($x+1).",";
				$this->string .="\n\t\t\thideLabel : true,";
				$this->string .="\n\t\t\twidth     : 275,";
				$this->string .="\n\t\t\theight    : 100";
				$this->string .="\n\t\t});";
				$this->string .="\n";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\t\tthis.selectText();";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
			}
			else if ($this->renderList[$x] == "Ext.form.Checkbox")
			{
				$this->string .="\n\t\t// creamos el Checkbox ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.Checkbox', { ";
				$this->string .="\n\t\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\t\tlabelAlign: 'top',";
				$this->string .="\n\t\t\ttabIndex  :".($x+1).",";
				$this->string .="\n\t\t\tsubmitOffValue: 0,";
				$this->string .="\n\t\t\tsubmitOnValue:1";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
			}
/*
			else if ($this->renderList[$x] == "Ext.form.Checkbox")
			{
				$this->string .="\n\t\t// creamos el Checkbox ".strtolower($attribute)."";
				$this->string .="\n\t\tvar ".strtolower($attribute)." = new Ext.form.Checkbox({ ";
				$this->string .="\n\t\t\tid        : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\t\ttabIndex  :".($x+1)."";
				$this->string .="\n\t\t});\n\t";				
				$this->arrayControls[] = strtolower($attribute);
			}
*/
			else if ($this->renderList[$x] == "Ext.form.HtmlEditor")
			{
				$this->string .="\n\t\t// creamos el TextArea ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.HtmlEditor', { ";
				$this->string .="\n\t\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\t\ttabIndex  :".($x+1).",";
				$this->string .="\n\t\t\thideLabel : true,";
				$this->string .="\n\t\t\tanchor    : '98%',";
				$this->string .="\n\t\t\theight    : 200";
				$this->string .="\n\t\t});";
				$this->string .="\n";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\t\tthis.selectText();";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
			}
			else if ($this->renderList[$x] == "Ext.form.TimeField")
			{
				$this->string .="\n\t\t// creamos el TextField ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.TimeField', { ";
				$this->string .="\n\t\t\tname      : '".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel: '".strtolower($attribute)."',";
				$this->string .="\n\t\t\ttabIndex  :".($x+1).",";
				$this->string .="\n\t\t\tminValue  : '8:00am',";
				$this->string .="\n\t\t\tmaxValue  : '6:00pm'";
				$this->string .="\n\t\t});";
				$this->string .="\n";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\t\tthis.selectText();";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
			}
			else
			{
				$this->string .="\n\t\t// creamos el TextField ".strtolower($attribute)."";
				$this->string .="\n\t\tthis.".strtolower($attribute)." = Ext.create('Ext.form.TextField', {";
				$this->string .="\n\t\t\tname      :'".strtolower($attribute)."',";
				$this->string .="\n\t\t\tfieldLabel:'".strtolower($attribute)."',";
				$this->string .="\n\t\t\ttabIndex  :".($x+1)."";
				$this->string .="\n\t\t});";
				$this->string .="\n";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('focus', function() { ";
				$this->string .="\n\t\t\tthis.selectText();";
				$this->string .="\n\t\t});";
				$this->arrayControls[] = strtolower($attribute);
			}
			if ($x != $count - 1)
			{
				$this->string .="\n";
				$this->string .="\n\t\t// creamos el listener para el keypress evento";
				$this->string .="\n\t\tthis.".strtolower($attribute).".on('keypress', function(el,e) { ";
				$this->string .="\n\t\t\tif (e.getKey() == e.ENTER) {";
				//$this->string .="\n\t\t\t\t//me.Field.focus(true, 10);";
				$this->string .="\n\t\t\t\tme.$focus_control.focus(true, 10);";
				$this->string .="\n\t\t\t}";
				$this->string .="\n\t\t});";
				$this->string .="\n";
			}
			$x++;
		}
		// Cerramos el objeto
		//$this->string .= $this->EndObject();
	}
	
	function CreateMainFunction()
	{
		$this->string .= "\n/**";
		$this->string .= "\n * ".$GLOBALS['configuration']['app']."";
		$this->string .= "\n *";
		$this->string .= "\n * Clase generada con POG+EXTJS - ExtJS 4.2 integrada con Metodos CRUD.";
		$this->string .= "\n *";
		$this->string .= "\n * \$Id:			main.php $";
		$this->string .= "\n * @package		".$GLOBALS['configuration']['app']."";
		$this->string .= "\n * @author		".$GLOBALS['configuration']['author'];
		$this->string .= "\n * @copyright	© 2013, POG+EXTJS - Kayak Innovations, C.A.";
		$this->string .= "\n * @version		v1.0";
		$this->string .= "\n * @created		".date('l jS \of F Y h:i:s A');
		$this->string .= "\n * @link		http://localhost/pog+extjs/?language=".$this->language."&wrapper=pdo&pdoDriver=".$this->pdoDriver."&extjsVersion=".$this->extjsVersion."&objectName=".urlencode($this->objectName)."&attributeList=".urlencode(var_export($this->attributeList, true))."&typeList=".urlencode(urlencode(var_export($this->typeList, true)))."&renderList=".urlencode(urlencode(var_export($this->renderList, true)));
		$this->string .= "\n *";
		$this->string .= "\n * This program is free software; you can redistribute it and/or modify";
		$this->string .= "\n * it under the terms of the GNU General Public License v3 (2007)";
		$this->string .= "\n * as published by the Free Software Foundation.";
		$this->string .= "\n */";
		$this->string .= "\n\n";
		$this->string .= "Ext.namespace(\"".$GLOBALS['configuration']['app'].".".$this->objectName."\");";
		$this->string .= "\n\n";
		$this->string .= "Ext.define('".$GLOBALS['configuration']['app'].".".$this->objectName.".".ucfirst($this->objectName)."Window', {";
		$this->string .= "\n\textend: 'Ext.Window',";
		$this->string .= "\n";
		$this->string .= "\n\tconstructor: function (config) {";
		$this->string .= "\n\t\tconfig = config || {};";
		$this->string .= "\n\t\tconfig.title = '".ucfirst($this->objectName)." CRUD';";
		$this->string .= "\n\t\tconfig.border = false;";
		$this->string .= "\n\t\tconfig.closeAction = 'hide';";
		$this->string .= "\n\t\tconfig.width = 1100;";
		$this->string .= "\n\t\tconfig.height = 439;";
		$this->string .= "\n\t\tconfig.minWidth = 300;";
		$this->string .= "\n\t\tconfig.minHeight = 300;";
		$this->string .= "\n\t\tconfig.layout = 'fit';";
		$this->string .= "\n\t\tconfig.resizable = true;";
		$this->string .= "\n\t\tconfig.modal = true;";
		$this->string .= "\n\t\tconfig.items = this.getContentPanel();";
		$this->string .= "\n";
		$this->string .= "\n\t\tthis.callParent([config]);";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\t/**";
		$this->string .= "\n\t*  Crea los componentes de la Ventana";
		$this->string .= "\n\t*/";
		$this->string .= "\n\tgetContentPanel: function () {";
		$this->string .= "\n\t\tgrid = Ext.create('".$GLOBALS['configuration']['app'].".".$this->objectName.".Grid');";
		$this->string .= "\n\t\tform = Ext.create('".$GLOBALS['configuration']['app'].".".$this->objectName.".Form');";
		$this->string .= "\n";
		$this->string .= "\n\t\tgrid.on('load_form_data', this.onGridSelect);";
		$this->string .= "\n";
		$this->string .= "\n\t\tmainPanel = Ext.create('Ext.form.FormPanel', {";
		$this->string .= "\n\t\t\tborder: false,";
		$this->string .= "\n\t\t\tlayout: 'column',";
		$this->string .= "\n\t\t\titems: [{";
		$this->string .= "\n\t\t\t\tcolumnWidth: 0.48,";
		$this->string .= "\n\t\t\t\tlayout: 'fit',";
		$this->string .= "\n\t\t\t\titems: grid";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\t{";
		$this->string .= "\n\t\t\t\tcolumnWidth: 0.52,";
		$this->string .= "\n\t\t\t\txtype: 'tabpanel',";
		$this->string .= "\n\t\t\t\tid   : 'tabContent',";
		$this->string .= "\n\t\t\t\tactiveTab: 0,";
		$this->string .= "\n\t\t\t\theight: 400,";
		$this->string .= "\n\t\t\t\titems: [form]";
		$this->string .= "\n\t\t\t}]";
		$this->string .= "\n\t\t});";
		$this->string .= "\n";
		$this->string .= "\n\t\treturn mainPanel;";
		$this->string .= "\n\t},";
		$this->string .= "\n";
		$this->string .= "\n\t/**";
		$this->string .= "\n\t*  Evento para cargar el registro seleccionado en el Grid en el Formulario";
		$this->string .= "\n\t*/";
		$this->string .= "\n\tonGridSelect: function(record) {";
		$this->string .= "\n\t\t//Esto es cuando queremos que se recarge manteniendo el parametro que es en este caso el co_producto";
		$this->string .= "\n\t\t//pnlImages.grdImages.getStore().getProxy().extraParams['co_obra'] = record.data.co_producto;";
		$this->string .= "\n\t\t//pnlImages.grdImages.getStore().load();";
		$this->string .= "\n";
		$this->string .= "\n\t\tif (record.data.co_".rtrim(strtolower($this->objectName),s)." > 0) { ";
		$this->string .= "\n\t\t\tform.getForm().load({";
		$this->string .= "\n\t\t\t\turl: 'controllers/controller.".$this->objectName.".php?accion=Get',";
		$this->string .= "\n\t\t\t\tparams:{";
		$this->string .= "\n\t\t\t\t\tco_".rtrim(strtolower($this->objectName),s).": record.data.co_".rtrim(strtolower($this->objectName),s)."";
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\tsuccess: function(f, action) {";
		$this->string .= "\n\t\t\t\t\tform.down('button[name=btnNuevo]').setVisible(true);";
		$this->string .= "\n\t\t\t\t\tform.down('button[name=btnEliminar]').setVisible(true);";
		$this->string .= "\n\t\t\t\t\tform.down('button[name=btnCancelar]').setVisible(false);";
		$this->string .= "\n\t\t\t\t\tform.getForm().loadRecord(record);";
		$this->string .= "\n\t\t\t\t},";
		$this->string .= "\n\t\t\t\tfailure: function(form, action) {";
		$this->string .= "\n\t\t\t\t\tExt.Msg.alert(\"Errar\", \"No se pudo cargar la data\");";
		$this->string .= "\n\t\t\t\t}";
		$this->string .= "\n\t\t\t});";
		$this->string .= "\n\t\t} else {";
		$this->string .= "\n\t\t\tthis.callParent();";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t}";
		$this->string .= "\n});";
		$this->string .= "\n";
		$this->string .= "\nExt.onReady(function() {";
		$this->string .= "\n\tvar a = Ext.create('".$GLOBALS['configuration']['app'].".".$this->objectName.".".ucfirst($this->objectName)."Window');";
		$this->string .= "\n\ta.show();";
		$this->string .= "\n});";
		$this->string .= "\n/* End of file main.php - ".$GLOBALS['configuration']['app']." */";
		$this->string .= "\n/* Location: TODO: ./extmodules/".$this->objectName."/main.php */ ";
	}
	
	function CreateMainKedruxFunction()
	{
		$this->string .= "\n/**";
		$this->string .= "\n * ".$GLOBALS['configuration']['app']."";
		$this->string .= "\n *";
		$this->string .= "\n * Clase generada con POG+EXTJS - ExtJS 4.2 integrada con Metodos CRUD.";
		$this->string .= "\n *";
		$this->string .= "\n * \$Id:			main.php $";
		$this->string .= "\n * @package		".$GLOBALS['configuration']['app']."";
		$this->string .= "\n * @author		".$GLOBALS['configuration']['author'];
		$this->string .= "\n * @copyright	© 2013, POG+EXTJS - Kayak Innovations, C.A.";
		$this->string .= "\n * @version		v1.0";
		$this->string .= "\n * @created		".date('l jS \of F Y h:i:s A');
		$this->string .= "\n * @link		http://localhost/pog+extjs/?language=".$this->language."&wrapper=pdo&pdoDriver=".$this->pdoDriver."&extjsVersion=".$this->extjsVersion."&objectName=".urlencode($this->objectName)."&attributeList=".urlencode(var_export($this->attributeList, true))."&typeList=".urlencode(urlencode(var_export($this->typeList, true)))."&renderList=".urlencode(urlencode(var_export($this->renderList, true)));
		$this->string .= "\n *";
		$this->string .= "\n * This program is free software; you can redistribute it and/or modify";
		$this->string .= "\n * it under the terms of the GNU General Public License v3 (2007)";
		$this->string .= "\n * as published by the Free Software Foundation.";
		$this->string .= "\n */";
		$this->string .= "\n\n";
		$this->string .= "Ext.namespace(\"".$GLOBALS['configuration']['app'].".".$this->objectName."\");";
		$this->string .= "\n\n";
		$this->string .= "Ext.override(".$GLOBALS['configuration']['app'].".desktop.".ucfirst(strtolower($this->objectName))."Window, {";
		$this->string .= "\n";
		$this->string .= "\n\tcreateWindow : function() {";
		$this->string .= "\n\tvar desktop = this.app.getDesktop();";
		$this->string .= "\n\tvar win = desktop.getWindow('".$this->objectName."-win');";
		$this->string .= "\n\t";
		$this->string .= "\n\tif (!win) {";
		$this->string .= "\n";
		$this->string .= "\n\t\twin = desktop.createWindow({";
		$this->string .= "\n\t\t\tid: '".$this->objectName."-win',";
		$this->string .= "\n\t\t\ttitle: '".$this->objectName."',";
		$this->string .= "\n\t\t\twidth: 1100,";
		$this->string .= "\n\t\t\titems: this.getContentPanel()";
		$this->string .= "\n\t\t});";
		$this->string .= "\n\t}";
		$this->string .= "\n";
		$this->string .= "\n\twin.show();";
		$this->string .= "\n\t},";
		$this->string .= "\n  ";
		$this->string .= "\n  getContentPanel: function () {";
		$this->string .= "\n\t\tgrid = Ext.create('".$GLOBALS['configuration']['app'].".".$this->objectName.".Grid');";
		$this->string .= "\n\t\tform = Ext.create('".$GLOBALS['configuration']['app'].".".$this->objectName.".Form');";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\t//pnlImages = Ext.create('".$GLOBALS['configuration']['app'].".".$this->objectName.".Images');";
		$this->string .= "\n";
		$this->string .= "\n\t\tform.on('create_categorias', this.onCreateCategoria, this);";
		$this->string .= "\n\t\tform.on('create_subcategorias', this.onCreateSubCategoria, this);";
		$this->string .= "\n\t\tgrid.on('load_form_data', this.onGridSelect)";
		$this->string .= "\n";
		$this->string .= "\n\t\tmainPanel = Ext.create('Ext.form.FormPanel', {";
		$this->string .= "\n\t\t\tborder: false,";
		$this->string .= "\n\t\t\tlayout: 'column',";
		$this->string .= "\n\t\t\titems: [{";
		$this->string .= "\n\t\t\t\tcolumnWidth: 0.48,";
		$this->string .= "\n\t\t\t\tlayout: 'fit',";
		$this->string .= "\n\t\t\t\titems: grid";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\t{";
		$this->string .= "\n\t\t\t\tcolumnWidth: 0.52,";
		$this->string .= "\n\t\t\t\txtype: 'tabpanel',";
		$this->string .= "\n\t\t\t\tid   : 'tabContent',";
		$this->string .= "\n\t\t\t\tactiveTab: 0,";
		$this->string .= "\n\t\t\t\theight: 400,";
		$this->string .= "\n\t\t\t\titems: [form]//,pnlImages]";
		$this->string .= "\n\t\t\t}]";
		$this->string .= "\n\t\t});";
		$this->string .= "\n";
		$this->string .= "\n\t\treturn mainPanel;";
		$this->string .= "\n\t},";
		$this->string .= "\n\tonGridSelect: function(record) {";
		$this->string .= "\n\t\t//console.log(this);";
		$this->string .= "\n\t\t//console.log(me);";
		$this->string .= "\n\t\t//console.log(form);\t\t";
		$this->string .= "\n\t\t//console.log(record.data.tx_descripcion2);";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\t//form.getForm().loadRecord(record);";
		$this->string .= "\n\t\t//console.log(grdImages);";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\t//Esto es cuando queremos que se recarge manteniendo el parametro que es en este caso el co_producto";
		$this->string .= "\n\t\t//pnlImages.grdImages.getStore().getProxy().extraParams['co_obra'] = record.data.co_producto;";
		$this->string .= "\n\t\t//pnlImages.grdImages.getStore().load();";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\tif (record.data.co_obra > 0) { ";
		$this->string .= "\n\t\t  form.getForm().load({";
		$this->string .= "\n\t\t\turl: 'controllers/controller.".$this->objectName.".php?accion=Get',";
		$this->string .= "\n\t\t\tparams:{";
		$this->string .= "\n\t\t\t  co_".rtrim(strtolower($this->objectName),s).": record.data.co_".rtrim(strtolower($this->objectName),s)."";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\tsuccess: function(f, action) {";
		$this->string .= "\n\t\t\t  //~ store = form.CboSubCategorias.getStore();";
		$this->string .= "\n\t\t\t  //~ store.load({";
		$this->string .= "\n\t\t\t\t  //~ params: {";
		$this->string .= "\n\t\t\t\t\t\t\t//~ co_categoria: record.data.co_categoria";
		$this->string .= "\n\t\t\t\t  //~ }";
		$this->string .= "\n\t\t\t  //~ })";
		$this->string .= "\n\t\t\t  // ESTA MANERA LO HACE DIRECTA PERO COMO NECESITAMOS HACER ALGO QUE ES CARGAR EL CBOSUBCATEGORIAS DE ACUERDO";
		$this->string .= "\n\t\t\t  // A LA CATERIA UTILIZAMOS ESTA FUNCION DE LO CONTRARIO CON";
		$this->string .= "\n\t\t\t  // form.getForm().loadRecord(record); BASTARIA";
		$this->string .= "\n\t\t\t  ";
		$this->string .= "\n\t\t\t  form.getForm().loadRecord(record);";
		$this->string .= "\n\t\t\t  ";
		$this->string .= "\n\t\t\t  //".$GLOBALS['configuration']['app'].".despachos.ConductoresDialog.superclass.show.call(this);";
		$this->string .= "\n\t\t\t},";
		$this->string .= "\n\t\t\tfailure: function(form, action) {";
		$this->string .= "\n\t\t\t  Ext.Msg.alert(\"Errar\", \"No se pudo cargar la data\");";
		$this->string .= "\n\t\t\t}";
		$this->string .= "\n\t\t  });";
		$this->string .= "\n\t\t} else {";
		$this->string .= "\n";
		$this->string .= "\n\t\t  this.callParent();";
		$this->string .= "\n\t\t}";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t\t//me.form.getForm().loadRecord(producto);";
		$this->string .= "\n\t\t";
		$this->string .= "\n\t}";
		$this->string .= "\n});";
		$this->string .= "\n/* End of file main.php - ".$GLOBALS['configuration']['app']." */";
		$this->string .= "\n/* Location: TODO: ./extmodules/".$this->objectName."/main.php */ ";
	}
	
	function Debug()
	{
		$this->string .="\nExt.onReady(function () {\n";
		$this->string .="\n\t// Habilita los Tooltiptext";
		$this->string .="\n\tExt.QuickTips.init();\n";	
		$this->string .="\n\t// Activar la validacion de errores en el lado del control";
		$this->string .="\n\tExt.form.Field.prototype.msgTarget = 'side';\n";
	}
}
?>

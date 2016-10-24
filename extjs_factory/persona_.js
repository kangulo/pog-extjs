/*!
* Ext JS Library 3.0.0
* Copyright(c) 2006-2009 Ext JS, LLC
* licensing@extjs.com
* http://www.extjs.com/license
*
* <b>Estudiantes</b> Clase ExtJs integrada con Metodos CRUD.
* @author Kevin Angulo extended from Php Object Generator
* @link http://locahost/pog+extjs/?language=php5.1&wrapper=pdo&pdoDriver=mysql&extjsVersion=3&objectName=Estudiantes&attributeList=array+%28%0A++0+%3D%3E+%27ci_estudiante%27%2C%0A++1+%3D%3E+%27nb_estudiante%27%2C%0A++2+%3D%3E+%27tx_correo_particular%27%2C%0A++3+%3D%3E+%27fe_nacimiento%27%2C%0A++4+%3D%3E+%27tx_lugar_nacimiento%27%2C%0A++5+%3D%3E+%27tlf_particular%27%2C%0A++6+%3D%3E+%27dir_estudiante%27%2C%0A++7+%3D%3E+%27tx_cargo%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527DATE%2527%252C%250A%2B%2B4%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B5%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B6%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B7%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2529&renderList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527Ext.form.TextField%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527Ext.form.TextField%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527Ext.form.TextField%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527Ext.form.DateField%2527%252C%250A%2B%2B4%2B%253D%253E%2B%2527Ext.form.TextField%2527%252C%250A%2B%2B5%2B%253D%253E%2B%2527Ext.form.TextField%2527%252C%250A%2B%2B6%2B%253D%253E%2B%2527Ext.form.TextArea%2527%252C%250A%2B%2B7%2B%253D%253E%2B%2527Ext.form.TextField%2527%252C%250A%2529
*/

Ext.SSL_SECURE_URL  = 'images/s.gif';
Ext.BLANK_IMAGE_URL = 'images/s.gif';


Ext.onReady(function () {
	
	new Cargar();

});

/**
* Inicializa los valores del formulario y carga y muestra el grid
* @return void
*/

Cargar = function() {
	
	// Habilita los Tooltiptext
	Ext.QuickTips.init();

	// Activar la validacion de errores al lado del control
	Ext.form.Field.prototype.msgTarget = 'side';

	/**
	* Definimos los campos que podra contener el panel which this Panel contains.
	* @return {Ext.form.BasicForm} The {@link Ext.form.BasicForm Form} which this Panel contains.
	*/
	// creamos el TextField ci_estudiante
	var estudiantesId = new Ext.form.TextField({ 
		id        :'estudiantesid',
		name      :'estudiantesid',
		fieldLabel:'estudiantesid',
		//hidden	  : true,
		//hideLabel : true,
		tabIndex  :1
	});
	
	// creamos el TextField ci_estudiante
	var ci_estudiante = new Ext.form.TextField({ 
		id        :'ci_estudiante',
		name      :'ci_estudiante',
		fieldLabel:'ci_estudiante',
		tabIndex  :1
	});
	
	// creamos el TextField nb_estudiante
	var nb_estudiante = new Ext.form.TextField({ 
		id        :'nb_estudiante',
		name      :'nb_estudiante',
		fieldLabel:'nb_estudiante',
		tabIndex  :2
	});
	
	// creamos el TextField tx_correo_particular
	var tx_correo_particular = new Ext.form.TextField({ 
		id        :'tx_correo_particular',
		name      :'tx_correo_particular',
		fieldLabel:'tx_correo_particular',
		tabIndex  :3
	});
	
	// creamos el DateField fe_nacimiento
	var fe_nacimiento = new Ext.form.DateField({
		id        : 'fe_nacimiento',
		name      : 'fe_nacimiento',
		fieldLabel: 'fe_nacimiento',
		tabIndex   :4,
		format    : 'd/m/Y'
	});
	
	// creamos el TextField tx_lugar_nacimiento
	var tx_lugar_nacimiento = new Ext.form.TextField({ 
		id        :'tx_lugar_nacimiento',
		name      :'tx_lugar_nacimiento',
		fieldLabel:'tx_lugar_nacimiento',
		tabIndex  :5
	});
	
	// creamos el TextField tlf_particular
	var tlf_particular = new Ext.form.TextField({ 
		id        :'tlf_particular',
		name      :'tlf_particular',
		fieldLabel:'tlf_particular',
		tabIndex  :6
	});
	
	// creamos el TextArea dir_estudiante
	var dir_estudiante = new Ext.form.TextArea({ 
		id        : 'dir_estudiante',
		name      : 'dir_estudiante',
		fieldLabel:'dir_estudiante',
		tabIndex  :7,
		hideLabel : true,
		width     : 275,
		height    : 100
	});
	
	// creamos el TextField tx_cargo
	var tx_cargo = new Ext.form.TextField({ 
		id        :'tx_cargo',
		name      :'tx_cargo',
		fieldLabel:'tx_cargo',
		tabIndex  :8
	});
	
	/**
	*  JsonReader crea un arreglo de objectos desde una respuesta en json y
	*  los mapea segun el tipo de datos
	*/
	
	var drEstudiantes = new Ext.data.JsonReader({
		root: 'data',
		id  : 'estudiantesid',
		// Nombre de la propiedad que indica si tuvo exito la consulta o no.
		successProperty: 'success',
		// Nombre de la propiedad que me devuleve el numero total de filas.
		totalProperty: 'rows',
		fields:[
		{
			name: 'estudiantesid',
			type: 'int',
			mapping: 'estudiantesid'
		},
		{
			name: 'ci_estudiante',
			type: 'int',
			mapping: 'ci_estudiante'
		},
		{
			name: 'nb_estudiante',
			type: 'string',
			mapping: 'nb_estudiante'
		},
		{
			name: 'tx_correo_particular',
			type: 'string',
			mapping: 'tx_correo_particular'
		},
		{
			name: 'fe_nacimiento',
			type: 'date',
			mapping: 'fe_nacimiento',
			dateFormat: 'Y-m-d'		// Formato como viene desde la base de datos
		},
		{
			name: 'tx_lugar_nacimiento',
			type: 'string',
			mapping: 'tx_lugar_nacimiento'
		},
		{
			name: 'tlf_particular',
			type: 'string',
			mapping: 'tlf_particular'
		},
		{
			name: 'dir_estudiante',
			type: 'string',
			mapping: 'dir_estudiante'
		},
		{
			name: 'tx_cargo',
			type: 'string',
			mapping: 'tx_cargo'
		}
		]
	});
	
	    	
	/**
	*  Creamos los filtros para cada uno de los campos
	*  
	*/
	
	var filters = new Ext.ux.grid.GridFilters({
        // encode and local configuration options defined previously for easier reuse
        encode: false, // json encode the filter query
        local: false,  // defaults to false (remote filtering)
        filters: [{
            type: 'numeric',
            dataIndex: 'estudiantesid'
        }, {
            type: 'string',
            dataIndex: 'nb_estudiante'
            //disabled: true
        }, {
            type: 'numeric',
            dataIndex: 'ci_estudiante'
        }, {
            type: 'date',
            dataIndex: 'fe_nacimiento'
        }]
    });
	
	/**
	*  Creamos un proxy que sera usado para hacer llamadas al servidor y retornar la
	*  data cargada usando el Reader y mantenerla en cache en el store
	*/
	
	var httpProxy = new Ext.data.HttpProxy({
		url: 'estudiantes.php?accion=Listar',
	});
	
	
	// Se dispara si un error de HTTP status es devuelto desde el sevidor.
	// Maneja cualquier excepcion que pueda ocurrir con la conexion y el http request.
	httpProxy.getConnection().on('requestexception', requestFailed);
	
	
	/**
	* Maneja la ocurrencia de algun error HTTP y verifica el status retornado desde el servidor. 
	* Ver HTTP Status Code Definitions para mas detalles de los codigos de status HTTP.
	* @param {Ext.data.Connection} connection El Objeto Conexion.
	* @param {Object} response El Objeto XHR que contiene los datos de la respuesta. 
	*		Ver http://www.w3.org/TR/XMLHttpRequest/ para mas detalles para acceder a los elementos
	*		del response.
	* @param {Object} options configura el objeto pasado al metodo.
	*/
	function requestFailed(connection, response, options) {
		Ext.MessageBox.alert('Error Message','Please contact support with the following: ' + 'Status: ' + response.status + ', Status Text: ' + response.statusText);
	}
	
	
	// El Objeto Store encapsula un cache de los registros en el lado del cliente de los cuales
	// proveen datos para los componentes tales como el GridPanel, el ComboBox, 
	// o el DataView.
	// Un Objeto Store usa la implementacion del DataProxy para acceder 
	// a un objecto de datos a menos que hagas el llamado del metodo loadData directamente y pases los datos.
	var dsEstudiantes = new Ext.data.Store({
		proxy: httpProxy,
		reader: drEstudiantes
	});
	
	// Se dispara si ocurre una excepcion en la carga del store.
	// maneja cualquier excepcion que pueda ocurrir en el Proxy durante la carda de los datos.
	dsEstudiantes.on('loadexception', loadFailed);
	
	// Funcion que de dispara luego que los datos han sido cargados exitosamente.
	dsEstudiantes.on('load', loadSuccessful);
	
	// Usa un callback metodo para crear y cargar el grid.
	dsEstudiantes.load({
		params: {
			start: 0,
			limit: 5
		},
		callback: LoadAndShowGrid
	});
	
	function loadFailed(proxy, options, response, error) {
		// Decodes (parses) a JSON string to an object. If the JSON is invalid, 
		// this function throws a SyntaxError.
		var object = Ext.util.JSON.decode(response.responseText);
		var errorMessage = 'Error loading data.';
		// If the load from the server was successful and this method was called then
		// the reader could not read the response.
		if (object.success) {
			if (object.rows == 0) {
				errorMessage = 'No existen registros en la Base de Datos';	
				var grid = Ext.getCmp('grid');
				grid.getStore().removeAll();
				grid.getView().emptyText = 'No hay datos';
				grid.getView().refresh();
				Ext.getCmp('form').getForm().reset();
			}
			else
			{
				errorMessage = 'The data returned from the server is in the wrong format. Please notify support with the following information: ' + response.responseText;
			}
		} else {
			// Error on the server side will include an error message in 
			// the response.
			errorMessage = object.message;
		}
		Ext.MessageBox.alert('Error Message', errorMessage);
	}
	
	
	function loadSuccessful(store, recordArray, options) {
		//Ext.MessageBox.alert('Confirm', drEstudiantes.jsonData.message);
	}
		
	/**
	* Carga y Muestra el Grid con los Datos
	* @return form
	*/
	function LoadAndShowGrid(recordArray, options, success){
	
	
		var estudiantesColumnModel = new Ext.grid.ColumnModel([
			// Esta es un clase utilitaria que puede ser pasada al Ext.grid.ColumnModel 
			// como una configuracion de columnas que provee un enumaramiento automatico.
			// Aqui se renderizan todas las columnas con el fin de dejar a tu eleccion las que quieras mostrar.
			new Ext.grid.RowNumberer(),
			{
				id: 'estudiantesid',
				header: 'Id',
				width: 30,
				sortable: true,
				//hidden: true,
				dataIndex: 'estudiantesid'
			},
			{
				header: 'Ci_estudiante',
				width: 30,
				sortable: true,
				dataIndex: 'ci_estudiante'
			},
			{
				header: 'Nb_estudiante',
				width: 30,
				sortable: true,
				dataIndex: 'nb_estudiante'
			},
			{
				header: 'Tx_correo_particular',
				width: 30,
				sortable: true,
				dataIndex: 'tx_correo_particular'
			},
			{
				header: 'Fe_nacimiento',
				width: 30,
				sortable: true,
				// Formato para Mostrar en el grid
	            renderer: Ext.util.Format.dateRenderer('d/m/Y'),
				dataIndex: 'fe_nacimiento'
			},
			{
				header: 'Tx_lugar_nacimiento',
				width: 30,
				sortable: true,
				dataIndex: 'tx_lugar_nacimiento'
			},
			{
				header: 'Tlf_particular',
				width: 30,
				sortable: true,
				dataIndex: 'tlf_particular'
			},
			{
				header: 'Dir_estudiante',
				width: 30,
				sortable: true,
				dataIndex: 'dir_estudiante'
			},
			{
				header: 'Tx_cargo',
				width: 30,
				sortable: true,
				dataIndex: 'tx_cargo'
			}
		]);
		
		
	
	
		// Agrega una barra de paginado al pie del grid.  
		var pagingToolbar = new Ext.PagingToolbar({
			pageSize: 5,  // Registros por pagina
			displayInfo: true,
			displayMsg: 'Un total de {2} registros encontrados. Actualmente mostrando {0} - {1}',
			emptyMsg: 'No se encontraron registros',
			plugins: [filters],
			store: dsEstudiantes
		});
	
	
		// Crea el grid.  
		var grid = new Ext.grid.GridPanel({
			id   : 'grid',
			store: dsEstudiantes,
			cm: estudiantesColumnModel,
			sm: new Ext.grid.RowSelectionModel({
				singleSelect: true,
				listeners: {
					rowselect: function (sm, row, rec) {
						Ext.getCmp('form').getForm().loadRecord(rec);									
					}
				}
			}),
			viewConfig: {
				forceFit: true
			},
			//autoExpandColumn: 'nb_estudiante',
			plugins: [filters],
			height: 350,
			border: true,
			listeners: {
				render: function (g) {
					g.getSelectionModel().selectRow(0);
				},
				delay: 10 // Allow rows to be rendered.
			}			
		});
	
	
		// Creamos el formulario
		var form = new Ext.form.FormPanel({
			id: 'form',
			frame: true,
			labelAlign: 'left',
			title: 'Estudiantes',
			//bodyStyle: 'padding:5px',
			//width: 750,
			autoHeight: true,
			layout: 'column',
			// Especifica que los items ahora seran ordenados en columnas
			items: [{
				columnWidth: 0.4,
				layout: 'fit',						
				bodyStyle: 'padding:0 10px 0 0px',
				items: grid
			},
			{
				columnWidth: 0.6,
				bodyStyle: Ext.isIE ? 'padding:0 0 5px 15px;' : 'padding:10px 15px;',
				xtype: 'tabpanel',
				id   : 'tabContent',
				plain: true,
				activeTab: 0,
				forceLayout:true,
				height: 400,
				items: [{
					title: 'Datos',
					id   : 'tab1',
					layout: 'column',
					labelAlign: 'top',
					labelWidth: 60,
					defaults: {
						width: 230
					},//8 Campos distribuidos en 2 Columnas;
					items: [{
							columnWidth: .5,
							layout: 'form',
							labelWidth: 50,
							border: false,
							items: [estudiantesId,ci_estudiante,tx_correo_particular,tx_lugar_nacimiento,dir_estudiante]
						},
						{
							columnWidth: .5,
							layout: 'form',
							labelWidth: 50,
							border: false,
							items: [nb_estudiante,fe_nacimiento,tlf_particular,tx_cargo]
						}
						/*,
						{
							columnWidth: 1,
							layout: 'form',
							labelWidth: 46,
							items: [{
								xtype: 'textarea',
								name: 'dir_estudiante',
								id: 'dir_estudiante',
								fieldLabel: 'Direccion',
								width: '96%'
							}]
						}*/
					]
				}],
				buttons: [{
					id: 'btnAgregar',
					text: 'Agregar',
					disabled: false,
					handler: Limpiar					
				},
				{
					id: 'btnGuardar',
					text: 'Guardar',
					disabled: false,
					handler: function() {
						// borrar el registro
						new Guardar(dsEstudiantes);
					}				
				},
				{
					id: 'btnEliminar',
					text: 'Eliminar',
					disabled: false,
					handler: function() {
						// borrar el registro
						new Eliminar(dsEstudiantes, grid);
					}
				}]
			}],
			bbar: pagingToolbar
			/*
			tbar: [
			'Buscar: ', ' ',
			],
			*/
		});	//Fin creacion del formulario
	
	
	
	// add some buttons to bottom toolbar just for demonstration purposes
    form.getBottomToolbar().add([
        '->',
        {
            text: 'All Filter Data',
            tooltip: 'Get Filter Data for Grid',
            handler: function () {
                var data = Ext.encode(grid.filters.getFilterData());
                Ext.Msg.alert('All Filter Data',data);
            } 
        },{
            text: 'Clear Filter Data',
            handler: function () {
                grid.filters.clearFilters();
            } 
        },{
            text: 'Reconfigure Grid',
            handler: function () {
                grid.reconfigure(dsEstudiantes, createColModel(6));
            } 
        }    
    ]);
	
	
		// Renderizamos el formulario al cuerpo del HTML
		form.render(Ext.getBody());
	
	
		// El siguiente bloque es para forzar el renderizado de todos los tabs
		// por supuesto es para cuando se tiene mas de un tab
		// la Variable i debe de ser igual al numero de tabs
		/*
		for (i=1; i>0; i--){
			Ext.getCmp('TabContent').setActiveTab('tab'+i);
		}
	
	
		Ext.getCmp('TabContent').setActiveTab('tab1');
		*/
		dsEstudiantes.on('load', function() {			
			var countRowsGrid = dsEstudiantes.getCount();    //Cuenta la cantidad de registros en el grid
			// verificamos la cantidad de registros
			if (countRowsGrid>0)
			{	
				// forzamos la seleccion del primer registro				
				grid.getSelectionModel().selectFirstRow();	
			}
		});

	
		dsEstudiantes.load({
			params: {
				start: 0,
				limit: 5		// limite de la paginación
			}
		});
				
	
		setTimeout(function(){
			Ext.get('loading').remove();
			Ext.get('loading-mask').fadeOut({remove:true});	
		}, 250);
	}	//Fin funcion LoadAndShowGrid
}//Fin del Script 


/**
 * Este metodo es llamado cuando el usario hace click en el boton de guardar.
 * El metodo valida primero si el formulario es valido para luego enviarlo al
 * servidor para salvar la informacion.
 * Si el formulario no es valido se lo hace saber al usuario. 
 * Maneja las respuestas desde el servidor si fue exitoso o fallo.
 * @param {ds} El dataStore. 
 * @return void
 */
Guardar = function (ds) {
    	
    var form = Ext.getCmp('form');	
	// Check if the form is valid. 
    if (form.form.isValid()) {	 		
		// If the form is valid, submit it.
		// To enable normal browser submission of the Ext Form contained in this 
		// FormPanel, override the submit method.
		form.getForm().submit({
			url: 'estudiantes.php?accion=Guardar',
			method: 'POST',
			waitTitle: ' ',
			waitMsg: 'Guardando...',
			success:submitSuccessful,
			failure: submitFailed
		});                  
	} else {
		// If the form is invalid.
		Ext.MessageBox.alert('Error Message', 'Por favor corriga los errrores señalados.');
	}    
    /**
     * The function to call when the response from the server was a successful
     * attempt (save in this case). The function is passed the following parameters:
     *
     * @param {Ext.form.BasicForm} form The form that requested the action.
     * @param {Ext.form.Action} action The Action class.
     * The result property of this object may be examined to perform custom postprocessing.
     *
     * A successful attempt (save in this case) response from the server will be:
     * {success: true, message: 'Success message to be displayed.'}
     */
    function submitSuccessful(form, action) {
    	var object = Ext.util.JSON.decode(action.response.responseText);

		// If the delete was successfully executed on server.
		if (object.success) {
			Ext.MessageBox.alert('Confirm', object.message);
			ds.reload();
		} else {
			Ext.MessageBox.alert('Error Message', object.message);
		}		
    }
    
    /**
     * The function to call when the response from the server was a failed 
     * attempt (save in this case), or when an error occurred in the Ajax 
     * communication. The function is passed the following parameters:
     * @param {Ext.form.BasicForm} form The form that requested the action.
     * @param {Ext.form.Action} action The Action class. 
     * If an Ajax error ocurred, the failure type will be in failureType. 
     * The result property of this object may be examined to perform custom postprocessing.
     * 
     * A failed attempt (save in this case) response from the server will be:
	 * {success: false, message: 'Failure message to be displayed.'}
	 * 
	 * A failed attempt (validation in this case) response from the server will be:
	 * {
	 *	 success: false,
	 *   errors: {
	 *	   "clientCode": "Client not found",
	 *     "phone": "This field must be in the format of xxx-xxx-xxxx"
	 *   },
	 *   message : 'Validation Errors, please fix the errors noted.'
	 * }
	 */
    function submitFailed(form, action) {
    	
    	var failureMessage = "Error occurred trying to save data.";
		
		// Failure type returned when no field values are returned in the 
		// response's data property or the successProperty value is false.
		if (action.failureType == Ext.form.Action.LOAD_FAILURE) {
			// Error on the server side will include an error message in 
			// the response.			
			alert(action.result.message);
			failureMessage = action.result.message;
		} 
		// Failure type returned when a communication error happens when 
		// attempting to send a request to the remote server.
		else if (action.failureType == Ext.form.Action.CONNECT_FAILURE) {
			
			// The XMLHttpRequest object containing the 
     		// response data. See http://www.w3.org/TR/XMLHttpRequest/ for 
     		// details about accessing elements of the response.
			failureMessage = "Please contact support with the following: " + 
				"Status: " + action.response.status + 
				", Status Text: " + action.response.statusText;
		}
		// Failure type returned when server side validation of the Form fails 
		// indicating that field-specific error messages have been returned in 
		// the response's errors property.
		else if (action.failureType == Ext.form.Action.SERVER_INVALID) {
			// Validation on the server side will include an error message in 
			// the response.
			failureMessage = action.result.message;
		}
		// Failure type returned when client side validation of the Form fails 
		// thus aborting a submit action.
		else if (action.failureType == Ext.form.Action.CLIENT_INVALID) {
			failureMessage = "Please fix any and all validation errors.";
		} 
		// Since none of the failure types handled the error, simply retrieve
		// the message off of the response. The response from the server on a 
		// failed submital (application error) is:
		// {success: false, message: 'Person was not saved successfully. Please try again.')
		else {
			failureMessage = action.result.message;		
		}
		
		Ext.MessageBox.alert('Error Message', failureMessage);
    }
}

/**
* Limpiar los controles del Formulario
* @return void
*/
Limpiar = function()
{
	Ext.getCmp('estudiantesid').reset();
	Ext.getCmp('ci_estudiante').reset();
	Ext.getCmp('nb_estudiante').reset();
	Ext.getCmp('tx_correo_particular').reset();
	Ext.getCmp('fe_nacimiento').reset();
	Ext.getCmp('tx_lugar_nacimiento').reset();
	Ext.getCmp('tlf_particular').reset();
	Ext.getCmp('dir_estudiante').reset();
	Ext.getCmp('tx_cargo').reset();
	Ext.getCmp('ci_estudiante').focus();
}

/**
* Elimina un registro seleccionado en el grid
* @param {ds} El dataStore.
* @param {grid} El grid donde se visualizan los datos del Store.
* @return void
*/

Eliminar = function(ds, grid) {

	// Devuelve el registro seleccionado en el grid
	var selectedItems = grid.selModel.getSelections();
    
    // Chequea si hay algun registro seleccionado
	if (selectedItems.length > 0) {
    	
    	Ext.MessageBox.confirm('Mensaje', 
			'Esta seguro de eliminar el registro?', 
    	    function(btn) {
	    	     
	    	     if (btn == 'yes') {	
					
					// Send a HTTP request to a remote server.
					// Important: Ajax server requests are asynchronous, and this 
					// call will return before the response has been recieved. 
					// Process any returned data in a callback function. 
					new Ext.data.Connection().request({
						url: 'estudiantes.php?accion=Eliminar',
						// Obtenemos el id del item seleccionado
						params: {id: selectedItems[0].id},
						failure: requestFailed,
						success: requestSuccessful
					});
					
					// Recargar los registros del cache desde el proxy a traves del JsonReader configurado.
					ds.reload();
			    }
		    } 
		);	
    }
    else
    {
    	Ext.MessageBox.alert('Error', 
    	    'To process delete action, please select at least one person to delete.'
    	);
    }
    
    /**
     * Handle a successful connection and http request to the server.
     * The response from the application may still be unsuccessful so
     * that needs to be checked.
     * @param {Object} response The XMLHttpRequest object containing the 
     * 		response data. See http://www.w3.org/TR/XMLHttpRequest/ for 
     *		details about accessing elements of the response.
     * @param {Object} options The parameter to the request call.
     */ 
    function requestSuccessful(response, options) {	
	
    	// Decodes (parses) a JSON string to an object. If the JSON is invalid, 
		// this function throws a SyntaxError.
		// The response text from the server is:
		// {success: true, message: 'Person was deleted successfully.'}
		// The object will contain two variables: success and message.
		var object = Ext.util.JSON.decode(response.responseText);
	
		// If the delete was successfully executed on server.
		if (object.success) {
			Ext.MessageBox.alert('Confirm', object.message);
		} else {
			Ext.MessageBox.alert('Error Message', object.message);
		}
		
    }
    
    /**
     * Handle an unsuccessful connection or http request to the server.
     * This has nothing to do with the response from the application.
     * @param {Object} response The XMLHttpRequest object containing the 
     * 		response data. See http://www.w3.org/TR/XMLHttpRequest/ for 
     *		details about accessing elements of the response.
     * @param {Object} options The parameter to the request call.
     */
    function requestFailed(response, options) {
    	// Devolvio error la peticion hecha al servidor.
		Ext.MessageBox.alert('Error Message', 
			"No se pudo borrar el Registro ");
    }
}

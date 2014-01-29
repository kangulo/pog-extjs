Ext.SSL_SECURE_URL  = '../extjs3.0/resources/images/default/s.gif';
Ext.BLANK_IMAGE_URL = '../extjs3.0/resources/images/default/s.gif';

Ext.onReady(function () {

    Ext.QuickTips.init();

    // Activar la validacion de errores en el lado del control
    Ext.form.Field.prototype.msgTarget = 'side';

    /* 
	*  JsonStore que provee los estados el cual llenara el Combo de Estados
	*  y se carga Automaticamente =>  autoLoad=true
	*/

    var estudiantesReader = new Ext.data.JsonReader({
        root: 'Estudiantes.datos',
        id: 'id',
        // Name of the property within a row object that contains a record identifier value.	
        successProperty: 'Estudiantes.exitoso',
        // Name of the property from which to retrieve the success attribute used by forms.
        totalProperty: 'Estudiantes.totalFilas'
		},
        [
			{
				name: 'co_estudiante',
				type: 'int',
				mapping: 'co_estudiante'
			},
			{
				name: 'nb_estudiante',
				type: 'string',
				mapping: 'nb_estudiante'
			},
			{
				name: 'ci_estudiante',
				type: 'string',
				mapping: 'ci_estudiante'
			},
			{
				name: 'co_estado',
				type: 'string',
				mapping: 'co_estado'
			},
			{
				name: 'tx_correo_particular',
				type: 'string',
				mapping: 'tx_correo_particular'
			},
			{
				name: 'tx_lugar_nacimiento',
				type: 'string',
				mapping: 'tx_lugar_nacimiento'
			},
			{
				name: 'fe_nacimiento',
				type: 'string',  // ojo formateo fecha
				mapping: 'fe_nacimiento'
			},
			{
				name: 'co_sexo',
				type: 'string',
				mapping: 'co_sexo'
			},
			{
				name: 'co_estado_civil',
				type: 'string',
				mapping: 'co_estado_civil'
			},
			{
				name: 'tlf_particular',
				type: 'string',
				mapping: 'tlf_particular'
			},
			{
				name: 'tlf_trabajo',
				type: 'string',
				mapping: 'tlf_trabajo'
			},
			{
				name: 'dir_estudiante',
				type: 'string',
				mapping: 'dir_estudiante'
			},
			{
				name: 'tx_correo_laboral',
				type: 'string',
				mapping: 'tx_correo_laboral'
			},
			{
				name: 'co_instituto',
				type: 'int', 
				mapping: 'co_instituto'
			},
			{
				name: 'co_grado_instruccion',
				type: 'int',
				mapping: 'co_grado_instruccion'
			},
			{
				name: 'tx_ano_graduacion',
				type: 'string',
				mapping: 'tx_ano_graduacion'
			},
			{
				name: 'co_mision',
				type: 'int',
				mapping: 'co_mision'
			},
			{
				name: 'co_profesion',
				type: 'int',
				mapping: 'co_profesion'
			},
			{
				name: 'co_pnf',
				type: 'int',
				mapping: 'co_pnf'
			},
			{
				name: 'co_gerencia',
				type: 'int',
				mapping: 'co_gerencia'
			},
			{
				name: 'tx_departamento',
				type: 'string',
				mapping: 'tx_departamento'
			},
			{
				name: 'tx_cargo',
				type: 'string',
				mapping: 'tx_cargo'
			},
			{
				name: 'tx_supervisor',
				type: 'string', 
				mapping: 'tx_supervisor'
			},
			{
				name: 'tx_supervisor_email',
				type: 'string',
				mapping: 'tx_supervisor_email'
			},
			{
				name: 'tx_oficina',
				type: 'string',
				mapping: 'tx_oficina'
			}
		]
    );

    var httpProxy = new Ext.data.HttpProxy({
        url: 'data/pnf.php?accion=getEstudiantes'
    });

    httpProxy.getConnection().on('requestexception', requestFailed);

    var dsEstudiantes = new Ext.data.Store({
        proxy: httpProxy,
        reader: estudiantesReader
    });

    // Fires if an exception occurs in the Proxy during data loading.
    // Called with the signature of the Proxy's "loadexception" event.
    // Handle any exception that may occur in the Proxy during data loading.
    dsEstudiantes.on('loadexception', loadFailed);

    // Fires after a new set of Records has been loaded successfully.
    dsEstudiantes.on('load', loadSuccessful);

    // Use a callback method to load and create the Grid.
    dsEstudiantes.load({
        params: {
            start: 0,
            limit: 5
        },
        callback: loadAndShowGrid
    });

    /* 
	*  JsonStore que provee los estados el cual llenara el Combo de Estados
	*  y se carga Automaticamente =>  autoLoad=true
	*/

    var dsEstados = new Ext.data.JsonStore({
        url: 'data/pnf.php?accion=getEstados',
        root: 'Estados',
        autoLoad: true,
        fields: [{
            name: 'co_estado',
            type: 'int'
        },
        {
            name: 'nb_estado',
            type: 'string'
        }]
    });
	
	/* 
	*  JsonStore que provee los estados el cual llenara el Combo de Institutos
	*  y se carga Automaticamente =>  autoLoad=true
	*/

    var dsInstitutos = new Ext.data.JsonStore({
        url: 'data/pnf.php?accion=getInstitutos',
        root: 'Institutos',
        autoLoad: true,
        fields: [{
            name: 'co_instituto',
            type: 'int'
        },
        {
            name: 'nb_instituto',
            type: 'string'
        }]
    });

	
	/* 
	*  JsonStore que provee los estados el cual llenara el Combo de Gerencias
	*  y se carga Automaticamente =>  autoLoad=true
	*/

    var dsGerencias = new Ext.data.JsonStore({
        url: 'data/pnf.php?accion=getGerencias',
        root: 'Gerencias',
        autoLoad: true,
        fields: [{
            name: 'co_gerencia',
            type: 'int'
        },
        {
            name: 'nb_gerencia',
            type: 'string'
        }]
    });
 
	/* 
	*  JsonStore que provee los estados el cual llenara el Combo de Grado Instruccion
	*  y se carga Automaticamente =>  autoLoad=true
	*/

    var dsGradoInstruccion = new Ext.data.JsonStore({
        url: 'data/pnf.php?accion=getGradoInstruccion',
        root: 'GradoInstruccion',   
		autoLoad: true,     
        fields: [{
            name: 'co_grado_instruccion',
            type: 'int'
        },
        {
            name: 'nb_grado_instruccion',
            type: 'string'
        }]
    });

	/* 
	*  JsonStore que provee los estados el cual llenara el Combo de Misiones
	*  y se carga Automaticamente =>  autoLoad=true
	*/

    var dsMisiones = new Ext.data.JsonStore({
        url: 'data/pnf.php?accion=getMisiones',
        root: 'Misiones',
        autoLoad: true,
        fields: [{
            name: 'co_mision',
            type: 'int'
        },
        {
            name: 'nb_mision',
            type: 'string'
        }]
    });
	
	/* 
	*  JsonStore que provee los estados el cual llenara el Combo de Misiones
	*  y se carga Automaticamente =>  autoLoad=true
	*/

    var dsProfesiones = new Ext.data.JsonStore({
        url: 'data/pnf.php?accion=getProfesiones',
        root: 'Profesiones',
        autoLoad: true,
        fields: [{
            name: 'co_profesion',
            type: 'int'
        },
        {
            name: 'nb_profesion',
            type: 'string'
        }]
    });

	/* 
	*  JsonStore que provee los estados el cual llenara el Combo de Grado Instruccion
	*  y se carga Automaticamente =>  autoLoad=true
	*/

    var dsPNF = new Ext.data.JsonStore({
        url: 'data/pnf.php?accion=getPNF',
        root: 'PNF',
        autoLoad: true,
        fields: [{
            name: 'co_pnf',
            type: 'int'
        },
        {
            name: 'nb_pnf',
            type: 'string'
        }]
    });
	
    // Combo de los Estados	
    var cmbEstados = new Ext.form.ComboBox({
        id: 'cmbEstados',
        fieldLabel: 'Estados',
		hiddenName: 'co_estado',
        valueField: 'co_estado',
        displayField: 'nb_estado',
        store: dsEstados,
        typeAhead: true,
        forceSelection: true,
        mode: 'local',
        triggerAction: 'all',
        emptyText: 'Seleccione un Estado...',
        width: 160
    });
	
	// Combo de los Estados	
    var cmbSexo = new Ext.form.ComboBox({
		id: 'cmbSexo',		
		name: 'cmbSexo',				
		fieldLabel: 'Sexo',
		hiddenName: 'co_sexo',
		valueField: 'co_sexo',
		store: new Ext.data.SimpleStore({
			fields: ['co_sexo', 'nb_sexo'],
			data: [
				['M', 'Masculino'],
				['F', 'Femenino']]
		}),
		mode: 'local',
		triggerAction: 'all',
		typeAhead: true,
		displayField: 'nb_sexo',
		emptyText: '(Seleccione)',
		width: 160
    });
	
	// Combo de los Estados	
    var cmbEdoCivil = new Ext.form.ComboBox({
		id: 'cmbEdoCivil',
		name: 'cmbEdoCivil',
		fieldLabel: 'Edo. Civils',
		hiddenName:'co_estado_civil',		
		valueField: 'co_estado_civil',
		store: new Ext.data.SimpleStore({
			fields: ['co_estado_civil', 'nb_estado_civil'],
			data: [
				['S', 'Soltero(a)'],
				['C', 'Casado(a)'],
				['D', 'Divorciado(a)']]
		}),		
		mode: 'local',
		triggerAction: 'all',
		typeAhead: true,
		displayField: 'nb_estado_civil',		
		emptyText: '(Seleccione)',
		width: 180
    });
	
	Ext.reg('comboadd',Ext.ux.form.ComboBoxAdd);
	
	var cmbInstituto = new Ext.ux.form.ComboBoxAdd({		                           								
		id: 'cmbInstituto',
		name: 'cmbInstituto',
		hiddenName: 'co_instituto',  
		valueField:	'co_instituto',
		fieldLabel: 'Universidad o Instituto de Procedencia',                              
		mode: 'local',
		triggerAction: 'all',
		store: dsInstitutos,
		displayField: 'nb_instituto',
		emptyText: '(Seleccione)',
		width: 235,
		listWidth: 250
	});
	
	var cmbProfesion = new Ext.form.ComboBox({		                           								
		id: 'cmbProfesion',
		name: 'cmbProfesion',
		hiddenName: 'co_profesion',  
		valueField:	'co_profesion',
		fieldLabel: 'Profesion',                              
		mode: 'local',
		triggerAction: 'all',
		store: dsProfesiones,
		displayField: 'nb_profesion',
		emptyText: '(Seleccione)',
		width: 235,
		listWidth: 250
	});
	
	
	var cmbMision = new Ext.ux.form.ComboBoxAdd({
		id: 'cmbMision',
		name: 'cmbMision',
		fieldLabel: 'Participo en alguna Mision de Educacion?',
		hiddenName: 'co_mision',
		valueField:	'co_mision',
		mode: 'local',
		triggerAction: 'all',
		store: dsMisiones,
		displayField: 'nb_mision',
		emptyText: '(Seleccione)',
		listWidth: 250,
		width: 235
	});

    // listen to 2nd trigger via "add" event
	cmbInstituto.on('add', function(ev) {
		// create the window on the first click and reuse on subsequent clicks   // <-- you might show a form on a dialog here
        Ext.MessageBox.prompt('Name', 'Please enter your name:', showResultText);
	});
	
	function showResultText(btn, text){
        alert(text);
    };

    var pnlFoto = new Ext.Panel({
		id     : 'pnlFoto',		
		bodyStyle: 'padding:5px 0px 0 100px',
		width  : 125,
		height : 145,
		html   : '<div class="shadow"><img  src="images/fotos/++resource++foto-faltante.png" id="foto" width="90px" height="88px" border="2" alt="No hay imagen" /></div>',
		buttons: [{
                    id: 'btnSubir',
                    text: 'Foto...',
                    disabled: false
                    //handler: guardar					
                }]
	});
    
    /**
     * Handle the occurrence of an error HTTP status that was returned from the server. 
     * See HTTP Status Code Definitions for details of HTTP status codes.
     * @param {Ext.data.Connection} connection The Connection object.
     * @param {Object} response The XHR object containing the response data. 
     *		See http://www.w3.org/TR/XMLHttpRequest/ for details about accessing elements
     *		of the response.
     * @param {Object} options The options config object passed to the request method.
     */
    function requestFailed(connection, response, options) {

        Ext.MessageBox.alert('Error Message', "Please contact support with the following: " + "Status: " + response.status + ", Status Text: " + response.statusText);
    }

    /**
     * Handle the occurrence of an exception that occurs in the Proxy during data 
     * loading. This event can be fired for one of two reasons:
     * The load call returned success: false. This means the server logic returned
     * a failure status and there is no data to read. In this case, this event will
     * be raised and the fourth parameter (read error) will be null.
     * The load succeeded but the reader could not read the response. This means the
     * server returned data, but the configured Reader threw an error while reading 
     * the data. In this case, this event will be raised and the caught error will be 
     * passed along as the fourth parameter of this event.
     * @param {Object} proxy The HttpProxy object.
     * @param {Object) options The loading options that were specified (see load for details).
     * @param {Object} response The XMLHttpRequest object containing the response data.
     *		See http://www.w3.org/TR/XMLHttpRequest/ for details about accessing elements
     *		of the response.
     * @param {Error} error The JavaScript Error object caught if the configured Reader
     * could not read the data. If the load call returned success: false, this parameter
     * will be null.pagingToolbar
     */
    function loadFailed(proxy, options, response, error) {

        // Decodes (parses) a JSON string to an object. If the JSON is invalid, 
        // this function throws a SyntaxError.
        var object = Ext.util.JSON.decode(response.responseText);

        var errorMessage = "Error loading data.";

        // If the load from the server was successful and this method was called then
        // the reader could not read the response.				
        if (object.Estudiantes.exitoso) {
            errorMessage = "The data returned from the server is in the wrong format. " + "Please notify support with the following information: " + response.responseText;
        } else {
            // Error on the server side will include an error message in 
            // the response.
            errorMessage = object.Estudiantes.mensaje;
        }

        Ext.MessageBox.alert('Error Message', errorMessage);
    }

    /**
     * Handle the occurrence of new set of Records have been loaded successfully.
     * @param {Store} store Store instance.
     * @param {Ext.data.Record[]} recordArray The Records that were loaded.
     * @param {Object} options The loading options that were specified (see load for details).
     */
    function loadSuccessful(store, recordArray, options) {

        // After any data loads, the raw JSON data is available for further 
        // custom processing. If no data is loaded or there is a load exception
        // this property will be undefined.
        // Ext.MessageBox.alert('Confirm', personReader.jsonData.persona.mensaje);	
    }
	
	function limpiar(){				
		//// Datos Personales
		Ext.getCmp('ci_estudiante').reset();
		Ext.getCmp('nb_estudiante').reset();		
		Ext.getCmp('cmbSexo').clearValue();
		Ext.getCmp('cmbEdoCivil').reset();
		Ext.getCmp('tx_correo_particular').reset();
		Ext.getCmp('tlf_particular').reset();
		Ext.getCmp('cmbEstados').clearValue();
		Ext.getCmp('tx_lugar_nacimiento').reset();
		Ext.getCmp('fe_nacimiento').reset();
		Ext.getCmp('dir_estudiante').reset();
		//// Datos Laborales
		Ext.getCmp('tx_cargo').reset();
		Ext.getCmp('cmbGerencia').clearValue();
		
		Ext.getCmp('tx_departamento').setValue('fnhv');
		Ext.getCmp('tx_oficina').reset();	
		Ext.getCmp('tx_correo_laboral').reset();
		Ext.getCmp('tlf_trabajo').reset();
		Ext.getCmp('tx_supervisor').reset();
		Ext.getCmp('tx_supervisor_email').reset();
		//// Datos Academicos				
		
		
		
		Ext.getCmp('tx_ano_graduacion').reset();		
		Ext.getCmp('cmbMision').clearValue();
		Ext.getCmp('cmbProfesion').clearValue();
		Ext.getCmp('cmbPNF').clearValue();
		
		Ext.getCmp('cmbGradoInstruccion').clearValue();
		Ext.getCmp('cmbInstituto').clearValue();
		//Ext.getCmp('TabContent').load(['tabDatosPersonales','tabDatosAcademicos','tabDatosAcademicos']);
		
	}
	/***********************************************
	* generaFoto	: Permite formatear el numero de la cedula de la persona
	*				  para obtener su foto desde el servidor
	* cedula	 	: String con la cedula ej:   12345678
	* return 		: devuelve 			   ej: 0012345678
	***********************************************/

	function generaFoto(cedula)
	{
		var r = '000000000' + cedula;
		return r.substring(r.length,r.length-9) + ".jpg";
	}

    /** 
     * A callback method that is called when the data is returned from the
     * Store (personDataStore) load() method call. This method is called
     * after the Records have been loaded.
     *  
     * Create and display the grid with the data in the datastore. Set any
     * events on the grid.
     *  
     * The callback is passed the following arguments:
     * @param {Ext.data.Record[]} recordArray An array of Ext.data.Record objects
     *		loaded by the Ext.data.JsonReader that was received by the server.
     * @param {Object} options Options object from the load call.
     * @param {Boolean} success Boolean success indicator from the server. The
     * 		value is set on the JsonReader's successProperty.
     */

    function loadAndShowGrid(recordArray, options, success) {

        var estudianteColumnModel = new Ext.grid.ColumnModel([
        // This is a utility class that can be passed into a Ext.grid.ColumnModel 
        // as a column config that provides an automatic row numbering column.
        new Ext.grid.RowNumberer(), {
            id: 'id',
            header: "Id",
            dataIndex: 'co_estudiante',
            width: 50,
            hidden: true
        },
        {
            header: "Cedula",
            width: 30,
            sortable: true,
            dataIndex: 'ci_estudiante'
        },
        {
            header: "Nombres",
            width: 100,
            sortable: true,
            dataIndex: 'nb_estudiante'
        }]);

        // Add a paging toolbar to the grid's footer.  
        var pagingToolbar = new Ext.PagingToolbar({
            pageSize: 5,
            displayInfo: true,
            displayMsg: 'Un total de {2} registros encontrados. Actualmente mostrando {0} - {1}',
            emptyMsg: "No se encontraron registros",
            store: dsEstudiantes
        });
		
	var gridForm = new Ext.FormPanel({
            id: 'frmEstudiante',
            frame: true,
            labelAlign: 'left',
            title: 'Estudiantes',
            //bodyStyle: 'padding:5px',
            //width: 750,
            autoHeight: true,
            layout: 'column',
            // Specifies that the items will now be arranged in columns
            items: [{
                columnWidth: 0.4,
                layout: 'fit',						
                bodyStyle: 'padding:0 10px 0 0px',
                items: {
                    xtype: 'grid',					
                    store: dsEstudiantes,
                    cm: estudianteColumnModel,
                    sm: new Ext.grid.RowSelectionModel({
                        singleSelect: true,
                        listeners: {
                            rowselect: function (sm, row, rec) {
                                Ext.getCmp("frmEstudiante").getForm().loadRecord(rec);	
								//alert(2);								
								//Ext.cmbSexo.(rec.get('tx_sexo'));
								//Ext.getCmp('cmbSexo').setValue(rec.get('co_sexo'));
								//Ext.getCmp('cmbEdoCivil').setValue(rec.get('co_estado_civil'));
								//Ext.getCmp('cmbMision').setValue(rec.get('co_mision'));
								Ext.get('foto').dom.src = 'http://ccschu14.pdvsa.com/PHOTOS/'+generaFoto(rec.get('ci_estudiante'))+'';
                            }
                        }
                    }),
                    viewConfig: {
                        forceFit: true
                    },
                    //autoExpandColumn: 'nb_estudiante',
                    height: 350,
                    border: true,
                    listeners: {
                        render: function (g) {
                            g.getSelectionModel().selectRow(0);
                        },
                        delay: 10 // Allow rows to be rendered.
                    }
                }
            },
            {
                columnWidth: 0.6,
                bodyStyle: Ext.isIE ? 'padding:0 0 5px 15px;' : 'padding:10px 15px;',
                xtype: 'tabpanel',
				id: 'TabContent',
                plain: true,
                activeTab: 0,
				forceLayout: true,
                //deferredRender:false,
				//layoutOnTabChange:true,
                height: 400,

                items: [{
                    title: 'Datos Personales',
					id: 'tab1',
                    layout: 'column',
                    labelAlign: 'top',
                    labelWidth: 60,
                    defaults: {
                        width: 230
                    },                    
                    items: [{
                            columnWidth: .30,
                            layout: 'form',
                            labelWidth: 46,
                            border: false,
                            items: [{
                                xtype: 'textfield',
                                fieldLabel: 'Cedula',
                                id: 'ci_estudiante',
                                name: 'ci_estudiante',
                                allowBlank: true,
                                maskRe: /^[0-9]$/,
                                width: 160,
                                //readOnly: true,
                                listeners: {
                                    blur: function () {
                                        if (document.getElementById('ci_estudiante').value != '') {
                                            var mascara = new Ext.LoadMask(Ext.get('frmEstudiante'), {
                                                msg: "Por favor Espere..."
                                            });
                                            mascara.show();
                                            Ext.Ajax.request({
                                                waitMsg: 'Procesando ...',
                                                url: 'data/matsed16.php',
                                                params: {
                                                    co_cedula: document.getElementById('ci_estudiante').value
                                                },
                                                callback: function (options, success, response) {
                                                    var json = Ext.util.JSON.decode(response.responseText);                                                    
													document.getElementById('foto').src = 'http://ccschu14.pdvsa.com/PHOTOS/'+generaFoto(json.ci_estudiante)+'';
													Ext.getCmp("nb_estudiante").setValue(json.nb_estudiante);
                                                    mascara.hide();
                                                }
                                            });
                                        }
                                    }
                                },
                                validator: function (value) {
                                    if (value.length > 8) {
                                        this.setValue(value.substr(0, 8));
                                    }
                                    return true;
                                }
                            },cmbSexo,{
                                xtype: 'textfield',
                                fieldLabel: 'Correo Electronico',
                                id: 'tx_correo_particular',
                                name: 'tx_correo_particular',
                                allowBlank: true,
                                width: 160
                            },
                            cmbEstados]
                        },
                        {
                            columnWidth: .4,
                            layout: 'form',
                            labelWidth: 50,
                            border: false,
                            items: [{
                                xtype: 'textfield',
                                fieldLabel: 'Nombres',
                                id: 'nb_estudiante',
                                name: 'nb_estudiante',
                                allowBlank: true,
                                width: 250
                            },
							cmbEdoCivil,
                            {
                                xtype: 'textfield',
                                fieldLabel: 'Telefono',
                                id: 'tlf_particular',
                                name: 'tlf_particular',
                                allowBlank: true,
                                width: 180
                            },
							{
                                xtype: 'textfield',
                                fieldLabel: 'Lugar de Nacimiento',
                                id: 'tx_lugar_nacimiento',
                                name: 'tx_lugar_nacimiento',
                                allowBlank: true,
                                width: 250
                            }]
                        },
                        {
                            columnWidth: .30,
                            layout: 'form',
                            border: false,
                            items: [pnlFoto,{
                                xtype: 'datefield',
                                fieldLabel: 'Fecha Nac.',
                                allowBlank: true,
                                id: 'fe_nacimiento',
                                name: 'fe_nacimiento',
                                width: 160
                            }]
                        },
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
                        }]
                },
                { 
					title: 'Datos Laborales',
					id: 'tab2',
                    layout: 'column',
                    labelAlign: 'top',
                    labelWidth: 60,
                    defaults: {
                        width: 230
                    },
                    //defaultType: 'textfield',
                    items: [{
                            columnWidth: .5,
                            layout: 'form',
                            //labelWidth: 46,
                            border: false,
                            items: [{
                                xtype: 'combo',
                                id: 'cmbGerencia',
                                name: 'cmbGerencia',
								valueField: 'co_gerencia',
								hiddenName: 'co_gerencia',
                                fieldLabel: 'Gerencia',
                                mode: 'local',
                                triggerAction: 'all',
                                store: dsGerencias,
                                displayField: 'nb_gerencia',
                                emptyText: '(Seleccione)',
								listWidth: 250,
                                width: 235
                            },
                            {
                                xtype: 'textfield',
                                fieldLabel: 'Departamento',
                                id: 'tx_departamento',
                                name: 'tx_departamento',
                                allowBlank: true,
                                width: 250
                            },
							{
                                xtype: 'textfield',
                                fieldLabel: 'Correo Laboral',
                                id: 'tx_correo_laboral',
                                name: 'tx_correo_laboral',
                                allowBlank: true,
                                width: 250
                            },
							{
                                xtype: 'textfield',
                                fieldLabel: 'Nombre Supervisor',
                                id: 'tx_supervisor',
                                name: 'tx_supervisor',
                                allowBlank: true,
                                width: 250
                            }]
                        },
                        {
                            columnWidth: .5,
                            layout: 'form',
                            labelWidth: 50,
                            border: false,
                            items: [{
                                xtype: 'textfield',
                                fieldLabel: 'Cargo',
                                id: 'tx_cargo',
                                name: 'tx_cargo',
                                allowBlank: true,
                                width: 250
                            },
							{
                                xtype: 'textfield',
                                fieldLabel: 'Oficina',
                                id: 'tx_oficina',
                                name: 'tx_oficina',
                                allowBlank: true,
                                width: 250
                            },
							{
                                xtype: 'textfield',
                                fieldLabel: 'Telefono',
                                id: 'tlf_trabajo',
                                name: 'tlf_trabajo',
                                allowBlank: true,
                                width: 250
                            },
							{
                                xtype: 'textfield',
                                fieldLabel: 'Email Supervisor',
                                id: 'tx_supervisor_email',
                                name: 'tx_supervisor_email',
                                allowBlank: true,
                                width: 250
                            }]
                        }]
                },
                {
                    title: 'Datos Academicos',
					id: 'tab3',
                    layout: 'column',
                    labelAlign: 'top',
                    labelWidth: 60,
                    defaults: {
                        width: 230
                    },                    
                    items: [{
                            columnWidth: 1,
                            layout: 'form',
                            //labelWidth: 46,
                            border: false,
                            items: [cmbInstituto,{
                                xtype: 'combo',
                                id: 'cmbGradoInstruccion',
                                name: 'cmbGradoInstruccion',
								hiddenName: 'co_grado_instruccion',
								valueField: 'co_grado_instruccion',
                                fieldLabel: 'Grado de Instruccion',
                                mode: 'local',
                                triggerAction: 'all',
                                store: dsGradoInstruccion,
                                displayField: 'nb_grado_instruccion',
                                emptyText: '(Seleccione)',
								width: 235,
								listWidth: 250
                            },{
                                xtype: 'textfield',
                                fieldLabel: 'Ano de Graduacion',
                                id: 'tx_ano_graduacion',
                                name: 'tx_ano_graduacion',
                                allowBlank: true,
                                width: 100
                            },
							{
								xtype: 'combo',
								id: 'cmbProfesion',
								name: 'cmbProfesion',
								hiddenName: 'co_profesion',  
								valueField:	'co_profesion',
								fieldLabel: 'Profesion',                              
								mode: 'local',
								triggerAction: 'all',
								store: dsProfesiones,
								displayField: 'nb_profesion',
								emptyText: '(Seleccione)',
								width: 235,
								listWidth: 250
							},
							cmbMision,
							{
                                xtype: 'combo',
                                id: 'cmbPNF',
                                name: 'cmbPNF',
								valueField: 'co_pnf',
								hiddenName: 'co_pnf',
                                fieldLabel: 'Programa Nacional de Formación elegido?',								
                                mode: 'local',
                                triggerAction: 'all',
                                store: dsPNF,
                                displayField: 'nb_pnf',
                                emptyText: '(Seleccione)',
								listWidth: 250,
                                width: 235
                            }]
                        }]
                }],
                buttons: [{
                    id: 'btnAgregar',
                    text: 'Agregar',
                    disabled: false,
                    handler: limpiar					
                },
                {
                    id: 'btnGuardar',
                    text: 'Guardar',
                    disabled: false
                    //handler: guardar					
                },
                {
                    id: 'btnEliminar',
                    text: 'Eliminar',
                    disabled: false
                    //handler: guardar
                }]
            }],
            bbar: pagingToolbar
			/*
			tbar: [
            'Buscar: ', ' ',
			],
			*/
            //renderTo: Ext.getBody()

        });

                  
gridForm.render(Ext.getBody());
   
for (i=3; i>0; i--){
        Ext.getCmp("TabContent").setActiveTab('tab'+i);

    }

Ext.getCmp("TabContent").setActiveTab('tab1');
        dsEstudiantes.load({
            params: {
                start: 0,
                limit: 5
            }
        });

setTimeout(function(){
        Ext.get('loading').remove();
        Ext.get('loading-mask').fadeOut({remove:true});
	
    }, 250);


    }



});

<?php
include_once("configuration.php");
include_once("class.database.php");
include_once("class.estudiantes.php");
require_once "../plugin_factory/plugin.getjson.php";
//require_once "../plugin_factory/plugin.setjson.php";

$accion = (isset($_POST['accion']) ? $_POST['accion'] : $_GET['accion']);
    
switch ($accion) 
{
	case 'Listar':
	{
		Listar();
		break;
	}
	case 'Get':
	{    
		Get();
		break;
	}
	case 'Guardar':
	{    
		Guardar();
		break;
	}
	case 'Eliminar':
	{    
		Eliminar();
		break;
	}
	case 'DeleteList':
	{    
		DeleteList();
		break;
	}
	break;
}

function Guardar()
{
	$estudiantes = new Estudiantes();
	$estudiantes->estudiantesId = (isset($_POST['estudiantesid']) ? $_POST['estudiantesid'] : $_GET['estudiantesid']);
	$estudiantes->ci_estudiante = (isset($_POST['ci_estudiante']) ? $_POST['ci_estudiante'] : $_GET['ci_estudiante']);
	$estudiantes->nb_estudiante = (isset($_POST['nb_estudiante']) ? $_POST['nb_estudiante'] : $_GET['nb_estudiante']);
	$estudiantes->tx_correo_particular = (isset($_POST['tx_correo_particular']) ? $_POST['tx_correo_particular'] : $_GET['tx_correo_particular']);
	$estudiantes->fe_nacimiento = (isset($_POST['fe_nacimiento']) ? $_POST['fe_nacimiento'] : $_GET['fe_nacimiento']);
	$estudiantes->tx_lugar_nacimiento = (isset($_POST['tx_lugar_nacimiento']) ? $_POST['tx_lugar_nacimiento'] : $_GET['tx_lugar_nacimiento']);
	$estudiantes->tlf_particular = (isset($_POST['tlf_particular']) ? $_POST['tlf_particular'] : $_GET['tlf_particular']);
	$estudiantes->dir_estudiante = (isset($_POST['dir_estudiante']) ? $_POST['dir_estudiante'] : $_GET['dir_estudiante']);
	$estudiantes->tx_cargo = (isset($_POST['tx_cargo']) ? $_POST['tx_cargo'] : $_GET['tx_cargo']);	
	if ($estudiantes->Save())
	{
		$result['message']    = 'Personas cargadas Exitosamente!';
		$result['success']    = true;		
		//$estudiantes->GetJSON(array(array("EstudiantesId", ">", 0)), "EstudiantesId", false);
	}
	else
	{
		$result['message']    = 'Error al Intentar guardar la Informacion.';
		$result['success']    = false;		
	}
	$response = json_encode($result);
	print $response;
}

function Listar()
{
	$start = (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
	$limit = (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);
	
	// Esto obtiene el array de filtros
	$filters = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : null;

	// GridFilters sends filters as an Array if not json encoded
	if (is_array($filters)) {
		$encoded = false;
	} else {
		$encoded = true;
		$filters = json_decode($filters);
	}

	// initialize variables
	$where = ' 0 = 0 ';
	$qs = '';
	
	// kk	
	$qk = '';
	$params = array();
	$params[] = array('EstudiantesId', '>', 0);
	

	// loop through filters sent by client
	if (is_array($filters)) {
		for ($i=0;$i<count($filters);$i++){
			$filter = $filters[$i];

			// assign filter data (location depends if encoded or not)
			if ($encoded) {
				$field = $filter->field;
				$value = $filter->value;
				$compare = isset($filter->comparison) ? $filter->comparison : null;
				$filterType = $filter->type;
			} else {
				$field = $filter['field'];
				$value = $filter['data']['value'];
				$compare = isset($filter['data']['comparison']) ? $filter['data']['comparison'] : null;
				$filterType = $filter['data']['type'];
			}

			switch($filterType){
				case 'string' : 
					$qs .= " AND ".$field." LIKE '%".$value."%'"; 
					$qk .= " ,array(".$field.", 'LIKE', '%".$value."%')";
					$params[] = array($field, 'LIKE', "%$value%"); 
					Break;
				case 'list' :
					if (strstr($value,',')){
						$fi = explode(',',$value);
						for ($q=0;$q<count($fi);$q++){
							$fi[$q] = "'".$fi[$q]."'";
						}
						$value = implode(',',$fi);
						$qs .= " AND ".$field." IN (".$value.")";
						$qk .= " ,array(".$field.", 'IN', (".$value."))";
						$params[] = array($field, 'IN', (".$value."));
					}else{
						$qs .= " AND ".$field." = '".$value."'";
						$qk .= " ,array(".$field.", '=', ".$value.")";
						$params[] = array($field, '=', $value);
					}
					Break;
				case 'boolean' : 
					$qs .= " AND ".$field." = ".($value); 
					$qk .= " ,array(".$field.", '=', ".($value).")";
					$params[] = array($field, '=', ($value));
					Break;
				case 'numeric' :
					switch ($compare) {
						case 'eq' : 
							$qs .= " AND ".$field." = ".$value; 
							$qk .= " ,array(".$field.", '=', ".$value.")";
							$params[] = array($field, '=', $value);
							Break;
						case 'lt' : 
							$qs .= " AND ".$field." < ".$value; 
							$qk .= " ,array(".$field.", '<', ".$value.")";
							$params[] = array($field, '<', $value);
							Break;
						case 'gt' : 
							$qs .= " AND ".$field." > ".$value; 
							$qk .= " ,array(".$field.", '>', ".$value.")";
							$params[] = array($field, '>', $value);
							Break;
					}
				Break;
				case 'date' :
					switch ($compare) {
						case 'eq' : 
							$qs .= " AND ".$field." = '".date('Y-m-d',strtotime($value))."'"; 
							$qk .= " ,array(".$field.", '=', '".date('Y-m-d',strtotime($value))."')";
							$params[] = array($field, '=', date('Y-m-d',strtotime($value)));
							Break;
						case 'lt' : 
							$qs .= " AND ".$field." < '".date('Y-m-d',strtotime($value))."'"; 
							$qk .= " ,array(".$field.", '<', '".date('Y-m-d',strtotime($value))."')";
							$params[] = array($field, '<', date('Y-m-d',strtotime($value)));
							Break;
						case 'gt' : 
							$qs .= " AND ".$field." > '".date('Y-m-d',strtotime($value))."'"; 
							$qk .= " ,array(".$field.", '>', '".date('Y-m-d',strtotime($value))."')";
							$params[] = array($field, '>', date('Y-m-d',strtotime($value)));
							Break;
					}
				Break;
			}
		}
		$where .= $qs;		
	}
		
	$Estudiantes = new Estudiantes();	
	//print_r($params);	
	print $Estudiantes->GetJSON($params, 
								'EstudiantesId', 
								true, 
								"$start,$limit"
								);
}

function Eliminar()
{
	$estudiantes = new Estudiantes();
	$estudiantes->estudiantesId = (isset($_POST['id']) ? $_POST['id'] : $_GET['id']);
	//$EstudiantesList = $Estudiantes->GetList(array(array("EstudiantesId", ">", 0)), "EstudiantesId", false, 5);	
	//print $Estudiantes->GetJSON(array(array("EstudiantesId", ">", 0)), "EstudiantesId", true, "$start,$limit");
	if ($estudiantes->Delete())
	{
		$result['message']    = 'El Registro ha sido Eliminado!';
		$result['success']    = true;
		$result['totalFilas'] = $estudiantes->estudiantesId;	
	}
	else	
	{
		$result['message']    = 'Error al Intentar eliminar.';
		$result['success']    = false;
	}
	$response = json_encode($result);
	print $response;
}
?>

<?php
include_once("configuration.php");
include_once("class.database.php");
include_once("class.propietario.php");
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
	$propietario = new propietario();
	$propietario->cedula = (isset($_POST['cedula']) ? $_POST['cedula'] : $_GET['cedula']);
	$propietario->nombre = (isset($_POST['nombre']) ? $_POST['nombre'] : $_GET['nombre']);
	$propietario->telefono = (isset($_POST['telefono']) ? $_POST['telefono'] : $_GET['telefono']);
	$propietario->fax = (isset($_POST['fax']) ? $_POST['fax'] : $_GET['fax']);
	$propietario->email = (isset($_POST['email']) ? $_POST['email'] : $_GET['email']);	
	$propietario->rol = (isset($_POST['rol']) ? $_POST['rol'] : $_GET['rol']);	
	$propietario->clave = (isset($_POST['clave']) ? $_POST['clave'] : $_GET['clave']);	
	if ($propietario->Save())
	{
		$result['message']    = 'Personas cargadas Exitosamente!';
		$result['success']    = true;		
		//$propietario->GetJSON(array(array("id_propietario", ">", 0)), "id_propietario", false);
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
	$params[] = array('cedula', '>', 0);
	

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
		
	$propietario = new propietario();	
	//print_r($params);	
	print $propietario->GetJSON($params, 
								'cedula', 
								true, 
								"$start,$limit"
								);
}

function Eliminar()
{
	$propietario = new propietario();
	$propietario->cedula = (isset($_POST['id']) ? $_POST['id'] : $_GET['id']);
	//$propietarioList = $propietario->GetList(array(array("cedula", ">", 0)), "cedula", false, 5);	
	//print $propietario->GetJSON(array(array("cedula", ">", 0)), "cedula", true, "$start,$limit");
	if ($propietario->Delete())
	{
		$result['message']    = 'El Registro ha sido Eliminado!';
		$result['success']    = true;
		$result['totalFilas'] = $propietario->cedula;	
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

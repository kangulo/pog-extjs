<?php
/*
	include_once("configuration.php");
	include_once("class.database.php");
	include_once("class.estudiantes.php");
	require_once "../plugin_factory/plugin.getjson.php";
	$Estudiantes = new Estudiantes();
	
	//$EstudiantesList = $Estudiantes->GetList(array(array("EstudiantesId", ">", 0)), "EstudiantesId", false, 5);	
	//print $Estudiantes->GetJSON(array(array("EstudiantesId", ">", 0)), "EstudiantesId", true, "$start,$limit");
	$a = $Estudiantes->GetJSON(array(
									array("EstudiantesId", ">", 0),
									array("nb_estudiante", "like", "%ez%"),
									array("OR"),
									array("nb_estudiante", "like", "%er%")
									), 
								"EstudiantesId", 
								true, 
								"0,5"
								);
*/
	require_once "class.objectextjs3.0.php";
	$object = new ObjectExtjs("persona");
	$object->Debug();
	$a = $object->string;
?>
<textarea cols="200" rows="30"><?php echo $a;?></textarea>

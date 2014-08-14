<?php 

function recordset_to_xml($arr){

	$salida =  '<?xml version="1.0" ?>'."\n";
	$salida .= "<consulta>";
	for ($c = 0; $c < count($arr); $c++){
		foreach($arr as $campo => $valor){
			$salida .= "<registro>";
			$salida .= "<campo>".$campo."</campo>";
			$salida .= "<valor>".$valor."</valor>";
			$salida .= "</registro>";
		}
		$salida .= "</consulta>";
	}
	return $salida;

}

?>
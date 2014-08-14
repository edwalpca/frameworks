<?php

	
	function valid_field($field){
		$retorno = str_replace(' ','_',$field);
		return $retorno;
	}
	
	function recordset_to_xml($arr){

		// $salida =  '< ? xml version="1.0" encoding="utf-8" ? >'."\n";
		$salida .= "<consulta>";
		for ($c = 0; $c < count($arr); $c++){

			$salida .= "<registro>";

			foreach($arr[$c] as $campo => $valor){
				$salida .= "<".valid_field($campo).">".$valor."</".valid_field($campo).">";
			}

			$salida .= "</registro>";
		}
		$salida .= "</consulta>";
		
		return $salida;
	
	}


?>
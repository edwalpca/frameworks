/*
Parámetros:
   0. Nombre de la llave primaria de la tabla
	 1. Nombre del campos de detalle
	 2. Nombre de la tabla
	 3. Filtro de la sentencia de datos
*/

SELECT 
			 {$param[0]} as id, 
			 {$param[1]} as valor 
FROM 
		 {$param[2]}
{$param[3]}
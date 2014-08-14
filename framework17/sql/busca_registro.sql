/*
Parámetros:
   0. Nombre de la tabla
	1. Nombre de la llave primaria de la tabla
	2. Valor a localizar en base a la llave primaria
*/

SELECT 
       * 
FROM 
       {$param[0]} 
WHERE 
       {$param[1]} = '{$param[2]}' 

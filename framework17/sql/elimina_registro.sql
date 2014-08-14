/*
Parámetros:
0 = Nombre de la tabla
1 = Nombre del campo de Llave primaria
2 = ID del registro a eliminar
*/

DELETE FROM
			{$param[0]}
WHERE
		 {$param[1]} = '{$param[2]}' 
LIMIT
		 1
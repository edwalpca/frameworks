<?php
# La siguiente libreria carga como constantes de la aplicacion, las variables declaradas como parametros en
# la tabla llamada parametros.
# Si la Tabla no existe en la base de datos
# la crea y carga el sistema con las variable predeterminadas.
# Autor: Edwin Mauricio Alpizar Castro.
# ealpizar@cyberfuel.com

 class_builder("parametros");
 $obj_parametros = new class_parametros();
 #$obj_parametros->view_class();
 $a_parametros = $obj_parametros->sql_get_list_data();
 # Para visualizar el orden de los parametro descomentar la siguiente linea.
 # ----------------------------------
 #ver_variable($a_parametros);
  while (list($indice,$valor) = each($a_parametros)){
    define($valor[nombre],$valor[valor]);
  }
 # ----------------------------------
 ?>
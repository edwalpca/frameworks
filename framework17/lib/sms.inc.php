<?php


	function enviar_sms($numero,$mensaje){

		$GATEWAY = CONFIG_SMS_GATEWAY;
		$GATEWAY_PORT = CONFIG_SMS_GATEWAY_PORT;
		$txt_sms_msg_salida = urlencode($mensaje);
		$txt_sms_phone = urlencode($numero);
	
		$fpgw = @fsockopen("$GATEWAY", $GATEWAY_PORT, $errno, $errstr, 1);
		if (!$fpgw) {    // Connection exist.
		   echo "Problemas con la conexion con el Gateway SMS";
		   exit;
		}else{
				$fpgw = fopen("http://$GATEWAY:$GATEWAY_PORT/?PhoneNumber=$txt_sms_phone&Text=$txt_sms_msg_salida", "r");
		}// if

	} // function
?>
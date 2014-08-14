<?php

# Parámetros
# ==========

$tabla = 'noticias';
$prefijo = "frm_";

# Variable para recibir parámetros externos

if($_FILES['frm_foto']['name']!=''){ 
    $file = new FileUpload(); 
    $file->SetFileType(".jpg"); 
	$file->SetFileType(".gif"); 
    //echo "Allowable File Types: " . $file->GetFileTypes() . "<br>"; 
    $file->SetBadFileType(".png"); 
    //echo "Unacceptable File Types: " . $file->GetBadFileTypes() . "<br>"; 
    $file->SetMaxFileSize("1000000"); 
    $file->UploadFile("frm_foto", "images/noticias/",""); 
	//echo "FileSize: " . $file->GetFileSize() . "<br>"; 
    //echo "Extension: " . $file->GetExtension() . "<br>"; 
    //echo "Filename: " . $file->GetFilename() . "<br>"; 
    //echo "Error: " . $file->GetError() . "<br>"; 
	$frm_foto_principal = $_POST["frm_foto_principal"] = $file->GetFilename();
	#exit;
} 

$_GET['id'] = $_GET['id']; # No eliminar esta linea
form_manager_flex($tabla, $prefijo = "frm_");


?>
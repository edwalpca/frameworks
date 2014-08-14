<?php 
/************************************************ 
Purpose: Upload file class 
*************************************************/ 
class FileUpload{ 
    var $diraddition = ""; //Gets added to $uploaddir, helpful when using hosting services 
    var $tmpfile; //Temporary Filename 
    var $filename; //File Name 
    var $originalfilename; //Original File Name 
    var $filelocation; //File Location 
    var $afiletypes = array(); //File types allowed to be uploaded 
    var $abadfiletypes = array(); //Files types not allowed to be uploaded 
    var $extension; //Extension type of file 
    var $err = ""; //Current Error 
    var $maxfilesize = ""; //You can define here as a constant and/or set through SetMaxFileSize function in the class (stored as bytes) 
    var $filesize; //File size of uploaded file 
    var $overwrite = ""; //overwrite if file already exists 

    function FileUpload(){ 
    } 

    function SetFileType($ext){ 
        $this->afiletypes[] = $ext; 
    } 

    function SetBadFileType($ext){ 
        $this->abadfiletypes[] = $ext; 
    } 

    function SetMaxFileSize($maxsize){ 
        $this->maxfilesize = $maxsize; 
    } 
     
    function SetOverwrite($ow){ 
        $this->overwrite = $ow; 
    } 

    function UploadFile($input, $uploaddir, $newfilename){ 
        $i = TRUE; 
        set_time_limit(600); 
		$md5_file =  md5_file($_FILES[$input]['tmp_name']);
		$this->tmpfile = $_FILES[$input]['tmp_name']; 
        $this->originalfilename = $_FILES[$input]['name']; 
        $this->extension = strtolower(strstr($this->originalfilename, '.')); 
        if(count($this->afiletypes) > 0){ 
            $i = array_search($this->extension, $this->afiletypes); 
            if($i === FALSE){ 
                $this->err .= "File type is not allowed!<br>"; 
            } 
        } 
        if(count($this->abadfiletypes) > 0){ 
            $i = array_search($this->extension, $this->abadfiletypes); 
            if($i === TRUE){ 
                $this->err .= "File type had been blocked!<br>"; 
            } 
        } 
        #$this->filename = $newfilename . $this->extension; 
        $this->filename = $md5_file . $this->extension; 
		$newfilename = $md5_file; 
		if($newfilename != ''){ 
            $this->filelocation = $uploaddir . $newfilename . $this->extension; 
        }else{ 
            $this->filelocation = $uploaddir . $this->originalfilename; 
        } 
        if(file_exists($this->filelocation) && $this->overwrite=='N'){ 
            $this->err .= "This filename already exists in " . $uploaddir . " and cannot be overwritten!<br>"; 
        } 
        
		
		$srcfile = $diraddition . $uploaddir . $newfilename . $this->extension; 
        if($this->err == ''){ 
                if (is_uploaded_file($this->tmpfile)){ 
                if (!copy($this->tmpfile,$srcfile)){ 
                    $this->err .= "Error Uploading File!<br>"; 
                }else{ 
                    $this->filesize = filesize($srcfile); 
                    if($this->maxfilesize != ''){ 
                        if($this->filesize > $this->maxfilesize){ 
                            $this->err .= "File size is greater than allowable max. file size (" . $this->maxfilesize . " bytes)<br>"; 
                            unlink($srcfile); 
                        } 
                    } 
                } 
                } 
        } 
        unlink($this->tmpfile); 
    } 

    function GetExtension(){ 
        return $this->extension; 
    } 

    function GetFilename(){ 
        return $this->filename; 
    } 

    function GetOriginalFilename(){ 
        return $this->originalfilename; 
    } 

    function GetFileLocation(){ 
        return $this->filelocation; 
    } 

    function GetFilesize(){ 
        return $this->filesize; 
    } 

    function GetFileTypes(){ 
        return implode(", ", $this->afiletypes); 
    } 

    function GetBadFileTypes(){ 
        return implode(", ", $this->abadfiletypes); 
    } 

    function GetError(){ 
        return $this->err; 
    } 
         
} 
?><?php 
/* Example.
include('i_upload.cls.php'); 

<html> 
<body> 

if($_FILES['userfile']['name']!=''){ 
    $file = new FileUpload(); 
    $file->SetFileType(".jpg"); 
    echo "Allowable File Types: " . $file->GetFileTypes() . "<br>"; 
    $file->SetBadFileType(".png"); 
    echo "Unacceptable File Types: " . $file->GetBadFileTypes() . "<br>"; 
    $file->SetMaxFileSize("10000"); 
    $file->UploadFile("userfile", "../cache/",""); 
	echo "FileSize: " . $file->GetFileSize() . "<br>"; 
    echo "Extension: " . $file->GetExtension() . "<br>"; 
    echo "Filename: " . $file->GetFilename() . "<br>"; 
    echo "Error: " . $file->GetError() . "<br>"; 
} 
?> 
<form enctype="multipart/form-data" action="" method="post"> 
    Choose a file to upload: <input name="userfile" type="file"><br> 
    <input type="submit" value="Upload File">&nbsp;&nbsp;<input type="button" value="Cancel" OnClick="Reset();"> 
</form> 
</body> 
</html>
*/
?>
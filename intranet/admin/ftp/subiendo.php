<?php
$fileName=$_FILES['archivo']['name'];
$extension = end(explode('.',$fileName)); 

set_time_limit(0);
if(!empty($_FILES["archivo"]))
{
	if($extension=="pdf")
	{
		include("inc/ftp-pdf.php");
		$file = $_FILES["archivo"]["tmp_name"];
		$base_archivo = basename($_FILES["archivo"]["name"]);
		$id_ftp=ConectarFTP();
		$ruta=ObtenerRuta();
		
		$lista=ftp_nlist($id_ftp, $ruta); //Devuelve un array con los nombres de ficheros
		$item=array_pop($lista); //Se leen todos los ficheros y directorios del directorio
		
		$num = 0;
		$name = $base_archivo;
		$extension = end(explode('.',$base_archivo));
		$onlyName = substr($base_archivo,0,strlen($base_archivo)-(strlen($extension)+1));
		error_reporting(0);
		while(ftp_get($id_ftp, $name, $name, FTP_BINARY))
		{
			$num++;
			$name = $onlyName."".$num.".".$extension;
		}
				
		$uploadFile=$name;
		$upload = ftp_put($id_ftp, $uploadFile, $file, FTP_BINARY);
		
		if (!$upload) {
			echo "Error al guardar: " . $base_archivo; 
		} else {
			echo "Exito al gaurdar: " . $base_archivo; 
		}
		
		unset($_FILES["archivo"]);
		ftp_quit($id_ftp);
	}elseif($extension=="doc" or $extension=="docx")
	{
		include("inc/ftp-word.php");
		$file = $_FILES["archivo"]["tmp_name"];
		$base_archivo = basename($_FILES["archivo"]["name"]);
		$id_ftp=ConectarFTP();
		$ruta=ObtenerRuta();
		
		$lista=ftp_nlist($id_ftp, $ruta); //Devuelve un array con los nombres de ficheros
		$item=array_pop($lista); //Se leen todos los ficheros y directorios del directorio
		
		$num = 0;
		$name = $base_archivo;
		$extension = end(explode('.',$base_archivo));
		$onlyName = substr($base_archivo,0,strlen($base_archivo)-(strlen($extension)+1));
		
		while(ftp_get($id_ftp, $name, $name, FTP_BINARY))
		{
			$num++;
			$name = $onlyName."".$num.".".$extension; 
		}
				
		$uploadFile=$name;
		$upload = ftp_put($id_ftp, $uploadFile, $file, FTP_BINARY);
		
		if (!$upload) {
			echo "Error al guardar: " . $base_archivo; 
		} else {
			echo "Exito al gaurdar: " . $base_archivo; 
		}

		unset($_FILES["archivo"]);
		ftp_quit($id_ftp);
	}elseif ($extension=="jpg" or $extension=="jpeg" or $extension=="gif" or $extension=="png")
	{
		include("inc/ftp-imagen.php");
		$file = $_FILES["archivo"]["tmp_name"];
		$base_archivo = basename($_FILES["archivo"]["name"]);
		$id_ftp=ConectarFTP();
		$ruta=ObtenerRuta();
		
		$lista=ftp_nlist($id_ftp, $ruta); //Devuelve un array con los nombres de ficheros
		$item=array_pop($lista); //Se leen todos los ficheros y directorios del directorio
		
		$num = 0;
		$name = $base_archivo;
		$extension = end(explode('.',$base_archivo));
		$onlyName = substr($base_archivo,0,strlen($base_archivo)-(strlen($extension)+1));
		
		while(ftp_get($id_ftp, $name, $name, FTP_BINARY))
		{
			$num++;
			$name = $onlyName."".$num.".".$extension; 
		}
				
		$uploadFile=$name;
		$upload = ftp_put($id_ftp, $uploadFile, $file, FTP_BINARY);
		
		if (!$upload) {
			echo "Error al guardar: " . $base_archivo; 
		} else {
			echo "Exito al gaurdar: " . $base_archivo; 
		}
		
		/*elseif($item<>$name)
		{
			echo "no existe<br/>";
			$num++;
			$name = $onlyName."".$num.".".$extension; 
			$uploadFile=$name;
			$upload = ftp_put($id_ftp, $uploadFile, $file, FTP_BINARY);
		}*/

		//unset($_FILES["archivo"]);
		//ftp_quit($id_ftp);
	}
}
?>
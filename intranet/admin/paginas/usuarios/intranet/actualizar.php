<?php
include ("../../../conexion/conexion.php");

// IMAGEN
if($_FILES['file']['name']!="")
{
	if(is_uploaded_file($_FILES['file']['tmp_name']))
	{ 
		$fileName=$_FILES['file']['name'];
		$uploadDir="../../../../imagenes/upload/";
		$uploadFile=$uploadDir.$fileName;
		$num = 0;
		$name = $fileName;
		$extension = end(explode('.',$fileName));     
		$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
		while(file_exists($uploadDir.$name))
		{
			$num++;         
			$name = $onlyName."".$num.".".$extension; 
		}
		$uploadFile = $uploadDir.$name; 
		move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);  
		$name;
	}
}else
{
	$name=$_POST["img-actual"];
	$name;
}

//DATOS USUARIO
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$usuario=$_POST["usuario"];
$email=$_POST["email"];
$clave=$_POST["clave"];

//PRIVILEGIOS USUARIO
$confidencial=$_POST["confidencial"];

//FORO
$asesores_legales=$_POST["asesores_legales"];
$auditores=$_POST["auditores"];
$consejo_directivo=$_POST["consejo_directivo"];
$contadores=$_POST["contadores"];
$defensa_gremial=$_POST["defensa_gremial"];
$gerencia_general=$_POST["gerencia_general"];
$oficiales_atencion=$_POST["oficiales_atencion"];
$oficiales_cumplimiento=$_POST["oficiales_cumplimiento"];
$rrhh=$_POST["rrhh"];
$ti=$_POST["ti"];
$unidades_riesgos=$_POST["unidades_riesgos"];
$cumplimiento_normativo=$_POST["cumplimiento_normativo"];

mysql_query("UPDATE ap_usuario_intranet SET clave='$clave', nombre='$nombre', apellidos='$apellidos', email='$email', foto='$name' WHERE usuario='". $_REQUEST["usuario"]."';",$conexion);

mysql_query("UPDATE ap_privilegio_user_intranet SET confidencial=$confidencial WHERE usuario='". $_REQUEST["usuario"]."';", $conexion);


//ACTUALIZAR
mysql_query("UPDATE ap_foro_permiso_usuario_intranet SET asesores_legales=$asesores_legales, auditores=$auditores, consejo_directivo=$consejo_directivo, contadores=$contadores, defensa_gremial=$defensa_gremial, gerencia_general=$gerencia_general, oficiales_atencion=$oficiales_atencion, oficiales_cumplimiento=$oficiales_cumplimiento, rrhh=$rrhh, ti=$ti, unidades_riesgos=$unidades_riesgos, cumplimiento_normativo=$cumplimiento_normativo WHERE usuario='$usuario';", $conexion);

if (mysql_errno()!=0)
{
	echo "<br>ERROR: <strong>". mysql_errno() . "</strong> - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>
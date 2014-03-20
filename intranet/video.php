<?php
session_start();
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");

//VARIABLES
$idnoticia=$_REQUEST["id"];
$tipo_pagina=$_REQUEST["tipo_pagina"];

if($tipo_pagina=="evento"){
	$rst_query=mysql_query("SELECT * FROM ap_eventos WHERE id=$idnoticia;", $conexion);
	$fila_query=mysql_fetch_array($rst_query);
}elseif($tipo_pagina=="capacitaciones"){
	$rst_query=mysql_query("SELECT * FROM ap_capac_docs WHERE id=$idnoticia;", $conexion);
	$fila_query=mysql_fetch_array($rst_query);
}elseif($tipo_pagina=="estadisticas"){
	$rst_query=mysql_query("SELECT * FROM ap_estadistica WHERE id=$idnoticia;", $conexion);
	$fila_query=mysql_fetch_array($rst_query);	
}elseif($tipo_pagina=="normas_legales"){
	$rst_query=mysql_query("SELECT * FROM ap_evaluacion WHERE id=$idnoticia;", $conexion);
	$fila_query=mysql_fetch_array($rst_query);	
}elseif($tipo_pagina=="pro_coop"){
	$rst_query=mysql_query("SELECT * FROM ap_proyectos WHERE id=$idnoticia;", $conexion);
	$fila_query=mysql_fetch_array($rst_query);	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Video: <?php echo $fila_query["taller"]; ?></title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
</head>

<body>
<object width="640" height="385"><param name="movie" value="http://www.youtube.com/v/<?php echo $fila_query["enlace_video"]; ?>&hl=es_ES&fs=1&rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/<?php echo $fila_query["enlace_video"]; ?>&hl=es_ES&fs=1&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="385"></embed></object>

</body>
</html>
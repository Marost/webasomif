<?php
session_start();
include("conexion/inactividad.php");
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
	$cons=mysql_query("SELECT online FROM ap_usuario_online", $conexion); 
	while($resultado=mysql_fetch_array($cons)) 
	$sumatoria+=$resultado["online"];	
?>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script type="text/javascript">
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
</script>
<div id="interior-sombra">
    <div id="barra-inferior">
        <div id="texto-footer-izq"><a href="javascript:;" onclick="MM_openBrWindow('condiciones.php','condicionesuso','scrollbars=yes,width=620,height=500')">Condiciones de Uso</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="archivos/bajando.php?archivo=manual-asomif.pdf">Manual de Uso</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="sugerencia-contacto.php">Sugerencias y Contacto</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:;" onclick="MM_openBrWindow('usuarios-conectados.php','usuarios','width=420,height=400')"><?php echo $sumatoria; ?> usuarios en línea</a></div>
        <div id="texto-footer-der">
        	Todos los derechos reservados 2010&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.grupo7peru.com/" title="Grupo7Peru" target="_blank">GRUPO 7 Perú</a>
        </div>
  </div>
</div>
<?php
include("conexion/conexion.php");
$url="usuarios-conectados.php";
$rst_query=mysql_query("SELECT * FROM ap_usuario_online WHERE online=1;", $conexion);
$num_registros=mysql_num_rows($rst_query);
		
$registros=20;	
$pagina=$_GET["pag"];
if (is_numeric($pagina))
$inicio=(($pagina-1)*$registros);
else
$inicio=0;
	
$rst_query=mysql_query("SELECT * FROM ap_usuario_online WHERE online=1 LIMIT $inicio, $registros;", $conexion);
$paginas=ceil($num_registros/$registros);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Usuarios Conectados</title>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div id="titulo-envio">
        <img src="imagenes/usuarios-conectados.jpg" width="420" height="84" />
</div>
    <div id="contenido-envio">
    <table width="95%" border="0" cellpadding="5" cellspacing="0">
          <tr>
            <td width="30%" align="center"><strong>USUARIO</strong></td>
            <td width="70%" align="center"><strong>NOMBRE Y APELLIDOS</strong></td>
  </tr>
  		<?php while($fila_query=mysql_fetch_array($rst_query)){ ?>
          <tr>
            <td align="center"><?php echo $fila_query["usuario"] ?></td>
            <td align="center">
            <?php
			$user=$fila_query["usuario"];
			$rst_query1=mysql_query("SELECT * FROM ap_usuario_intranet WHERE usuario='$user'", $conexion);
			$fila_query1=mysql_fetch_array($rst_query1);
			echo $fila_query1["nombre"]." ".$fila_query1["apellidos"];
			?>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="2" align="center">
<?php
	if (!isset($_GET["pag"]))
		$pag = 1;
	else
		$pag = $_GET["pag"];
		
	function paginar($actual, $total, $por_pagina, $enlace, $maxpags=0)
	{
		$total_paginas = ceil($total/$por_pagina);
		$anterior = $actual - 1;
		$posterior = $actual + 1;
		$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
		$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
		if ($actual>1)
		$texto = "<a href=\"$enlace$anterior\">Anterior</a> ";
		else
		$texto = "<b></b> ";
		if ($minimo!=1) $texto.= "... ";
		for ($i=$minimo; $i<$actual; $i++)
		$texto .= "<a href=\"$enlace$i\">$i</a> ";
		$texto .= "<b>$actual</b> ";
		for ($i=$actual+1; $i<=$maximo; $i++)
		$texto .= "<a href=\"$enlace$i\">$i</a> ";
		if ($maximo!=$total_paginas) $texto.= "... ";
		if ($actual<$total_paginas)
		$texto .= "<a href=\"$enlace$posterior\">Siguiente</a>";
		else
		$texto .= "<b></b>";
		return $texto;
	}
	echo paginar($pag, $num_registros, $registros, "$url?pag=", 5);
?>
            </td>
          </tr>
        </table>
</div>
</body>
</html>
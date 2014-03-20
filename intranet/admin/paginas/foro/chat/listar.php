<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");
header("Content-Type: text/html; charset=utf-8");

$cebra=1;
$url="listar.php";
$buscar=$_REQUEST["busqueda"];

	if ($_REQUEST["btnbuscar"]=="")
	{
		$rst_query=mysql_query("SELECT * FROM ap_foro_izq WHERE id>0 ORDER BY id DESC;", $conexion);
		$num_registros=mysql_num_rows($rst_query);
			
		$registros=20;	
		$pagina=$_GET["pag"];
		if (is_numeric($pagina))
		$inicio=(($pagina-1)*$registros);
		else
		$inicio=0;
		
		$rst_query=mysql_query("SELECT * FROM ap_foro_izq WHERE id>0 ORDER BY id DESC LIMIT $inicio, $registros;", $conexion);
		$paginas=ceil($num_registros/$registros);
	}
	
	//----------------------------------------------------------------------------------------------------------------------------	
	if ($num_registros==0)
	{
		if ($buscar!="")		
			$mensaje2="No hay registros con el nombre: <b>$buscar</b>";
		else
			$mensaje2="No hay registros en la base de datos";
	}
	
	
	//------- MENSAJE DE ERROR
	if($_REQUEST["mensaje"]==1)
	{
		$mensaje="El registro fue agregado exitosamente";
	}elseif($_REQUEST["mensaje"]==2)
			$mensaje="El registro fue modificado exitosamente";
	elseif($_REQUEST["mensaje"]==3)
			$mensaje="El registro fue eliminado exitosamente";
	elseif($_REQUEST["mensaje"]==4)
			$mensaje="Se ha producido un error al ingresar el nuevo registro";
	elseif($_REQUEST["mensaje"]==5)
			$mensaje="Se ha producido un error al modificar el registro";
	elseif($_REQUEST["mensaje"]==6)
			$mensaje="Se ha producido un error al eliminar el registro";	
		
?>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css">
<script type="text/javascript">
function eliminarComentario(comentario) {
if(confirm("¿Está seguro de borrar este comentario?")) {
	document.location.href="eliminar.php?id="+comentario;
	}
}
</script>
    <div id="contenido">
            	<div id="titulo_principal">
            	  <h2>Lista - Foro Chat</h2>
				</div><!-- FIN TITULO PRINCIPAL -->
                <div id="contenido_total">
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center"><p class="mensaje"><?php echo $mensaje; ?></p></td>
                    </tr>
                    <tr>
                      <td><table width="95%" align="center" cellpadding="5" cellspacing="0" id="cebreado-php">
                        <thead>
                          <tr class="titulo-campo">
                            <th width="20%">usuario</th>
                            <th width="70%">comentario</th>
                            <th width="10%" height="25" align="center">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while ($fila=mysql_fetch_array($rst_query)) {?>
                          <tr<?php echo alt($zebra); $zebra++; ?>>
                            <td width="20%"><p><?php echo $fila["usuario"]; ?></p></td>
                            <td width="70%"><p><?php echo $fila["mensaje"] ?></p></td>
                            <td width="10%" align="center"><a href="javascript:;" onclick="eliminarComentario(<?php echo $fila["id"] ?>)"><img src="../../../images/eliminar_16.png" width="16" height="16" border="0" title="Eliminar" /></a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="30" align="center">
					<?php 
						if ($_REQUEST["btnbuscar"]=="")
						{
							if (!isset($_GET["pag"]))
							$pag = 1;
							else
							$pag = $_GET["pag"];
							echo paginar($pag, $num_registros, $registros, "$url?pag=", 10);
						}
					?>
</td>
                    </tr>
                  </table>
    </div></div><!-- FIN PANEL DERECHA -->
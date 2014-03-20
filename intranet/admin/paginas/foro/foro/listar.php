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
		$rst_query=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;");
		$num_registros=mysqli_num_rows($rst_query);
			
		$registros=20;	
		$pagina=$_GET["pag"];
		if (is_numeric($pagina))
		$inicio=(($pagina-1)*$registros);
		else
		$inicio=0;
		
		$rst_query=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC LIMIT $inicio, $registros;");
		$paginas=ceil($num_registros/$registros);
	}
	
	//----------------------------------------------------------------------------------------------------------------------------
	//BUSQUEDA

	if ($_REQUEST["btnbuscar"]!="" || $_REQUEST["busqueda"]!="")
	{
		$rst_query=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE foro LIKE '%$buscar%' ORDER BY foro ASC;");
		$num_registros=mysqli_num_rows($rst_query);
		
		$registros=10;	
		$pagina=$_GET["pag"];
		if (is_numeric($pagina))
			$inicio=(($pagina-1)*$registros);
		else
			$inicio=0;
		
		$rst_query=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE foro LIKE '%$buscar%' ORDER BY foro ASC LIMIT $inicio, $registros;");
		$paginas=ceil($num_registros/$registros);
		
	}
	
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
function eliminarForo(foro, nombre) {
if(confirm("¿Está seguro de borrar el foro "+nombre+"?\nSe borraran los temas y comentarios publicados en este")) {
	document.location.href="eliminar-foro.php?id="+foro+"&nombre="+nombre;
	}
}
</script>
    <div id="contenido">
            	<div id="titulo_principal">
            	  <h2>Lista -  Foro</h2>
				</div><!-- FIN TITULO PRINCIPAL -->
                <div id="contenido_total">
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="30" colspan="2" align="center"><form id="form1" name="form1" method="get" action="listar.php">
                        <p>Buscar:
                          <input name="busqueda" type="text" id="busqueda" value="<?php echo $_GET["busqueda"]; ?>" />
                          <br />
                          <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" />
                        </p>
                      </form></td>
                    </tr>
                    <tr>
                      <td width="28%" height="30" align="center"><p><a href="form-agregar.php"><strong>Agregar Foro</strong></a></p></td>
                      <td width="72%" align="center"><span class="mensaje"><?php echo $mensaje; ?></span></td>
                    </tr>
                    <tr>
                      <td colspan="2"><table width="95%" align="center" cellpadding="5" cellspacing="0" id="cebreado-php">
                        <thead>
                          <tr class="titulo-campo">
                            <th width="50%" height="25">foro</th>
                            <th width="3%" height="25" align="center">Modificar</th>
                            <th width="3%" height="25" align="center">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while ($fila=mysqli_fetch_array($rst_query)){ ?>
                          <tr<?php echo alt($zebra); $zebra++; ?>>
                            <td width="50%"><p><strong class="up"><?php echo $fila["foro"]; ?></strong></p></td>
                            <td width="3%" align="center"><a href="form-modificar.php?id=<?php echo $fila["id"] ?>" target="mainFrame"><strong>Modificar</strong></a></td>
                            <td width="3%" align="center"><a href="javascript:;" onclick="eliminarForo(<?php echo $fila["id"] ?>, '<?php echo $fila["foro"]; ?>')"><img src="../../../images/eliminar_16.png" width="16" height="16" /></a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="30" colspan="2" align="center"><?php 
if ($_REQUEST["btnbuscar"]=="")
{
	if (!isset($_GET["pag"]))
	$pag = 1;
	else
	$pag = $_GET["pag"];
	echo paginar($pag, $num_registros, $registros, "$url?pag=", 10);
}
?>
                        <?php 
/*----------- PAGINACION CON SOLO DESTINO ------------------*/
if ($_REQUEST["btnbuscar"]!="" || $_REQUEST["busqueda"]!="")
{
	if (!isset($_GET["pag"]))
	$pag = 1;
	else
	$pag = $_GET["pag"];
	echo paginar2($pag, $num_registros, $registros, "$url?pag=", 10);
}
?></td>
                    </tr>
                    <tr>
                      <td height="30" colspan="2" align="center"><?php echo $mensaje2; ?></td>
                    </tr>
                  </table>
    </div></div><!-- FIN PANEL DERECHA -->
<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/funcion-paginacion.php");
header("Content-Type: text/html; charset=utf-8");

$user=$_SESSION["user"];
$cebra=1;
$url="listar.php";
$buscar=$_REQUEST["busqueda"];

	if ($_REQUEST["btnbuscar"]=="")
	{
		$rst_query=mysql_query("SELECT * FROM ap_usuario ORDER BY usuario ASC;", $conexion);
		$num_registros=mysql_num_rows($rst_query);
			
		$registros=20;	
		$pagina=$_GET["pag"];
		if (is_numeric($pagina))
		$inicio=(($pagina-1)*$registros);
		else
		$inicio=0;
		
		$rst_query=mysql_query("SELECT * FROM ap_usuario ORDER BY usuario ASC LIMIT $inicio, $registros;", $conexion);
		$paginas=ceil($num_registros/$registros);
	}
	
	//----------------------------------------------------------------------------------------------------------------------------
	//BUSQUEDA

	if ($_REQUEST["btnbuscar"]!="" || $_REQUEST["busqueda"]!="")
	{
		$rst_query=mysql_query("SELECT * FROM ap_usuario WHERE usuario LIKE '%$buscar%' ORDER BY usuario ASC;", $conexion);
		$num_registros=mysql_num_rows($rst_query);
		
		$registros=20;	
		$pagina=$_GET["pag"];
		if (is_numeric($pagina))
			$inicio=(($pagina-1)*$registros);
		else
			$inicio=0;
		
		$rst_query=mysql_query("SELECT * FROM ap_usuario WHERE usuario LIKE '%$buscar%' ORDER BY usuario ASC LIMIT $inicio, $registros;", $conexion);
		$paginas=ceil($num_registros/$registros);
		
	}
	
	if ($num_registros==0)
	{
		if ($buscar!="")		
			$mensaje2="No hay registros con el nombre de: <b>$buscar</b>";
		else
			$mensaje2="No hay registros en la base de datos";
	}
	
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
	
	//--------- CARGAR PRIVILEGIOS
	$rst_query2=mysql_query("SELECT * FROM ap_privilegio_user WHERE usuario='$user'", $conexion);
	$fila_query3=mysql_fetch_array($rst_query2);
	
?>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css">

<script type="text/javascript">
function eliminarUsuario(user) {
if(confirm("¿Está seguro de borrar este Usuario?")) {
	document.location.href="eliminar.php?usuario="+user;
	}
}
</script>

    <div id="contenido">
            	<div id="titulo_principal">
            	  <h2>Lista - Usuarios: Panel de Administración</h2>
				</div><!-- FIN TITULO PRINCIPAL -->
                <div id="contenido_total">
                  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="28%" height="30" colspan="2" align="center">
                      <form id="form1" name="form1" method="get" action="listar.php">
                          <p>Buscar:<input name="busqueda" type="text" id="busqueda" value="<?php echo $_GET["busqueda"]; ?>" />
                            <br>
                          <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" /></p>
</form></td>
                    </tr>
                    <tr>
                      <td width="20%" height="30" align="center"><p><a href="form-agregar.php"><strong>Agregar Usuario</strong></a></p></td>
                      <td width="80%" align="center"><span class="mensaje"><?php echo $mensaje; ?></span></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                      <table width="100%" align="center" cellpadding="5" cellspacing="0" id="cebreado-php">
            <thead>
                <tr class="titulo-campo">
                    <th width="20%" height="25">USUARIO</th>
                    <th width="60%" height="25">NOMBRE Y APELLIDO</th>
                    <?php if($fila_query3["modificar"]==1){ ?>
                    	<th width='10%' height='25' align='center'>Modificar</th>
					<?php }?>
					
					<?php if($fila_query3["eliminar"]==1){ ?>
                    	<th width='10%' height='25' align='center'>Eliminar</th>
					<?php }?>
                </tr>
            </thead>
            <tbody>
            	<?php while ($fila=mysql_fetch_array($rst_query)){ ?>
                <tr<?php echo alt($zebra); $zebra++; ?>>
                    <td width="20%"><p><?php echo $fila["usuario"]; ?></p></td>
                    <td width="60%"><p><?php echo $fila["nombre"]; ?> <?php echo $fila["apellidos"]; ?></p></td>
                    <?php if($fila_query3["modificar"]==1){ ?>
						<td width="10%" align="center">
                        	<a href="form-modificar.php?usuario=<?php echo $fila["usuario"]?>" target="mainFrame">
                            <strong>Modificar</strong></a></td>
					<?php }?>
					
					<?php if($fila_query3["eliminar"]==1){ ?>
                    	<td width="10%" align="center">
							<a href="javascript:;" onclick="eliminarUsuario('<?php echo $fila["usuario"]?>')">
									<img src="../../../images/eliminar_16.png" width="16" height="16" title="Eliminar" />
								</a></td>
					<?php } ?>
                </tr>
				<?php }?>
            </tbody>
                      </table>
                      
                      </td>
                    </tr>
                <tr>
                      <td height="30" colspan="2" align="center">
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
?>

                      </td>
                    </tr>
  <tr>
    <td height="30" colspan="2" align="center"><?php echo $mensaje2; ?></td>
  </tr>
                  </table>
</div></div><!-- FIN PANEL DERECHA -->
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
		$rst_query=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_temas WHERE id>0 ORDER BY foro ASC;", $conexion);
		$num_registros=mysql_num_rows($rst_query);
			
		$registros=20;	
		$pagina=$_GET["pag"];
		if (is_numeric($pagina))
		$inicio=(($pagina-1)*$registros);
		else
		$inicio=0;
		
		$rst_query=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_temas WHERE id>0 ORDER BY foro ASC LIMIT $inicio, $registros;", $conexion);
		$paginas=ceil($num_registros/$registros);
	}
	
	//------------------------------------------------------------------------------------------------//
	//BUSQUEDA

	if ($_REQUEST["btnbuscar"]!="" || $_REQUEST["busqueda"]!="")
	{
		$rst_query=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_temas WHERE tema_foro LIKE '%$buscar%' ORDER BY foro ASC;", $conexion);
		$num_registros=mysql_num_rows($rst_query);
		
		$registros=10;	
		$pagina=$_GET["pag"];
		if (is_numeric($pagina))
			$inicio=(($pagina-1)*$registros);
		else
			$inicio=0;
		
		$rst_query=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_temas WHERE tema_foro LIKE '%$buscar%' ORDER BY foro ASC LIMIT $inicio, $registros;", $conexion);
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
function eliminarTema(tema) {
if(confirm("¿Está seguro de borrar este Tema?\nSi borra este tema, tambien se borraran los comentarios de este")) {
	document.location.href="eliminar-tema.php?id="+tema;
	}
}
</script>

    <div id="contenido">
            	<div id="titulo_principal">
            	  <h2>Lista - Tema de Foro</h2>
				</div><!-- FIN TITULO PRINCIPAL -->
                <div id="contenido_total">
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="30" align="center"><form id="form1" name="form1" method="get" action="listar.php">
                        <p>Buscar:
                          <input name="busqueda" type="text" id="busqueda" value="<?php echo $_GET["busqueda"]; ?>" />
                          <br />
                          <input type="submit" name="btnbuscar" id="btnbuscar" value="Buscar" />
                        </p>
                      </form></td>
                    </tr>
                    <tr>
                      <td height="30" align="center"><p><span class="mensaje"><?php echo $mensaje; ?></span></p></td>
                    </tr>
                    <tr>
                      <td>
                      <table width="95%" align="center" cellpadding="5" cellspacing="0" id="cebreado-php">
                        <thead>
                          <tr class="titulo-campo">
                            <th width="60%" height="25">TEMAS</th>
                            <th width="20%" align="center">FORO</th>
                            <th width="10%" height="25" align="center">COMENTARIOS</th>
                            <th width="10%" height="25" align="center">Eliminar</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while ($fila=mysql_fetch_array($rst_query)){ ?>
                          <tr<?php echo alt($zebra); $zebra++; ?>>
                            <td width="60%"><p><strong class="texto-azul12-Arial"><?php echo stripslashes(htmlspecialchars($fila["tema_foro"])) ?></strong><br />
                            Creado por <strong><?php echo $fila["usuario"]; ?></strong> el <?php echo $fila["fecha2"]; ?>
                            </p></td>
                            <td width="20%" align="center">
                              <p>
                                <?php
							$foro=$fila["foro"];
							$rst_foro=mysql_query("SELECT * FROM ap_foro WHERE id=$foro", $conexion);
							$fila_foro=mysql_fetch_array($rst_foro);
							echo stripslashes(htmlspecialchars($fila_foro["foro"]));
							?>
                            </p></td>
                            <td width="10%" align="center"><a href="form-ver.php?id=<?php echo $fila["id"] ?>" target="mainFrame"><strong>Ver</strong></a></td>
                            <td width="10%" align="center"><a href="javascript:;" onclick="eliminarTema(<?php echo $fila["id"] ?>)"><img src="../../../images/eliminar_16.png" width="16" height="16" /></a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="30" align="center"><?php 
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
                      <td height="30" align="center"><?php echo $mensaje2; ?></td>
                    </tr>
                  </table>
    </div></div><!-- FIN PANEL DERECHA -->
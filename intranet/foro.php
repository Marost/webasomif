<?php
session_start();
include("conexion/inactividad.php");
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
include("admin/conexion/funciones.php");

$id=$_REQUEST["id"];

	$user=$_SESSION["user-asomif"];
	$rst_query=mysql_query("SELECT * FROM ap_privilegio_user_intranet WHERE usuario='$user';",$conexion);
	$fila_query=mysql_fetch_array($rst_query);

	
	//MENU FORO PRINCIPAL
	$rst_query2=mysql_query("SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;",$conexion);
	
	//TEMAS DEL FORO
	$rst_query3=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_temas WHERE foro=$id ORDER BY fecha DESC", $conexion);

	//TITULO DE FORO
	$rst_query4=mysql_query("SELECT * FROM ap_foro WHERE id=$id LIMIT 1", $conexion);
	$fila_query4=mysql_fetch_array($rst_query4);
	
	//PRIVILEGIOS FORO
	$rst_foro=mysql_query("SELECT * FROM ap_foro_permiso_usuario_intranet WHERE usuario='$user'", $conexion);
	$fila_foro=mysql_fetch_array($rst_foro);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet - Foro:<?php echo $fila_query4["foro"] ?></title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery-shadow.js" type="text/javascript"></script>
<script type='text/javascript'>
window.onload = function()
	{
		$("#contenido740").dropShadow({left: 0, top: 0, blur: 4, color:"#000"}); 
	}
</script>

</head>
<body id="content-principal">

<?php include("cabecera.php");?>

<div id="contenido">
	<div id="interior">
	  <div id="interior-sombra">
                <div id="panel-izq-menu">
                    <ul id="navmenu">
                        <li><a href="principal.php">INICIO</a></li>
                        <li><a href="consulta-legal.php">BLOG LEGAL</a></li>
                        <li><a href="estadistica.php">ESTADÍSTICAS</a></li>
                        <li><a href="eventos.php">EVENTOS Y ACTIVIDADES</a></li>
                    	<li><a href="#">Foros</a>
                            <ul>
                            	<?php while($fila_query2=mysql_fetch_array($rst_query2)){ ?>
                                	<?php if($fila_foro[$fila_query2["permisos"]]==1){ ?>
                                    	<li><a href="foro.php?id=<?php echo $fila_query2["id"] ?>"><?php echo $fila_query2["foro"] ?></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>                    	</li>
                        <li><a href="capacitaciones.php">MATERIAL DE CAPACITACIÓN</a></li>
                        <li><a href="evaluacion.php">NORMAS LEGALES</a></li>
                        <li><a href="proyectos-cooperacion.php">PROYECTOS DE COOPERACIÓN</a></li>
                    </ul>
                    <?php if($fila_query["confidencial"]==1){ ?>
						<ul id="confidencial">
						<li><a href="confidencial.php">Confidencial</a></li>
						</ul>
                    <?php } ?>
                    <ul id="navmenu2">
      					<li><a href="perfil-usuario.php">PERFIL DE USUARIO</a></li>
                    </ul>
                
	  </div>
              
              <div id="contenido740">
              	<table width="740" border="0" cellspacing="2" cellpadding="0">
                    <tr>
                      <td height="25" colspan="3" align="center" class="cabecera_foro"><?php echo $fila_query4["foro"] ?></td>
                    </tr>
                    <tr>
                      <td height="40" colspan="3" align="left"><a href="nuevo-tema.php?foro=<?php echo $fila_query4["id"] ?>"><img src="imagenes/icon-nuevo-tema.jpg" width="95" height="21" /></a>
                         </td>
                    </tr>
                    <tr>
                        <td width="50%" height="25" align="center" class="cabecera_foro">Comentarios</td>
                      <td width="35%" height="25" align="center" class="cabecera_foro">Último Mensaje</td>
                        <td width="15%" height="25" align="center" class="cabecera_foro">Mensajes</td>
                    </tr>
                   	<?php while($fila_query3=mysql_fetch_array($rst_query3)){ ?>
                        <tr>
                            <td width="50%" height="45" class="texto_foro-principal">
                            <span class="texto_negro14-Tahoma">
                            
                            <?php if($fila_query3["cerrado"]==1){ ?>
                           	<img src="imagenes/close.png" width="12" height="12" title="Tema cerrado" />
                            <?php } else{ ?>
                           		<img src="imagenes/check.png" width="12" height="12" title="Tema abierto" />
                            <?php } ?>
                            <a href="debate-foro.php?tema=<?php echo $fila_query3["id"] ?>&foro=<?php echo $fila_query3["foro"] ?>">
							<?php echo $fila_query3["tema_foro"] ?></a></span><br />
                            <span class="texto-negro12-MyriadProRegular">
                            Creado el <?php echo $fila_query3["fecha2"] ?> 
                            por </span>
                            <span class="texto-azul13-MyriadProRegular"><strong>
							<a href="javascript:;" onclick="MM_openBrWindow('enviar-correo.php?usuario=<?php echo $fila_query3["usuario"] ?>','enviarcorreo','width=420,height=570')" ><?php echo $fila_query3["usuario"] ?></a></strong></span></td>
                            <td width="35%" height="25" class="ult-mensaje_foro-principal">
                                <?php 
									$rst_query1=mysql_query("SELECT * FROM ap_foro_comentario WHERE tema_foro=".$fila_query3["id"]." ORDER BY id DESC LIMIT 1;", $conexion);
									$fila_query1=mysql_fetch_array($rst_query1);
                                    echo substr($fila_query1["comentario"],0,35)."...<br/>";
                                    echo "<strong>".$fila_query1["user"]."</strong>";
                                ?>
                            </td>
                            <td width="15%" height="25" align="center" class="mensajes_foro-principal">
								<?php
									$rst_query1_cant=mysql_query("SELECT * FROM ap_foro_comentario WHERE tema_foro=".$fila_query3["id"].";", $conexion);
									$num_query1_cant=mysql_num_rows($rst_query1_cant);
									echo $num_query1_cant; 
								?>
                            </td>
                    	</tr>
                    <?php } ?>
                    <tr>
                      <td height="0">&nbsp;</td>
                      <td height="25">&nbsp;</td>
                      <td height="25">&nbsp;</td>
                  </tr>
                </table>
              </div>
      <!-- FIN CONTENIDO INFO INTERES --><!-- FIN FORO -->
    
        </div><!-- FIN SOMBRA INTERIOR -->
	</div><!-- FIN INTERIOR -->
</div><!-- FIN CONTENIDO -->

<div id="inferior">
	<div id="interior">
    	<?php include("footer.php"); ?>
	</div>
</div>
</body>
</html>
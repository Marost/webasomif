<?php
session_start();
include("conexion/inactividad.php");
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
include("admin/conexion/funciones.php");

$tema=$_REQUEST["tema"];
$foro=$_REQUEST["foro"];
$url="debate-foro.php";

	//USUARIO
	$user=$_SESSION["user-asomif"];
	$rst_query=mysqli_query($conexion, "SELECT * FROM ap_privilegio_user_intranet WHERE usuario='$user';");
	$fila_query=mysqli_fetch_array($rst_query);
	
	//MENU FORO PRINCIPAL
	$rst_query2=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;");
	
	//MENSAJES FORO
	$rst_query5=mysqli_query($conexion, "SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_comentario WHERE tema_foro=$tema;");
	$num_registros=mysqli_num_rows($rst_query5);
		
	$registros=8;	
	$pagina=$_GET["pag"];
	if (is_numeric($pagina))
	$inicio=(($pagina-1)*$registros);
	else
	$inicio=0;
	
	$rst_query5=mysqli_query($conexion, "SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_comentario WHERE tema_foro=$tema LIMIT $inicio, $registros;");
	$paginas=ceil($num_registros/$registros);
	
	//TEMA FORO
	$rst_query3=mysqli_query($conexion, "SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM ap_foro_temas WHERE id=$tema");
	$fila_query3=mysqli_fetch_array($rst_query3);
	
	//FORO
	$rst_query4=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id=$foro");
	$fila_query4=mysqli_fetch_array($rst_query4);
	
	//PRIVILEGIOS FORO
	$rst_foro=mysqli_query($conexion, "SELECT * FROM ap_foro_permiso_usuario_intranet WHERE usuario='$user'");
	$fila_foro=mysqli_fetch_array($rst_foro);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet - Foro:<?php echo $fila_query4["foro"] ?>| Tema:<?php echo $fila_query3["tema_foro"] ?></title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery-shadow.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script src="admin/js/ckeditor.js" type="text/javascript"></script>
<script type="text/javascript" src="admin/js/adapters/jquery.js"></script>

<script type="text/javascript">
//<![CDATA[
	$(function()
	{
		var config = {
			toolbar:
			[
				['Bold', 'Italic', 'Underline', '-', 'Link', 'Unlink', 'RemoveFormat'],
				['UIColor']
			]
		};
		$('.jquery_ckeditor').ckeditor(config);
	});
//]]>
</script>

<script type='text/javascript'>
	window.onload = function()
	{
		$("#contenido740").dropShadow({left: 0, top: 0, blur: 4, color:"#000"}); 
	} 
</script>

<script type="text/javascript">
function cerrarForo(tema, foro) {
if(confirm("¿Está seguro de cerrar este Tema?")) {
	document.location.href="conexion/foro/cerrar-foro.php?tema="+tema+"&foro="+foro;
	}
}
</script>

<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
                            	<?php while($fila_query2=mysqli_fetch_array($rst_query2)){ ?>
                                	<?php if($fila_foro[$fila_query2["permisos"]]==1){ ?>
	                                    <li><a href="foro.php?id=<?php echo $fila_query2["id"] ?>"><?php echo $fila_query2["foro"] ?></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                    	</li>
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
                      <td height="25" colspan="2" align="center" class="cabecera_foro"><table width="100%" border="00" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="14%"><a href="foro.php?id=<?php echo $foro ?>"><img src="imagenes/btn-atras-foro.png" width="100" height="25" /></a></td>
                          <td width="72%" align="center"><?php echo $fila_query4["foro"] ?></td>
                          
                          <?php if($fila_query3["cerrado"]<>1){ ?>
							  <?php if($fila_query3["usuario"]==$_SESSION["user-asomif"]){ ?>
                              <td width="14%" align="center">
                                <a href="javascript:;" onclick="cerrarForo(<?php echo $fila_query3["id"]?>, <?php echo $fila_query4["id"]?>)">
                                <img src="imagenes/btn-cerrar-foro.png" width="100" height="25" /></a>
                              </td>
                              <?php } ?>
                          <?php } ?>
                          
                        </tr>
                      </table></td>
                  </tr>
                    <tr>
                    	<td height="25" colspan="2" class="tema-foro">
                        <span class="texto-azul13-MyriadProRegular">Tema:</span>
                        <span class="texto_negro14-Tahoma"> 
					  <?php echo $fila_query3["tema_foro"] ?></span></td>
                    </tr>
                    <tr>
                      <td colspan="2"><span class="texto-negro12-MyriadProRegular">Creado el <?php echo $fila_query3["fecha2"] ?> por </span><span class="texto-azul13-MyriadProRegular"><strong><?php echo $fila_query3["usuario"] ?></strong></span></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <?php while($fila_query5=mysqli_fetch_array($rst_query5)){ ?>
						
                    <tr>
                      <td colspan='2' valign='middle' class='cabecera-fecha-foro'><strong><?php echo $fila_query5['fecha2']." - ".$fila_query5['hora'] ?> </strong></td>
                  </tr>
                    <tr>
                      <td width='166' align='center' valign='top' class='datos-user-foro'>
					  	<p class='texto_negro12-Tahoma-bold'>
					
					<?php 
						$user=$fila_query5['user'];
						$rst_user=mysqli_query($conexion, "SELECT * FROM ap_usuario_intranet WHERE usuario='$user';");
						$fila_user=mysqli_fetch_array($rst_user);
					?>
						<a href="javascript:;" onclick="MM_openBrWindow('enviar-correo.php?usuario=<?php echo $fila_query3["usuario"] ?>','enviarcorreo','width=420,height=570')" >
						<?php echo $fila_user["nombre"]." ".$fila_user["apellidos"]?>
                        </a>
						</p>
                      	<div id='imagen-user-foro'>
                        <?php if($fila_query5["foto"]<>""){ ?>
                        	<img src='imagenes/upload/escala-100.php?imagen=<?php echo $fila_query5["foto"]; ?>' />
                        <?php }else{ ?>
                       	  <img src="imagenes/user.png" width="64" height="64" />
<?php } ?>
                        </div>
                      </td>
                      <td width='568' valign='middle' class='comment-foro-user'><?php echo $fila_query5['comentario'] ?>
					  <hr/>
					  
                      <?php if($fila_query5['archivo']<>""){ ?>
					  	<strong>Enlace de Archivo:</strong>
                        <a href="archivos/foro/bajando.php?f=<?php echo $fila_query5["archivo"] ?>">
							<?php echo $fila_query5["archivo"] ?></a>
                            <?php } ?>
					  </td>
                  </tr>
                    <tr>
                      <td colspan='2' align='center' valign='top'>&nbsp;</td>
                    </tr>
					<?php } ?>
                    <tr>
                      <td width="140" align="center" valign="top" class="paginacion">&nbsp;</td>
                      <td width="568" align="center" valign="top" class="paginacion"><?php
if (!isset($_GET["pag"]))
	$pag = 1;
else
	$pag = $_GET["pag"];
	
function paginar($actual, $total, $por_pagina, $enlace, $maxpags=0)
{
	$tema=$_REQUEST["tema"];
	$foro=$_REQUEST["foro"];
	$total_paginas = ceil($total/$por_pagina);
	$anterior = $actual - 1;
	$posterior = $actual + 1;
	$minimo = $maxpags ? max(1, $actual-ceil($maxpags/2)): 1;
	$maximo = $maxpags ? min($total_paginas, $actual+floor($maxpags/2)): $total_paginas;
	if ($actual>1)
	$texto = "<a href=\"$enlace$anterior&tema=$tema&foro=$foro\">Anterior</a> ";
	else
	$texto = "<b></b> ";
	if ($minimo!=1) $texto.= "... ";
	for ($i=$minimo; $i<$actual; $i++)
	$texto .= "<a href=\"$enlace$i&tema=$tema&foro=$foro\">$i</a> ";
	$texto .= "<b>$actual</b> ";
	for ($i=$actual+1; $i<=$maximo; $i++)
	$texto .= "<a href=\"$enlace$i&tema=$tema&foro=$foro\">$i</a> ";
	if ($maximo!=$total_paginas) $texto.= "... ";
	if ($actual<$total_paginas)
	$texto .= "<a href=\"$enlace$posterior&tema=$tema&foro=$foro\">Siguiente</a>";
	else
	$texto .= "<b></b>";
	return $texto;
}

	echo paginar($pag, $num_registros, $registros, "$url?pag=", 5);
?></td>
                    </tr>
                    <tr>
                    
                    <?php if($fila_query3["cerrado"]<>1){ ?>
                      <td colspan="2" align="center" valign="top">
                      <form action="conexion/foro/mensaje-foro-principal.php?id=<?php echo $fila_query3["id"]; ?>&foro=<?php echo $fila_query4["id"]; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="25" align="left" valign="middle" class="texto_negro12-Tahoma-bold">Participa dejando tu comentario<strong>
                              <input name="user-creador" type="hidden" id="user-creador" value="<?php echo $fila_query3["usuario"] ?>" />
                            </strong><strong>
                            <input name="tema-foro" type="hidden" id="tema-foro" value="<?php echo $fila_query3["tema_foro"] ?>" />
                            </strong><strong>
                            <input name="titulo-foro" type="hidden" id="titulo-foro" value="<?php echo $fila_query4["foro"] ?>" />
                            </strong><strong>
                            <input name="url-pagina" type="hidden" id="url-pagina" value=
							"<?php echo "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] ?>" />
                            </strong></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" class="texto_negro12-Tahoma-bold"><span id="sprytextarea1">
                              <label>
                                <textarea class="jquery_ckeditor" name="foro-principal" id="foro-principal" cols="60" rows="5"></textarea>
                              </label>
                            <span class="textareaRequiredMsg"></span></span></td>
                          </tr>
                          <tr>
                            <td height="35" align="left" valign="middle" class="texto_negro12-Tahoma-bold">Subir Archivo: 
                              <label for="archivo"></label>
                            <input type="file" name="archivo" id="archivo" />
                            <br />
                            <span class="texto-negro10-Arial">Peso maximo: 2Mb</span><br /></td>
                          </tr>
                          <tr>
                            <td height="40" align="left" valign="middle" class="texto_negro12-Tahoma-bold"><label>
                              <input name="boton_comentar" type="submit" class="boton_comentar_foro" id="boton_comentar" value="" />
                            </label></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </form></td>
                      <?php } ?>
                      
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
<script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
//-->
</script>
</body>
</html>
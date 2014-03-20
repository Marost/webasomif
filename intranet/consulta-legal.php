<?php
session_start();
include("conexion/inactividad.php");
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
include("admin/conexion/funciones.php");

	$url="consulta-legal.php";
	$user=$_SESSION["user-asomif"];
	$rst_query=mysql_query("SELECT * FROM ap_privilegio_user_intranet WHERE usuario='$user';",$conexion);
	$fila_query=mysql_fetch_array($rst_query);

	//FORO IZQUIERDA
	$rst_query1=mysql_query("SELECT * FROM ap_foro_izq WHERE foro=1 ORDER BY id DESC;", $conexion);
	
	//TEMA FORO PRINCIPAL
	$rst_query2=mysql_query("SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;",$conexion);
	
	//CONSULTAS LEGALES
	$rst_query3=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM  ap_consulta_legal WHERE id>0 ORDER BY id DESC;", $conexion);
	$num_registros=mysql_num_rows($rst_query3);
		
	$registros=4;	
	$pagina=$_GET["pag"];
	if (is_numeric($pagina))
	$inicio=(($pagina-1)*$registros);
	else
	$inicio=0;
	
	$rst_query3=mysql_query("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha2 FROM  ap_consulta_legal WHERE id>0 ORDER BY id DESC LIMIT $inicio, $registros;", $conexion);
	$paginas=ceil($num_registros/$registros);
	
	//PRIVILEGIOS FORO
	$rst_foro=mysql_query("SELECT * FROM ap_foro_permiso_usuario_intranet WHERE usuario='$user'", $conexion);
	$fila_foro=mysql_fetch_array($rst_foro);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet - Consulta Legal</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery-shadow.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<script type='text/javascript'>
	window.onload = function()
	{
		$("#contenido525, #panel-der-foro").dropShadow({left: 0, top: 0, blur: 4, color:"#000"}); 
	} 
</script>

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
                            	<?php while($fila_query2=mysql_fetch_array($rst_query2)){ ?>
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
                
	  </div><!-- FIN MENU IZQUIERDA -->
              
              <div id="contenido525">
                <p class="texto-negro15-MyriadProBold">BLOG LEGAL</p>
                <p>&nbsp;</p>
                <form action="conexion/formularios/consulta-legal.php" method="post" id="form-consulta">
                <table width="500" border="00" cellspacing="3" cellpadding="0">
                  <tr>
                    <td width="158" height="30" align="right" class="texto_negro12-Tahoma-bold"><p>Empresa:</p></td>
                    <td width="333">
                      <label for="empresa"></label>
                      <span id="sprytextfield1">
                      <input type="text" name="empresa" id="empresa" />
                      <span class="textfieldRequiredMsg"></span></span></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" class="texto_negro12-Tahoma-bold"><p>Cargo:</p></td>
                    <td><label for="cargo"></label>
                      <span id="sprytextfield2">
                      <input type="text" name="cargo" id="cargo" />
                    <span class="textfieldRequiredMsg"></span></span></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" class="texto_negro12-Tahoma-bold"><p>Persona de Contacto:</p></td>
                    <td><label for="persona"></label>
                      <span id="sprytextfield3">
                      <input type="text" name="persona" id="persona" />
                    <span class="textfieldRequiredMsg"></span></span></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" class="texto_negro12-Tahoma-bold"><p>Email:</p></td>
                    <td><label for="email"></label>
                      <span id="sprytextfield4">
                      <input type="text" name="email" id="email" />
                    <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" class="texto_negro12-Tahoma-bold"><p>Mensaje:</p></td>
                    <td><span id="sprytextarea1">
                      <textarea name="msj" id="msj" cols="25" rows="5"></textarea>
                    <span class="textareaRequiredMsg"></span></span></td>
                  </tr>
                  <tr>
                    <td height="30" colspan="2" align="center" valign="middle"><input type="submit" name="button" id="button" value="Enviar" /> <input type="reset" name="button2" id="button2" value="Restablecer" /></td>
                  </tr>
                </table>
                </form>
                <p>&nbsp;</p>
                <table width="500" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td class="texto-negro15-MyriadProBold">PREGUNTAS Y RESPUESTAS</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <?php while($fila_query3=mysql_fetch_array($rst_query3)){ ?>
                  <tr>
                    <td>
                        <div id="div-ancho100" class="cabecera-fecha-foro">
                            <strong>ID: <?php echo $fila_query3["id"]; ?></strong> | 
                            Por: <strong><a href="javascript:;" onclick="MM_openBrWindow('enviar-correo-email.php?email=<?php echo $fila_query3["email"] ?>','enviarcorreo','width=420,height=570')" ><?php echo $fila_query3["persona"]; ?></a></strong> el <strong><?php echo $fila_query3["fecha2"]; ?></strong>
                        	</div>
                    </td>
                  </tr>
                  <tr>
                    <td class="comment-foro-user">
                    	<?php if($fila_query3["respuesta"]==1){ ?>
                        	<div id="content-pregunta">
                            	<strong>Pregunta</strong><br />
                            	<?php 
								$identificador=$fila_query3["identificador"];
								$pregunta=mysql_query("SELECT * FROM ap_consulta_legal WHERE id=$identificador", $conexion);
								$fila_pregunta=mysql_fetch_array($pregunta);
								echo $fila_pregunta["mensaje"]; ?><br /><br />
                                <strong>Respuesta</strong><br />
                            <?php echo $fila_query3["mensaje"]; ?>
                            </div>
                        <?php }else echo $fila_query3["mensaje"]; ?>
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td align="center" class="paginacion">
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
                <p>&nbsp;</p>
              </div>
      <!-- FIN CONTENIDO INFO INTERES -->
              
<div id="panel-der-foro">
                <p>Chat:</p>
                <div id="div-ancho100-border2">
                <iframe src="chat/index.php" frameborder="0" scrolling="no" width="176" height="570"></iframe>
                </div>
        <!-- FIN CONTENIDO FORO --></div><!-- FIN FORO -->
    
        </div><!-- FIN SOMBRA INTERIOR -->
	</div><!-- FIN INTERIOR -->
</div><!-- FIN CONTENIDO -->

<div id="inferior">
	<div id="interior">
    	<?php include("footer.php"); ?>
	</div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
</script>
</body>
</html>
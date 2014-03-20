<?php
session_start();
include("conexion/inactividad.php");
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
include("admin/conexion/funciones.php");
header("Content-Type: text/html; charset=utf-8");

	$user=$_SESSION["user-asomif"];
	
	$rst_query5=mysql_query("SELECT * FROM ap_usuario_intranet WHERE usuario='$user';",$conexion);
	$fila_query5=mysql_fetch_array($rst_query5);
	
	//PRIVILEGIO USUARIO
	$rst_query=mysql_query("SELECT * FROM ap_privilegio_user_intranet WHERE usuario='$user';",$conexion);
	$fila_query=mysql_fetch_array($rst_query);

	//FORO IZQUIERDA
	$rst_query1=mysql_query("SELECT * FROM ap_foro_izq WHERE foro=1 ORDER BY id DESC;", $conexion);
	
	//DOCUMENTOS
	$rst_query2=mysql_query("SELECT * FROM ap_proyectos WHERE id>0 AND tipo='Documento' AND publicar=1 LIMIT 4", $conexion);
	
	//VIDEOS
	$rst_query3=mysql_query("SELECT * FROM ap_proyectos WHERE id>0 AND tipo='Video' AND publicar=1 LIMIT 4", $conexion);
	
	//TEMA FORO PRINCIPAL
	$rst_query4=mysql_query("SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;",$conexion);
	
	//PRIVILEGIOS FORO
	$rst_foro=mysql_query("SELECT * FROM ap_foro_permiso_usuario_intranet WHERE usuario='$user'", $conexion);
	$fila_foro=mysql_fetch_array($rst_foro);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet - Perfil de Usuario</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery-shadow.js" type="text/javascript"></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type='text/javascript'>
window.onload = function()
	{
		$("#contenido525, #panel-der-foro").dropShadow({left: 0, top: 0, blur: 4, color:"#000"}); 
	}
</script>

<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
                            	<?php while($fila_query4=mysql_fetch_array($rst_query4)){ ?>
                                	<?php if($fila_foro[$fila_query4["permisos"]]==1){ ?>
                                    	<li><a href="foro.php?id=<?php echo $fila_query4["id"] ?>"><?php echo $fila_query4["foro"] ?></a></li>
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
              
              <div id="contenido525">
              <div id="div-ancho100">
                <p>PERFIL DE USUARIO</p>
                <p>&nbsp;</p>
                <div id="TabbedPanels1" class="TabbedPanels">
                  <ul class="TabbedPanelsTabGroup">
                    <li class="TabbedPanelsTab" tabindex="0">Datos Personales</li>
                    <li class="TabbedPanelsTab" tabindex="0">Cambiar contraseña</li>
                  </ul>
                  <div class="TabbedPanelsContentGroup">
                    <div class="TabbedPanelsContent">
                      <form id="form1" name="form1" method="post" action="conexion/perfil_usuario/datos_personales.php">
                        <table width="490" border="0" cellpadding="5" cellspacing="0">
                          <tr>
                            <td width="99">&nbsp;</td>
                            <td width="371">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="right" class="texto-negro11-Arial"><p><strong>Nombre:</strong></p></td>
                            <td><label for="pu-nombre"></label>
                              <span id="sprytextfield1">
                              <input name="pu-nombre" type="text" id="pu-nombre" value="<?php echo $fila_query5["nombre"] ?>" />
                            <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                          </tr>
                          <tr>
                            <td align="right" class="texto-negro11-Arial"><p><strong>Apellidos:</strong></p></td>
                            <td><label for="pu-apellidos"></label>
                              <span id="sprytextfield2">
                              <input name="pu-apellidos" type="text" id="pu-apellidos" value="<?php echo $fila_query5["apellidos"] ?>" />
                            <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
                          </tr>
                          <tr>
                            <td align="right" class="texto-negro11-Arial"><p><strong>Email:</strong></p></td>
                            <td><label for="pu-email"></label>
                              <span id="sprytextfield3">
                              <input name="pu-email" type="text" id="pu-email" value="<?php echo $fila_query5["email"] ?>" />
                            <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg"></span></span></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Guardar cambios" /></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center">
                            	<div id="mensaje">
								<?php
									if($_REQUEST["mensaje"]==1){
										echo "Se produjo un error";
									} elseif($_REQUEST["mensaje"]==2){
										echo "Los datos fueron modificados satisfactoriamente";
									}
								?>
                                </div>
                            </td>
                          </tr>
                        </table>
                      </form>
                    </div>
                    <div class="TabbedPanelsContent">
                      <form id="form2" name="form2" method="post" action="conexion/perfil_usuario/cambio-clave.php">
                        <table width="490" border="0" cellpadding="5" cellspacing="0">
                          <tr>
                            <td width="120">&nbsp;</td>
                            <td width="350">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="right" class="texto-negro11-Arial"><p><strong>Contraseña:</strong></p></td>
                            <td><label for="textfield5"></label>
                              <input type="password" name="clave1" id="textfield5" /></td>
                          </tr>
                          <tr>
                            <td align="right" class="texto-negro11-Arial"><p><strong>Repetir contraseña:</strong></p></td>
                            <td><label for="textfield6"></label>
                              <span id="spryconfirm1">
                              <input type="password" name="clave2" id="textfield6" />
                            <span class="confirmRequiredMsg"></span><span class="confirmInvalidMsg">Las contraseñas no coinciden</span></span></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center"><input type="submit" name="button2" id="button2" value="Enviar" /></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </form>
                    </div>
                  </div>
                </div>
                <p>&nbsp;</p>
              </div>
        </div><!-- FIN CONTENIDO INFO INTERES -->
              
      <div id="panel-der-foro">
                <p>Chat:</p>
                <div id="div-ancho100-border2">
                  <iframe src="chat/index.php" frameborder="0" scrolling="no" width="176" height="570"></iframe>
                </div>
                <!-- FIN CONTENIDO FORO -->
	</div><!-- FIN FORO -->
    
        </div><!-- FIN SOMBRA INTERIOR -->
	</div><!-- FIN INTERIOR -->
</div><!-- FIN CONTENIDO -->

<div id="inferior">
	<div id="interior">
    	<?php include("footer.php"); ?>
	</div>
</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "textfield5");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email");
</script>
</body>
</html>
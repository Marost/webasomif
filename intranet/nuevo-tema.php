<?php
session_start();
include("conexion/inactividad.php");
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
include("admin/conexion/funciones.php");

$id=$_REQUEST["foro"];

	$user=$_SESSION["user-asomif"];
	$rst_query=mysqli_query($conexion, "SELECT * FROM ap_privilegio_user_intranet WHERE usuario='$user';");
	$fila_query=mysqli_fetch_array($rst_query);

	
	//MENU FORO PRINCIPAL
	$rst_query2=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;");
	
	//TITULO DE FORO
	$rst_query4=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id=$id LIMIT 1");
	$fila_query4=mysqli_fetch_array($rst_query4);
	
	//PRIVILEGIOS FORO
	$rst_foro=mysqli_query($conexion, "SELECT * FROM ap_foro_permiso_usuario_intranet WHERE usuario='$user'");
	$fila_foro=mysqli_fetch_array($rst_foro);
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
                            	<?php while($fila_query2=mysqli_fetch_array($rst_query2)){ ?>
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
                      <td height="25" align="center" class="cabecera_foro"><?php echo $fila_query4["foro"] ?></td>
                    </tr>
                    <tr>
                      <td height="25" align="left">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="25"><form id="form1" name="form1" method="post" action="conexion/foro/nuevo-tema.php?foro=<?php echo $fila_query4["id"] ?>">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="25" class="texto_negro12-Tahoma-bold">Nombre del Nuevo Tema:</td>
                          </tr>
                          <tr>
                            <td><label for="tema-foro"></label>
                            <textarea name="tema-foro" cols="80" id="tema-foro"></textarea></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><label>
                              <input type="image" src="imagenes/btn-crear-tema.jpg" />
                            </label></td>
                          </tr>
                        </table>
                      </form></td>
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
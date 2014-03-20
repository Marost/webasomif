<?php
session_start();
include("conexion/inactividad.php");
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
include("admin/conexion/funciones.php");

$user=$_SESSION["user-asomif"];
	$rst_query=mysql_query("SELECT * FROM ap_privilegio_user_intranet WHERE usuario='$user';",$conexion);
	$fila_query=mysql_fetch_array($rst_query);

	//FORO IZQUIERDA
	$rst_query1=mysql_query("SELECT * FROM ap_foro_izq WHERE foro=1 ORDER BY id DESC;", $conexion);
	
	//TEMA FORO PRINCIPAL
	$rst_query2=mysql_query("SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;",$conexion);
	
	//NOTICIAS
	$rst_query3=mysql_query("SELECT * FROM ap_noticias WHERE id>0 ORDER BY id DESC LIMIT 3;", $conexion);
	
	//PRIVILEGIOS FORO
	$rst_foro=mysql_query("SELECT * FROM ap_foro_permiso_usuario_intranet WHERE usuario='$user'", $conexion);
	$fila_foro=mysql_fetch_array($rst_foro);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery-shadow.js" type="text/javascript"></script>
<script type='text/javascript'>
	window.onload = function()
	{
		$("#contenido525, #panel-der-foro").dropShadow({left: 0, top: 0, blur: 4, color:"#000"}); 
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
              
              <table width="500" border="0" cellpadding="0" cellspacing="0">
                  <?php while($fila_query3=mysql_fetch_array($rst_query3)){ ?>
                  <tr>
                    <td width="205"><div id="imagen-noticia"><img src="imagenes/upload/escala-205.php?imagen=<?php echo $fila_query3["imagen"] ?>"  /></div></td>
                    <td><div id="contenido-noticia">
                <div class="texto-azul11-MyriadProBold" id="titulo-noticia">
					<?php echo $fila_query3["titulo"] ?>
                </div>
                        <div class="texto-negro11-Arial" id="descripcion-noticia"><?php echo $fila_query3["contenido"] ?></div>
                  </div></td>
                  </tr>
                  <tr>
                    <td colspan="2"><div id="espacio-hor500"></div></td>
                  </tr>
                  <?php } ?>
                </table>
        </div>
      <!-- FIN CONTENIDO INFO INTERES -->
              
<div id="panel-der-foro">
                <p>Chat:</p>
                <div id="div-ancho100-border2">
                <iframe src="chat/index.php" frameborder="0" scrolling="no" width="176" height="555"></iframe>
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
</body>
</html>
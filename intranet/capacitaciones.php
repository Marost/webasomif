<?php
session_start();
include("conexion/inactividad.php");
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
include("conexion/funciones.php");
include("admin/conexion/funciones.php");
header("Content-Type: text/html; charset=utf-8");
$pagina="Material de Capacitación";

	$url="capacitaciones.php";
	$user=$_SESSION["user-asomif"];
	$rst_query=mysqli_query($conexion, "SELECT * FROM ap_privilegio_user_intranet WHERE usuario='$user';");
	$fila_query=mysqli_fetch_array($rst_query);

	//FORO IZQUIERDA
	$rst_query1=mysqli_query($conexion, "SELECT * FROM ap_foro_izq WHERE foro=1 ORDER BY id DESC;");
	
	//DOCUMENTOS Y VIDEOS
	$rst_query2=mysqli_query($conexion, "SELECT * FROM ap_capac_docs WHERE id>0 AND publicar=1 ORDER BY id DESC LIMIT 5");
	$num_registros=mysqli_num_rows($rst_query2);
		
	$registros=4;	
	$pagina=$_GET["pag"];
	if (is_numeric($pagina))
	$inicio=(($pagina-1)*$registros);
	else
	$inicio=0;
	
	$rst_query2=mysqli_query($conexion, "SELECT * FROM ap_capac_docs WHERE id>0 AND publicar=1 ORDER BY id DESC LIMIT $inicio, $registros;");
	$paginas=ceil($num_registros/$registros);
	
	//VIDEOS
	//$rst_query2=mysqli_query($conexion, "SELECT * FROM ap_capac_docs WHERE id>0 AND tipo='Documento' AND publicar=1 ORDER BY id DESC LIMIT 4");
	//$rst_query3=mysqli_query($conexion, "SELECT * FROM ap_capac_docs WHERE id>0 AND tipo='Video' AND publicar=1 ORDER BY id DESC LIMIT 4");
	
	
	//TEMA FORO PRINCIPAL
	$rst_query4=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;");
	
	//PRIVILEGIOS FORO
	$rst_foro=mysqli_query($conexion, "SELECT * FROM ap_foro_permiso_usuario_intranet WHERE usuario='$user'");
	$fila_foro=mysqli_fetch_array($rst_foro);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet - Material de Capacitación</title>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery-shadow.js" type="text/javascript"></script>
<script type='text/javascript'>
window.onload = function()
	{
		$("#contenido525, #panel-der-foro").dropShadow({left: 0, top: 0, blur: 4, color:"#000"}); 
	}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
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
                            	<?php while($fila_query4=mysqli_fetch_array($rst_query4)){ ?>
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
                <p class="texto-negro15-MyriadProBold">MATERIAL DE CAPACITACIÓN</p>
                <p class="texto-negro11-Arial">Descargue material de los diversos cursos, seminarios, talleres y ponencias que realizamos durante todo el año a nivel nacional para la capacitación de nuestras asociadas. Compártalo entre los miembros de su institución. Remita información que considere pertinente difundirla.</p>
                <p>&nbsp;</p>
                </div>
                
                <?php while($fila_query2=mysqli_fetch_array($rst_query2)){ ?>
					<?php if($fila_query2["tipo"]=='Documento'){ ?>
                        <div id="documentos-pdf-doc">
                            <div id="icon-pdf-doc">
                            <?php if($fila_query2["extension"]='pdf'){ ?>
                                    <img src='imagenes/icon_pdf.png' width='40' height='46' />
                            <?php }elseif($fila_query2["extension"]='doc' or $fila_query2["extension"]='docx'){ ?>	
                                    <img src='imagenes/icon_word.png' width='40' height='46' />
                            <?php } ?>
                                
                              <div id="btn-descargar">
                              <form action="conexion/guardarDescarga.php" method="post" name="docs<?php echo $fila_query2["id"]; ?>" id="docs<?php echo $fila_query2["id"]; ?>">
                              <input name="" type="image" src="imagenes/btn-descargar.png" />
                              <input name="tipo" type="hidden" value="documento" />
                              <input name="enlace-descarga" type="hidden" id="enlace-descarga" value="<?php echo $fila_query2["nombre_archivo"]; ?>" />
                              <input name="titulo" type="hidden" id="titulo" 
                                value="<?php echo stripslashes(htmlspecialchars($fila_query2["taller"])); ?>" />
                              <input name="pagina" type="hidden" value="<?php echo $pagina; ?>" />
                              </form>
                              </div>
                            </div>
                        
                            <div id="datos-pdf-doc">
                                <div id="taller-fecha-pdf-doc">
                                <p class="texto-azul13-MyriadProRegular"><?php echo stripslashes(htmlspecialchars($fila_query2["taller"])); ?></p>
                                <p class="texto-negro12-MyriadProRegular"><?php echo stripslashes(htmlspecialchars($fila_query2["lugar_fecha"])) ?></p>
                                </div>
                                <div id="logo-pdf-doc">
                                <?php if($fila_query2["logo"]<>""){ ?>
                                    <img src="imagenes/upload/escala-100.php?imagen=<?php echo $fila_query2["logo"] ?>" />
                                    <?php } ?>
                                </div>
                                <div id="programa-pdf-doc">
                                <div id="div-ancho100" class="texto-negro10-Arial"><?php echo $fila_query2["programa"]; ?></div>
                                </div>                   
                            </div>
                        </div>
                        
                        <div id="espacio-hor500"></div>
                    <?php }elseif($fila_query2["tipo"]=='Video'){ ?>
                      <div id="documentos-pdf-doc">
                                <div id="icon-pdf-doc">
                                    <img src="imagenes/icon_youtube.png" width="40" height="46" />
                                    <div id="btn-descargar">
                                    <script type="text/javascript">
										function abrirVentana(theURL,winName,features){
										  window.open(theURL,winName,features);
										}
									</script>
                                    <form action="conexion/guardarDescarga.php?tipo_pagina=capacitaciones" method="post" id="video<?php echo $fila_query2["id"]; ?>" onsubmit="abrirVentana('video.php?id=<?php echo $fila_query2["id"]; ?>&tipo_pagina=capacitaciones','video','width=640,height=385')">>
                                    <input name="tipo" type="hidden" value="video" />
                                    <input name="" type="image" src="imagenes/btn-video.png" />
                                    <input name="idvideo" type="hidden" value="<?php echo $fila_query2["id"]; ?>" />
                                    <input name="titulo" type="hidden" id="titulo" 
                                        value="<?php echo stripslashes(htmlspecialchars($fila_query2["taller"])); ?>" />
                                    <input name="pagina" type="hidden" value="<?php echo $pagina; ?>" />
                                      </form>
                                    </div>
                                </div>
                                
                                <div id="datos-pdf-doc">
                                    <div id="taller-fecha-pdf-doc"> 
                                      <p class="texto-azul13-MyriadProRegular"><?php echo stripslashes(htmlspecialchars($fila_query2["taller"])); ?> </p>
                                      <p class="texto-negro12-MyriadProRegular"><?php echo stripslashes(htmlspecialchars($fila_query2["lugar_fecha"])) ?></p>
                                  </div>
                                      <div id="programa-pdf-doc">
                                        <div id="div-ancho100" class="texto-negro10-Arial"><?php echo $fila_query2["programa"]; ?></div>
                                    </div>
                                </div>
                </div>
                        <div id="espacio-hor500"></div>
                    <?php }} ?>
                <div id="div-ancho100"></div>
                    <div class="paginacion" id="div-ancho100">
                      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                          <td height="25" align="center">
                            <p>
                              <?php
							if (!isset($_GET["pag"]))
								$pag = 1;
							else
								$pag = $_GET["pag"];
							echo paginar($pag, $num_registros, $registros, "$url?pag=", 5);
						?>
                          </p></td>
                        </tr>
                      </table>
                    </div>
                    
      </div><!-- FIN CONTENIDO INFO INTERES -->
              
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

</body>
</html>
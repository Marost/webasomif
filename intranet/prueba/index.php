<?php
session_start();
include("../conexion/inactividad.php");
include("../conexion/conexion.php");
include("../conexion/verificar_sesion.php");
include("../admin/conexion/funciones.php");
header("Content-Type: text/html; charset=utf-8");
$pagina="Material de Capacitación";

	$user=$_SESSION["user-asomif"];
	$rst_query=mysqli_query($conexion, "SELECT * FROM ap_privilegio_user_intranet WHERE usuario='$user';");
	$fila_query=mysqli_fetch_array($rst_query);

	//FORO IZQUIERDA
	$rst_query1=mysqli_query($conexion, "SELECT * FROM ap_foro_izq WHERE foro=1 ORDER BY id DESC;");
	
	//DOCUMENTOS
	$rst_query2=mysqli_query($conexion, "SELECT * FROM ap_capac_docs WHERE id>0 AND tipo='Documento' AND publicar=1 ORDER BY id DESC LIMIT 4");
	
	//VIDEOS
	$rst_query3=mysqli_query($conexion, "SELECT * FROM ap_capac_docs WHERE id>0 AND tipo='Video' AND publicar=1 ORDER BY id DESC LIMIT 4");
	
	//TEMA FORO PRINCIPAL
	$rst_query4=mysqli_query($conexion, "SELECT * FROM ap_foro WHERE id>0 ORDER BY foro ASC;");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intranet - Material de Capacitación</title>
<link rel="stylesheet" type="text/css" href="../css/estilos.css"/>
<script src="../js/recarga.js" type="text/javascript"></script>
</head>
<body id="content-principal">

<div id="contenido">
	<div id="interior">
<div id="interior-sombra">
                
<div id="contenido525">
              <div id="div-ancho100">
                <p class="texto-negro15-MyriadProBold">MATERIAL DE CAPACITACIÓN</p>
                <p class="texto-negro11-Arial">Descargue material de los diversos cursos, seminarios, talleres y ponencias que realizamos durante todo el año a nivel nacional para la capacitación de nuestras asociadas. Compártalo entre los miembros de su institución. Remita información que considere pertinente difundirla.</p>
                <p>&nbsp;</p>
                </div>
                
                <?php while($fila_query2=mysqli_fetch_array($rst_query2)){ ?>
                <div id="documentos-pdf-doc">
                    <div id="icon-pdf-doc">
                    <?php if($fila_query2["extension"]='pdf'){ ?>
							<img src='../imagenes/icon_pdf.png' width='40' height='46' />
					<?php }elseif($fila_query2["extension"]='doc' or $fila_query2["extension"]='docx'){ ?>	
							<img src='../imagenes/icon_word.png' width='40' height='46' />
					<?php } ?>
                      <div id="btn-descargar">
                      <form action="../conexion/guardarDescarga.php" method="post" name="docs<?php echo $fila_query2["id"]; ?>" id="docs<?php echo $fila_query2["id"]; ?>">
                      <input name="" type="image" src="../imagenes/btn-descargar.png" />
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
                        <p class="texto-azul13-MyriadProRegular">
						<?php echo stripslashes(htmlspecialchars($fila_query2["taller"])); ?></p>
                        <p class="texto-negro12-MyriadProRegular">
						<?php echo stripslashes(htmlspecialchars($fila_query2["lugar_fecha"])) ?></p>
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
                <?php } ?>
                <?php while($fila_query3=mysqli_fetch_array($rst_query3)){ ?>
      <div id="documentos-pdf-doc">
          		<div id="icon-pdf-doc">
                	<img src="../imagenes/icon_youtube.png" width="40" height="46" />
                    <div id="btn-descargar">
                    <form action="../conexion/guardarDescarga.php" method="post" id="video<?php echo $fila_query3["id"]; ?>">
           	    <a href="#" title="<?php echo utf8_encode($fila_query3["taller"]); ?>" onclick="MM_openBrWindow('video.php?id=<?php echo $fila_query3["id"]; ?>','video','width=640,height=385')">
	                <input name="tipo" type="hidden" value="video" />
                    <input name="" type="image" src="../imagenes/btn-video.png" />
                    <input name="idvideo" type="hidden" value="<?php echo $fila_query3["id"]; ?>" />
                    <input name="titulo" type="hidden" id="titulo" 
                      	value="<?php echo stripslashes(htmlspecialchars($fila_query3["taller"])); ?>" />
                    <input name="pagina" type="hidden" value="<?php echo $pagina; ?>" />
                        </a>
                        </form>
                    </div>
                </div>
                
                <div id="datos-pdf-doc">
                	<div id="taller-fecha-pdf-doc"> 
                	  <p class="texto-azul13-MyriadProRegular"><?php echo stripslashes(htmlspecialchars($fila_query3["taller"])); ?> </p>
                	  <p class="texto-negro12-MyriadProRegular"><?php echo stripslashes(htmlspecialchars($fila_query3["lugar_fecha"])) ?></p>
               	  </div>
                      <div id="programa-pdf-doc">
                        <div id="div-ancho100" class="texto-negro10-Arial"><?php echo $fila_query3["programa"]; ?></div>
                    </div>
                </div>
        </div>
        <div id="espacio-hor500"></div>
        <?php } ?>
        </div><!-- FIN CONTENIDO INFO INTERES --><!-- FIN FORO -->
    
        </div><!-- FIN SOMBRA INTERIOR -->
	</div><!-- FIN INTERIOR -->
</div><!-- FIN CONTENIDO -->

</body>
</html>
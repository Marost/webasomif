<?php
session_start();
include("conexion/verificar_sesion.php");
include("conexion/conexion.php");

$user=$_SESSION["user"];

$rst_query=mysqli_query($conexion, "SELECT * FROM ap_privilegio_user WHERE usuario='$user';");
$fila_query=mysqli_fetch_array($rst_query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex" />
<title>Administración de Contenido</title>

<link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	//Menu desplegable
	$("#menu ul li ul").hide();	
	$("#menu ul li span.current").addClass("open").next("ul").show();
	$("#menu ul li span").click(function(){	
		$(this).next("ul").slideToggle("slow").parent("li").siblings("li").find("ul:visible").slideUp("slow");
		$("#menu ul li").find("span").removeClass("open");
		$(this).addClass("open");
	});

});
</script>
</head>

<body>
<div id="menu">
        <h3>Administrar</h3>
  <div id="datos-usuario">
        	Usuario: <strong><?php echo $_SESSION["user"]; ?></strong><br />
        	Nombre: <strong><?php echo $_SESSION["user_nombre"]; ?> <?php echo $_SESSION["user_apellido"]; ?></strong><br /><br />
	  <a href="conexion/salir.php" target="_top"><strong>Cerrar sesión</strong></a>
    </div>
        <ul>
        	<?php if($fila_query["capacitaciones"]==1){ ?>
            <li><span <?php if($p == "categorias"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-info">Noticias</a></span>
                <ul>
                    <li><a href="paginas/noticias/form-agregar.php" target="mainFrame" class="add">Agregar</a></li>
                    <li><a href="paginas/noticias/listar.php" target="mainFrame" class="list">Listar</a></li>
                </ul>
            </li>
            <?php } ?>
        	<?php if($fila_query["capacitaciones"]==1){ ?>
            <li><span <?php if($p == "categorias"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-info">Capacitaciones</a></span>
                <ul>
                    <li><a href="paginas/capacitaciones/docs/listar.php" target="mainFrame" class="list">Documentos</a></li>
                    <li><a href="paginas/capacitaciones/video/listar.php" target="mainFrame" class="list">Video</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["capacitaciones"]==1){ ?>
            <li><span <?php if($p == "categorias"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-estadisticas">Estadisticas</a></span>
                <ul>
                    <li><a href="paginas/estadisticas/docs/listar.php" target="mainFrame" class="list">Documentos</a></li>
                    <li><a href="paginas/estadisticas/video/listar.php" target="mainFrame" class="list">Video</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["evaluacion"]==1){ ?>
            <li><span <?php if($p == "categorias"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-evaluacion">Normas Legales</a></span>
                <ul>
                    <li><a href="paginas/evaluacion/docs/listar.php" target="mainFrame" class="list">Documentos</a></li>
                    <li><a href="paginas/evaluacion/video/listar.php" target="mainFrame" class="list">Video</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["evaluacion"]==1){ ?>
            <li><span <?php if($p == "categorias"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-evaluacion">Eventos y Actividades</a></span>
                <ul>
                    <li><a href="paginas/eventos/docs/listar.php" target="mainFrame" class="list">Documentos</a></li>
                    <li><a href="paginas/eventos/video/listar.php" target="mainFrame" class="list">Video</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["proyectos"]==1){ ?>
            <li><span <?php if($p == "categorias"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-proyectos">Proyectos de Cooperación</a></span>
                <ul>
                    <li><a href="paginas/proyectos/docs/listar.php" target="mainFrame" class="list">Documentos</a></li>
                    <li><a href="paginas/proyectos/video/listar.php" target="mainFrame" class="list">Video</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["confidencial"]==1){ ?>
            <li><span <?php if($p == "categorias"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-confidencial">Confidencial</a></span>
                <ul>
                    <li><a href="paginas/confidencial/docs/listar.php" target="mainFrame" class="list">Documentos</a></li>
                    <li><a href="paginas/confidencial/video/listar.php" target="mainFrame" class="list">Video</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["foro"]==1){ ?>
            <li><span <?php if($p == "multimedia"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-foro">Foro</a></span>
                <ul>
                    <li><a href="paginas/foro/foro/listar.php" target="mainFrame" class="list">Foro</a></li>
                    <li><a href="paginas/foro/tema/listar.php" target="mainFrame" class="list">Temas</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["consultas"]==1){ ?>
            <li><span <?php if($p == "multimedia"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-consulta">BLog Legal</a></span>
              <ul>
                    <li><a href="paginas/consultas-legales/listar.php" target="mainFrame" class="list">Listar</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["sugerencia"]==1){ ?>
            <li><span <?php if($p == "multimedia"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-sugerencia">Sugerencia y Contacto</a></span>
                <ul>
                    <li><a href="paginas/sugerencia-contacto/listar.php" target="mainFrame" class="list">Listar</a></li>
                </ul>
            </li>
            <?php } ?>
            <?php if($fila_query["usuarios"]==1){ ?>
            <li><span <?php if($p == "opciones"){echo 'class="current"';} ?>><a href="javascript:void(0);" id="link-usuarios">Usuarios</a></span>
                <ul>
                    <li><a href="paginas/usuarios/intranet/listar.php" target="mainFrame" class="list">Intranet</a></li>
                    <li><a href="paginas/usuarios/administracion/listar.php" target="mainFrame" class="list">Panel de Administración</a></li>
                    <li><a href="http://webstats.motigo.com/s?id=4788021" target="mainFrame" class="list">Contador de Visitas</a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>
</div>
    <!--/menu-->
</body>
</html>

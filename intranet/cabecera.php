<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<div id="superior">
	<div id="interior">
	    <div id="interior-sombra">
            <div id="barra-superior">
                <div id="logo-superior"><img src="imagenes/logo-asomif316x55.png" width="235" height="49" /></div>
          <div id="titulo-principal"><h1>Red Privada Virtual de las IMFs</h1></div>
                <div id="user-superior">
                    <p><span class="texto-blanco15-MyriadProBold"><strong>Usuario: </strong></span><span class="texto-blanco15-MyriadProRegular"><?php echo $_SESSION["user-asomif"]; ?></span></p>
                    <br />
                    <p><a href="conexion/salir.php"><img src="imagenes/btn-salir.png" name="salir" width="80" height="24" border="0" id="salir" /></a></p>
</div>
                <div id="fecha"><?php $hoy = fecha(); echo $hoy; ?></div>
          </div><!-- FIN BARRA SUPERIOR -->
        </div><!-- FIN INTERIOR -->
	</div>
</div><!-- FIN SUPERIOR -->
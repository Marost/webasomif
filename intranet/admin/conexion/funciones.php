<?php
	function fecha(){
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
		$dia = date(j); // devuelve el día del mes
		$dia2 = date(w); // devuelve el número de día de la semana
		$mes = date(n)-1; // devuelve el número del mes
		$ano = date(Y); // devuelve el año
		$fecha = $dia." de ".$meses[$mes]." de ".$ano;
		return $fecha;
	}
	
	function alt ($cebra) {
	if ($cebra/2 == floor($cebra/2)) {
		return ' class="alt"';
	} else {
		return '';
	}
}

function codigoAleatorio($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
{
	$source = 'abcdefghijklmnopqrstuvwxyz';
	if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if($n==1) $source .= '1234567890';
	if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
	if($length>0){
		$rstr = "";
		$source = str_split($source,1);
		for($i=1; $i<=$length; $i++){
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1,count($source));
			$rstr .= $source[$num-1];
		}

	}
	return $rstr;
}
?>
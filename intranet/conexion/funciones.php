<?php
function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
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

?>
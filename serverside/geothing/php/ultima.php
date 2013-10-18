<?php
$conexion = mysqli_connect('localhost','root','*********','geothing');
if ($conexion) {
	if ($ejecucion0 = mysqli_query($conexion,"SELECT la,lo,f FROM g ORDER BY id DESC LIMIT 1")) {
		$fila = mysqli_fetch_row($ejecucion0);
		$la = $fila[0];
		$lo = $fila[1];
		$f = str_replace('-','',$fila[2]);
		$f = str_replace(' ','',$f);
		$f = str_replace(':','',$f);
		mysqli_free_result($ejecucion0);
	}
	mysqli_close($conexion);
}
?>

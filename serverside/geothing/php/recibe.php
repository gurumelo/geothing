<?php
if(isset($_POST) && isset($_POST['latitud']) && isset($_POST['longitud']) && isset($_POST['llave']) && count($_POST) == 3) {
	$la = htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_POST['latitud'])))));
	$lo = htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_POST['longitud'])))));
	$llave = htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_POST['llave'])))));
	
	if ($la != NULL && $lo != NULL && $llave != NULL && is_numeric($la) && is_numeric($lo) && hash('sha256', $llave) == '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4') {
		
		$conexion = mysqli_connect('localhost','root','*********','geothing');
		if ($conexion) {
			$la = mysqli_real_escape_string($conexion, $la);
			$lo = mysqli_real_escape_string($conexion, $lo);
			if ($ejecucion0 = mysqli_query($conexion, "INSERT INTO g(la, lo, f) VALUES(". $la .", ". $lo .", now())")) {
				echo 1;
			}
			else {
				echo 2;
			}
			mysqli_close($conexion);
			
		}
		else {
			echo 2;
		}
	}
	else {
		echo 2;
	}
}
?>

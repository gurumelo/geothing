<?php
if (isset($_POST) && isset($_POST['f']) && !empty($_POST['f']) && count($_POST) == 1) {
	$f = htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_POST['f'])))));
	if (is_numeric($f)) {
		$conexion = mysqli_connect('localhost','root','********','geothing');
		if ($conexion) {
			$f = mysqli_real_escape_string($conexion, $f);
			if ($ejecucion0 = mysqli_query($conexion, "SELECT la,lo,f FROM g WHERE f>". $f ." ORDER BY id DESC LIMIT 1")) {
				if (mysqli_num_rows($ejecucion0) == 1) {
					$json = array();
					$actual = mysqli_fetch_row($ejecucion0);
					$json[] = $actual;
					echo json_encode($json);
					mysqli_free_result($ejecucion0);
				}
				else {
					echo 2;
				}
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
}
?>

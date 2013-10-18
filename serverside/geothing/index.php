<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
	<style type="text/css">
		html,body {
			margin: 0 auto;
			padding: 0;
			width: 100%;
			height: 100%;
			text-align: center;
		}
		#contenedor {
			position: relative;
		}
		#contenedor, #map {
			width: 100%;
			height: 100%;
			background: #b5d0d0;
		}
	</style>
	<link rel="stylesheet" href="l/leaflet.css" />
</head>
<body>
	<div id="contenedor">
		<div id="map"></div>
	</div>
	<?php require_once('php/ultima.php'); ?>
	<script src="l/leaflet.js"></script>
	<script src="js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript">
		var ultimaactualizacion = <?php echo $f; ?>;
		var map = L.map('map').setView([<?php echo $la .", ". $lo; ?>], 17);
		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: ' <a href="http://openstreetmap.org">OpenStreetMap</a>'
		}).addTo(map);
		var marker = L.marker([<?php echo $la .", ". $lo; ?>]).addTo(map);

		function actualizaGlobito(coneltiempodentro) {
			$.ajax({
				dataType: 'json',
				type: 'POST',
				cache: false,
				url: 'php/tiemporeal.php',
				data: { f: coneltiempodentro }
			}).done( function(devuelta) {
				if (devuelta != 2) {
					// ultima actualizacion refrescar, mover marca y setinterval
					ultimaactualizacion = devuelta[0][2].replace(/-/g, '');
					ultimaactualizacion = ultimaactualizacion.replace(' ', '');
					ultimaactualizacion = ultimaactualizacion.replace(/:/g, '');
					marker.setLatLng([devuelta[0][0], devuelta[0][1]]);
					map.panTo([devuelta[0][0], devuelta[0][1]]);
					//console.log('prueba: '+ devuelta[0][0] +' '+ devuelta[0][1] +' '+ devuelta[0][2]);
				}
			});
		}

		lasvuertas = setInterval(function(){ actualizaGlobito(ultimaactualizacion); }, 5000);
	</script>
</body>
</html>

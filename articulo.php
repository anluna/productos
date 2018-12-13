<?php 
	
	$conexion = new mysqli('localhost','root','','almacen');
	
		if (isset($_POST['claveArtic'])) {
			$clave_ar = $_POST['claveArtic'];
			$consulta = "SELECT concepto, medida, categoria FROM cat_articulo WHERE clave_ar = '$clave_ar'";

			// var_dump($consulta);

			$result = $conexion->query($consulta);
			
			$respuesta = new stdClass();
			if($result->num_rows > 0){
				$fila = $result->fetch_array();
				$respuesta->concepto = $fila['concepto'];
				$respuesta->medida = $fila['medida'];
				$respuesta->categoria = $fila['categoria'];
			}
			echo json_encode($respuesta);
		}
?>			

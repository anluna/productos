<?php 
	if (isset($_GET['term'])) { // evaluar var 
		$clave_art = $_GET['term'];

		$conexion = new mysqli('localhost', 'root', '', 'almacen');
		$con = "SELECT * FROM cat_articulo WHERE clave_ar LIKE '%$clave_art%'"; // nombre de var 

		$result = $conexion->query($con);

		$response = []; // declarar var

		if ($result->num_rows > 0) {
			while ($fila = $result->fetch_array()) {
				$response[] = $fila['clave_ar'];
			}
			echo json_encode($response);
		}
	}
?>	

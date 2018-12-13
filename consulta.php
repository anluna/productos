<?php 

 	class Consulta{
 		private $conexion;
 			function __construct(){
 				require_once('../productos/conexion2.php');
 					$this->conexion = new conexion();
 			}
 			function lista_arti($valor){
 				$sql = "SELECT c.clave_ar, c.concepto, c.medida, c.categoria, SUM(e.existencia) AS exist_suma FROM cat_articulo c LEFT JOIN existencias e ON c.clave_ar = e.clave_ar";
 				$con=$this->conexion->conectar();

 				$result=$con->query($sql);
		
 				$arreglo = array();
				
				while ($res=$result->fetch_assoc()) {
					$arreglo[] = $res;
				}

 				return $arreglo;
 			} 		
 	}
 	header("content-Type: application/json");
 	$prueba = new Consulta;
 	$results = $prueba->lista_arti(null);
 	print_r(json_encode($results));

 ?>

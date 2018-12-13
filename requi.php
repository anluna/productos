<!DOCTYPE html>
<html>
<head>
	<title>Ingreso de Productos</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

		<link href="../productos/jquery-ui/jquery-ui.css" type="text/css" rel="stylesheet"/>
</head>

<body>
	<form action="requi.php" method="post">
		<label for="clave_ar">Clave del Articulo</label>
			<input type="text" name="clave_ar" id="clave_ar">
			<div id="dv-response"></div>
			<br> <br> <br> 
		<label>Nombre de quien registra</label>
			<input type="text" name="nombre">
		<label>Cantidad que solicita</label>
			<input type="text" name="cantidad">
		<label>Clave de Unidad</label>
			<input type="type" name="unidad">
		<button type="sumbit" name="registra" id="registra">
		Aceptar</button>
	</form>

<?php 
	class Articulo{
		private $conexion;
		function __construct()
		{
			require_once('../productos/conexion.php'); 
			$this->conexion = new conexion();
		}
		function listar_articulos($valor){ 
			$sql= "SELECT * FROM cat_articulo"; 
			$con = $this->conexion->conectar();
			$resultado=$con->query($sql);	
			$arreglo = array();
			while ($res=$resultado->fetch_assoc()) {
				$arreglo[] = $res;
			}
			return json_encode($arreglo, JSON_FORCE_OBJECT);
		}
		function agregar_articulos($sql_insert){
			$con = $this->conexion->conectar();
			$resultado=$con->query($sql_insert);
			return $resultado;
		}
	}
	$inst = new Articulo();
	$arr=$inst->listar_articulos('tica');
	//print_r($arr);

	if(isset($_POST["clave_ar"])) {
		$sql_insert = "INSERT INTO requi (nombre, cantidad, clave_ar, clave_unia) VALUES ('".$_POST["nombre"]."', '".$_POST["cantidad"]."', '".$_POST["clave_ar"]."','".$_POST["unidad"]."')";
		var_dump($sql_insert);
		$arr=$inst->agregar_articulos($sql_insert);
		//echo "<script>alert(".$arr.")</script>";
	}
?>


<script type="text/javascript">
		$(document).ready(function(){
			$( "#clave_ar" ).autocomplete({
				source : "buscador.php",
				minLength: 2,
				select:(e, ui)=>{// 
					$.ajax({
						url:'articulo.php',
						type:'POST',
						dataType:'json',
						data:{ claveArtic:ui.item.value },
					}).done(function(respuesta){

						// $("#dv-response").append(); // añade
						$("#dv-response").html(`
							<p><strong>Concepto :</strong>`+respuesta.concepto+`</p>
							<p><strong>Medida :  
						</strong>`+respuesta.medida+`</p>
							<p><strong>Categoria :</strong>`+respuesta.categoria+`</p>
						`); // reemplaza

					});
				}
			});
		});
	</script>
		<script type="text/javascript">
		var alerta = JSON.stringify('Registrado');
		alert(alerta);
		</script>

</body>
</html>

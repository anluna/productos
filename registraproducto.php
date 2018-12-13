<!DOCTYPE html>
<html>
<head>
	<title>Ingreso de Productos</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<link href="../productos/jquery-ui/jquery-ui.css" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="../productos/estilo.css">
</head>

<body>
	<form action="registroproducto.php" method="post">
	<label class="titulo" for="clave_ar">Clave del Articulo</label>
	<input type="text" name="clave_ar" id="clave_ar">
	<div id="dv-response"></div>
		<br> <br> <br> 
	<label>Fecha de Caducidad</label>
				<input type="date" name="fecCaduce" id="fecCaduce">
				<br>
			<label>Precio</label>
				<input type="number"  min="0.00" max="10000.00" step="0.01" name="precio" id="precio">
				<br>
			<label>Cantidad</label>
				<input type="text" name="cantidad" id="cantidad">
				<br>
			<label>Fecha de Ingreso</label>
				<input type="date" name="fecIngreso" id="fecIngreso">
			<br>
			<button class="regis" type="submit" name="registrar" id="registrar">Aceptar</button>
	</form>

<?php 
	class Articulo{
		private $conexion;
		function __construct()
		{
			require_once('../productos/conexion2.php'); 
			$this->conexion = new conexion();
		}
		function listar_articulos($valor){ 
			$sql= "SELECT * FROM existencias"; 
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
		$sql_insert = "INSERT INTO existencias (fec_caducidad, precio, cantidad, existencia, fec_ingreso, clave_ar) VALUES ('".$_POST["fecCaduce"]."','".$_POST["precio"]."','".$_POST["cantidad"]."','".$_POST["cantidad"]."','".$_POST["fecIngreso"]."','".$_POST["clave_ar"]."')";
		$arr=$inst->agregar_articulos($sql_insert);
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

						$("#dv-response").html(`
							<p><strong>Concepto :</strong>`+respuesta.concepto+`</p>
							<p><strong>Medida :  
						</strong>`+respuesta.medida+`</p>
							<p><strong>Categoria :</strong>`+respuesta.categoria+`</p>
						`); 

					});
				}
			});
		});
	</script>
	<script type="text/javascript">
		swal("Registrado");
		alert(alerta);
		</script>
</body>
</html>

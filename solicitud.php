<!DOCTYPE html>
<html>
<head>
	<title>SOLICITUDES</title>
</head>
<body>
	<form action="solicitud.php" method="post">
		<h2>Lista de Productos</h2>
			<table>
				   	<tr>
				   		<th> &nbsp; </th>
				   		<th> Concepto</th>
						<th> Medida</th>
						<th> Categoria</th>
						<th> Cantidad</th>
						<th> Clave Unidad</th>
				   	</tr>
<?php 
	class Articu{
		private $conexion;
		function __construct()
		{
			require_once('../productos/conexion2.php');
			$this->conexion = new conexion();
		}
		function mostrar($valor){
			$sql = "SELECT clave_ar, concepto, medida, categoria FROM cat_articulo";
			$con = $this->conexion->conectar();
			$result = $con->query($sql);
			$arreglo = array();
		while ($row=$result->fetch_assoc()) {
			$arreglo[] = $row;

	?>
		<tr>
		<td>
		<input type="checkbox" name="clave_ar" value="<?php echo $row['clave_ar']; ?>" /></td>
		<td><?php echo $row['concepto']; ?></td>
		<td><?php echo $row['medida']; ?></td>
		<td><?php echo $row['categoria']; ?></td>
		<th><input type="text" name="cantidad"></th>
		<th><input type="text" name="clave"></th>
		</tr>
<?php
}	
}
		function registrar($sql_insert){
			$con = $this->conexion->conectar();
			$result = $con->query($sql_insert);
			return $result;
		}
	}
	$inst = new Articu();
	$arr=$inst->mostrar('tica');
	

?>
	</table>
	<input type="submit" name="solicitado" value="Registrar" />
	</form>
</body>
</html>		
<?php 
	if (isset($_POST["clave_ar"])) {

	$sql_insert = "INSERT INTO requi (estatus, cantidad, clave_ar, clave_unia) VALUES ('solicitado', '".$_POST["cantidad"]."','".$_POST["clave_ar"]."', '".$_POST["clave"]."') "; 
		$arr=$inst->registrar($sql_insert);

		echo "Se actualizo correctamente";   
	}
?>

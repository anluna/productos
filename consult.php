<!DOCTYPE html>
<html>
<head>
	<title>Consultas de Productos</title>
	

	<link rel="stylesheet" type="text/css" href="https://limepay.mx/sistema/vendor/datatables/jquery.dataTables.min.css">
<script src="https://limepay.mx/sistema/vendor/datatables/jquery-3.3.1.js" ></script>
<script src="https://limepay.mx/sistema/vendor/datatables/jquery.dataTables.min.js" ></script>

</head>

<body>	
	<div class="container">
		<h2>Consultas</h2>
		  <table id="my-example">

		</table>
	</div>
</body>
	<script type="text/javascript">

		$(document).ready(function(){
			$.ajax({
				url:'cons.php',
				type:'post',
				success:(result)=>{

					var dataSet = [];

					$.each(result, (i, v)=>{

						dataSet.push([v.clave_ar, v.concepto, v.medida, v.categoria, v.exist_suma ]);
						
					});
					
					console.log(dataSet);

    			$('#my-example').DataTable( {
        data: dataSet,
        columns: [
        	{ title: "Clave Articulo", data:0},
            { title: "Concepto", data:1 },
            { title: "Medida", data:2 },
            { title: "Categoria", data:3 },
          	{ title: "Existencia", data:4 }
          //	{ title: "Existencia", data:5},
        ]
    	} );
    		}
    	})
			
	});
	</script>
	</script>
</html>

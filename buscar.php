<link href="estilo.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="jquery.jqplot.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.jqplot.js"></script>
<script type="text/javascript" src="jqplot.pieRenderer.js"></script>
<!--<link rel="stylesheet" type="text/css" href="bootstrap.css">-->

<?php

require('conexion.php');

$consultaBusqueda = $_POST["valorBusqueda"];

$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

$mensaje = "";

if (isset($consultaBusqueda)) {
	$consulta = mysqli_query($conexion, "SELECT nombre,calorias,carbohidratos,grasas,proteinas FROM alimentos
	WHERE nombre COLLATE UTF8_SPANISH_CI LIKE '$consultaBusqueda'");

$filas = mysqli_num_rows($consulta);

if ($filas === 0) {
		$mensaje = '<p class="mensaje">No hay ningún alimento con ese nombre</p>';
	}

while($resultados = mysqli_fetch_array($consulta)) {
			$nombre = $resultados['nombre'];
			$calorias = $resultados['calorias'];
			$carbohidratos = $resultados['carbohidratos'];
			$grasas = $resultados['grasas'];
			$proteinas = $resultados['proteinas'];

			$mensaje .= 
			'
			<script>
			$(document).ready(function(){ 
    var s1 = [["Carbohidratos",' . $carbohidratos . '], ["Grasas",' . $grasas . '], ["Proteinas",' . $proteinas . ']];
         
    var plot8 = $.jqplot("grafico", [s1], {
    	title: "<strong>' . $nombre . '</strong><br>Contiene ' . $calorias . ' calorias",
        grid: {
            drawBorder: false, 
            drawGridlines: false,
            background: "#ffffff",
            shadow:false
        },
        axesDefaults: {
             
        },
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer,
            rendererOptions: {
                showDataLabels: true
            }
        },
        legend: {
            show: true,
            rendererOptions: {
                numberRows: 1
            },
            location: "s",
            marginTop: "15px"
        }
    }); 
});
</script>
		<p id="grafico"></p>
    '
	;

		};

	};
echo $mensaje;
?>

			<!--'
			<br><br>
			<div id="contenedor_tabla">
			<table>
			<thead>
			<tr>
			<th>
			<strong>Nombre</strong>
			</th>
			<th>
			<strong>Calorias</strong>
			</th>
			<th>
			<strong>Carbohidratos</strong>
			</th>
			<th>
			<strong>Grasas</strong>
			</th>
			<th>
			<strong>Proteinas</strong>
			</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td id="nom_alimento"><strong>' . $nombre . '</strong></td>
			<td>' . $calorias . '</td>
			<td>' . $carbohidratos . '%' . '</td>
			<td>' . $grasas . '%' . '</td>
			<td>' . $proteinas . '%' . '</td>
			</tr>
			</tbody> 
			</table>
			</div>
			'-->
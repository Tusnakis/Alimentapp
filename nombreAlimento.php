<?php

require('conexion.php');

$consultaBusqueda = $_GET['term'];

$consulta = "SELECT nombre FROM alimentos WHERE nombre COLLATE UTF8_SPANISH_CI LIKE '$consultaBusqueda%'";

$result = $conexion->query($consulta);
 
if($result->num_rows > 0){
    while($fila = $result->fetch_array()){
        $nombres[] = $fila['nombre'];
    }
echo json_encode($nombres);
}
?>
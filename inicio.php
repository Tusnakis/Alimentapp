<html>
<head>
	<meta http-equiv="conten-type" content="text/html; charset=UTF-8" />
	<link href="estilo.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="jquery-ui.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Calculo de alimentos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script>

		$(document).ready(function(){
    		$("#busqueda").autocomplete({
      			source: "nombreAlimento.php",
     			 minLength: 1
    		});
    	});

		$(document).ready(function() {
			$("#resultadoBusqueda").html("<p></p>");
		});
		function buscar() {
			var textoBusqueda = $("input#busqueda").val();

			if(textoBusqueda != "") {
				$.post("buscar.php",{valorBusqueda: textoBusqueda}, function(mensaje) {
					$("#resultadoBusqueda").html(mensaje);
				});
			} else {
				$("#resultadoBusqueda").html("<p></p>");
			};
		};

		function cargar() {
			document.getElementById("busqueda").focus();
		}

	</script>
</head>
<body onload="cargar()">
	<div id="div_vacio"></div>
	<div id="contenedor">
		<h1 id="titulo">Cual es el valor nutricional de los alimentos</h1>
		<br>
			<h2 id="subtitulo">Introduce aquí un alimento:</h2>
			<br>
			<form accept-charset="utf-8" method="post">
			<br>
            	<div class="input-group" id="input-group">
                	<input type="text" class="form-control" name="busqueda" id="busqueda" maxlength="20" size="5" autocomplete="off" placeholder="Buscar&hellip;"/>
                		<span class="input-group-btn">
                    <button type="button" id="botonBuscar" class="btn btn-default" onclick="buscar();"><span class="glyphicon glyphicon-search" id="search"></span></button>
                </span>
            </div>
				<!--<input type="text" name="busqueda" id="busqueda" maxlength="20" autocomplete="off" onkeydown="if(event.keyCode == '13') buscar();"/>
				<input type="button" value="Buscar" id="botonBuscar" onclick="buscar();"/>-->
			</form>
			<div id="resultadoBusqueda"></div>
	</div>
</body>
</html>

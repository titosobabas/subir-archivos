<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Formulario</title>
</head>
<body>
	<p>Formulario para subir múltiples archivos con Codeigniter</p>
	<form action="subir-archivos" enctype="multipart/form-data" method="POST">
		<label for="">Seleccione archivos:</label><br>
		<input type="file" name="archivos[]" id="archivos" accept="*" multiple required><br><br>
		<button type="submit">Enviar archivos</button>
	</form>
</body>
</html>

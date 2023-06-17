<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>proyectoFinal</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<body>
		<div class="container">
			<h2>Formulario de Registro</h2>
			<form action="" method="POST">
				<label for="nombre">Nombre:</label>
				<input type="text" id="nombre" name="nombre" required>

				<label for="apellido1">Primer Apellido:</label>
				<input type="text" id="apellido1" name="apellido1" required>

				<label for="apellido2">Segundo Apellido:</label>
				<input type="text" id="apellido2" name="apellido2" required>

				<label for="email">Email:</label>
				<input type="email" id="email" name="email" required>

				<label for="login">Login:</label>
				<input type="text" id="login" name="login" required>

				<label for="password">Password:</label>
				<input type="password" id="password" name="password" required>

				<input type="submit" value="Registrar">

				<?php
				if ($_POST) {
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "proyectoFinal";

					// Establecer conexión a la base de datos
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("Error al conectar con la base de datos: " . $conn->connect_error);
					}

					// Obtener los valores del formulario
					$nombre = $_POST["nombre"];
					$apellido1 = $_POST["apellido1"];
					$apellido2 = $_POST["apellido2"];
					$email = $_POST["email"];
					$login = $_POST["login"];
					$password = $_POST["password"];

					// Validar el formato del correo electrónico
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						die("El correo electrónico no tiene un formato válido.");
					}

					// Validar la longitud de la contraseña
					if (strlen($password) < 4 || strlen($password) > 8) {
						die("La contraseña debe tener entre 4 y 8 caracteres.");
					}

					// Consultar si el correo electrónico ya existe en la base de datos
					$sql = "SELECT * FROM USUARIO WHERE EMAIL = '$email'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						die("El correo electrónico ya está registrado.");
					}

					// Insertar los datos en la tabla USUARIO
					$sql = "INSERT INTO USUARIO (NOMBRE, APELLIDO1, APELLIDO2, EMAIL, LOGIN, PASSWORD) 
        			VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password')";
					if ($conn->query($sql) === TRUE) {
						echo "Registro completado con éxito";
					} else {
						echo "Error al registrar los datos: " . $conn->error;
					}

					$conn->close();
				}
				?>
			</form>
		</div>
	</body>
</body>

</html>